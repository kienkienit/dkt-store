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
        @include('partials.product_list', ['products' => $products])
    </div>
    <div class="pagination-wrapper">
        @include('partials.pagination', ['pagination' => $products])
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/user/products.js"></script>