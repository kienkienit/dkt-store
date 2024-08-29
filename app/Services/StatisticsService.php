<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;

class StatisticsService
{
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function getMonthlyRevenue($year)
    {
        return $this->orderRepository->getMonthlyRevenue($year);
    }
    
    public function getMonthlyOrders($year)
    {
        return $this->orderRepository->getMonthlyOrders($year);
    }
    

    public function getBestSellers($limit = 10)
    {
        return $this->orderDetailRepository->getBestSellers($limit);
    }

    public function getTopRevenue($limit = 10)
    {
        return $this->orderDetailRepository->getTopRevenue($limit);
    }

    private function fillMissingMonths($data)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = [
                'month' => \DateTime::createFromFormat('!m', $i)->format('F'),
                'value' => $data->get($i, 0)
            ];
        }
        return $result;
    }
}
