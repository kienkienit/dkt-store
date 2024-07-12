<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Log;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function createOrUpdateCart($userId, $data)
    {
        Log::info('Creating or updating cart for user:', ['user_id' => $userId, 'data' => $data]);

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
        return $this->cartRepository->deleteCartItem($itemId);
    }

    public function deleteAllCartItems($userId)
    {
        return $this->cartRepository->deleteAllCartItems($userId);
    }

    public function getUserCart($userId)
    {
        return $this->cartRepository->getUserCart($userId);
    }
}
