@extends('layouts.admin')
@section('title', 'Danh Sách Biến Thể Sản Phẩm')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_products.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Danh Sách Biến Thể cho Sản Phẩm: {{ $product->name }}</h2>
                <button class="btn btn-success btn-add-variant" data-toggle="modal" data-target="#addVariantModal">Thêm Biến Thể</button>
            </div>
            <a href="{{ route('admin.manage.products') }}" class="link-to-products">Danh Sách Sản Phẩm</a>
            <div id="variants-content">
                @include('partials-admin.product_variants', ['variants' => $variants])
            </div>
        </div>
    </div>

    <!-- Add Variant Modal -->
    <div class="modal fade" id="addVariantModal" tabindex="-1" role="dialog" aria-labelledby="addVariantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVariantModalLabel">Thêm Biến Thể</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addVariantForm">
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="storage">Dung Lượng</label>
                            <input type="text" class="form-control" id="storage" name="storage" required>
                        </div>
                        <div class="form-group">
                            <label for="color">Màu Sắc</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="stock_quantity">Số Lượng Còn Lại</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Variant Modal -->
    <div class="modal fade" id="editVariantModal" tabindex="-1" role="dialog" aria-labelledby="editVariantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVariantModalLabel">Chỉnh Sửa Biến Thể</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editVariantForm">
                        <input type="hidden" id="edit_variant_id" name="variant_id">
                        <div class="form-group">
                            <label for="edit_storage">Dung Lượng</label>
                            <input type="text" class="form-control" id="edit_storage" name="storage" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_color">Màu Sắc</label>
                            <input type="text" class="form-control" id="edit_color" name="color" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_price">Giá</label>
                            <input type="number" class="form-control" id="edit_price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_stock_quantity">Số Lượng Còn Lại</label>
                            <input type="number" class="form-control" id="edit_stock_quantity" name="stock_quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var productId = "{{ $product->id }}";
        var fetchVariantsUrl = "/admin/manage/products/" + productId + "/variants";
        var addVariantUrl = "/admin/manage/products/" + productId + "/variants";
        var updateVariantUrl = "/admin/manage/products/" + productId + "/variants";
        var deleteVariantUrl = "/admin/manage/products/" + productId + "/variants";
    </script>
    <script src="{{ asset('js/admin/manage_product_variants.js') }}"></script>
@endsection