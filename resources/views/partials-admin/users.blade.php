<table class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <div class="option">
                        <button class="btn btn-info btn-sm btn-edit" data-id="{{ $user->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($users->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        @foreach ($users->links()->elements[0] as $page => $url)
            @if ($page == $users->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($users->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
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
