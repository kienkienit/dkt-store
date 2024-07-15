@extends('layouts.master')
@section('title', 'Payment')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/payment.css') }}">
    <div class="go-home">
        <a href="/">Trang chủ</a>
        <span>>></span>
        <p>Thanh toán</p>
    </div>
    <div class="payment-container">
        <div class="cart-info">
            <div class="cart-title">Đơn hàng</div>
            <div class="line"></div>
            <div class="cart-detail">
                <table>
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Thông tin sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                            <tr data-product-id="{{ $item->product->id }}">
                                <td><img src="{{ $item->product->image }}" alt="Image"></td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right"><strong>Tổng tiền đơn hàng:</strong></td>
                            <td><strong>{{ number_format($cart->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }} VND</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="order-info">
            <div class="title">Nhập đầy đủ thông tin để đặt hàng</div>
            <form id="order-form" method="POST" action="{{ route('order.submit') }}">
                @csrf
                <input type="hidden" id="items" name="items">
                <input type="hidden" id="total_amount" name="total_amount">
                <div class="form-group">
                    <label for="name">Họ tên <span>*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ nhận hàng <span>*</span></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="phone-number">Số điện thoại <span>*</span></label>
                    <input type="text" class="form-control" id="phone-number" name="phone_number" placeholder="+84xxxxxxxxx">
                </div>
                <div class="form-group">
                    <label for="payment-method">Phương thức thanh toán <span>*</span></label>
                    <select id="payment-method" name="payment_method" class="form-control">
                        <option value="cod">Thanh toán khi nhận hàng</option>
                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                        <option value="credit_card">Thẻ tín dụng</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div class="button-form">
                    <button type="submit" class="btn btn-primary btn-order">Đặt hàng</button>
                    <button class="btn-back-to-home btn btn-primary">Quay lại trang chủ</button>
                </div>
            </form>            
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("order-form");
    
            form.addEventListener("submit", function(event) {
                event.preventDefault();
    
                let items = [];
                let totalAmount = 0;
    
                document.querySelectorAll('.cart-detail tbody tr').forEach(row => {
                    const productId = row.getAttribute('data-product-id');

                    const productNameCell = row.cells[1];
                    const productName = productNameCell ? productNameCell.textContent : '';

                    const quantityCell = row.cells[2];
                    const quantity = quantityCell ? parseInt(quantityCell.textContent) : 0;

                    const priceCell = row.cells[3];
                    const priceText = priceCell ? priceCell.textContent : '';

                    const price = parseFloat(priceText.replace(/[.]+/g, ''));
                    
                    if (!isNaN(quantity) && quantity > 0 && !isNaN(price) && price > 0) {
                        const product = {
                            product_id: productId,
                            name: productName,
                            quantity: quantity,
                            price: price
                        };
        
                        items.push(product);
        
                        totalAmount += price;
                    }
                });

                document.getElementById("items").value = JSON.stringify(items);
                document.getElementById("total_amount").value = totalAmount;

                form.submit();
            });
        });
    </script>    
@endsection