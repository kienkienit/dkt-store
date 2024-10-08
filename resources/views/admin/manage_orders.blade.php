@extends('layouts.admin')
@section('title', 'Danh Sách Đơn Hàng')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_orders.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div class="row mb-4 align-items-end ml-3">
                <div class="col-md-5 pl-0">
                    <label for="orderStatus">Trạng thái đơn hàng:</label>
                    <select class="form-control" id="orderStatus" name="status">
                        <option value="">Tất cả</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="shipped">Đã giao</option>
                        <option value="delivered">Đã nhận</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="orderCode">Mã đơn hàng:</label>
                    <input type="text" class="form-control" id="orderCode" name="order_code" placeholder="Nhập mã đơn hàng">
                </div>
            </div>
            <div class="row mb-4 align-items-end ml-3">
                <div class="col-md-5 pl-0">
                    <label for="startDate">Ngày đặt từ ngày:</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" id="startDate" name="start_date" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="endDate">Đến ngày:</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" id="endDate" name="end_date" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-search ml-3">Tìm kiếm</button>
            <h2 class="ml-3 mb-3">Danh Sách Đơn Hàng</h2>
            <div id="orders-content">
                @include('partials-admin.orders', ['orders' => $orders])
            </div>
            <div id="pagination-content">
                @include('partials-admin.pagination', ['pagination' => $pagination])
            </div>
        </div>
    </div>

    <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel">Chỉnh Sửa Đơn Hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editOrderForm">
                        <input type="hidden" id="editOrderId">
                        <div class="form-group">
                            <label for="editOrderStatus">Trạng thái</label>
                            <select class="form-control" id="editOrderStatus" name="status" required>
                                @foreach(\App\Enums\OrderStatus::cases() as $status)
                                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTotalAmount">Tổng tiền</label>
                            <input type="number" class="form-control" id="editTotalAmount" name="total_amount" required>
                        </div>
                        <div class="form-group">
                            <label for="editOrderDate">Ngày đặt</label>
                            <input type="date" class="form-control" id="editOrderDate" name="order_date" required>
                        </div>
                        <div class="form-group">
                            <label for="editName">Người mua</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editAddress">Địa chỉ</label>
                            <input type="text" class="form-control" id="editAddress" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="editPaymentMethod">Phương thức thanh toán</label>
                            <select class="form-control" id="editPaymentMethod" name="payment_method" required>
                                <option value="cod">Thanh toán khi nhận hàng</option>
                                <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                                <option value="credit_card">Thẻ tín dụng</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="updateOrderButton">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/manage_orders.js') }}"></script>
@endsection