@extends('layouts.master')
@section('title', 'Product detail')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/product_detail.css') }}">
    <div class="go-home">
        <a href="#">Trang chủ</a>
        <span>>></span>
        <a href="#">Điện thoại di động</a>
        <span>>></span>
        <p>APPLE IPHONE 6S PLUS ROSE GOLD 128GB</p>
    </div>
    <div class="product-detail-container">
        <div class="header-product-detail-container">
            <div class="product-image">
                <img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/047/633/products/iphone-6s---6s-plus-hong-color-x96i-91-uw67-ts-m58z-4y.jpg?v=1469338556760" alt="Image">
                <span class="is-loved"></span>
            </div>
            <div class="product-detail">
                <div class="product-name">APPLE IPHONE 6S PLUS ROSE GOLD 128GB</div>
                <div class="line"></div>
                <div class="price">27.490.000 VND</div>
                <div class="description">
                    Phiên bản iPhone 6S Plus 128GB Rose Gold dành cho người dùng có nhu cầu lưu trữ và thường xuyên sử dụng điện thoại để làm việc. 
                    Với chip xử lý A9 cải tiến và camera được cải tiến mạnh mẽ và công nghệ 3D Touch. 
                    Mạnh mẽ vượt trội là những từ khi nhắc đến chiếc điện thoại iPhone 6S Plus 128GB này. 
                    Với phiên bản mới màu vàng hồng thì iPhone 6S Plus sẽ là vật trang sức tạo nên sự đẳng cấp kì diệu cho bạn.
                </div>
                <div class="quantity">
                    <div class="title">Số lượng:</div>
                    <div class="change-quantity">
                        <button class="subtract btn btn-primary">-</button>
                        <div class="now-quanity">1</div>
                        <button class="add btn btn-primary">+</button>
                    </div>
                </div>
                <button class="add-to-cart btn btn-primary">Thêm vào giỏ hàng</button>
            </div>
        </div>
        <div class="middle-product-detail-container">
            <div class="detail-title">Chi tiêt sản phẩm</div>
        </div>
    </div>
@endsection