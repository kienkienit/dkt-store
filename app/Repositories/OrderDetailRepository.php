<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository
{
    protected $orderDetail;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    public function create(array $data)
    {
        return $this->orderDetail->create($data);
    }

    public function findByOrderId($orderId)
    {
        return $this->orderDetail->where('order_id', $orderId)->get();
    }

    public function update($id, array $data)
    {
        $orderDetail = $this->orderDetail->find($id);
        $orderDetail->update($data);
        return $orderDetail;
    }

    public function delete($id)
    {
        $orderDetail = $this->orderDetail->find($id);
        return $orderDetail->delete();
    }
}
