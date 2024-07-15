document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function () {
            const itemId = this.dataset.itemId;
            const quantity = this.value;
            updateCartItemQuantity(itemId, quantity);
        });
    });

    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.dataset.itemId;
            deleteCartItem(itemId);
        });
    });

    const removeAllButton = document.querySelector('.remove-all');
    if (removeAllButton) {
        removeAllButton.addEventListener('click', function () {
            if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi giỏ hàng không?')) {
                deleteAllCartItems();
            }
        });
    }

    function updateCartItemQuantity(itemId, quantity) {
        fetch('/user/cart/update', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ item_id: itemId, quantity: quantity })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data); 
            if (data.success) {
                const row = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`).parentNode.parentNode;
                const priceCell = row.querySelector('td:nth-child(3)');
                const totalPriceCell = row.querySelector('td:nth-child(5)');
                const totalPriceElement = document.querySelector('.total-price .price');

                function convertPriceStringToFloat(priceString) {
                    let cleanedPrice = priceString.trim().replace(/[.]+/g, '').replace('VND', '');
                    return parseFloat(cleanedPrice);
                }

                if (priceCell) {
                    priceCell.textContent = convertPriceStringToFloat(data.data.item.price_formatted).toLocaleString();
                }

                if (totalPriceCell) {
                    totalPriceCell.textContent = convertPriceStringToFloat(data.data.total).toLocaleString();
                }

                if (totalPriceElement) {
                    totalPriceElement.textContent = convertPriceStringToFloat(data.data.cart_total).toLocaleString();
                }

            } else {
                throw new Error('Update quantity failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm. Vui lòng thử lại.');
        });
    }

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
                const row = document.querySelector(`.btn-delete[data-item-id="${itemId}"]`).parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else {
                alert('Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại.');
        });
    }

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
                const cartTableBody = document.querySelector('.cart-detail tbody');
                cartTableBody.innerHTML = '<tr><td colspan="6">Giỏ hàng của bạn trống.</td></tr>';
            } else {
                alert('Có lỗi xảy ra khi xóa tất cả sản phẩm. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa tất cả sản phẩm. Vui lòng thử lại.');
        });
    }

    const payButton = document.querySelector('.pay');
    payButton.addEventListener('click', function () {
        window.location.href = "/user/payment";
    });
});