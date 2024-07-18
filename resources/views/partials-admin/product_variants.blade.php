<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Dung lượng</th>
            <th>Màu sắc</th>
            <th>Số lượng đã bán</th>
            <th>Số lượng còn lại</th>
            <th>Giá</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($variants as $variant)
            <tr>
                <td>{{ $variant->product->name }}</td>
                <td><img src="{{ $variant->product->image }}" alt="Product Image" class="img-fluid"></td>
                <td>{{ $variant->storage }}</td>
                <td>{{ $variant->color }}</td>
                <td>{{ $variant->sold_quantity }}</td>
                <td>{{ $variant->stock_quantity }}</td>
                <td>{{ $variant->price }}</td>
                <td>
                    <div class="option">
                        <button class="btn btn-info btn-sm btn-edit" data-id="{{ $variant->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $variant->id }}"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($variants->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $variants->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        @foreach ($variants->links()->elements[0] as $page => $url)
            @if ($page == $variants->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($variants->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $variants->nextPageUrl() }}" aria-label="Next">
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