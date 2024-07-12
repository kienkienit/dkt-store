<?php

namespace App\Repositories;

use App\Models\CartItem;

class CartItemRepository
{
    protected $cartItem;

    public function __construct(CartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    public function updateOrCreate($cartId, $productId, $variantId, $quantity, $price)
    {
        return $this->cartItem->updateOrCreate(
            ['cart_id' => $cartId, 'product_id' => $productId, 'variant_id' => $variantId],
            ['quantity' => $quantity, 'price' => $price]
        );
    }
}
