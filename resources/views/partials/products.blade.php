<div class="products-container">
    <div class="header-products">
        <ul class="category-menu">
            @foreach($categories as $category)
                <li class="category-item {{ $loop->first ? 'active' : '' }}">
                    <a href="#" class="category-link" data-id="{{ $category->id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="middle-products" id="product-list">
        @foreach ($products->take(8) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-0">
                <a href="{{ route('product.detail', $product->id) }}" class="product-link">
                    <div class="product-item">
                        <span class="is-loved"></span>
                        <img src="{{ $product->image }}" alt="Image">
                        <div class="name">{{ $product->name }}</div>
                        <div class="price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                        <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <ul class="pagination" style="margin-top: 10px;"></ul>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let currentPage = 1;
        let productsPerPage = 8;
        let totalProducts = 0;
        let currentCategoryId = null;

        function loadProducts(categoryId, page) {
            $.ajax({
                url: `/products/category/${categoryId}?page=${page}&per_page=${productsPerPage}`,
                method: 'GET',
                success: function(data) {
                    if (page === 1) {
                        totalProducts = data.total; 
                        currentCategoryId = categoryId;
                        updatePagination();
                    }
                    $('#product-list').empty();
                    data.data.forEach(function(product) {
                        var productId = product.id;
                        var productHtml = `
                            <a href="product/${productId}" class="product-link">
                                <div class="product-item">
                                    <span class="is-loved"></span>
                                    <img src="${product.image}" alt="Image">
                                    <div class="name">${product.name}</div>
                                    <div class="price">${new Intl.NumberFormat().format(product.price)} VND</div>
                                    <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                                </div>
                            </a>
                        `;
                        $('#product-list').append(productHtml);
                    });
                },
                error: function(error) {
                    console.error('Error loading products:', error);
                }
            });
        }

        function updatePagination() {
            let totalPages = Math.ceil(totalProducts / productsPerPage);
            $('.pagination').empty();
            for (let i = 1; i <= totalPages; i++) {
                $('.pagination').append(`
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}" data-category-id="${currentCategoryId}">${i}</a>
                    </li>
                `);
            }
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
        });

        let defaultCategoryId = $('.category-item.active').find('.category-link').data('id');
        loadProducts(defaultCategoryId, currentPage);
    });
</script>