<div class="admin-header">
    <h1>Quản Lý Sản Phẩm</h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Đăng Xuất</button>
    </form>
</div>
