<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;

class ProductService
{
    protected $productRepository;
    protected $productVariantRepository;

    public function __construct(ProductRepository $productRepository, ProductVariantRepository $productVariantRepository)
    {
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function getProductsByCategory($categoryId, $perPage = 8)
    {
        return $this->productRepository->getProductsByCategory($categoryId, $perPage);
    }

    public function getHotProductsByCategory($categoryId)
    {
        return $this->productRepository->getHotProductsByCategory($categoryId);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    protected function updateProductPrice($productId)
    {
        $minPrice = $this->productVariantRepository->getMinPriceByProductId($productId);
        $this->productRepository->update($productId, ['price' => $minPrice]);
    }
}
