<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Người mua</th>
            <th>Trạng thái</th>
            <th>Tổng tiền (VND)</th>
            <th>Ngày đặt</th>
            <th>Cập nhật</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td class="text-success">{{ $order->status }}</td>
                <td>{{ number_format($order->total_amount) }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y H:i:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</td>
                <td>
                    <div class="option">
                        <button class="btn btn-info btn-sm btn-edit" data-id="{{ $order->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-primary btn-sm btn-detail" data-id="{{ $order->id }}"><i class="fas fa-info-circle"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($orders->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        @foreach ($orders->links()->elements[0] as $page => $url)
            @if ($page == $orders->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($orders->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
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
