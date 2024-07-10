<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/partials-admin/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials-admin/sidebar.css') }}">
</head>
<body>
    @include('partials-admin.header')
    @include('partials-admin.sidebar')
    <div class="content-container">
        @yield('content')
    </div>
</body>
</html>