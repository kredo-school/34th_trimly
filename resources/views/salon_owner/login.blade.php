{{-- =====================================================
   * To do
   ✅create CSS for this

   ===================================================== --}}


   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>Salon Portal - Sign In</title>
       <!-- Font Awesome Icons -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
           integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
           crossorigin="anonymous" referrerpolicy="no-referrer" />
       <!-- Custom CSS -->
       <link href="/css/login-salon-owner.css" rel="stylesheet">
       <link href="/css/app.css" rel="stylesheet">
   </head>
   <body>
       <div class="owner-container">
           <!-- Logo Section -->
           <div class="owner-logo-section">
               <div class="owner-logo">
                <img src="/images/Trimly Logo.png" alt="Trimly Logo">
               </div>
               
               <h1 class="owner-h1">Salon Portal</h1>
               <p class="owner-subtitle">Welcome back! Sign in to manage your salon.</p>
           </div>
   
           <!-- Login Form Card -->
           <div class="owner-form-card">
               <h2 class="owner-form-title">Sign In</h2>
               
               <form id="loginForm" action="#" method="post">
                   @csrf
                   <!-- Email Input -->
                   <div class="owner-form-group">
                       <label class="owner-form-label" for="email">Email Address</label>
                       <div class="owner-input-group-custom">
                           <span class="owner-input-group-text-custom">
                               <i class="fa-regular fa-envelope"></i>
                           </span>
                           <input 
                               type="email" 
                               id="email" 
                               name="email"
                               class="owner-form-input" 
                               placeholder="Enter your email"
                               required
                           >
                       </div>
                   </div>
   
                   <!-- Password Input -->
                   <div class="owner-form-group">
                       <label class="owner-form-label" for="password">Password</label>
                       <div class="owner-input-group-custom">
                           <span class="owner-input-group-text-custom">
                               <i class="fa-solid fa-lock"></i>
                           </span>
                           <div class="owner-password-input-container">
                               <input 
                                   type="password" 
                                   id="password" 
                                   name="password"
                                   class="owner-form-input" 
                                   placeholder="Enter your password"
                                   required
                               >
                               <button type="button" class="owner-password-toggle" onclick="togglePassword()">
                                   <i class="fa-solid fa-eye"></i>
                               </button>
                           </div>
                       </div>
                   </div>
   
                   <!-- Remember me & Forgot password -->
                   <div class="owner-form-options">
                       <div class="owner-checkbox-container">
                           <input type="checkbox" id="remember" name="remember">
                           <label for="remember">Remember me</label>
                       </div>
                       <a href="#" class="owner-forgot-password">Forgot password?</a>
                   </div>
   
                   <!-- Sign In Button -->
                   <button type="submit" class="owner-btn-signin">Sign In</button>
                   
                   <!-- Divider -->
                   <div class="owner-divider"></div>
               </form>
   
               <!-- Register Section -->
               <div class="owner-register-section">
                   <p class="owner-register-text">Don't have a salon account yet?</p>
                   <button type="button" class="owner-btn-register" onclick="goToRegister()">
                       Register Your Salon
                   </button>
               </div>
   
               <!-- Back to Customer Login -->
               <div class="owner-divider"></div>
               <a href="{{ route('pet_owner.login') }}" class="owner-back-link owner-back-link-center">
                    <i class="fa-solid fa-arrow-left"></i> Back to Customer Login
               </a>
           </div>
   
           <!-- Help Text -->
           <p class="owner-help-text">
               Need help? Contact our <a href="#">support team</a>
   
               <br>
               <br>
               <br>
               <br>
           </p>
   
       </div>
   
       <script src="{{ asset('js/owner/login.js') }}" defer></script>
   </body>
   </html>