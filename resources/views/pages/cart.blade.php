@extends('layouts.master')
@section('title', 'Cart')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/cart.css') }}">
    <div class="go-home">
        <a href="/">Trang chủ</a>
        <span>>></span>
        <p>Giỏ hàng</p>
    </div>
    <div class="cart-container">
        <div class="cart-title">Giỏ hàng của bạn</div>
        <div class="line"></div>
        <div class="cart-detail">
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/047/633/products/iphone-6s---6s-plus-hong-color-x96i-91-uw67-ts-m58z-4y.jpg?v=1469338556760" alt="Image"></td>
                        <td>APPLE IPHONE 6S PLUS ROSE GOLD 128GB</td>
                        <td>27.490.000 VND</td>
                        <td><input type="number" value="1" min="1"></td>
                        <td>27.490.000 VND</td>
                        <td><button class="btn-delete btn btn-primary">Xóa</button></td>
                    </tr>
                    <tr>
                        <td><img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/047/633/products/iphone-6s---6s-plus-hong-color-x96i-91-uw67-ts-m58z-4y.jpg?v=1469338556760" alt="Image"></td>
                        <td>APPLE IPHONE 6S PLUS ROSE GOLD 128GB</td>
                        <td>27.490.000 VND</td>
                        <td><input type="number" value="1" min="1"></td>
                        <td>27.490.000 VND</td>
                        <td><button class="btn-delete btn btn-primary">Xóa</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="total-price">
            <div class="title">Tổng tiền thanh toán:</div>
            <div class="price">54.980.000 VND</div>
        </div>
        <div class="cart-button">
            <button class="remove-all btn btn-primary">Xóa tât cả</button>
            <button class="pay btn btn-primary">Thanh toán</button>
        </div>
    </div>
@endsection