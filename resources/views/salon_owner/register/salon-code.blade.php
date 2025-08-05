{{-- Todo --}}

 <!-- Qestion 
*  <i  class="fa-solid fa-check me-2"></i>Confirm Registratio< Is that should be brown? ✅
*   When hover Bsck botton, the color shuld be change ? -->

{{-- Memo >> Some Font Awesome icons are only available in the Pro version,
 so most of the time, you can only use the solid style in the free version. --}}

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salon Code - Trimly</title>
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
                        <img src="/images/Trimly Logo.png" alt="Trimly Logo" class="img-fluid" style="max-width: 80px;">
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
                        <!-- Step 3: Current Step -->
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle">3</div>
                            <div class="owner-step-text">Salon Code</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <!-- Step 4: Pending -->
                        <div class="owner-step-item-inactive">
                            <div class="owner-step-circle">4</div>
                            <div class="owner-step-text">Complete</div>
                        </div>
                    </div>

                    <!-- Main Card -->
                    <div class="owner-card p-4 owner-mb-4">
                        <div class="owner-card-body">
                            <!-- Card Title -->
                            <h4 class="owner-card-title owner-fw-bold owner-text-muted">
                                <i class="fa-solid fa-key me-2" style="color: #ab8b73;"></i>Your Salon Code
                            </h4>
                            <!-- Card Description -->
                            <p class="owner-card-text owner-text-muted owner-card-subtitle-center text-start">
                                Share this code with customers to invite them to your salon
                            </p>

                            <!-- Salon Code Display Section -->
                            <div class="owner-code-display-section">
                                <!-- Key Icon -->
                                <div class="owner-code-icon">
                                    <i class="fa-solid fa-key"></i>
                                </div>
                                <!-- Success Message -->
                                <div class="owner-code-generated-text">Salon Code Generated!</div>
                                <!-- Generated Code -->
                                <div class="owner-salon-code-wrapper" style="background-color: #ffffff; padding: 1.5rem 3rem; border-radius: 12px; display: inline-block; margin: 1.5rem 0;">
                                    <div class="owner-salon-code">G1P441219</div>
                                </div>
                                <br>
                                <!-- Copy Button -->
                                <button type="button" class="owner-copy-btn" onclick="copyCode()">
                                    <i class="fa-regular fa-copy"></i>
                                    Copy Code
                                </button>
                            </div>

                            <!-- Form Section -->
                            <form action="#" method="post"> 
                                <input type="hidden" name="salon_code" value="G1P441219">
                                <!-- Navigation Buttons -->
                                <div class="d-flex justify-content-between owner-mt-4">
                                    <!-- Back Button -->
                                    <button type="button" class="btn btn-owner-back " onclick="goBack()">
                                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                                    </button>
                                  
                                    <!-- Continue Button -->
                                    <button type="submit" class="btn btn-owner-continue" onclick="handleContinue(event)">
                                        Continue<i class="fa-solid fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <script src="{{ asset('js/owner/register.salon.code.js') }}" defer></script>
</body>
</html>