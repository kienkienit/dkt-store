<div class="tab-pane fade show active" id="best-sellers" role="tabpanel" aria-labelledby="best-sellers-tab">
    <h3>Sản phẩm bán chạy</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng đã bán</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bestSellers as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
