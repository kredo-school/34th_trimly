<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login PetOwner</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f6f2;
        }
    </style>
</head>
<body>
    <div class="container"> 
        <div class="row justify-content-center"> 
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="login-container text-center">
                    <div class="logo">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trymly Logo" class="img-fluid" style="max-width:100px;">
                    </div>
                        <h3 class="mb-4">Welcome Back!</h3>
                        <p class="text-muted mb-4">Sign in to manage your pets and book appointments</p>
                            <div class="bg-white shadow-sm rounded-5 py-4 px-4">
                                <form>
                                    <div class="mb-3 text-start">
                                        <label for="email" class="form-label text-muted">Email Address</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-start position-relative">
                                        <label for="password" class="form-label text-muted">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
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

</body>
</html>
