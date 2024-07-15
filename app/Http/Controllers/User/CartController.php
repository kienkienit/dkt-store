<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

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
        $result = $this->cartService->createOrUpdateCart($user->id, $request->all());

        return $result ? json_response(true) : json_response(false, null, 500);
    }

    public function show()
    {
        $cart = $this->cartService->getCartByUserId(Auth::user()->id);
        $cart->load('items.product', 'items.variant');
        return view('pages.cart', compact('cart'));
    }

    public function updateCartItemQuantity(Request $request)
    {
        $result = $this->cartService->updateCartItemQuantity($request->item_id, $request->quantity);

        if ($result && $result['item']) {
            $response = [
                'success' => true,
                'data' => [
                    'item' => [
                        'price' => $result['item']->price,
                        'price_formatted' => number_format($result['item']->price, 0, ',', '.'),
                    ],
                    'total' => number_format($result['item']->price * $result['item']->quantity, 0, ',', '.'),
                    'cart_total' => number_format($result['cart_total'], 0, ',', '.'),
                ],
            ];
        } else {
            $response = [
                'success' => false,
                'data' => null,
            ];
        }

        return response()->json($response);
    }

    public function deleteCartItem(Request $request)
    {
        $this->cartService->deleteCartItem($request->item_id);
        return json_response(true);
    }

    public function deleteAllCartItems()
    {
        $this->cartService->deleteAllCartItems(Auth::user()->id);
        return json_response(true);
    }

    public function showPaymentPage()
    {
        $user = Auth::user();
        $cart = $this->cartService->getCartByUserId($user->id);
        $cart->load('items.product', 'items.variant');
        return view('pages.payment', compact('cart'));
    }
}

