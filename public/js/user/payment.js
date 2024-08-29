document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("order-form");
    const submitButton = document.querySelector(".btn-order");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        fetch('/user/cart/check', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert(data.message);
                window.location.href = '/user/cart';
                return;
            }

            let items = [];
            let totalAmount = 0;

            document.querySelectorAll('.cart-detail tbody tr').forEach(row => {
                const productId = row.getAttribute('data-product-id');
                const variantId = row.getAttribute('data-variant-id');
                const productNameCell = row.cells[1];
                const productName = productNameCell ? productNameCell.textContent : '';
                const quantityCell = row.cells[2];
                const quantity = quantityCell ? parseInt(quantityCell.textContent) : 0;
                const priceCell = row.cells[3];
                const priceText = priceCell ? priceCell.textContent : '';
                const price = parseFloat(priceText.replace(/[.]+/g, ''));

                if (!isNaN(quantity) && quantity > 0 && !isNaN(price) && price > 0) {
                    const product = {
                        product_id: productId,
                        variant_id: variantId,
                        name: productName,
                        quantity: quantity,
                        price: price
                    };

                    items.push(product);
                    totalAmount += price * quantity;
                }
            });

            if (items.length === 0) {
                alert('Không có sản phẩm nào trong giỏ hàng.');
                return;
            }

            document.getElementById("items").value = JSON.stringify(items);
            document.getElementById("total_amount").value = totalAmount;

            form.submit();
        })
        .catch(error => {
            console.error('Error checking cart:', error);
            alert('Có lỗi xảy ra khi kiểm tra giỏ hàng. Vui lòng thử lại.');
            window.location.reload();
        });
    });

    function checkCartItems() {
        const items = document.querySelectorAll('.cart-detail tbody tr');
        if (items.length === 0) {
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;
        }
    }

    checkCartItems();
});
