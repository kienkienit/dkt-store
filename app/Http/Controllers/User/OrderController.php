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

        $data = $request->only([
            'name', 
            'address', 
            'phone_number', 
            'payment_method', 
            'total_amount'
        ]);

        $data['user_id'] = auth()->id();
        $data['items'] = $items;
        $data['order_date'] = now();
        $data['status'] = 'pending';

        $order = $this->orderService->placeOrder($data);

        foreach ($items as $item) {
            $orderItem = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];

            $this->orderService->createOrderDetail($orderItem);
            $this->cartService->deleteCartItemByProductId($item['product_id']);
        }

        return redirect()->route('home')->with('success_message', 'Đặt hàng thành công!');
    }
}
