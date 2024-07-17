<?php

namespace App\Http\Controllers\Admin;

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

    public function index(Request $request)
    {
        $products = $this->productService->paginateProducts($request->input('page', 1), 4);
        if ($request->ajax()) {
            return response()->json([
                'products' => view('partials-admin.products', compact('products'))->render()
            ]);
        }
        return view('admin.manage_products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|string'
        ]);

        $data = $request->all();
        $this->productService->createProduct($data);

        return response()->json(['success' => 'Sản phẩm đã được thêm thành công!']);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|string'
        ]);

        $data = $request->all();
        $this->productService->updateProduct($id, $data);

        return response()->json(['success' => 'Sản phẩm đã được cập nhật thành công!']);
    }

    public function delete($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['success' => 'Sản phẩm đã được xóa thành công!']);
    }
}
