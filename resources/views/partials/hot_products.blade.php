<div class="hot-products-container">
    <div class="header-hot-products">
        <div class="title-hot-products">SẢN PHẨM HOT</div>
        <ul class="hot-menu">
            @foreach($categories as $category)
                <li class="hot-item {{ $loop->first ? 'active' : '' }}">
                    <a href="" class="hot-category-link" data-id="{{ $category->id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="middle-hot-products" id="hot-product-list">
        @foreach ($hotProducts->take(4) as $product)
            <a href="{{ route('product.detail', $product->id) }}" class="product-link">
                <div class="product-item">
                    <span class="is-loved"></span>
                    <img src="{{ $product->image }}" alt="Image">
                    <div class="name">{{ $product->name }}</div>
                    <div class="price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                    <button class="btn btn-primary add-to-cart">CHỌN SẢN PHẨM</button>
                </div>
                @endforeach
            </a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
                    var productsToShow = data.slice(0, 4);
                    productsToShow.forEach(function(product) {
                        $('#hot-product-list').append(`
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