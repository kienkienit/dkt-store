<?php

namespace App\Services;

use App\Repositories\ProductVariantRepository;

class ProductVariantService
{
    protected $productVariantRepository;

    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    public function createVariant(array $data)
    {
        return $this->productVariantRepository->create($data);
    }
    public function getVariantById($id)
    {
        return $this->productVariantRepository->findById($id);
    }

    public function updateVariant($id, array $data)
    {
        return $this->productVariantRepository->update($id, $data);
    }

    public function deleteVariant($id)
    {
        return $this->productVariantRepository->delete($id);
    }

    public function getMinPriceByProductId($productId)
    {
        return $this->productVariantRepository->getMinPriceByProductId($productId);
    }

    public function paginateVariants($productId, $page)
    {
        return $this->productVariantRepository->paginate($productId, $page);
    }

    public function updateInventory($variantId, $quantity)
    {
        $variant = $this->productVariantRepository->findById($variantId);
        if ($variant) {
            $variant->sold_quantity += $quantity;
            $variant->stock_quantity -= $quantity;
            $variant->save();
        }
    }
}
