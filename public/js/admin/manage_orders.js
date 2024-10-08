$(document).ready(function(){
    $('.datepicker').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    function fetchOrders(page, filters = {}) {
        $.ajax({
            url: "/admin/manage/orders?page=" + page,
            method: 'GET',
            data: filters,
            success: function(data) {
                $('#orders-content').html(data.orders);
                $('#pagination-content').html(data.pagination);
            },
            error: function(error) {
                console.error('Error fetching orders:', error);
            }
        });
    }

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).data('page');
        let filters = {
            status: $('#orderStatus').val(),
            order_code: $('#orderCode').val(),
            start_date: $('#startDate').val(),
            end_date: $('#endDate').val()
        };
        fetchOrders(page, filters);
    });

    $(document).on('click', '.btn-search', function(event) {
        event.preventDefault();
        let filters = {
            status: $('#orderStatus').val(),
            order_code: $('#orderCode').val(),
            start_date: $('#startDate').val(),
            end_date: $('#endDate').val()
        };
        fetchOrders(1, filters);
    });

    $(document).on('click', '.btn-edit', function() {
        var orderId = $(this).data('id');
        $.get("/admin/manage/orders/" + orderId, function(data) {
            $('#editOrderId').val(data.id);
            $('#editOrderStatus').val(data.status);
            $('#editTotalAmount').val(data.total_amount);
            $('#editOrderDate').val(new Date(data.order_date).toISOString().split('T')[0]);
            $('#editName').val(data.name);
            $('#editAddress').val(data.address);
            $('#editPaymentMethod').val(data.payment_method);
            $('#editOrderModal').modal('show');

            if (data.status === 'delivered') {
                $('#updateOrderButton').prop('disabled', true);
            } else {
                $('#updateOrderButton').prop('disabled', false);
            }
        });
    });

    $('#editOrderForm').on('submit', function(event) {
        event.preventDefault();

        var orderId = $('#editOrderId').val();
        var formData = {
            status: $('#editOrderStatus').val(),
            total_amount: $('#editTotalAmount').val(),
            order_date: $('#editOrderDate').val(),
            name: $('#editName').val(),
            address: $('#editAddress').val(),
            payment_method: $('#editPaymentMethod').val()
        };

        $.ajax({
            url: "/admin/manage/orders/" + orderId,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#editOrderModal').modal('hide');
                alert('Thông tin đơn hàng đã được cập nhật thành công!');
                let filters = {
                    status: $('#orderStatus').val(),
                    order_code: $('#orderCode').val(),
                    start_date: $('#startDate').val(),
                    end_date: $('#endDate').val()
                };
                fetchOrders(1, filters);
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi cập nhật thông tin đơn hàng.');
            }
        });
    });

    $(document).on('click', '.btn-detail', function() {
        var orderId = $(this).data('id');
        window.location.href = "/admin/manage/orders/" + orderId + "/detail";
    });

    fetchOrders(1);
});
