@extends('layouts.master')
@section('title', 'Login')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <div class="go-home">
        <a href="#">Trang chủ</a>
        <span>>></span>
        <p>Đăng nhập tài khoản</p>
    </div>
    <div class="login-page">
        <div class="login-part">
            <h3 class="login-title">Đăng nhập tài khoản</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username <span>*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu <span>*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary btn-login">Đăng nhập</button>
                <p class="login-or">Hoặc đăng nhập bằng</p>
                <div class="line"></div>
                <div class="social-login">
                    <button type="button" class="btn btn-facebook btn-primary">Facebook</button>
                    <button type="button" class="btn btn-google btn-primary">Google</button>
                </div>
                <p class="forgot-password">
                    Bạn quên mật khẩu bấm <a href="#">vào đây</a>
                </p>
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
            <button type="button" class="btn btn-primary btn-register" onclick="window.location.href='{{ route('register') }}'">Đăng ký</button>
        </div>
    </div>
@endsection
