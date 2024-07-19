<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    const PER_PAGE = 5;

    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function paginate($page, $perPage = self::PER_PAGE)
    {
        return $this->model->orderBy('order_date', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }

    public function getMonthlyRevenue($year)
    {
        return $this->model->select(
                DB::raw('MONTH(order_date) as month'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
            ->whereYear('order_date', $year)
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->get()
            ->pluck('total_revenue', 'month')
            ->toArray();
    }
    
    public function getMonthlyOrders($year)
    {
        return $this->model->select(
                DB::raw('MONTH(order_date) as month'),
                DB::raw('COUNT(*) as total_orders')
            )
            ->whereYear('order_date', $year)
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->get()
            ->pluck('total_orders', 'month')
            ->toArray();
    }
    
}
