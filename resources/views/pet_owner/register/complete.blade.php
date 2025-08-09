<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Complete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

    <style>
        /* 独自スタイルとしてBlade内に残すCSS */
        /* ステップ表示 */
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
        
        /* 完了画面専用スタイル */
        .check-circle {
            background-color: #e6fae6; 
            color: #5cb85c;
            width: 80px;
            height: 80px;
            font-size: 3rem;
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
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold"><i class="fa-solid fa-check"></i></div>
                            <div class="step-text mt-2 fs-6">Confirm</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">5</div>
                            <div class="step-text mt-2 fs-6">Complete</div>
                        </div>
                    </nav>

                    {{--Card--}}
                    <div class="card p-4 mb-4 shadow-sm">
                        {{-- check-circle --}}
                        <div class="check-circle d-flex justify-content-center align-items-center rounded-circle mx-auto mb-4">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <h2 class="complete-title text-center mb-3 fw-bold">Welcome to Trimly!</h2>
                        <p class="complete-message text-center mb-4">Your registration is complete. You can now manage your pets and book appointments.</p>
                        
                        <a href="#" class="btn btn-primary d-block mx-auto">
                            Go to My Page <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
</body>
</html>