<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng đã bán</th>
            <th>Số lượng còn lại</th>
            <th>Loại sản phẩm</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><img src="{{ $product->image }}" alt="Product Image" class="img-fluid" style="max-width: 50px;"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->total_sold_quantity }}</td>
                <td>{{ $product->total_stock_quantity }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->created_at->format('d-m-Y') }}</td>
                <td>{{ $product->updated_at->format('d-m-Y') }}</td>
                <td>
                    <div class="option">
                        <button class="btn btn-info btn-sm btn-edit" data-id="{{ $product->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $product->id }}"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn btn-primary btn-sm btn-variants" data-id="{{ $product->id }}"><i class="fas fa-info-circle"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($products->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        @foreach ($products->links()->elements[0] as $page => $url)
            @if ($page == $products->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($products->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @endif
    </ul>
</nav>