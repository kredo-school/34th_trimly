<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Petowner</title>
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
        }
        /* input-group-textの背景色とボーダーを調整 */
        .input-group-text-custom {
            background-color: #FEFCF1;
            border: none;
            color: #6c757d; 
            padding-right: 8px; 
            padding: 0.75rem 1rem; /* アイコン側のパディングも調整して高さを揃える */
            min-height: 50px; /* ★アイコン側の最小高さを指定して、入力フィールドと高さを合わせる */
        }
        /* input-group内のform-controlのボーダーと角丸を調整 */
        .input-group .form-control {
            background-color: #FEFCF1;
            border: none;
            border-radius: 0; /* 角丸を削除 (input-group-customに任せる) */
            padding-left: 0;
        }
       .step-item-active .step-circle {
            background-color: #ab8b73; /* アクティブなステップの色 */
            border-color: #ab8b73;
            color: #fff; /* 数字の色 */
            position: relative; /* z-indexを効かせるため */
            z-index: 2; /* 線より手前に来るように */
        }
        .step-item-active .step-text {
            color: #ab8b73; /* アクティブなステップのテキスト色 */
            font-weight: bold;
            position: relative; /* z-indexを効かせるため */
            z-index: 2; /* 線より手前に来るように */
            background-color: #FEFCF1; /*bodyと同じ背景色を設定して線が文字を透けないように */
        }
        .step-item-inactive .step-circle {
            background-color: #e0e0e0; /* 未完了ステップの背景色 */
            border-color: #e0e0e0;
            color: #fff; /* 数字の色 */
            position: relative; /* z-indexを効かせるため */
            z-index: 2; /* ★追加: 線より手前に来るように */
        }
        .step-item-inactive .step-text {
            color: #e0e0e0; /* 未完了ステップのテキスト色 */
            position: relative; 
            z-index: 2; 
            background-color: #FEFCF1;
        }
        /* ステップ円の固定サイズ*/
        .w-40px { width: 40px; }
        .h-40px { height: 40px; }

        /* ステップ間の線 */
        .step-line {
            flex-grow: 1; /* 親のFlexboxコンテナ内で利用可能なスペースを埋める */
            height: 3px; /* 線の太さ */
            background-color: #e0e0e0; /* 線の色 */
            margin: 0 20px; /* 線と丸の間のスペース */
            align-self: flex-start; /* 親のFlexアイテムの上端に寄せる */
            margin-top: 19px; /* step-circle (40px) の中心に線が来るように調整 (40px/2 - 2px/2 = 19px) */
            z-index: -1; /*線を円やテキストの裏に隠す */
        }
        
        /* ★step-indicatorにz-indexの基準を設定 */
        .step-indicator {
            position: relative; /* 子要素のz-indexの基準とする */
            z-index: 1; /* 他の要素と重なったときの順序 */
        }
        .salon-code-info {
            background-color: #f9f5f2; 
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: left;
        }
        .btn-continue {
            background-color: #D5C4B8 !important; 
            border-color: #D5C4B8 !important; 
            border-radius: 8px; 
            padding: 10px 25px;
            font-weight: bold;
            color: #fff;
        }
    </style>

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
                    <p class="text-muted mb-0 me-2 fs-6">Pet Owner Registration</p> 
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">
                   
                    {{--Status--}}
                    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">1</div>
                            <div class="step-text mt-2 fs-6">Salon Code</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">2</div>
                            <div class="step-text mt-2 fs-6">Pet Owner</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">3</div>
                            <div class="step-text mt-2 fs-6">Pets</div>
                        </div>
                        <div class="step-line"></div> 
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
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
                    <div class="card p-4 mb-4 shadow-sm" style="border-radius: 12px; border: none;">
                        <div class="card-body">
                            <h4 class="card-title text-start mb-3 fw-bold text-muted"><i class="fa-solid fa-key me-2"></i>Enter Salon Code</h4>
                            <p class="card-text text-muted text-start mb-4">Please enter the invitation code provided by your salon</p>

                            <form action="#" method="post"> 
                                @csrf
                                <div class="mb-3 text-start">
                                    <label for="salonCode" class="form-label text-muted">Salon Invitation Code <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text input-group-text-custom">
                                            <i class="fa-solid fa-key"></i>
                                        </span>
                                        <input type="text" class="form-control text-center fw-bold" id="salonCode" placeholder="Enter your salon code" required>
                                    </div>
                                </div>

                                <div class="salon-code-info">
                                    <h5 class="fw-bold text-muted">Don't have a salon code?</h5>
                                    <p class="text-muted">Contact your preferred salon to get an invitation code. This ensures you can book appointments and access their specific services.</p>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
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

</body>
</html>