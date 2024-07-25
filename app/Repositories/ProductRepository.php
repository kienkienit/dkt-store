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

    public function getProductsByCategory($categoryId, $perPage = 8, $page = 1)
    {
        return $this->model->where('category_id', $categoryId)->paginate($perPage, ['*'], 'page', $page);
    }

    public function getHotProductsByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
    }

    public function filterProducts($data, $perPage = self::PER_PAGE)
    {
        $query = $this->model;
        
        if ($data['category_id']) {
            $query = $query->where('category_id', $data['category_id']);
        }

        if ($data['product_name']) {
            $query = $query->where('name', 'like', '%' . $data['product_name']);
        }

        return $query->paginate($perPage, ['*'], 'page', $data['page']);
    }
}
