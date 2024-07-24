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
                    @forelse($cart->items as $item)
                        @if($item->product && $item->variant)
                            <tr>
                                <td><img src="{{ $item->product->image }}" alt="Image"></td>
                                <td>{{ $item->product->name }} - {{ $item->variant->color }} - {{ $item->variant->storage }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                <td><input type="number" value="{{ $item->quantity }}" min="1" data-item-id="{{ $item->id }}" class="quantity-input"></td>
                                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                                <td><button class="btn-delete btn btn-primary" data-item-id="{{ $item->id }}">Xóa</button></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6">Sản phẩm này không tồn tại.</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6">Giỏ hàng của bạn trống.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="total-price">
            <div class="title">Tổng tiền thanh toán:</div>
            <div class="price">{{ number_format($cart->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }} VND</div>
        </div>
        <div class="cart-button">
            <button class="remove-all btn btn-primary">Xóa tất cả</button>
            <button class="pay btn btn-primary">Thanh toán</button>
        </div>
    </div>

    <script src="{{ asset('js/user/cart.js') }}"></script>
@endsection