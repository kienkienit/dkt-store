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
