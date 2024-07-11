<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('pages.product_detail', compact('product'));
    }

    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request->all());
        return redirect()->route('products.index');
    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->all());
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('products.index');
    }

    public function getByCategory($categoryId)
    {
        $products = $this->productService->getProductsByCategory($categoryId);
        return response()->json($products);
    }

    public function getHotProductsByCategory($categoryId)
    {
        $hotProducts = $this->productService->getHotProductsByCategory($categoryId);
        return response()->json($hotProducts);
    }
}
