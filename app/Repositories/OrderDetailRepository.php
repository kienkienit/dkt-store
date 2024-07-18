<?php

namespace App\Repositories;

use App\Models\OrderDetail;

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
}
