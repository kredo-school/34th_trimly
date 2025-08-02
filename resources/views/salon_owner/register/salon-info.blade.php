{{-- Todo --}}

 <!--
* Need to modify icon place and UI  -->

{{-- Memo >> Some Font Awesome icons are only available in the Pro version,
 so most of the time, you can only use the solid style in the free version. --}}
 

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
        <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
</head>
<body>
    <header class="bg-white shadow-sm mb-2"> 
        <div class="container-fluid"> 
            <div class="row align-items-center"> 
                <div class="col-6 d-flex align-items-center">
                    <div class="logo me-1">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="img-fluid" style="max-width: 80px;">
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
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">
                   
                    <!-- Status -->
                    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 owner-step-indicator">
                        <div class="d-flex flex-column align-items-center owner-step-item-active">
                            <div class="owner-step-circle d-flex justify-content-center align-items-center owner-w-40px owner-h-40px rounded-circle fs-6 fw-bold">1</div>
                            <div class="owner-step-text mt-2 fs-6">Salon Info</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <div class="d-flex flex-column align-items-center owner-step-item-inactive">
                            <div class="owner-step-circle d-flex justify-content-center align-items-center owner-w-40px owner-h-40px rounded-circle fs-6 fw-bold">2</div>
                            <div class="owner-step-text mt-2 fs-6">Confirm</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <div class="d-flex flex-column align-items-center owner-step-item-inactive">
                            <div class="owner-step-circle d-flex justify-content-center align-items-center owner-w-40px owner-h-40px rounded-circle fs-6 fw-bold">3</div>
                            <div class="owner-step-text mt-2 fs-6">Salon Code</div>
                        </div>
                        <div class="owner-step-line"></div> 
                        <div class="d-flex flex-column align-items-center owner-step-item-inactive">
                            <div class="owner-step-circle d-flex justify-content-center align-items-center owner-w-40px owner-h-40px rounded-circle fs-6 fw-bold">4</div>
                            <div class="owner-step-text mt-2 fs-6">Complete</div>
                        </div>
                    </nav>

                    <!-- Card -->
                    <div class="card p-4 mb-4 shadow-sm" style="border-radius: 12px; border: none;">
                        <div class="card-body">
                            <h4 class="card-title text-start mb-3 fw-bold text-muted">
                                <i class="fa-light fa-solid fa-building me-2"></i>Salon Information
                               
                            </h4>
                            <p class="card-text text-muted text-start mb-4">Tell us about your salon and business</p>

                            <form action="#" method="post"> 
                                @csrf
                                <!-- Salon Name -->
                                <div class="mb-3">
                                    <label for="salonName" class="owner-form-label">Salon Name <span class="text-danger">*</span></label>
                                    <div class="owner-input-group owner-input-group-custom">
                                        <span class="owner-input-group-text-custom">
                                            <i class="fa-solid fa-building"></i>
                                        </span>
                                        <input type="text" class="form-control" id="salonName" placeholder="&nbsp;&nbsp;&nbsp; Enter your salon name" required>
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
                                            <input type="text" class="form-control" id="ownerFirstName" placeholder="&nbsp;&nbsp;&nbsp; Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ownerLastName" class="owner-form-label">Owner Last Name <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="ownerLastName" placeholder="&nbsp;&nbsp;&nbsp; Enter last name" required>
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
                                            <input type="email" class="form-control" id="emailAddress" placeholder="&nbsp;&nbsp;&nbsp; Enter email address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phoneNumber" class="owner-form-label">Phone Number <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
                                            <span class="owner-input-group-text-custom">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="phoneNumber" placeholder="&nbsp;&nbsp;&nbsp; (555) 123-4567" required>
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
                                        <input type="text" class="form-control" id="businessAddress" placeholder="&nbsp;&nbsp;&nbsp; Enter street address" required>
                                    </div>
                                </div>

                                <!-- City and State -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="owner-form-label">City <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">
        
                                            <input type="text" class="form-control" id="city" placeholder="&nbsp;&nbsp;&nbsp; Enter city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="owner-form-label">State <span class="text-danger">*</span></label>
                                        <div class="owner-input-group owner-input-group-custom">

                                            <select class="form-control" id="state" required>
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
                                            <input type="password" class="form-control" id="password" placeholder="&nbsp;&nbsp;&nbsp; Create password" required>
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
                                            <input type="password" class="form-control" id="confirmPassword" placeholder="&nbsp;&nbsp;&nbsp; Confirm password" required>
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
                          
                                        <input type="url" class="form-control" id="website" placeholder="&nbsp;&nbsp;&nbsp;https://yourwebsite.com">
                                    </div>
                                </div>

                                <!-- Business License -->
                                <div class="mb-3">
                                    <label for="businessLicense" class="owner-form-label">Business License Number (optional)</label>
                                    <div class="owner-input-group owner-input-group-custom">
                    
                                        <input type="text" class="form-control" id="businessLicense" placeholder="&nbsp;&nbsp;&nbsp; Enter business license number">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="owner-form-label">Description</label>
                                    <textarea class="form-control owner-textarea" id="description" rows="4" placeholder="Describe your salon, services, and what makes you special..."></textarea>
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

    <script>
        function toggleOwnerPassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.nextElementSibling;
            const icon = button.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Owner form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            if (password.length < 8) {
                alert('Password must be at least 8 characters long!');
                return;
            }
            
            alert('Owner registration information submitted successfully! Proceeding to confirmation...');
        });
    </script>

</body>
</html>