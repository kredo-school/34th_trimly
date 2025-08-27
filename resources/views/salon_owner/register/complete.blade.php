<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Complete - Trimly</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link href="/css/register-salon-owner.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header class="bg-white shadow-sm mb-2"> 
        <div class="container-fluid"> 
            <div class="row align-items-center"> 
                <!-- Logo and Brand Name -->
                <div class="col-6 d-flex align-items-center">
                    <div class="logo me-1">
                        <img src="/images/Trimly Logo.png" alt="Trimly Logo" class="img-fluid">
                    </div>
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p> 
                </div>
                <!-- Page Title -->
                <div class="col-6 text-end"> 
                    <p class="text-muted mb-0 me-2 fs-6">Salon Registration</p> 
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container my-4"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="owner-register-container">
                   
                    <!-- Progress Indicator -->
                    <div class="owner-step-indicator">
                        <!-- Step 1: Completed -->
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle"><i class="fa-solid fa-check"></i></div>
                            <div class="owner-step-text">Salon Info</div>
                        </div>
                        <div class="owner-step-line-active"></div> 
                        <!-- Step 2: Completed -->
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle"><i class="fa-solid fa-check"></i></div>
                            <div class="owner-step-text">Confirm</div>
                        </div>
                        <div class="owner-step-line-active"></div> 
                        <!-- Step 3: Completed -->
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle"><i class="fa-solid fa-check"></i></div>
                            <div class="owner-step-text">Salon Code</div>
                        </div>
                        <div class="owner-step-line-active"></div> 
                        <!-- Step 4: Current Step (Completed) -->
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle">4</div>
                            <div class="owner-step-text">Complete</div>
                        </div>
                    </div>

                    <!-- Main Card -->
                    <div class="owner-card p-5 owner-mb-4">
                        <div class="owner-card-body text-center">
                            <!-- Success Icon -->
                            <div class="owner-success-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            
                            <!-- Welcome Message -->
                            <h2 class="owner-welcome-title">Welcome to Trimly!</h2>
                            
                            <!-- Description -->
                            <p class="owner-welcome-description">
                                Your salon is now registered and ready to serve customers. Access your dashboard to<br>
                                start managing your business.
                            </p>

                            <!-- How to Use Section -->
                            <div class="owner-howto-section">
                                <h5 class="owner-howto-title no-wrap-text">How to use your Salon Code:</h5>
                                <ul class="owner-howto-list no-wrap-text">
                                    <li>Share this code with your customers</li>
                                    <li>Only customers with your code can book appointments</li>
                                </ul>
                            </div>

                            <!-- Dashboard Button -->
                            <button type="button" class="btn btn-owner-dashboard" onclick="goToDashboard()">
                                Go to Dashboard <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <script src="/js/owner/register.complete.js" defer></script>

</body>
</html>