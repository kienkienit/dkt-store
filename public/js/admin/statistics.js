document.addEventListener('DOMContentLoaded', function () {
    const revenueYearSelect = document.getElementById('revenue-year-select');
    const orderYearSelect = document.getElementById('order-year-select');
    const revenueChartCtx = document.getElementById('revenueChart').getContext('2d');
    const orderChartCtx = document.getElementById('orderChart').getContext('2d');

    function drawChart(ctx, labels, data, label) {
        if (ctx.chart) {
            ctx.chart.destroy();
        }

        ctx.chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: 'rgba(119, 202, 100, 0.5)',
                    borderColor: 'rgba(119, 202, 100, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function fetchChartData(url, ctx, label) {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const labels = Array.from({ length: 12 }, (_, i) => `Tháng ${i + 1}`);
                const chartData = labels.map((_, i) => data[i + 1] || 0);
                drawChart(ctx, labels, chartData, label);
            })
            .catch(error => {
                console.error('Error fetching chart data:', error);
            });
    }

    revenueYearSelect.addEventListener('change', function () {
        const year = this.value;
        fetchChartData(`/admin/statistics/revenue/${year}`, revenueChartCtx, 'Doanh thu (VND)');
    });

    orderYearSelect.addEventListener('change', function () {
        const year = this.value;
        fetchChartData(`/admin/statistics/orders/${year}`, orderChartCtx, 'Số lượng đơn hàng');
    });

    const initialYear = new Date().getFullYear();
    revenueYearSelect.value = initialYear;
    orderYearSelect.value = initialYear;

    fetchChartData(`/admin/statistics/revenue/${initialYear}`, revenueChartCtx, 'Doanh thu (VND)');
    fetchChartData(`/admin/statistics/orders/${initialYear}`, orderChartCtx, 'Số lượng đơn hàng');
});
