<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('user.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $product->load('variants');
        $firstVariant = $product->variants->first();
        $initialPrice = $firstVariant ? $firstVariant->price : $product->price;
        return view('pages.product_detail', compact('product', 'initialPrice'));
    }

    public function getByCategory($categoryId)
    {
        $perPage = request()->query('per_page', 8);
        $page = request()->query('page', 1);
        $products = $this->productService->getProductsByCategory($categoryId, $perPage, $page);
        $pagination = $products->toArray();
        
        if (request()->ajax()) {
            return response()->json([
                'products' => view('partials.product_list', compact('products'))->render(),
                'pagination' => view('partials.pagination', ['pagination' => $pagination])->render(),
            ]);
        }
    
        return view('partials.products', compact('products', 'pagination'));
    }

    public function getHotProductsByCategory($categoryId)
    {
        $hotProducts = $this->productService->getHotProductsByCategory($categoryId);
        return json_response(true, $hotProducts);
    }
}
