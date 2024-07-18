<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository extends BaseRepository
{
    const PER_PAGE = 5;

    public function __construct(ProductVariant $productVariant)
    {
        parent::__construct($productVariant);
    }

    public function getMinPriceByProductId($productId)
    {
        return $this->model->where('product_id', $productId)->min('price');
    }

    public function paginate($productId, $page)
    {
        return $this->model->where('product_id', $productId)->orderBy('created_at', 'desc')->paginate(self::PER_PAGE, ['*'], 'page', $page);
    }
}
