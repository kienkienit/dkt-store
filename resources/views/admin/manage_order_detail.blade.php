@extends('layouts.admin')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_products.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div class="go-home mb-3">
                <a href="/admin/manage/orders">Danh Sách Đơn Hàng</a>
                <span>>></span>
                <p>Chi Tiết Đơn Hàng {{ $order->order_code }}</p>
            </div>
            <h2 class="mt-4 mb-4">Thông tin đơn mua</h2>
            <table class="table table-bordered order-info">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Số lượng mua</th>
                        <th>Giá bán (VND)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->details as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->product->category->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="order-details">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Tên người đặt hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->name }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Địa chỉ nhận hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->address }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>SDT nhận hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        {{ $order->phone_number }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Hình thức thanh toán:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        @switch($order->payment_method)
                            @case('cod')
                                Thanh toán khi nhận hàng
                                @break
                            @case('bank_transfer')
                                Chuyển khoản ngân hàng
                                @break
                            @case('credit_card')
                                Thẻ tín dụng
                                @break
                            @case('paypal')
                                PayPal
                                @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
