<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;

class CartRepository
{
    protected $cart;
    protected $cartItem;

    public function __construct(Cart $cart, CartItem $cartItem)
    {
        $this->cart = $cart;
        $this->cartItem = $cartItem;
    }

    public function createOrUpdateCart($userId, $data)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        Log::info('Cart created or found:', ['cart_id' => $cart->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $data['product_id'])
            ->where('variant_id', $data['variant_id'])
            ->first();

            if ($cartItem) {
                $cartItem->quantity += $data['quantity'];
                $cartItem->save();
    
                Log::info('CartItem updated:', ['cart_item_id' => $cartItem->id, 'new_quantity' => $cartItem->quantity]);
            } else {
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $data['product_id'],
                    'variant_id' => $data['variant_id'],
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ]);
    
                Log::info('CartItem created:', ['cart_item_id' => $cartItem->id]);
            }

        return $cartItem ? true : false;
    }

    public function getCartByUserId($userId)
    {
        return $this->cart->with('items')->where('user_id', $userId)->first();
    }

    public function updateCartItemQuantity($itemId, $quantity)
    {
        $item = $this->cartItem->find($itemId);
        if ($item) {
            $item->quantity = $quantity;
            $item->save();
        }
        return $item;
    }

    public function deleteCartItem($itemId)
    {
        $item = $this->cartItem->find($itemId);
        if ($item) {
            $item->delete();
        }
        return $item;
    }

    public function deleteAllCartItems($userId)
    {
        $cart = $this->cart->where('user_id', $userId)->first();
        if ($cart) {
            $cart->items()->delete();
        }
        return $cart;
    }

    public function getUserCart($userId)
    {
        return $this->cart->with('items.product', 'items.variant')->where('user_id', $userId)->first();
    }
}

