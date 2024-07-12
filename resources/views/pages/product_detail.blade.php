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
            <div class="product-image">
                <img src="{{ $product->image }}" alt="Image">
                <span class="is-loved"></span>
            </div>
            <div class="product-detail">
                <div class="product-name">{{ $product->name }}</div>
                <div class="line"></div>
                <div class="price" id="product-price">{{ number_format($initialPrice, 0, ',', '.') }} VND</div>
                <div class="description">{{ $product->description }}</div>
                <div class="variants">
                    <div class="variant">
                        <div class="title">Chọn màu sắc:</div>
                        <select id="color-select" class="form-control">
                            @foreach($product->variants->unique('color') as $variant)
                                <option value="{{ $variant->color }}" data-price="{{ $variant->price }}" data-storage="{{ $variant->storage }}" data-variant-id="{{ $variant->id }}">
                                    {{ $variant->color }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="variant">
                        <div class="title">Chọn dung lượng:</div>
                        <select id="storage-select" class="form-control">
                            @foreach($product->variants->unique('storage') as $variant)
                                <option value="{{ $variant->storage }}" data-price="{{ $variant->price }}" data-color="{{ $variant->color }}" data-variant-id="{{ $variant->id }}">
                                    {{ $variant->storage }}
                                </option>
                            @endforeach
                        </select>
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
            </div>
        </div>
    </div>

    <div id="cart-alert" style="display: none; position: fixed; top: 10px; right: 10px; background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px;">
        Sản phẩm đã được thêm vào giỏ hàng!
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const colorSelect = document.getElementById('color-select');
            const storageSelect = document.getElementById('storage-select');
            const productPrice = document.getElementById('product-price');
            const subtractButton = document.querySelector('.subtract');
            const addButton = document.querySelector('.add');
            const quantityDisplay = document.querySelector('.now-quantity');
            const variantIdInput = document.getElementById('variant-id');
            const quantityInput = document.getElementById('quantity');
            const variantPriceInput = document.getElementById('variant-price');
            const addToCartForm = document.getElementById('add-to-cart-form');
            const cartAlert = document.getElementById('cart-alert');
            let quantity = parseInt(quantityDisplay ? quantityDisplay.textContent : '1', 10);

            const variants = @json($product->variants);

            function updatePrice() {
                const selectedColor = colorSelect ? colorSelect.value : null;
                const selectedStorage = storageSelect ? storageSelect.value : null;

                if (selectedColor && selectedStorage) {
                    const selectedVariant = variants.find(variant =>
                        variant.color === selectedColor && variant.storage === selectedStorage
                    );

                    if (selectedVariant) {
                        const price = selectedVariant.price;
                        if (productPrice) {
                            productPrice.textContent = new Intl.NumberFormat().format(price) + ' VND';
                        }
                        if (variantIdInput) {
                            variantIdInput.value = selectedVariant.id;
                        }
                        if (variantPriceInput) {
                            variantPriceInput.value = price;
                        }
                    }
                }
            }

            function updateQuantityDisplay() {
                if (quantityDisplay) {
                    quantityDisplay.textContent = quantity;
                }
                if (quantityInput) {
                    quantityInput.value = quantity;
                }
            }

            if (colorSelect) {
                colorSelect.addEventListener('change', updatePrice);
            }

            if (storageSelect) {
                storageSelect.addEventListener('change', updatePrice);
            }

            if (subtractButton) {
                subtractButton.addEventListener('click', function () {
                    if (quantity > 1) {
                        quantity--;
                        updateQuantityDisplay();
                    }
                });
            }

            if (addButton) {
                addButton.addEventListener('click', function () {
                    quantity++;
                    updateQuantityDisplay();
                });
            }

            addToCartForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(addToCartForm);

                console.log('Form Data:', Array.from(formData.entries()));

                fetch(addToCartForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Server Response:', data);
                    if (data.success) {
                        cartAlert.style.display = 'block';
                        setTimeout(() => {
                            cartAlert.style.display = 'none';
                        }, 3000);
                    } else {
                        alert('Có lỗi xảy ra khi thêm vào giỏ hàng. Vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi thêm vào giỏ hàng. Vui lòng thử lại.');
                });
            });

            updatePrice();
            updateQuantityDisplay();
        });
    </script>
@endsection