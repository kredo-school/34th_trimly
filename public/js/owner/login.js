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
 * Handle form submission
 */
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (email && password) {
                // TODO: Add actual login logic
                alert(`Login attempt for: ${email}`);
                // window.location.href = '/salon/dashboard';
            }
        });
    }
});