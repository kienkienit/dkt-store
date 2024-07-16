<nav class="navbar-container">
    <ul class="navbar-menu">
        <li class="navbar-item active"><a href="/">Trang Chủ</a></li>
        <li class="navbar-item"><a href="#">Giới Thiệu</a></li>
        <li class="navbar-item dropdown">
            <a href="#">Sản Phẩm <span class="dropdown-arrow">&#9662;</span></a>
            <ul class="dropdown-menu">
                @foreach($categories as $category)
                    <li class="dropdown-item"><a href="#">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="navbar-item"><a href="/news">Tin Tức</a></li>
        <li class="navbar-item"><a href="#">Liên Hệ</a></li>
    </ul>
</nav>
<script>
    function toggleMenu() {
        const menu = document.querySelector('.navbar-container');
        menu.classList.toggle('show');
    }
</script>
