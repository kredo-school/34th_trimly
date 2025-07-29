<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Portal - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: -10%;
            right: -10%;
            width: 40%;
            height: 40%;
            background: linear-gradient(45deg, #d1e7dd, #a3cfbb);
            border-radius: 50%;
            opacity: 0.3;
            z-index: -1;
        }
        
        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -15%;
            width: 50%;
            height: 50%;
            background: linear-gradient(45deg, #e2e3e5, #ced4da);
            border-radius: 50%;
            opacity: 0.2;
            z-index: -1;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .icon-building {
            width: 2rem;
            height: 2rem;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .icon-eye, .icon-eye-off, .icon-arrow-left, .icon-help {
            width: 1.25rem;
            height: 1.25rem;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .icon-email, .icon-lock {
            width: 1.25rem;
            height: 1.25rem;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .floating-circles {
            position: fixed;
            top: 20px;
            right: 30px;
            z-index: -1;
        }

        .circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(45deg, #dee2e6, #adb5bd);
            opacity: 0.6;
            margin-bottom: 10px;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
    <!-- Floating decorative circles -->
    <div class="floating-circles">
        <div class="circle"></div>
        <div class="circle" style="width: 40px; height: 40px; opacity: 0.4;"></div>
    </div>

    <div class="max-w-md w-full login-container rounded-2xl shadow-xl p-8">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="icon-building text-amber-700" viewBox="0 0 24 24">
                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                    <path d="M6 12H4a2 2 0 0 0-2 2v8h20v-8a2 2 0 0 0-2-2h-2"/>
                    <path d="M10 6h4"/>
                    <path d="M10 10h4"/>
                    <path d="M10 14h4"/>
                    <path d="M10 18h4"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Salon Portal</h1>
            <p class="text-gray-600">Welcome back! Sign in to manage your salon.</p>
        </div>

        <!-- Sign In Form -->
        <form onsubmit="handleSignIn(event)" class="space-y-6">
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Sign In</h2>
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                        <svg class="icon-email text-gray-400" viewBox="0 0 24 24">
                            <path d="M16 12a4 4 0 1 0-8 0 4 4 0 0 0 8 0zm0 0v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-9 9m4.5-1.206a8.959 8.959 0 0 1-4.5 1.207"/>
                        </svg>
                    </div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        class="input-field w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all"
                        required
                    />
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                        <svg class="icon-lock text-gray-400" viewBox="0 0 24 24">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        class="input-field w-full pl-10 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all"
                        required
                    />
                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                    >
                        <svg id="eye-icon" class="icon-eye" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg id="eye-off-icon" class="icon-eye-off hidden" viewBox="0 0 24 24">
                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                            <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a13.16 13.16 0 0 1-1.67 2.68"/>
                            <path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8a9.74 9.74 0 0 0 5.39-1.61"/>
                            <line x1="2" x2="22" y1="2" y2="22"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        id="rememberMe"
                        name="rememberMe"
                        class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 focus:ring-2"
                    />
                    <span class="ml-2 text-sm text-gray-700">Remember me</span>
                </label>
                <a href="#" class="text-sm text-amber-600 hover:text-amber-700 transition-colors">
                    Forgot password?
                </a>
            </div>

            <!-- Sign In Button -->
            <button
                type="submit"
                class="w-full bg-amber-200 hover:bg-amber-300 text-amber-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
            >
                Sign In
            </button>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have a salon account yet?
                </p>
                <button 
                    type="button"
                    onclick="handleRegister()"
                    class="mt-2 w-full bg-gray-50 border border-gray-200 hover:bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                >
                    Register Your Salon
                </button>
            </div>

            <!-- Back to Customer Login -->
            <div class="mt-6 text-center">
                <button 
                    type="button"
                    onclick="backToCustomerLogin()"
                    class="flex items-center justify-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors mx-auto"
                >
                    <svg class="icon-arrow-left" viewBox="0 0 24 24">
                        <path d="M19 12H5"/>
                        <path d="m12 19-7-7 7-7"/>
                    </svg>
                    Back to Customer Login
                </button>
            </div>
        </form>

        <!-- Support -->
        <div class="mt-6 text-center">
            <button 
                onclick="contactSupport()"
                class="flex items-center justify-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors mx-auto"
            >
                <svg class="icon-help" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                    <path d="M12 17h.01"/>
                </svg>
                Need help? Contact our support team
            </button>
        </div>
    </div>

    <script>
        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        // Form submission
        function handleSignIn(event) {
            event.preventDefault(); // フォームのデフォルト送信を防ぐ
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            
            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }
            
            console.log('Login attempt:', { email, password, rememberMe });
            alert('Login functionality would be implemented here');
        }

        // Register button
        function handleRegister() {
            alert('Register new salon functionality');
        }

        // Back to customer login
        function backToCustomerLogin() {
            alert('Navigate back to customer login');
        }

        // Contact support
        function contactSupport() {
            alert('Opening support contact form');
        }

        // Form validation on input
        document.getElementById('email').addEventListener('input', function(e) {
            if (e.target.validity.typeMismatch) {
                e.target.setCustomValidity('Please enter a valid email address');
            } else {
                e.target.setCustomValidity('');
            }
        });
    </script>
</body>
</html>