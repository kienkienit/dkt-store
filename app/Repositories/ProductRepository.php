<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    const PER_PAGE = 5;

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function paginate($page, $perPage = self::PER_PAGE)
    {
        return parent::paginate($page, self::PER_PAGE);
    }

    public function getProductsByCategory($categoryId, $perPage = 8)
    {
        return $this->model->where('category_id', $categoryId)->paginate($perPage);
    }

    public function getHotProductsByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
    }
}
