<div class="sidebar">
    <div class="sidebar-header">
        <button class="sidebar-toggle">
            <span>&#9776;</span> DANH MỤC SẢN PHẨM
        </button>
    </div>
    <ul class="sidebar-menu">
        <li class="sidebar-item"><a href="/">Trang chủ</a></li>
        <li class="sidebar-item"><a href="#">Giới thiệu</a></li>
        <li class="sidebar-item dropdown">
            <a href="#">Sản phẩm <span class="dropdown-arrow">&#9656;</span></a>
            <ul class="dropdown-menu">
                @foreach($categories as $category)
                    <li class="dropdown-item"><a href="#">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="sidebar-item"><a href="/news">Tin tức</a></li>
        <li class="sidebar-item"><a href="#">Liên hệ</a></li>
    </ul>
</div>
