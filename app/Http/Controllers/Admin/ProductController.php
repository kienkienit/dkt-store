<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
        $products = $this->productService->paginateProducts($request->input('page', 1));

        if ($request->ajax()) {
            return response()->json([
                'products' => view('partials-admin.products', compact('products'))->render()
            ]);
        }

        return view('admin.manage_products', compact('products'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $this->productService->createProduct($data);

        return json_response(true, ['success' => 'Sản phẩm đã được thêm thành công!']);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->only(['name', 'description', 'image', 'category_id']);
        $this->productService->updateProduct($id, $data);

        return json_response(true, ['message' => 'Sản phẩm đã được cập nhật thành công!']);
    }

    public function delete($id)
    {
        $this->productService->deleteProduct($id);
        return json_response(true, ['message' => 'Sản phẩm đã được xóa thành công!']);
    }
}
