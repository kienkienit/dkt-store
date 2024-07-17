@extends('layouts.admin')
@section('title', 'Danh Sách Biến Thể Sản Phẩm')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_products.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div class="" style="display: flex; justify-content: space-between">
                <h2>Danh Sách Biến Thể </h2>
                <button class="btn btn-success btn-add-product">Thêm biến thể </button>
            </div>
            <a href="#" class="link-to-products">Danh Sách Sản Phẩm</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Dung lượng</th>
                        <th>Màu sắc</th>
                        <th>Số lượng đã bán</th>
                        <th>Số lượng còn lại</th>
                        <th>Giá</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Xiaomi 14 5G</td>
                        <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRagl6UY6YrAhpj3yScbqoakN7L5eg_zpcWqg&s" alt="Product Image" class="img-fluid" style="max-width: 50px;"></td>
                        <td>256GB</td>
                        <td>Black</td>
                        <td>25</td>
                        <td>35</td>
                        <td>40.000.000</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Xiaomi 14 5G</td>
                        <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRagl6UY6YrAhpj3yScbqoakN7L5eg_zpcWqg&s" alt="Product Image" class="img-fluid" style="max-width: 50px;"></td>
                        <td>256GB</td>
                        <td>Black</td>
                        <td>25</td>
                        <td>35</td>
                        <td>40.000.000</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Xiaomi 14 5G</td>
                        <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRagl6UY6YrAhpj3yScbqoakN7L5eg_zpcWqg&s" alt="Product Image" class="img-fluid" style="max-width: 50px;"></td>
                        <td>256GB</td>
                        <td>Black</td>
                        <td>25</td>
                        <td>35</td>
                        <td>40.000.000</td>
                        <td>
                            <div class="option">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
