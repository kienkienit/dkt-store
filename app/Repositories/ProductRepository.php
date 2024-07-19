<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

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

    public function getBestSellers()
    {
        return $this->model->select('products.*', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();
    }

    public function getTopRevenue()
    {
        return $this->model->select('products.*', DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue'))
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->groupBy('products.id')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
    }
}
