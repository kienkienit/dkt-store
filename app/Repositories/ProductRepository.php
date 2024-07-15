<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->get();
    }

    public function findById($id)
    {
        return $this->product->find($id);
    }

    public function getProductsByCategory($categoryId, $perPage = 8)
    {
        return $this->product->where('category_id', $categoryId)->paginate($perPage);
    }

    public function getHotProductsByCategory($categoryId)
    {
        return $this->product->where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->findById($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->findById($id);
        return $product->delete();
    }
}
