<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    const PER_PAGE = 10;

    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}
