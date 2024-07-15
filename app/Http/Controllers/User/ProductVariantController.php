<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductVariantService;

class ProductVariantController extends Controller
{
    protected $productVariantService;

    public function __construct(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    public function store(Request $request)
    {
        $variant = $this->productVariantService->createVariant($request->all());
        return redirect()->route('products.show', $variant->product_id);
    }

    public function update(Request $request, $id)
    {
        $variant = $this->productVariantService->updateVariant($id, $request->all());
        return redirect()->route('products.show', $variant->product_id);
    }

    public function destroy($id)
    {
        $variant = $this->productVariantService->deleteVariant($id);
        return redirect()->route('products.show', $variant->product_id);
    }
}