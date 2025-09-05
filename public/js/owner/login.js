/**
 * Toggle password visibility
 */
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.owner-password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.className = 'fa-solid fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        eyeIcon.className = 'fa-solid fa-eye';
    }
}

/**
 * Navigate to registration page
 */
function goToRegister() {
    window.location.href = '/register-salonowner/salon-info';
}

/**
 * Handle form submission with API call
 */
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    if (!loginForm) return;

    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const tokenInput = loginForm.querySelector('input[name="_token"]');
        const csrfToken = tokenInput ? tokenInput.value : '';

        if (!email || !password) return;

        try {
            const response = await fetch('/salon-owner/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json().catch(() => ({}));

            if (response.ok && data && data.success) {
                window.location.href = '/salon-owner/calendar';
            } else {
                const message = (data && data.message) ? data.message : 'Login failed';
                alert(message);
            }
        } catch (err) {
            console.error('Login error', err);
            alert('Network error. Please try again.');
        }
    });
});
