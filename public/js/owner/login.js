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
    window.location.href = '/register-salonowner';
}

/**
 * Get CSRF token
 */
function getCsrfToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.getAttribute('content') : '';
}

/**
 * Show/hide loading state
 */
function setLoading(isLoading) {
    const submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.disabled = isLoading;
        submitButton.innerHTML = isLoading ? 
            '<span class="spinner-border spinner-border-sm me-2"></span>Logging in...' : 
            'Login';
    }
}

/**
 * Show error message
 */
function showError(message) {
    // Remove existing alert
    const existingAlert = document.querySelector('.alert');
    if (existingAlert) {
        existingAlert.remove();
    }

    // Create new alert
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Insert alert before form
    const form = document.getElementById('loginForm');
    form.parentNode.insertBefore(alertDiv, form);
}

/**
 * Handle form submission
 */
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                showError('Please enter both email and password.');
                return;
            }

            setLoading(true);

            try {
                const response = await fetch('/salon-owner/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Login successful
                    console.log('Login successful:', data);
                    
                    // Redirect to dashboard
                    window.location.href = '/dashboard-salonowner/appointments';
                } else {
                    // Login failed
                    showError(data.message || 'Invalid email or password. Please try again.');
                }
            } catch (error) {
                console.error('Login error:', error);
                showError('An error occurred. Please try again later.');
            } finally {
                setLoading(false);
            }
        });
    }

    // Check if already logged in
    checkAuthStatus();
});

/**
 * Check authentication status
 */
async function checkAuthStatus() {
    try {
        const response = await fetch('/salon-owner/check', {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            }
        });

        const data = await response.json();

        if (data.authenticated) {
            // Already logged in, redirect to dashboard
            window.location.href = '/dashboard-salonowner/appointments';
        }
    } catch (error) {
        console.error('Auth check error:', error);
    }
}