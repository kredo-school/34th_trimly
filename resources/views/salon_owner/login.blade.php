{{-- Need to create CSS for this --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Portal - Sign In</title>
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Reset and Base Styles */
        /* Create a base style for the application @ Juri*/
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            background-color: #FEFCF1;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 300px;
            height: 300px;
            background-color: rgba(200, 220, 200, 0.3);
            border-radius: 50%;
            z-index: -1;
        }

        /* Common Layout */
        .main-content {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo-section {
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background-color: #D5C4B8;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
        }

        .info-icon {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 24px;
            height: 24px;
            background-color: #999;
            border: 2px solid #FEFCF1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
            cursor: pointer;
        }

        .info-icon::before {
            content: "?";
            font-weight: bold;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 40px;
        }

        /* Card Component */
        .card {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .form-card {
            background-color: white;
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group-custom {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            transition: border-color 0.2s;
            background-color: white;
        }

        .input-group-custom:focus-within {
            border-color: #D5C4B8;
        }

        .input-group-text-custom {
            background-color: white;
            border: none;
            color: #6c757d;
            padding: 12px 16px;
            display: flex;
            align-items: center;
        }

        .form-input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            font-size: 16px;
            background-color: white;
            outline: none;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .password-input-container {
            position: relative;
            flex: 1;
            display: flex;
        }

        .password-toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
            stroke: #999;
            fill: none;
            stroke-width: 1.5;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
            stroke: #999;
            fill: none;
            stroke-width: 1.5;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-container input[type="checkbox"] {
            margin: 0;
        }

        .forgot-password {
            color: #D5C4B8;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Button Styles */
        .btn {
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back {
            background-color: white;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-back:hover {
            background-color: #f5f5f5;
        }

        .btn-continue {
            background-color: #D5C4B8;
            color: white;
            margin-left: auto;
        }

        .btn-continue:hover {
            background-color: #C3B1A6;
        }

        .btn-continue:disabled {
            background-color: #e0d4c1;
            cursor: not-allowed;
        }

        /* Actions Container */
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .btn-signin {
            width: 100%;
            padding: 14px;
            background-color: #D5C4B8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 30px;
        }

        .btn-signin:hover {
            background-color: #C3B1A6;
        }

        .register-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .register-text {
            color: #666;
            margin-bottom: 12px;
        }

        .btn-register {
            width: 100%;
            padding: 12px 32px;
            background-color: #FEFCF1;
            color: #333;
            border: 2px solid #D5C4B8;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-register:hover {
            background-color: #D5C4B8;
            color: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
            padding: 12px 32px;
            background-color: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .back-link:hover {
            background-color: #f5f5f5;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <div class="logo">
                <img src="images/Trimly Logo.png" alt="Trymly Logo" style="max-width:150px;">
            </div>
            
            <h1>Salon Portal</h1>
            <p class="subtitle">Welcome back! Sign in to manage your salon.</p>
        </div>

        <div class="form-card">
            <h2 class="form-title">Sign In</h2>
            
            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            id="email" 
                            class="form-input" 
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <div class="password-input-container">
                            <input 
                                type="password" 
                                id="password" 
                                class="form-input" 
                                placeholder="Enter your password"
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <svg id="eyeIcon" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                    <path id="eyeSlash" d="M4.5 4.5l15 15" style="display: none;"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-options">
                    <div class="checkbox-container">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="btn-signin">Sign In</button>
                
                <div style="border-top: 1px solid #e0e0e0; margin: 20px 0;"></div>
            </form>

            <div class="register-section">
                <p class="register-text">Don't have a salon account yet?</p>
                <button type="button" class="btn-register" onclick="showRegisterAlert()">Register Your Salon</button>
            </div>

            <a href="#" style="color: #666; text-decoration: none; font-size: 14px; display: block; text-align: center; margin-top: 20px;">
                ← Back to Customer Login
            </a>
        </div>

        <p style="text-align: center; margin-top: 30px; color: #999; font-size: 14px;">
            Need help? Contact our <a href="#" style="color: #999; text-decoration: underline;">support team</a>
        </p>
    </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeSlash = document.getElementById('eyeSlash');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeSlash.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeSlash.style.display = 'none';
            }
        }

        function showRegisterAlert() {
            alert('Registration page would open here!');
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (email && password) {
                alert(`Login attempt for: ${email}`);
            }
        });
    </script>
</body>
</html>