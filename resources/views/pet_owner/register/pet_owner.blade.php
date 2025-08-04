<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register PetOwner</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <style>
        .form-label {
            font-weight: bold;
            /* ラベルを太字に */
            color: #6c757d;
            /* ラベルの色 */
        }

        .form-control::placeholder {
            color: #adb5bd;
            /* プレースホルダーの色 */
        }
    </style>
</head>

<body>
    @include('pet_owner.register.header')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">

                    {{-- Step --}}
                    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="step-text mt-2 fs-6">Salon Code</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                2</div>
                            <div class="step-text mt-2 fs-6">Pet Owner</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                3</div>
                            <div class="step-text mt-2 fs-6">Pets</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                4</div>
                            <div class="step-text mt-2 fs-6">Confirm</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                5</div>
                            <div class="step-text mt-2 fs-6">Complete</div>
                        </div>
                    </nav>

                    {{-- Card --}}
                    <div class="card p-4 mb-4 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title text-start mb-3 fw-bold text-muted"><i
                                    class="fa-solid fa-user me-2"></i>Pet Owner Information</h4>
                            <p class="card-subtitle text-muted text-start mb-4">Tell us about yourself</p>

                            <form action="#" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="firstName" class="form-label text-muted">First Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="firstName"
                                                placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="lastName" class="form-label text-muted">Last Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="lastName"
                                                placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="emailAddress" class="form-label text-muted">Email Address <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="emailAddress"
                                                placeholder="Enter email address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="phoneNumber" class="form-label text-muted">Phone Number <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="phoneNumber"
                                                placeholder="(555) 123-4567" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="city" class="form-label text-muted">City <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-map-marker-alt"></i>
                                            </span>
                                            <input type="text" class="form-control" id="city"
                                                placeholder="Enter your city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="prefecture" class="form-label text-muted">Prefecture <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-map"></i>
                                            </span>
                                            <select class="form-select form-control" id="prefecture" required>
                                                <option selected disabled value="">Select prefecture</option>
                                                <option>Tokyo</option>
                                                <option>Osaka</option>
                                                <option>*****</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="password" class="form-label text-muted">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Create password" required>
                                            <span class="input-group-text input-group-text-custom toggle-password"
                                                data-target="password">
                                                <i class="fa-solid fa-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-start">
                                        <label for="confirmPassword" class="form-label text-muted">Confirm Password
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-custom">
                                            <span class="input-group-text input-group-text-custom">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="confirmPassword"
                                                placeholder="Confirm password" required>
                                            <span class="input-group-text input-group-text-custom toggle-password"
                                                data-target="confirmPassword">
                                                <i class="fa-solid fa-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-back">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                                    </button>
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
    
    {{-- @push('scripts') --}}
        <script src="{{ asset('js/register.pet_owner.js') }}" defer></script>
    {{-- @endpush --}}

</body>

</html>
