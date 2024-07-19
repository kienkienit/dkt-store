<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\OrderStatus;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $page = $request->input("page", 1);
        $orders = $this->orderService->paginateOrders($page);
        $orderStatuses = OrderStatus::cases();

        if ($request->ajax()) {
            return response()->json([
                'orders' => view('partials-admin.orders', compact('orders'))->render()
            ]);
        }

        return view('admin.manage_orders', compact('orders', 'orderStatuses'));
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        return response()->json($order);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $data = $request->validated();

        $this->orderService->updateOrder($id, $data);

        return json_response(true, ['success' => 'Thông tin đơn hàng đã được cập nhật thành công!']);
    }

    public function detail($id)
    {
        $order = $this->orderService->getOrderById($id);
        return view('admin.manage_order_detail', compact('order'));
    }
}
