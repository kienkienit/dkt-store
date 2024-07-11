@extends('layouts.master')
@section('title', 'Product detail')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/product_detail.css') }}">
    <div class="go-home">
        <a href="/">Trang chủ</a>
        <span>>></span>
        <a href="/">Điện thoại di động</a>
        <span>>></span>
        <p>APPLE IPHONE 6S PLUS ROSE GOLD 128GB</p>
    </div>
    <div class="product-detail-container">
        <div class="header-product-detail-container">
            <div class="product-image">
                <img src="{{ $product->image }}" alt="Image">
                <span class="is-loved"></span>
            </div>
            <div class="product-detail">
                <div class="product-name">{{ $product->name }}</div>
                <div class="line"></div>
                <div class="price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                <div class="description">{{ $product->description }}</div>
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
    </div>
@endsection