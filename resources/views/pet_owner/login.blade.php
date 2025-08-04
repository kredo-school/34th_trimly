<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login PetOwner</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
      
    <style>
        body {
            background-color: #FEFCF1;
        }
        /* input-group自体にボーダーと角丸を適用 */
        .input-group-custom {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }
        /* input-group-textの背景色とボーダーを調整 */
        .input-group-text-custom {
            background-color: #FEFCF1;
            border: none;
            color: #6c757d; /* アイコンの色 */
            padding-right: 8px; /* アイコンとテキストの間のスペースを調整 */
        }
        /* input-group内のform-controlのボーダーと角丸を調整 */
        .input-group .form-control {
            background-color: #FEFCF1;
            border: none;
            border-radius: 0; /* 角丸を削除 (input-group-customに任せる) */
            padding-left: 0;
        }
        /* 右側の目のアイコンのスタイル */
        .input-group-text-custom-right {
            background-color: #FEFCF1;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding-left: 0; 
        }
        /* form-controlのフォーカス時のシャドウを調整 */
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(240, 195, 142, 0.25); /*フォーカスシャドウの色をボタンカラーに合わせる */
            border-color: #FEFCF1; /*フォーカス時のボーダー色をボタンカラーに合わせる */
        }
        a {
            color: #D5C4B8 !important;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .divider {
            margin: 20px 0; /* 上下の余白 */
            position: relative; /* 子要素（spanや擬似要素）の配置基準 */
        }
        .divider::before { /* 左側の線と右側の線を作成するための擬似要素 */
            content: ''; /* 擬似要素に内容がないことを示す */
            position: absolute; /* 親要素（.divider）を基準に配置 */
            top: 50%; /* 親要素の中央に配置 */
            left: 0;
            right: 0;
            border-top: 1px solid #e0e0e0; /* 罫線の色と太さ */
            z-index: 1; /* spanより奥に表示 */
        }
        .divider span {
            background-color: #fff; 
            padding: 0 10px; 
            position: relative; /* z-indexを適用するため */
            z-index: 2; /* 線より手前に表示 */
            color: #6c757d; 
        }
        .btn-primary {
            background-color: #D5C4B8 !important; 
            border-color: #D5C4B8 !important; 
            border-radius: 8px; 
            padding: 12px 25px;
            font-weight: bold;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #C3B1A6 !important;
            border-color: #C3B1A6 !important; 
        }
        .btn-outline-secondary {
            background-color: #FEFCF1 !important; 
            border-color: #FEFCF1 !important;
            border-radius: 8px; 
            padding: 6px 25px;
            font-weight: bold;
        }
        .btn-outline-secondary:hover {
            background-color: #D5C4B8 !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="login-container text-center">
                    <div class="logo">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trymly Logo" class="img-fluid" style="max-width:150px;">
                    </div>
                    <h2 class="text-muted fw-bold mb-2">Welcome Back!</h2>
                    <p class="text-muted mb-4">Sign in to manage your pets and book appointments</p>
                    <div class="bg-white shadow-sm rounded-5 p-4">
                        
                        <form action="#" method="post">
                            @csrf

                            <div class="mt-3 mb-3 text-start">
                                <label for="email" class="form-label text-muted">Email Address</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="mb-3 text-start">
                                <label for="password" class="form-label text-muted">Password</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                                    <span class="input-group-text input-group-text-custom-right" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label text-muted" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                            <p class="text-muted">Don't have an account? <a href="#" class="text-decoration-none">Sign up here</a></p>

                            <div class="divider mb-4">
                                <span>or</span>
                            </div>

                            <button type="button" class="btn btn-outline-secondary w-100 mb-3">For Salons - Sign In</button>
                            <p class="text-muted">New Salon? <a href="#" class="text-decoration-none">Register Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword'); // IDで要素を取得

            if (passwordField && togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);

                    // 目のアイコンの表示を切り替える
                    if (type === 'password') {
                        this.innerHTML = '<i class="fa-solid fa-eye"></i>'; // 閉じている目
                    } else {
                        this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'; // 開いている目
                    }
                });
            }
        });
    </script>
</body>

</html>
