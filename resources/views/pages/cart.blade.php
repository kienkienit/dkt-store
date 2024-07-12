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
            <button class="remove-all btn btn-primary">Xóa tât cả</button>
            <button class="pay btn btn-primary">Thanh toán</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Xử lý thay đổi số lượng sản phẩm
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const itemId = this.dataset.itemId;
                    const quantity = this.value;
                    updateCartItemQuantity(itemId, quantity);
                });
            });

            // Xử lý xóa sản phẩm
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.dataset.itemId;
                    deleteCartItem(itemId);
                });
            });

            // Xử lý xóa tất cả sản phẩm
            const removeAllButton = document.querySelector('.remove-all');
            if (removeAllButton) {
                removeAllButton.addEventListener('click', function () {
                    if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi giỏ hàng không?')) {
                        deleteAllCartItems();
                    }
                });
            }

            // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
            function updateCartItemQuantity(itemId, quantity) {
                fetch('/user/cart/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ item_id: itemId, quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm. Vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm. Vui lòng thử lại.');
                });
            }

            // Hàm xóa sản phẩm khỏi giỏ hàng
            function deleteCartItem(itemId) {
                fetch('/user/cart/delete', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ item_id: itemId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại.');
                });
            }

            // Hàm xóa tất cả sản phẩm khỏi giỏ hàng
            function deleteAllCartItems() {
                fetch('/user/cart/delete-all', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra khi xóa tất cả sản phẩm. Vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa tất cả sản phẩm. Vui lòng thử lại.');
                });
            }
        });
    </script>
@endsection