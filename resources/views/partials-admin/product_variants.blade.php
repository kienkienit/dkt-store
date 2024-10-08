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
