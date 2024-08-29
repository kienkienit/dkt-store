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

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.show')->withErrors(['Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.']);
        }
        
        return view('pages.payment', compact('cart'));
    }

    public function getCartItemCount()
    {
        $user = Auth::user();
        $count = 0;
        if ($user) {
            $cart = $this->cartService->getCartByUserId($user->id);
            $count = $cart->items->sum('quantity');
        }
        return response()->json(['count' => $count]);
    }

    public function checkCart()
    {
        $user = Auth::user();
        $cart = $this->cartService->getCartByUserId($user->id);
        if ($cart->items->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.']);
        }
        return response()->json(['success' => true]);
    }
}

