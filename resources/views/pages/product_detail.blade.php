@extends('layouts.master')
@section('title', 'Product Detail')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/product_detail.css') }}">
    <div class="go-home">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>>></span>
        <a href="#">Điện thoại di động</a>
        <span>>></span>
        <p>{{ $product->name }}</p>
    </div>
    <div class="product-detail-container">
        <div class="header-product-detail-container">
            <div class="product-image col-12 col-sm-4">
                <img src="{{ $product->image }}" alt="Image">
                <span class="is-loved"></span>
            </div>
            <div class="product-detail col-12 col-sm-8">
                <div class="product-name">{{ $product->name }}</div>
                <div class="line"></div>
                <div class="price" id="product-price">{{ number_format($initialPrice, 0, ',', '.') }} VND</div>
                <div class="description">{{ $product->description }}</div>
                <div class="variants">
                    <div class="variant">
                        <div class="title">Chọn màu sắc:</div>
                        <div id="color-buttons">
                            @foreach($product->variants->unique('color') as $variant)
                                <button class="color-button btn btn-outline-primary"
                                        data-color="{{ $variant->color }}" 
                                        data-price="{{ $variant->price }}" 
                                        data-storage="{{ $variant->storage }}" 
                                        data-variant-id="{{ $variant->id }}">
                                    {{ $variant->color }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="variant">
                        <div class="title">Chọn dung lượng:</div>
                        <div id="storage-buttons">
                            @foreach($product->variants->unique('storage') as $variant)
                                <button class="storage-button btn btn-outline-primary"
                                        data-storage="{{ $variant->storage }}" 
                                        data-price="{{ $variant->price }}" 
                                        data-color="{{ $variant->color }}" 
                                        data-variant-id="{{ $variant->id }}">
                                    {{ $variant->storage }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="quantity">
                    <div class="title">Số lượng:</div>
                    <div class="change-quantity">
                        <button class="subtract btn btn-primary">-</button>
                        <div class="now-quantity">1</div>
                        <button class="add btn btn-primary">+</button>
                    </div>
                </div>
                @auth
                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" id="variant-id">
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <input type="hidden" name="price" id="variant-price" value="{{ $initialPrice }}">
                        <button type="submit" class="add-to-cart btn btn-primary">Thêm vào giỏ hàng</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary add-to-cart">Đăng nhập để thêm vào giỏ hàng</a>
                @endauth
                <div id="stock-alert"></div>
            </div>
        </div>
    </div>
    <div id="cart-alert" style="display: none; position: fixed; top: 10px; right: 10px; background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px;">
        Sản phẩm đã được thêm vào giỏ hàng!
    </div>
    <div id="variantsData" data-variants="{{ json_encode($product->variants) }}"></div>
    
    <script src="{{ asset('js/product_detail.js') }}"></script>
@endsection