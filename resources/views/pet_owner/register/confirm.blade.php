<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Confirm</title>
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
        /* 新しい2列レイアウト用のスタイル */
        .info-pair {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* 上揃え */
            margin-bottom: 8px;
        }
        .info-pair .info-label,
        .info-pair .info-value {
            flex-grow: 1; /*均等にスペースを埋める*/
        }
        .info-pair .info-label {
             flex-basis: auto; /*Bootstrapのcol-6に任せる*/
             text-align: left; /* 左寄せ */
             color: #6c757d;
        }
        .info-pair .info-value {
            flex-basis: auto; /*Bootstrapのcol-6に任せる*/
            text-align: left /* 左寄せ */

        }
        /* 行のレイアウト用 */
        .info-item-row {
            margin-bottom: 8px;
        }
        .info-value.full-width {
            text-align: left;
        }
        
         /* Pet Informationセクションの新しいスタイル */
        .pet-info-item { /* pet1, pet2の見出しスタイル */
            font-weight: bold;
            color: #6c757d;
            font-size: 1.15rem; /* 少し大きく */
            margin-bottom: 5px;
        }
        .pet-sub-info { /* mix • young • small • female のスタイル */
            color: #888;
            font-size: 0.95rem;
            margin-bottom: 15px;
            display: block; /* 複数行の場合に備えてブロック要素に */
        }
        .pet-separator {
            border-bottom: 1px dashed #e9ecef; /* 各ペットの下線 */
            margin: 20px 0;
        }
        .pet-separator:last-child {
            display: none; /* 最後のセパレータは非表示 */
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
                                    <h4 class="card-title text-start mb-3 fw-bold text-muted"><i class="fa-solid fa-check me-2"></i>Confirm Registration</h4>
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
                                            {{-- @if(!empty($pet['special_notes'])) --}}
                                            {{-- <div class="info-item-row">
                                                <div class="col-12">
                                                    <div class="info-pair">
                                                        <div class="info-label">Special Notes</div>
                                                        <div class="info-value full-width text-start">#</div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- @endif --}}
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
                                    <button type="submit" class="btn btn-continue">
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