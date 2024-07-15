<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitOrderRequest;
use App\Services\CartService;

class OrderController extends Controller
{
    protected $orderService;
    protected $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }

    public function submitOrder(SubmitOrderRequest $request)
    {
        $items = json_decode($request->input('items'), true);

        $data = [
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'payment_method' => $request->input('payment_method'),
            'items' => $items,
            'total_amount' => $request->input('total_amount'),
            'order_date' => now(),
            'status' => 'pending',
        ];

        $this->orderService->placeOrder($data);

        foreach ($items as $item) {
            $this->cartService->deleteCartItemByProductId($item['product_id']);
        }

        return redirect()->route('home')->with('success_message', 'Đặt hàng thành công!');
    }
}
