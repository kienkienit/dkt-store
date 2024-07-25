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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="register-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username <span>*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu <span>*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu <span>*</span></label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
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
            <button type="button" class="btn btn-primary btn-login" onclick="window.location.href='{{ route('login') }}'">Đăng nhập</button>
        </div>
    </div>
    <script src="{{ asset('js/auth/register.js') }}"></script>
@endsection
