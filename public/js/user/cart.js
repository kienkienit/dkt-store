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

    // document.querySelectorAll('.btn-quantity-increase').forEach(button => {
    //     button.addEventListener('click', function () {
    //         const input = this.previousElementSibling;
    //         const itemId = this.dataset.itemId;
    //         let quantity = parseInt(input.value, 10) + 1;
    //         input.value = quantity;
    //         updateCartItemQuantity(itemId, quantity);
    //     });
    // });

    // document.querySelectorAll('.btn-quantity-decrease').forEach(button => {
    //     button.addEventListener('click', function () {
    //         const input = this.nextElementSibling;
    //         const itemId = this.dataset.itemId;
    //         let quantity = Math.max(1, parseInt(input.value, 10) - 1);
    //         input.value = quantity;
    //         updateCartItemQuantity(itemId, quantity);
    //     });
    // });

    function formatCurrency(value) {
        return value.toLocaleString('vi-VN') + ' VND';
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

                if (priceCell) {
                    priceCell.textContent = formatCurrency(data.data.item.price_formatted);
                }

                if (totalPriceCell) {
                    totalPriceCell.textContent = formatCurrency(data.data.total);
                }

                if (totalPriceElement) {
                    totalPriceElement.textContent = formatCurrency(data.data.cart_total);
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
                updateTotalPrice();
                checkCartItems();

                const cartTableBody = document.querySelector('.cart-detail tbody');
                if (cartTableBody.children.length === 0) {
                    cartTableBody.innerHTML = '<tr><td colspan="6">Giỏ hàng của bạn trống.</td></tr>';
                    updateTotalPrice(0);
                }
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
                updateTotalPrice(0); 
                checkCartItems();
            } else {
                alert('Có lỗi xảy ra khi xóa tất cả sản phẩm. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa tất cả sản phẩm. Vui lòng thử lại.');
        });
    }

    function updateTotalPrice(newTotal = null) {
        const totalPriceElement = document.querySelector('.total-price .price');
        if (totalPriceElement) {
            if (newTotal !== null) {
                totalPriceElement.textContent = formatCurrency(newTotal);
            } else {
                let total = 0;
                document.querySelectorAll('.cart-detail tbody tr').forEach(row => {
                    const itemTotalCell = row.querySelector('td:nth-child(5)');
                    if (itemTotalCell) {
                        const itemTotal = parseFloat(itemTotalCell.textContent.replace(/[^\d]/g, ''));
                        total += isNaN(itemTotal) ? 0 : itemTotal;
                    }
                });
                totalPriceElement.textContent = formatCurrency(total);
            }
        }
    }

    const payButton = document.querySelector('.pay');
    payButton.addEventListener('click', function () {
        const items = document.querySelectorAll('.cart-detail tbody tr');
        if (items.length === 0 || (items.length === 1 && items[0].querySelector('td').colSpan === 6)) {
            alert('Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        } else {
            window.location.href = "/user/payment";
        }
    });

    function checkCartItems() {
        const items = document.querySelectorAll('.cart-detail tbody tr');
        const payButton = document.querySelector('.pay');
        const removeAllButton = document.querySelector('.remove-all');
        if (items.length === 0 || (items.length === 1 && items[0].querySelector('td').colSpan === 6)) {
            payButton.disabled = true;
            removeAllButton.disabled = true;
        } else {
            payButton.disabled = false;
            removeAllButton.disabled = false;
        }
    }

    checkCartItems();
});