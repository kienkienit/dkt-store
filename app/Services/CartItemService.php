<?php

namespace App\Services;

use App\Repositories\CartItemRepository;

class CartItemService
{
    protected $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

}
