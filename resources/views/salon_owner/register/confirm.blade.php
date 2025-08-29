<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Salon Owner</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/css/register-salon-owner.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <header class="bg-white shadow-sm mb-2"> 
        <div class="container-fluid"> 
            <div class="row align-items-center"> 
                <div class="col-6 d-flex align-items-center">
                    <div class="logo me-1">
                        <img src="/images/Trimly Logo.png" alt="Trimly Logo" class="img-fluid">
                    </div>
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p> 
                </div>
                <div class="col-6 text-end"> 
                    <p class="text-muted mb-0 me-2 fs-6">Salon Registration</p> 
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container">
                   
                    <!-- Status -->
                    <div class="owner-step-indicator">
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle"><i class="fa-solid fa-check"></i></div>
                            <div class="owner-step-text">Salon Info</div>
                        </div>
                        <div class="owner-step-line-active"></div> 
                        <div class="owner-step-item-active">
                            <div class="owner-step-circle">2</div>
                            <div class="owner-step-text">Confirm</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <div class="owner-step-item-inactive">
                            <div class="owner-step-circle">3</div>
                            <div class="owner-step-text">Salon Code</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <div class="owner-step-item-inactive">
                            <div class="owner-step-circle">4</div>
                            <div class="owner-step-text">Complete</div>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="owner-card p-4 owner-mb-4">
                        <div class="owner-card-body">
                            <h4 class="owner-card-title text-start owner-mb-3 owner-fw-bold ">
                                <i class="fa-solid fa-check me-2"></i>Confirm Registration
                            </h4>
                            <p class="owner-card-text owner-text-muted text-start owner-mb-4">Please review your salon information</p>
                    
                            <form action="{{ route('salon.register.store') }}" method="POST">
                                @csrf
                                
                                <!-- Salon Information Display -->
                                <div class="owner-confirmation-section">
                                    <h4 class="owner-confirmation-title">Salon Information</h4>
                                    
                                    <div class="owner-info-row">
                                        <div class="owner-info-item d-flex">
                                            <div class="owner-info-label">Salon Name:</div>
                                            <div class="owner-info-value">{{ $data['salonname'] }}</div>
                                        </div>
                                        <div class="owner-info-item d-flex">
                                            <div class="owner-info-label">Owner:</div>
                                            <div class="owner-info-value">{{ $data['firstname'] }} {{ $data['lastname'] }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="owner-info-row d-flex">
                                        <div class="owner-info-item">
                                            <div class="owner-info-label">Email:</div>
                                            <div class="owner-info-value">{{ $data['email_address'] }}</div>
                                        </div>
                                        <div class="owner-info-item d-flex">
                                            <div class="owner-info-label">Phone:</div>
                                            <div class="owner-info-value">{{ $data['phone'] }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="owner-info-row d-flex">
                                        <div class="owner-info-item">
                                            <div class="owner-info-label">Address:</div>
                                            <div class="owner-info-value">{{ $data['businessAddress'] }}, {{ $data['city'] }}, {{ $data['state'] }}</div>
                                        </div>
                                    </div>
                                </div>
                    
                                <!-- Terms and Conditions -->
                                <div class="owner-checkbox-container">
                                    <input type="checkbox" class="owner-checkbox" id="termsCheckbox" required>
                                    <label for="termsCheckbox" class="owner-checkbox-label">
                                        I agree to the <a href="#" class="owner-link">Terms of Service</a> and <a href="#" class="owner-link">Privacy Policy</a>
                                    </label>
                                </div>
                    
                                <div class="owner-checkbox-container">
                                    <input type="checkbox" class="owner-checkbox" id="authorityCheckbox" required>
                                    <label for="authorityCheckbox" class="owner-checkbox-label">
                                        I confirm that I have the authority to register this business and agree to business terms
                                    </label>
                                </div>
                    
                                <div class="d-flex justify-content-between owner-mt-4">
                                    <!-- Left-aligned Back button -->
                                    <button type="button" class="btn btn-owner-back" onclick="goBack()">
                                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                                    </button>
                                    
                                    <!-- Right-aligned Create button -->
                                    <button type="submit" class="btn btn-owner-continue">
                                        Create Salon Account <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div> 
    </div>

    <script src="/js/owner/register.confirm.js" defer></script>

</body>
</html>