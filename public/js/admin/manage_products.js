$(document).ready(function() {
    function fetch_data(page, categoryId, productName) {
        $.ajax({
            url: "/admin/manage/products?page=" + page,
            method: 'GET',
            data: {
                category_id: categoryId,
                product_name: productName
            },
            success: function(data) {
                $('#product-content').html(data.products);
                $('#pagination-content').html(data.pagination);
            }
        });
    }

    $('.btn-search').on('click', function() {
        var categoryId = $('#productType').val();
        var productName = $('#productName').val();
        fetch_data(1, categoryId, productName);
    });

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).data('page');
        var categoryId = $('#productType').val();
        var productName = $('#productName').val();
        fetch_data(page, categoryId, productName);
    });

    $('#addProductForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            name: $('#name').val(),
            description: $('#description').val(),
            category_id: $('#category_id').val(),
            price: 0,
            image: $('#image').val()
        };
    
        $.ajax({
            url: "/admin/manage/products",
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#addProductModal').modal('hide');
                fetch_data(1); 
                alert('Sản phẩm đã được thêm thành công!');
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi thêm sản phẩm.');
            }
        });
    });            

    $(document).on('click', '.btn-edit', function() {
        var productId = $(this).data('id');
        $.get("/admin/manage/products/" + productId, function(data) {
            $('#editProductId').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_description').val(data.description);
            $('#edit_category_id').val(data.category_id);
            $('#edit_image').val(data.image);
            $('#editProductModal').modal('show');
        });
    });

    $('#editProductForm').on('submit', function(event) {
        event.preventDefault();

        var productId = $('#editProductId').val();
        var formData = {
            name: $('#edit_name').val(),
            description: $('#edit_description').val(),
            category_id: $('#edit_category_id').val(),
            image: $('#edit_image').val() 
        };

        $.ajax({
            url: "/admin/manage/products/" + productId,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#editProductModal').modal('hide');
                fetch_data(1);
                alert('Sản phẩm đã được cập nhật thành công!');
            },
            error: function(xhr) {
                console.error('Error updating product:', xhr);
                alert('Có lỗi xảy ra khi cập nhật sản phẩm.');
            }
        });
    });

    $(document).on('click', '.btn-delete', function() {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
            var productId = $(this).data('id');
            $.ajax({
                url: "/admin/manage/products/" + productId,
                method: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    fetch_data(1); 
                    alert('Sản phẩm đã được xóa thành công!');
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra khi xóa sản phẩm.');
                }
            });
        }
    });

    $(document).on('click', '.btn-variants', function() {
        var productId = $(this).data('id');
        window.location.href = "/admin/manage/products/" + productId + "/variants";
    });

    fetch_data(1, null, null);
});
