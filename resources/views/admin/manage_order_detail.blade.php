@extends('layouts.admin')
@section('title', 'Chi Tiet Don Hang')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_products.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div class="" style="display: flex; justify-content: space-between">
                <h2>Chi Tiet Don Hang</h2>
                <button class="btn btn-success btn-add-product">Danh Sach Don Hang</button>
            </div>
            <h2 class="mt-4 mb-4">Thông tin đơn mua</h2>
            <table class="table table-bordered order-info">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Số lượng mua</th>
                        <th>Giá bán (VND)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Jon Yost I</td>
                        <td>64GB, SlateBlue</td>
                        <td>8</td>
                        <td>24,706,153</td>
                    </tr>
                </tbody>
            </table>
            <div class="order-details">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Tên người đặt hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        Kristoffer Strosin
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Địa chỉ nhận hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        7975 Anais Springs Apt. 453 Margarettown, MT 76532-2495
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>SDT nhận hàng:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        678.483.3605
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Hình thức thanh toán:</label>
                    </div>
                    <div class="col-md-8 info-value">
                        Thanh toán khi nhận hàng
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
