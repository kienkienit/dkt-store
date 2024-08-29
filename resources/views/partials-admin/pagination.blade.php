<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($pagination['current_page'] > 1)
            <li class="page-item">
                <a class="page-link" href="#" data-page="{{ $pagination['current_page'] - 1 }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        @php
            $total_pages = $pagination['last_page'];
            $current_page = $pagination['current_page'];
            $start_page = max($current_page - 2, 1);
            $end_page = min($current_page + 2, $total_pages);
        @endphp

        @if ($start_page > 1)
            <li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>
            @if ($start_page > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
        @endif

        @for ($i = $start_page; $i <= $end_page; $i++)
            @if ($i == $current_page)
                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a></li>
            @endif
        @endfor

        @if ($end_page < $total_pages)
            @if ($end_page < $total_pages - 1)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            <li class="page-item"><a class="page-link" href="#" data-page="{{ $total_pages }}">{{ $total_pages }}</a></li>
        @endif

        @if ($pagination['current_page'] < $total_pages)
            <li class="page-item">
                <a class="page-link" href="#" data-page="{{ $pagination['current_page'] + 1 }}" aria-label="Next">
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
