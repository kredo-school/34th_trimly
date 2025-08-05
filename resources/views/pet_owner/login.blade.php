<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login PetOwner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

    <style>
        /* 共通CSSにないもの */

         /* 1. Inputフォームのデザイン */
        .input-group-custom {
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .input-group-text-custom {
            background-color: var(--color-background);
            border: none;
            color: var(--color-text-secondary);
            padding-right: var(--spacing-sm);
        }

        .input-group .form-control {
            background-color: var(--color-background);
            border: none;
            border-radius: 0;
            padding-left: 0;
        }

        .input-group-text-custom-right {
            background-color: var(--color-background);
            border: none;
            color: var(--color-text-secondary);
            cursor: pointer;
            padding-left: 0;
        }
         /* ２. For Salonボタンのデザイン */
        .btn-outline-secondary {
            background-color: var(--color-background);
            border-color: var(--color-background);
            border-radius: var(--radius-md);
            padding: var(--spacing-sm) var(--spacing-lg);
            font-weight: 500;
        }

        .btn-outline-secondary:hover {
            background-color: var(--color-primary);
        }

        /* ３. or罫線のデザイン */
        .divider {
            margin: var(--spacing-md) 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            border-top: 1px solid var(--color-border);
            z-index: 1;
        }

        .divider span {
            background-color: white;
            /* 背景色は共通CSSの--color-surfaceを使用 */
            padding: 0 var(--spacing-sm);
            position: relative;
            z-index: 2;
            color: var(--color-text-secondary);
        }
    </style>
</head>

<body class="login-page-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="login-container text-center">
                    <div class="logo">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trymly Logo" class="img-fluid"
                            style="max-width:150px;">
                    </div>
                    <h2>Welcome Back!</h2>
                    <p>Sign in to manage your pets and book appointments</p>
                    <div class="bg-white shadow-sm rounded-5 p-4">

                        <form action="#" method="post">
                            @csrf

                            <div class="mt-3 mb-3 text-start">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="mb-3 text-start">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Enter your password" required>
                                    <span class="input-group-text input-group-text-custom-right" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                            <p>Don't have an account? <a href="#" class="text-decoration-none">Sign up here</a></p>

                            <div class="divider mb-4">
                                <span>or</span>
                            </div>

                            <button type="button" class="btn btn-outline-secondary w-100 mb-3">For Salons - Sign In</button>
                            <p>New Salon? <a href="#" class="text-decoration-none">Register Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script src="{{ asset('js/pet_owner.login.js') }}" defer></script>
</body>

</html>
