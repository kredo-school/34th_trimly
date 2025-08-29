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
                            <div class="owner-step-circle">1</div>
                            <div class="owner-step-text">Salon Info</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <div class="owner-step-item-inactive">
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
                            <h4 class="card-title text-start mb-3 fw-bold ">
                                <i class="fa-light fa-solid fa-building me-2"></i>Salon Information
                            </h4>
                            <p class="card-text text-muted text-start mb-4">Tell us about your salon and business</p>

                            <form action="{{ route('salon.register.confirm') }}" method="post"> 
                                @csrf
                                <!-- CSRF token will be handled by server-side template -->
                                
                                <!-- Salon Name -->
                                <div class="mb-3">
                                    <label for="salonName" class="owner-form-label">Salon Name <span class="text-danger">*</span></label>
                                    <div class="owner-input-group owner-input-group-custom">
                                        <span class="owner-input-group-text-custom">
                                            <i class="fa-solid fa-building"></i>
                                        </span>
                                        <input type="text" class="form-control" id="salonName" name="salonname" placeholder="&nbsp;&nbsp;&nbsp; Enter your salon name" required>
                                    </div>
                                </div>

                                <!-- Owner Names -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ownerFirstName" class="owner-form-label">Owner First Name <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="ownerFirstName" name="ownerFirstName" placeholder="&nbsp;&nbsp;&nbsp; Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ownerLastName" class="owner-form-label">Owner Last Name <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="ownerLastName" name="ownerLastName" placeholder="&nbsp;&nbsp;&nbsp; Enter last name" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email and Phone -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="emailAddress" class="owner-form-label">Email Address <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-regular fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="&nbsp;&nbsp;&nbsp; Enter email address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phoneNumber" class="owner-form-label">Phone Number <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="&nbsp;&nbsp;&nbsp; (555) 123-4567" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Address -->
                                <div class="mb-3">
                                    <label for="businessAddress" class="owner-form-label">Business Address <span class="text-danger">*</span></label>
                                    <div class="owner-input-group owner-input-group-custom">
                                        <span class="owner-input-group-text-custom">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <input type="text" class="form-control" id="businessAddress" name="businessAddress" placeholder="&nbsp;&nbsp;&nbsp; Enter street address" required>
                                    </div>
                                </div>

                                <!-- City and State -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="owner-form-label">City <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="&nbsp;&nbsp;&nbsp; Enter city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="owner-form-label">State <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <select class="form-control" id="state" name="state" required>
                                                <option value="">&nbsp;&nbsp;&nbsp;Select state</option>
                                                <option value="CA">&nbsp;&nbsp;&nbsp;California</option>
                                                <option value="NY">&nbsp;&nbsp;&nbsp;New York</option>
                                                <option value="TX">&nbsp;&nbsp;&nbsp;Texas</option>
                                                <option value="FL">&nbsp;&nbsp;&nbsp;Florida</option>
                                                <option value="IL">&nbsp;&nbsp;&nbsp;Illinois</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="owner-form-label">Password <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom owner-password-container">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="&nbsp;&nbsp;&nbsp; Create password" required>
                                            <button type="button" class="owner-password-toggle" onclick="toggleOwnerPassword('password')">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="confirmPassword" class="owner-form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom owner-password-container">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="&nbsp;&nbsp;&nbsp; Confirm password" required>
                                            <button type="button" class="owner-password-toggle" onclick="toggleOwnerPassword('confirmPassword')">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Website -->
                                <div class="mb-3">
                                    <label for="website" class="owner-form-label">Website (optional)</label>
                                    <div class="owner-input-group owner-input-group-custom">
                                        <input type="url" class="form-control" id="website" name="website" placeholder="&nbsp;&nbsp;&nbsp;https://yourwebsite.com">
                                    </div>
                                </div>

                                <!-- Business License -->
                                <div class="mb-3">
                                    <label for="businessLicense" class="owner-form-label">Business License Number (optional)</label>
                                    <div class="owner-input-group owner-input-group-custom">
                                        <input type="text" class="form-control" id="businessLicense" name="businessLicense" placeholder="&nbsp;&nbsp;&nbsp; Enter business license number">
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="owner-form-label">Description</label>
                                    <textarea class="form-control owner-textarea" id="description" name="description" rows="4" placeholder="Describe your salon, services, and what makes you special..."></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-owner-continue">
                                        Continue <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <script src="/js/owner/register.salon.info.js" defer></script>

</body>
</html>