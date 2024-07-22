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

    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarMenu = document.querySelector('.navbar-menu');
    
    navbarToggler.addEventListener('click', function () {
        navbarMenu.classList.toggle('active');
    });
    
    document.addEventListener('click', function (event) {
        const isClickInsideNavbar = navbarMenu.contains(event.target);
        const isClickOnToggler = navbarToggler.contains(event.target);
        
        if (!isClickInsideNavbar && !isClickOnToggler) {
            navbarMenu.classList.remove('active');
        }
    });
});