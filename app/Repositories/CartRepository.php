<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

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

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $data['product_id'])
            ->where('variant_id', $data['variant_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $data['quantity'];
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $data['product_id'],
                'variant_id' => $data['variant_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
            ]);
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

            $cartTotal = $this->cartItem->where('cart_id', $item->cart_id)->sum(DB::raw('price * quantity'));

            return [
                'item' => $item,
                'cart_total' => $cartTotal
            ];
        }

        return null;
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

