<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderDetailRepository extends BaseRepository
{
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }

    public function findByOrderId($orderId)
    {
        return $this->model->where('order_id', $orderId)->get();
    }

    public function getBestSellers($limit = 10)
    {
        return $this->model
                    ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                    ->with('product')
                    ->groupBy('product_id')
                    ->orderBy('total_quantity', 'desc')
                    ->take($limit)
                    ->get()
                    ->map(function ($orderDetail) {
                        return (object) [
                            'name' => $orderDetail->product->name,
                            'total_quantity' => $orderDetail->total_quantity
                        ];
                    });
    }

    public function getTopRevenue($limit = 10)
    {
        return $this->model
                    ->select('product_id', DB::raw('SUM(quantity * price) as total_revenue'))
                    ->with('product')
                    ->groupBy('product_id')
                    ->orderBy('total_revenue', 'desc')
                    ->take($limit)
                    ->get()
                    ->map(function ($orderDetail) {
                        return (object) [
                            'name' => $orderDetail->product->name,
                            'total_revenue' => $orderDetail->total_revenue
                        ];
                    });
    }
}
