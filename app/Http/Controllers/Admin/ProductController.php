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
        $inputs = array_merge([
            'category_id' => null,
            'product_name' => null,
            'page' => 1,
        ], $request->only('category_id', 'product_name', 'page'));
        
        $products = $this->productService->filterProducts($inputs);
        $pagination = $products->toArray();

        if ($request->ajax()) {
            return response()->json([
                'products' => view('partials-admin.products', compact('products'))->render(),
                'pagination' => view('partials-admin.pagination', ['pagination' => $pagination])->render(),
            ]);
        }

        return view('admin.manage_products', compact('products', 'pagination'));
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
