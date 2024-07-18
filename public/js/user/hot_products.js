$(document).ready(function() {
    $('.hot-category-link').on('click', function(e) {
        e.preventDefault();
        var categoryId = $(this).data('id');
        $('.hot-item').removeClass('active');
        $(this).parent().addClass('active');
        $.ajax({
            url: '/products/hot/' + categoryId,
            method: 'GET',
            success: function(data) {
                $('#hot-product-list').empty();
                var productsToShow = data.data.slice(0, 4);
                productsToShow.forEach(function(product) {
                    $('#hot-product-list').append(`
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-0">
                            <a href="/product/${product.id}" class="product-link">
                                <div class="product-item">
                                    <span class="is-loved"></span>
                                    <img src="${product.image}" alt="Image">
                                    <div class="name">${product.name}</div>
                                    <div class="price">${new Intl.NumberFormat().format(product.price)} VND</div>
                                    <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                                </div>
                            </a>
                        </div>
                    `);
                });
            },
            error: function(error) {
                console.error('Error to load data:', error);
            }
        });
    });
});