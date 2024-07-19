<div class="tab-pane fade" id="revenue-chart" role="tabpanel" aria-labelledby="revenue-chart-tab">
    <h3>Doanh thu</h3>
    <label for="revenue-year-select">Chọn năm:</label>
    <select id="revenue-year-select" class="form-control">
        @foreach(range(date('Y'), date('Y') - 10) as $year)
            <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
    </select>
    <canvas id="revenueChart"></canvas>
</div>
