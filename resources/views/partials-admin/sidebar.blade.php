<div class="admin-sidebar">
    <div class="admin-manage">Admin Manage</div>
    <ul class="manage-list">
        <li class="manage-products-item {{ request()->is('admin/manage/products*') ? 'active' : '' }}">
            <a href="{{ route('admin.manage.products') }}">Quản lý sản phẩm</a>
        </li>
        <li class="manage-orders-item {{ request()->is('admin/manage/orders*') ? 'active' : '' }}">
            <a href="{{ route('admin.manage.orders') }}">Quản lý đơn đặt hàng</a>
        </li>
        <li class="manage-users-item {{ request()->is('admin/manage/users*') ? 'active' : '' }}">
            <a href="{{ route('admin.manage.users') }}">Quản lý tài khoản</a>
        </li>
        <li class="manage-reports-item {{ request()->is('admin/statistics*') ? 'active' : '' }}">
            <a href="{{ route('admin.statistics.index') }}">Thống kê và báo cáo</a>
        </li>
        <li class="manage-news-item {{ request()->is('admin/manage/news*') ? 'active' : '' }}">
            <a href="{{ route('admin.manage.news') }}">Quản lý tin tức</a>
        </li>
    </ul>
</div>