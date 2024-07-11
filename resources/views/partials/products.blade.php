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
            <a href="{{ route('product.detail', $product->id) }}" class="product-link">
                <div class="product-item">
                    <span class="is-loved"></span>
                    <img src="{{ $product->image }}" alt="Image">
                    <div class="name">{{ $product->name }}</div>
                    <div class="price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                    <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                </div>
            </a>
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.category-link').on('click', function(e) {
            e.preventDefault();
            var categoryId = $(this).data('id');
            $('.category-item').removeClass('active');
            $(this).parent().addClass('active');
            $.ajax({
                url: '/products/category/' + categoryId,
                method: 'GET',
                success: function(data) {
                    $('#product-list').empty();
                    var productsToShow = data.slice(0, 8);
                    productsToShow.forEach(function(product) {
                        $('#product-list').append(`
                            <div class="product-item">
                                <span class="is-loved"></span>
                                <img src="${product.image}" alt="Image">
                                <div class="name">${product.name}</div>
                                <div class="price">${new Intl.NumberFormat().format(product.price)} VND</div>
                                <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
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
</script>