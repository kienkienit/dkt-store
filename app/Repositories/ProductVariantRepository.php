<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository
{
    protected $productVariant;

    public function __construct(ProductVariant $productVariant)
    {
        $this->productVariant = $productVariant;
    }

    public function create(array $data)
    {
        return $this->productVariant->create($data);
    }

    public function update($id, array $data)
    {
        $variant = $this->productVariant->find($id);
        $variant->update($data);
        return $variant;
    }

    public function delete($id)
    {
        $variant = $this->productVariant->find($id);
        $variant->delete();
        return $variant;
    }

    public function getMinPriceByProductId($productId)
    {
        return $this->productVariant->where('product_id', $productId)->min('price');
    }
}
