<?php

namespace App\Services;

use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Log;

class CartService
{
    protected $cartRepository;
    protected $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function createOrUpdateCart($userId, $data)
    {
        return $this->cartRepository->createOrUpdateCart($userId, $data);
    }

    public function getCartByUserId($userId)
    {
        return $this->cartRepository->getCartByUserId($userId);
    }

    public function updateCartItemQuantity($itemId, $quantity)
    {
        return $this->cartRepository->updateCartItemQuantity($itemId, $quantity);
    }

    public function deleteCartItem($itemId)
    {
        return $this->cartItemRepository->deleteByItemId($itemId);
    }

    public function deleteCartItemByProductId($productId)
    {
        return $this->cartItemRepository->deleteCartItemByProductId($productId);
    }

    public function deleteAllCartItems($userId)
    {
        return $this->cartRepository->deleteAllCartItems($userId);
    }
}
