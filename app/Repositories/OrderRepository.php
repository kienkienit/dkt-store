<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function create(array $data)
    {
        return $this->order->create($data);
    }

    public function findById($id)
    {
        return $this->order->find($id);
    }

    public function update($id, array $data)
    {
        $order = $this->findById($id);
        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        $order = $this->findById($id);
        return $order->delete();
    }
}
