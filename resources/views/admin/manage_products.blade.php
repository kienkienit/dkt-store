@extends('layouts.admin')
@section('title', 'Quản Lý Sản Phẩm')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_products.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Danh Sách Sản Phẩm</h2>
                <button class="btn btn-success btn-add-product" data-toggle="modal" data-target="#addProductModal">Thêm Sản Phẩm</button>
            </div>
            <div id="product-content">
                @include('partials-admin.products', ['products' => $products])
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Loại sản phẩm</label>
                            <input type="number" class="form-control" id="category_id" name="category_id" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Đường dẫn ảnh</label>
                            <input type="text" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Chỉnh Sửa Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <input type="hidden" id="editProductId">
                        <div class="form-group">
                            <label for="edit_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Mô tả</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_category_id">Loại sản phẩm</label>
                            <input type="number" class="form-control" id="edit_category_id" name="category_id" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_price">Giá</label>
                            <input type="number" class="form-control" id="edit_price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Đường dẫn ảnh</label>
                            <input type="text" class="form-control" id="edit_image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                $.ajax({
                    url: "{{ route('admin.manage.products') }}?page=" + page,
                    success: function(data) {
                        $('#product-content').html(data.products);
                    }
                });
            }

            $('#addProductForm').on('submit', function(event) {
                event.preventDefault();

                var formData = {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    category_id: $('#category_id').val(),
                    price: $('#price').val(),
                    image: $('#image').val()
                };
            
                $.ajax({
                    url: "{{ route('admin.manage.products.create') }}",
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
                    $('#edit_price').val(data.price);
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
                    price: $('#edit_price').val(),
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
                            _token: '{{ csrf_token() }}'
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
        });
    </script>
@endsection