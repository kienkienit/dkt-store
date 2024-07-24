$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).data('page');
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: fetchVariantsUrl + "?page=" + page,
            success: function(data) {
                $('#variants-content').html(data.variants);
                $('#pagination-content').html(data.pagination);
            }
        });
    }

    $('#addVariantForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            product_id: $('#product_id').val(),
            storage: $('#storage').val(),
            color: $('#color').val(),
            price: $('#price').val(),
            stock_quantity: $('#stock_quantity').val()
        };

        $.ajax({
            url: addVariantUrl,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#addVariantModal').modal('hide');
                fetch_data(1);
                alert('Biến thể đã được thêm thành công!');
            },
            error: function(xhr) {
                alert('Biến thể này đã tồn tại!');
            }
        });
    });

    $(document).on('click', '.btn-edit', function() {
        var variantId = $(this).data('id');
        $.get(updateVariantUrl + "/" + variantId, function(data) {
            $('#edit_variant_id').val(data.id);
            $('#edit_storage').val(data.storage);
            $('#edit_color').val(data.color);
            $('#edit_price').val(data.price);
            $('#edit_stock_quantity').val(data.stock_quantity);
            $('#editVariantModal').modal('show');
        });
    });

    $('#editVariantForm').on('submit', function(event) {
        event.preventDefault();

        var variantId = $('#edit_variant_id').val();
        var formData = {
            storage: $('#edit_storage').val(),
            color: $('#edit_color').val(),
            price: $('#edit_price').val(),
            stock_quantity: $('#edit_stock_quantity').val()
        };

        $.ajax({
            url: updateVariantUrl + "/" + variantId,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#editVariantModal').modal('hide');
                fetch_data(1);
                alert('Biến thể đã được cập nhật thành công!');
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi cập nhật biến thể.');
            }
        });
    });

    $(document).on('click', '.btn-delete', function() {
        if (confirm('Bạn có chắc chắn muốn xóa biến thể này không?')) {
            var variantId = $(this).data('id');
            $.ajax({
                url: deleteVariantUrl + "/" + variantId,
                method: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    fetch_data(1);
                    alert('Biến thể đã được xóa thành công!');
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra khi xóa biến thể.');
                }
            });
        }
    });
});