$(document).ready(function() {
    let currentPage = 1;
    let productsPerPage = 8;
    let currentCategoryId = $('.category-item.active').find('.category-link').data('id');

    function loadProducts(categoryId, page) {
        $.ajax({
            url: `/products/category/${categoryId}?page=${page}&per_page=${productsPerPage}`,
            method: 'GET',
            success: function(data) {
                $('#product-list').html(data.products);
                $('.pagination-wrapper').html(data.pagination);
            },
            error: function(error) {
                console.error('Error loading products:', error);
            }
        });
    }

    $('.category-link').on('click', function(e) {
        e.preventDefault();
        let categoryId = $(this).data('id');
        currentPage = 1;
        $('.category-item').removeClass('active');
        $(this).parent().addClass('active');
        loadProducts(categoryId, currentPage);
    });

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        let categoryId = $(this).data('category-id');
        currentPage = page;
        loadProducts(categoryId, page);

        $('.page-item').removeClass('active');
        $(this).parent().addClass('active');
    });

    loadProducts(currentCategoryId, currentPage);
});
