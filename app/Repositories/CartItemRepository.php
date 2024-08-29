<?php

namespace App\Repositories;

use App\Models\CartItem;

class CartItemRepository extends BaseRepository
{
    public function __construct(CartItem $cartItem)
    {
        parent::__construct($cartItem);
    }

    public function updateOrCreate($cartId, $productId, $variantId, $quantity, $price)
    {
        return $this->model->updateOrCreate(
            ['cart_id' => $cartId, 'product_id' => $productId, 'variant_id' => $variantId],
            ['quantity' => $quantity, 'price' => $price]
        );
    }

    public function deleteByItemId($itemId)
    {
        return $this->model->where('id', $itemId)->delete();
    }

    public function deleteCartItemByProductId($productId)
    {
        return $this->model->where('product_id', $productId)->delete();
    }
}
