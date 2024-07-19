document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("order-form");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

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
                totalAmount += price;
            }
        });

        document.getElementById("items").value = JSON.stringify(items);
        document.getElementById("total_amount").value = totalAmount;

        form.submit();
    });
});
