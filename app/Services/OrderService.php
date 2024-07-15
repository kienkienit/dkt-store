<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function placeOrder(array $data)
    {
        $order = $this->orderRepository->create($data);
        return $order;
    }
}


