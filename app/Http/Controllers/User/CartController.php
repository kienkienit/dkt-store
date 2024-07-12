<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function createOrUpdateCart(Request $request)
    {
        $user = Auth::user();

        Log::info('User adding to cart:', [
            'user_id' => $user->id,
            'product_id' => $request->input('product_id'),
            'variant_id' => $request->input('variant_id'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ]);

        $result = $this->cartService->createOrUpdateCart($user->id, $request->all());

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }

    public function show()
    {
        $cart = $this->cartService->getCartByUserId(Auth::user()->id);

        $cart->load('items.product', 'items.variant');
        
        return view('pages.cart', compact('cart'));
    }

    public function updateCartItemQuantity(Request $request)
    {
        $this->cartService->updateCartItemQuantity($request->item_id, $request->quantity);
        return response()->json(['success' => true]);
    }

    public function deleteCartItem(Request $request)
    {
        $this->cartService->deleteCartItem($request->item_id);
        return response()->json(['success' => true]);
    }

    public function deleteAllCartItems()
    {
        $this->cartService->deleteAllCartItems(Auth::user()->id);
        return response()->json(['success' => true]);
    }
}

