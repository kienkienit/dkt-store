<div class="tab-pane fade" id="top-revenue" role="tabpanel" aria-labelledby="top-revenue-tab">
    <h3>Sản phẩm doanh thu tốt</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Doanh thu (VND)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topRevenue as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
