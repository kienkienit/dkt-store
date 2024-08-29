document.addEventListener('DOMContentLoaded', function() {
    const productPrice = document.getElementById('product-price');
    const subtractButton = document.querySelector('.subtract');
    const addButton = document.querySelector('.add');
    const quantityDisplay = document.querySelector('.now-quantity');
    const variantIdInput = document.getElementById('variant-id');
    const quantityInput = document.getElementById('quantity');
    const variantPriceInput = document.getElementById('variant-price');
    const addToCartForm = document.getElementById('add-to-cart-form');
    const cartAlert = document.getElementById('cart-alert');
    const variantsDataElement = document.getElementById('variantsData');
    const variants = JSON.parse(variantsDataElement.getAttribute('data-variants'));
    let quantity = parseInt(quantityDisplay ? quantityDisplay.textContent : '1', 10);
    let selectedColor = null;
    let selectedStorage = null;

    function updatePriceAndAvailability() {
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
                if (selectedVariant.stock_quantity > 0) {
                    addToCartForm.querySelector('button[type="submit"]').disabled = false;
                    document.getElementById('stock-alert').style.display = 'none';
                } else {
                    addToCartForm.querySelector('button[type="submit"]').disabled = true;
                    document.getElementById('stock-alert').textContent = 'Sản phẩm đã hết hàng';
                    document.getElementById('stock-alert').style.display = 'block';
                }
            } else {
                addToCartForm.querySelector('button[type="submit"]').disabled = true;
                document.getElementById('stock-alert').textContent = 'Không tồn tại sản phẩm này';
                document.getElementById('stock-alert').style.display = 'block';
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

    function selectFirstButton(buttons) {
        if (buttons.length > 0) {
            buttons[0].classList.add('active');
            buttons[0].click();
        }
    }

    document.querySelectorAll('.color-button').forEach(function(button) {
        button.addEventListener('click', function() {
            document.querySelectorAll('.color-button').forEach(function(btn) {
                btn.classList.remove('active');
            });
            button.classList.add('active');
            selectedColor = button.getAttribute('data-color');
            updatePriceAndAvailability();
        });
    });

    document.querySelectorAll('.storage-button').forEach(function(button) {
        button.addEventListener('click', function() {
            document.querySelectorAll('.storage-button').forEach(function(btn) {
                btn.classList.remove('active');
            });
            button.classList.add('active');
            selectedStorage = button.getAttribute('data-storage');
            updatePriceAndAvailability();
        });
    });

    if (subtractButton) {
        subtractButton.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                updateQuantityDisplay();
            }
        });
    }

    if (addButton) {
        addButton.addEventListener('click', function() {
            quantity++;
            updateQuantityDisplay();
        });
    }

    addToCartForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(addToCartForm);

        fetch(addToCartForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cartAlert.style.display = 'block';
                setTimeout(() => {
                    cartAlert.style.display = 'none';
                }, 3000);
                updateCartCount();
            } else {
                alert('Có lỗi xảy ra khi thêm vào giỏ hàng. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi thêm vào giỏ hàng. Vui lòng thử lại.');
        });
    });

    function updateCartCount() {
        fetch('/user/cart/count')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = data.count;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    selectFirstButton(document.querySelectorAll('.color-button'));
    selectFirstButton(document.querySelectorAll('.storage-button'));

    updatePriceAndAvailability();
    updateQuantityDisplay();
});