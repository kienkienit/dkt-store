<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitOrderRequest;
use App\Services\CartService;
use App\Services\ProductVariantService;

class OrderController extends Controller
{
    protected $orderService;
    protected $cartService;
    protected $variantService;

    public function __construct(
        OrderService $orderService, 
        CartService $cartService, 
        ProductVariantService $variantService
    ) {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
        $this->variantService = $variantService;
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

        $data += [
            'user_id' => auth()->id(),
            'items' => $items,
            'order_date' => now(),
            'status' => 'pending'
        ];

        $order = $this->orderService->placeOrder($data);

        foreach ($items as $item) {
            $orderItem = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];

            $this->orderService->createOrderDetail($orderItem);
            $this->variantService->updateInventory($item['variant_id'], $item['quantity']);
            $this->cartService->deleteCartItemByProductId($item['product_id']);
        }

        return redirect()->route('home')->with('success_message', 'Đặt hàng thành công!');
    }
}
