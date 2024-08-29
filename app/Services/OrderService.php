<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;

class OrderService
{
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function placeOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function createOrderDetail(array $data)
    {
        return $this->orderDetailRepository->create($data);
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->findById($id);
    }

    public function updateOrder($id, $data)
    {
        $order = $this->orderRepository->update($id, $data);
    }

    public function paginateOrders($page)
    {
        return $this->orderRepository->paginate($page);
    }

    public function filterOrders($page, $filters)
    {
        return $this->orderRepository->filterOrders($page, $filters);
    }
}
