@extends('layouts.master')
@section('title', 'Register')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <div class="go-home">
        <a href="#">Trang chủ</a>
        <span>>></span>
        <p>Đăng ký tài khoản</p>
    </div>
    <div class="container register-page">
        <div class="register-part">
            <h3 class="register-title">Đăng ký tài khoản</h3>
            <form>
                <div class="form-group">
                    <label for="fullname">Họ và tên <span>*</span></label>
                    <input type="text" class="form-control" id="fullname" placeholder="Họ và tên">
                </div>
                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ <span>*</span></label>
                    <input type="text" class="form-control" id="address" placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <label for="phone-number">Số điện thoại <span>*</span></label>
                    <input type="text" class="form-control" id="phone-number" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu <span>*</span></label>
                    <input type="password" class="form-control" id="password" placeholder="Mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary btn-register">Đăng ký</button>
                <p class="login-or">Hoặc đăng nhập bằng</p>
                <div class="line"></div>
                <div class="social-login">
                    <button type="button" class="btn btn-facebook btn-primary">Facebook</button>
                    <button type="button" class="btn btn-google btn-primary">Google</button>
                </div>
            </form>
        </div>
        <div class="profit-part">
            <h3 class="profit-title">Quyền lợi với thành viên</h3>
            <ul>
                <li>Vận chuyển siêu tốc</li>
                <li>Sản phẩm đa dạng</li> 
                <li>Đổi trả dễ dàng</li>
                <li>Tích điểm đối qua</li>
                <li>Được giảm giá cho lần mua tiếp theo lên đến 10%</li>
            </ul>
            <button type="button" class="btn btn-primary btn-login">Đăng nhập</button>
        </div>
    </div>
@endsection
