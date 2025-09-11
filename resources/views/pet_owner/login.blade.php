    @extends('layouts.pet_owner')

    @section('title', 'PetOwner Login')

    @push('styles')
        <style>
     
        </style>
    @endpush

    @section('content')
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="login-container text-center">
                    <div class="logo">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trymly Logo" class="img-fluid mx-auto d-block" style="max-width:150px; height:auto;">
                    </div>
                    <h2>Welcome Back!</h2>
                    <p>Sign in to manage your pets and book appointments</p>
                    <div class="bg-white shadow-sm rounded-5 p-4">
                       
                        @if (session('status'))
                            <div class="alert alert-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->has('email'))
                            <div class="alert alert-danger mb-3">
                                {{ $errors->first('email') }}
                            </div>
                        @endif


                        <form action="{{ route('pet_owner.login') }}" method="post">
                            @csrf

                            <div class="mt-3 mb-3 text-start">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="mb-3 text-start">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required>
                                    <span class="input-group-text input-group-text-custom-right" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                            <p>Don't have an account? <a href="{{ route('pet_owner.register.saloncode') }}"
                                    class="text-decoration-none">Sign up here</a></p>

                            <div class="divider mb-4">
                                <span>or</span>
                            </div>

                            <a href="{{ route('salonowner.login') }}" class="btn btn-outline-secondary w-100 mb-3" role="button">
                                For Salons - Sign In
                            </a>
                            <p>New Salon? <a href="{{ route('salon.register.create') }}" class="text-decoration-none">Register Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        @endsection

        @push('scripts')
            <script src="{{ asset('js/pet_owner/pet_owner.login.js') }}" defer></script>
        @endpush
