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
    <style>
        body{
             background-color: #FEFCF1;
        }
        /* input-group自体にボーダーと角丸を適用 */
        .input-group-custom {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            background-color: #FEFCF1;
        }
        /* input-group-textの背景色とボーダーを調整 */
        .input-group-text-custom {
            background-color: #FEFCF1;
            border: none;
            color: #6c757d; 
            padding-right: 8px; 
            padding: 0.75rem 1rem;
            min-height: 50px;
        }
        /* input-group内のform-controlのボーダーと角丸を調整 */
        .input-group .form-control {
            background-color: #FEFCF1;
            border: none;
            border-radius: 0;
            padding-left: 0;
        }
        /* ステップインジケーター */
        .step-item-active .step-circle {
            background-color: #ab8b73;
            border-color: #ab8b73;
            color: #fff;
            position: relative;
            z-index: 2;
        }
        .step-item-active .step-text {
            color: #ab8b73;
            font-weight: bold;
            position: relative;
            z-index: 2;
            background-color: #FEFCF1;
        }
        .step-item-inactive .step-circle {
            background-color: #e0e0e0;
            border-color: #e0e0e0;
            color: #666;
            position: relative;
            z-index: 2;
        }
        .step-item-inactive .step-text {
            color: #999;
            position: relative; 
            z-index: 2; 
            background-color: #FEFCF1;
            font-size: 12px;
        }
        /* ステップ円の固定サイズ*/
        .w-40px { width: 40px; }
        .h-40px { height: 40px; }

        /* ステップ間の線 */
        .step-line {
            flex-grow: 1;
            height: 2px;
            background-color: #e0e0e0;
            margin: 0 15px;
            align-self: flex-start;
            margin-top: 19px;
            z-index: -1;
        }
        
        .step-indicator {
            position: relative;
            z-index: 1;
        }
        
        .btn-continue {
            background-color: #D5C4B8 !important; 
            border-color: #D5C4B8 !important; 
            border-radius: 8px; 
            padding: 12px 30px;
            font-weight: bold;
            color: #fff;
        }
        
        .btn-continue:hover {
            background-color: #C3B1A6 !important;
            border-color: #C3B1A6 !important;
        }
        
        .form-label {
            color: #666;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        textarea.form-control {
            background-color: #FEFCF1;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            min-height: 100px;
        }
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            z-index: 3;
        }
        
        .password-container {
            position: relative;
        }
    </style>

</head>
<body>
    <header class="bg-white shadow-sm mb-2"> 
        <div class="container-fluid"> 
            <div class="row align-items-center"> 
                <div class="col-6 d-flex align-items-center">
                    <div class="logo me-1">
                        <img src="https://via.placeholder.com/80x40/D5C4B8/FFFFFF?text=Trimly" alt="Trimly Logo" class="img-fluid" style="max-width: 80px;">
                    </div>
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p> 
                </div>
                <div class="col-6 text-end"> 
                    <p class="text-muted mb-0 me-2 fs-6">Salon Owner Registration</p> 
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">
                   
                    <!-- Status -->
                    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-6 fw-bold">1</div>
                            <div class="step-text mt-2 fs-6">Salon Info</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-6 fw-bold">2</div>
                            <div class="step-text mt-2 fs-6">Confirm</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-6 fw-bold">3</div>
                            <div class="step-text mt-2 fs-6">Salon Code</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-6 fw-bold">4</div>
                            <div class="step-text mt-2 fs-6">Complete</div>
                        </div>
                    </nav>

                    <!-- Card -->
                    <div class="card p-4 mb-4 shadow-sm" style="border-radius: 12px; border: none;">
                        <div class="card-body">
                            <h4 class="card-title text-start mb-3 fw-bold text-muted">
                                <i class="fa-solid fa-clipboard-list me-2"></i>Salon Information
                            </h4>
                            <p class="card-text text-muted text-start mb-4">Tell us about your salon and business</p>

                            <form action="#" method="post"> 
                                <!-- Salon Name -->
                                <div class="mb-3">
                                    <label for="salonName" class="form-label">Salon Name <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text input-group-text-custom">
                                            <i class="fa-solid fa-store"></i>
                                        </span>
                                        <input type="text" class="form-control" id="salonName" placeholder="Enter your salon name" required>
                                    </div>
                                </div>

                                <!-- Owner Names -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ownerFirstName" class="form-label">Owner First Name <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="ownerFirstName" placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ownerLastName" class="form-label">Owner Last Name <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="ownerLastName" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email and Phone -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="emailAddress" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-regular fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="emailAddress" placeholder="Enter email address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phoneNumber" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="phoneNumber" placeholder="(555) 123-4567" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Address -->
                                <div class="mb-3">
                                    <label for="businessAddress" class="form-label">Business Address <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text input-group-text-custom">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <input type="text" class="form-control" id="businessAddress" placeholder="Enter street address" required>
                                    </div>
                                </div>

                                <!-- City and State -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                            
                                            </span>
                                            <input type="text" class="form-control" id="city" placeholder="Enter city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text input-group-text-custom">
                                            </span>
                                            <select class="form-control" id="state" required>
                                                <option value="">Select state</option>
                                                <option value="CA">California</option>
                                                <option value="NY">New York</option>
                                                <option value="TX">Texas</option>
                                                <option value="FL">Florida</option>
                                                <option value="IL">Illinois</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom password-container">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-regular fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" placeholder="Create password" required>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom password-container">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-regular fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
                                            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Website -->
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website (optional)</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text input-group-text-custom">
                                            <i class="fa-solid fa-globe"></i>
                                        </span>
                                        <input type="url" class="form-control" id="website" placeholder="https://yourwebsite.com">
                                    </div>
                                </div>

                                <!-- Business License -->
                                <div class="mb-3">
                                    <label for="businessLicense" class="form-label">Business License Number (optional)</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text input-group-text-custom">
                                            <i class="fa-solid fa-certificate"></i>
                                        </span>
                                        <input type="text" class="form-control" id="businessLicense" placeholder="Enter business license number">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="4" placeholder="Describe your salon, services, and what makes you special..."></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-continue">
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
        function togglePassword(fieldId) {
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

        // Form validation
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
            
            alert('Registration information submitted successfully! Proceeding to confirmation...');
        });
    </script>

</body>
</html>