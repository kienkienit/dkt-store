document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('register-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const passwordConfirm = document.getElementById('password-confirm').value.trim();

        if (username === '') {
            alert('Username is required');
            return;
        }

        if (email === '' || !validateEmail(email)) {
            alert('Valid email is required');
            return;
        }

        if (password === '') {
            alert('Password is required');
            return;
        }

        if (password !== passwordConfirm) {
            alert('Passwords do not match');
            return;
        }

        form.submit();
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
