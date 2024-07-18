<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản Lý Sản Phẩm</h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="btn btn-danger">Đăng Xuất</button>
    </form>
</div>
