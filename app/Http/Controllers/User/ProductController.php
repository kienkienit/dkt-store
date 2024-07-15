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
        $products = $this->productService->getProductsByCategory($categoryId, $perPage);
        return response()->json($products);
    }

    public function getHotProductsByCategory($categoryId)
    {
        $hotProducts = $this->productService->getHotProductsByCategory($categoryId);
        return json_response(true, $hotProducts);
    }
}
