@extends('layouts.admin')
@section('title', 'Login Admin')
@section('content')
    <div class="login-page mx-auto mt-4">
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
            </form>
        </div>
    </div>
@endsection