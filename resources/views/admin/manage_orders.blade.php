@extends('layouts.admin')
@section('title', 'Danh Sách Đơn Hàng')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_orders.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div class="row mb-4 align-items-end">
                <div class="col-md-5">
                    <label for="productType">Trang thai don hang</label>
                    <select class="form-control" id="productType">
                        <option>Tất cả</option>
                        <option>Oppo</option>
                        <option>Samsung</option>
                        <option>Apple</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="productName">Ma don hang:</label>
                    <input type="text" class="form-control" id="productName" placeholder="Nhập tên sản phẩm">
                </div>
            </div>
            <div class="row mb-4 align-items-end">
                <div class="col-md-5">
                    <label for="startDate">Ngày đặt từ ngày:</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" id="startDate" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="endDate">Đến ngày:</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" id="endDate" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-search">Tìm kiếm</button>
            <h2>Danh Sách Đơn Hàng</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Người mua</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền (VND)</th>
                        <th>Ngày đặt</th>
                        <th>Cập nhật</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>8021481</td>
                        <td>emever</td>
                        <td class="text-success">Giao hàng thành công</td>
                        <td>47.047.684</td>
                        <td>06-05-2024 18:34:56</td>
                        <td>06-05-2024 21:23:04</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2612804</td>
                        <td>systemadmin</td>
                        <td class="text-success">Giao hàng thành công</td>
                        <td>7.341.076</td>
                        <td>06-05-2024 18:15:41</td>
                        <td>06-05-2024 21:23:06</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>7522201</td>
                        <td>dat123</td>
                        <td class="text-success">Giao hàng thành công</td>
                        <td>3.234.079</td>
                        <td>06-05-2024 17:34:12</td>
                        <td>06-05-2024 21:23:08</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>6054055</td>
                        <td>ANguyenVan</td>
                        <td class="text-success">Giao hàng thành công</td>
                        <td>6.823.393</td>
                        <td>06-05-2024 04:21:37</td>
                        <td>06-05-2024 21:23:10</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true
            });
        });
    </script>
@endsection
