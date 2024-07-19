<?php

namespace App\Repositories;

use App\Models\Order;

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
}
