@extends('layouts.master')
@section('title', 'Payment')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/payment.css') }}">
    <div class="go-home">
        <a href="#">Trang chủ</a>
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
                        <tr>
                            <td><img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/047/633/products/iphone-6s---6s-plus-hong-color-x96i-91-uw67-ts-m58z-4y.jpg?v=1469338556760" alt="Image"></td>
                            <td>APPLE IPHONE 6S PLUS ROSE GOLD 128GB</td>
                            <td>1</td>
                            <td>27.490.000 VND</td>
                        </tr>
                        <tr>
                            <td><img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/047/633/products/iphone-6s---6s-plus-hong-color-x96i-91-uw67-ts-m58z-4y.jpg?v=1469338556760" alt="Image"></td>
                            <td>APPLE IPHONE 6S PLUS ROSE GOLD 128GB</td>
                            <td>1</td>
                            <td>27.490.000 VND</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="order-info">
            <div class="title">Nhập đầy đủ thông tin để đặt hàng</div>
            <form>
                <div class="form-group">
                    <label for="name">Ho ten <span>*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Nhap ho ten">
                </div>
                <div class="form-group">
                    <label for="address">Dia chi nhan hang <span>*</span></label>
                    <input type="text" class="form-control" id="address" placeholder="Nhap dia chi">
                </div>
                <div class="form-group">
                    <label for="phone-number">So dien thoai <span>*</span></label>
                    <input type="text" class="form-control" id="phone-number" placeholder="+84xxxxxxxxx">
                </div>
                <div class="form-group">
                    <label for="payment-method">Phuong thuc thanh toan <span>*</span></label>
                    <select id="payment-method" name="payment_method" class="form-control">
                        <option value="cod">Thanh toán khi nhận hàng</option>
                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                        <option value="credit_card">Thẻ tín dụng</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div class="button-form">
                    <button type="submit" class="btn btn-primary btn-order">Dat hang</button>
                    <button class="btn-back-to-home btn btn-primary">Quay lai trang chu</button>
                </div>
            </form>
        </div>
    </div>
@endsection