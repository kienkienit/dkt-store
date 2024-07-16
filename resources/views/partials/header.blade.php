<header>
    <div class="top-header">
        <div class="left-top-header">
            <div class="hotline">
                <img src="{{ asset('images/icon_hotline.svg') }}" alt="Hotline">
                <a href="#" class="hotline-title">19006750</a>
            </div>
            <div class="email-support">
                <img src="{{ asset('images/icon_email_support.svg') }}" alt="Support">
                <a href="#" class="email-support">support@sapo.vn</a>
            </div>
        </div>
        <div class="right-top-header">
            @guest
                <div class="login">
                    <img src="{{ asset('images/icon_login.svg') }}" alt="Login">
                    <a href="{{ route('login') }}" class="login">Đăng nhập</a>
                </div>
                <div class="register">
                    <img src="{{ asset('images/icon_register.svg') }}" alt="Register">
                    <a href="{{ route('register') }}" class="register">Đăng ký</a>
                </div>
            @else
                <div class="login">
                    <img src="{{ asset('images/icon_account.svg') }}" alt="Account">
                    <a href="#" class="login">Tài khoản</a>
                </div>
                <div class="register">
                    <img src="{{ asset('images/icon_exit.svg') }}" alt="Logout">
                    <a href="#" class="register" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Thoát</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div>
    <div class="bottom-header">
        <div class="left-bottom-header">
            <button class="navbar-toggler" onclick="toggleMenu()">
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
            </button>
            <a href="/" class="logo">
                <img src="//bizweb.dktcdn.net/100/047/633/themes/887206/assets/logo.png?1676252851087" alt="DKT Store">
            </a>
            <button class="navbar-toggler none-button">
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
                <div class="navbar-toggler-icon"></div>
            </button>
        </div>
        <div class="mid-bottom-header">
            <form action="/search" class="search-form">
                <input type="text" placeholder="Nhập từ khóa tìm kiếm..." class="search-input">
                <button class="btn-search btn btn-primary">
                    <img src="{{ asset('images/icon_search.svg') }}" alt="Search">
                </button>
            </form>
        </div>
        <div class="right-bottom-header">
            <div class="loved-products">
                <span class="icon">
                    <img src="{{ asset('images/icon_love.svg') }}" alt="Loved">
                </span>
                <span class="loved-count">0</span>
                <span class="loved-text">Yêu thích</span>
            </div>
            <div class="cart">
                <span class="icon">
                    <img src="{{ asset('images/icon_cart.svg') }}" alt="Cart">
                </span>
                <span class="cart-count">0</span>
                <span class="cart-text">Sản phẩm</span>
            </div>
        </div>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartIcon = document.querySelector('.cart');
    
        if (cartIcon) {
            cartIcon.addEventListener('click', function () {
                fetch('/api/check-role')
                    .then(response => response.json())
                    .then(data => {
                        if (data.authenticated && data.role === 'user') {
                            window.location.href = '/user/cart';
                        } else if (!data.authenticated) {
                            window.location.href = '/login';
                        } else {
                            alert('Bạn không có quyền truy cập giỏ hàng.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        window.location.href = '/login';
                    });
            });
        }
        function toggleMenu() {
            const menu = document.getElementById('navbar');
            menu.classList.toggle('show');
        }
    });    
</script>
