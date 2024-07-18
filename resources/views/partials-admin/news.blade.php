<!-- resources/views/partials-admin/news.blade.php -->

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ảnh</th>
            <th>Tiêu Đề</th>
            <th>Ngày Đăng Tin</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($news as $newsItem)
            <tr>
                <td><img src="{{ $newsItem->image }}" alt="Image" width="100"></td>
                <td>{{ $newsItem->title }}</td>
                <td>{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</td>
                <td>
                    <div class="option">
                        <button class="btn btn-info btn-sm btn-edit" data-id="{{ $newsItem->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $newsItem->id }}"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($news->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $news->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        @foreach ($news->links()->elements[0] as $page => $url)
            @if ($page == $news->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($news->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $news->nextPageUrl() }}" aria-label="Next">
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