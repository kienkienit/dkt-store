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
    const variantsDataElement = document.getElementById('variantsData');
    const variants = JSON.parse(variantsDataElement.getAttribute('data-variants'));
    let quantity = parseInt(quantityDisplay ? quantityDisplay.textContent : '1', 10);

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