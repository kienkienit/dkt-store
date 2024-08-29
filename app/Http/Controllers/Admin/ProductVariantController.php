<?php

namespace App\Http\Controllers\Admin;

use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use Illuminate\Http\Request;
use App\Services\ProductVariantService;
use App\Services\ProductService;

class ProductVariantController extends Controller
{
    protected $productVariantService;
    protected $productService;

    public function __construct(ProductVariantService $productVariantService, ProductService $productService)
    {
        $this->productVariantService = $productVariantService;
        $this->productService = $productService;
    }

    public function index($productId, Request $request)
    {
        $variants = $this->productVariantService->paginateVariants($productId, $request->input('page', 1));
        $product = $this->productService->getProductById($productId);
        $pagination = $variants->toArray();

        if ($request->ajax()) {
            return response()->json([
                'variants' => view('partials-admin.product_variants', compact('variants'))->render(),
                'pagination' => view('partials-admin.pagination', ['pagination' => $pagination])->render(),
            ]);
        }

        return view('admin.manage_product_variants', compact('variants', 'product', 'pagination'));
    }

    public function store(ProductVariantRequest $request, $productId)
    {
        $data = $request->all();
        $data['product_id'] = $productId;
        $exists = $this->productVariantService->checkVariantExist($productId, $data['color'], $data['storage']);

        if ($exists) {
            return json_response(false, ['message' => 'Biến thể này đã tồn tại.'], HttpStatus::BAD_REQUEST->value);
        }

        $this->productVariantService->createVariant($data);

        return json_response(true, ['message' => 'Biến thể đã được thêm thành công!']);
    }

    public function show($productId, $variantId)
    {
        $variant = $this->productVariantService->getVariantById($variantId);
        return response()->json($variant);
    }

    public function update(Request $request, $productId, $variantId)
    {
        $data = $request->all();
        $this->productVariantService->updateVariant($variantId, $data);

        return json_response(true, ['message' => 'Biến thể đã được cập nhật thành công!']);
    }

    public function delete($productId, $variantId)
    {
        $this->productVariantService->deleteVariant($variantId);
        return json_response(true, ['message' => 'Biến thể đã được xóa thành công!']);
    }
}
