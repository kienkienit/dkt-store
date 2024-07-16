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