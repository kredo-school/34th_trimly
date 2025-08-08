<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Confirm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

    <style>
        /* 独自スタイルとしてBlade内に残すCSS */
        /* Step */
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
            color: #fff;
            position: relative;
            z-index: 2;
        }
        .step-item-inactive .step-text {
            color: #e0e0e0;
            position: relative;
            z-index: 2;
            background-color: #FEFCF1;
        }
        .w-40px { width: 40px; }
        .h-40px { height: 40px; }
        .step-line {
            flex-grow: 1;
            height: 3px;
            background-color: #e0e0e0;
            margin: 0 20px;
            align-self: flex-start;
            margin-top: 19px;
            z-index: -1;
        }
        .step-indicator {
            position: relative;
            z-index: 1;
        }

        /* 確認画面専用の表示スタイル */
        .info-section {
            background-color: #f9f5f2;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: left;
        }
        .info-section h5 {
            color: #6c757d;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-pair {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        .info-pair .info-label,
        .info-pair .info-value {
            flex-grow: 1;
        }
        .info-pair .info-label {
             flex-basis: auto;
             text-align: left;
             color: #6c757d;
        }
        .info-pair .info-value {
            flex-basis: auto;
            text-align: left;
        }
        .info-item-row {
            margin-bottom: 8px;
        }
        .info-value.full-width {
            text-align: left;
        }
        .pet-info-item {
            font-weight: bold;
            color: #6c757d;
            font-size: 1.15rem;
            margin-bottom: 5px;
        }
        .pet-sub-info {
            color: #888;
            font-size: 0.95rem;
            margin-bottom: 15px;
            display: block;
        }
        .pet-separator {
            border-bottom: 1px dashed #e9ecef;
            margin: 20px 0;
        }
        .pet-separator:last-child {
            display: none;
        }
        
        /* ボタンのデザイン */
        .btn-back {
            background-color: #FEFCF1;
            border: 1px solid #ccc;
            color: #6c757d;
            font-weight: bold;
            border-radius: 8px;
            padding: 12px 25px;
        }
    </style>
</head>

<body>
    @include('pet_owner.register.header') 

    <div class="container my-4"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">
                   
                    {{--Step--}}
                    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold"><i class="fa-solid fa-check"></i></div>
                            <div class="step-text mt-2 fs-6">Salon Code</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold"><i class="fa-solid fa-check"></i></div>
                            <div class="step-text mt-2 fs-6">Pet Owner</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold"><i class="fa-solid fa-check"></i></div>
                            <div class="step-text mt-2 fs-6">Pets</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">4</div>
                            <div class="step-text mt-2 fs-6">Confirm</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">5</div>
                            <div class="step-text mt-2 fs-6">Complete</div>
                        </div>
                    </nav>

                    {{--Card--}}
                    <div class="card p-4 mb-4 shadow-sm">
                        <div class="card-body">
                                <div>
                                    <h4 class="card-title text-start mb-3 fw-bold"><i class="fa-solid fa-check me-2" style="color:#ab8b73"></i>Confirm Registration</h4>
                                    <p class="card-subtitle text-muted text-start mb-4">Please review your information before completing registration</p>
                                </div>
                        
                               <form action="#" method="POST">
                                @csrf

                                {{-- Salon Code Section --}}
                                <div class="info-section">
                                    <h5 class="text-start">Salon Code</h5>
                                    <div class="info-item">
                                        <div class="info-value full-width">ABCDE</div>
                                    </div>
                                </div>

                                {{-- Personal Information Section --}}
                                <div class="info-section">
                                    <h5 class="text-start">Personal Information</h5>
                                    {{-- name&Email --}}
                                    <div class="row info-item-row">
                                        <div class="col-6">
                                            <div class="info-pair">
                                                <div class="info-label">Name</div>
                                                <div class="info-value">ABCDE</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-pair">
                                                <div class="info-label">Email</div>
                                                <div class="info-value">ABCDE</div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Phone&Location --}}
                                    <div class="row info-item-row">
                                        <div class="col-6">
                                            <div class="info-pair">
                                                <div class="info-label">Phone</div>
                                                <div class="info-value">ABCDE</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-pair">
                                                <div class="info-label">Location</div>
                                                <div class="info-value">ABCDE</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 {{-- Pet Information Section --}}
                                <div class="info-section">
                                    <h5 class="text-start">Pet Information</h5>
                                    {{-- @forelse($petsData as $index => $pet) --}}
                                        {{-- 複数のペットを登録した場合の表示例 --}}
                                        <div class="pet-details-compact">
                                            <div class="pet-info-item">Pet 1</div>
                                            <div class="pet-sub-info">
                                               # • # • # • #
                                            </div>
                                        </div>
                                        <div class="pet-separator"></div> {{-- 最初のペットと次のペットの区切り線 --}}
                                        <div class="pet-details-compact">
                                            <div class="pet-info-item">Pet 2</div>
                                            <div class="pet-sub-info">
                                               # • # • # • #
                                            </div>
                                        </div>
                                    {{-- @empty
                                        <p class="text-muted text-center">No pet information entered.</p>
                                    @endforelse --}}
                                </div>
                                
                                {{-- Terms of Service Checkbox --}}
                                <div class="my-4 form-check text-start">
                                    <input type="checkbox" class="form-check-input" id="termsConsent" name="terms_consent" required>
                                    <label class="form-check-label" for="termsConsent">I agree to the Terms of Service and Privacy Policy</label>
                                </div>

                                {{-- Navigation Buttons --}}
                                <div class="d-flex justify-content-between mt-4"> 
                                    <a href="#" class="btn btn-back">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Complete Registration <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
</body>
</html>