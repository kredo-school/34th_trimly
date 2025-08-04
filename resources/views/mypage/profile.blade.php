<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mypage Profile</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <style>
        .form-label {
            font-weight: bold;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        /* 読み取り専用フィールド */
        .form-control-readonly {
            background-color: #FEFCF1;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            color: #333;
            font-size: 1rem;
            display: flex;
            align-items: center;
            min-height: calc(2.25rem + 2px);
            /* Bootstrap form-control の高さに合わせる */
        }

        .form-control-readonly .fa-solid {
            color: #a68c76;
            margin-right: 10px;
        }

        .form-control-readonly .value-text {
            flex-grow: 1;
            /* テキストが残りのスペースを占める */
            color: #adb5bd;
        }

        /* 目玉アイコンは .toggle-password が付与されている部分にのみ適用 */
        .input-group-custom .toggle-password {
            background-color: #FEFCF1;
            border-left: none;
            /* input との間のボーダーは不要 */
            color: #a68c76;
            /* アイコンの色 (画像に合わせて) */
            cursor: pointer;
            height: calc(2.25rem + 2px);
            /* Bootstrap form-control の高さに合わせる */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 10px;
            padding-right: 15px;
        }

        /* input がフォーカスされた時の .toggle-password のボーダースタイル */
        .input-group-custom .form-control:focus+.toggle-password {
            border-color: #a68c76;
            /* フォーカス時の枠線色を合わせる */
            box-shadow: 0 0 0 0.25rem rgba(166, 140, 118, 0.25);
            /* フォーカス時の影を合わせる */
        }

        /* レスポンシブ調整 */
        @media (max-width: 767.98px) {

            /* mdブレイクポイント以下 */
            .card {
                padding: 20px;
                /* モバイルでのパディングを調整 */
            }

            .card-title {
                font-size: 1.3rem;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    @include('mypage.header.mypage')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0 text-muted">Pet Owner Information</h4>
                        {{-- edit button --}}
                        <button class="btn btn-continue">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                    </div>

                    <form action="#" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <div class="form-control-readonly">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="value-text" id="firstName">John</span> {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <div class="form-control-readonly">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="value-text" id="lastName">Smith</span> {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <div class="form-control-readonly">
                                    <i class="fa-solid fa-envelope"></i>
                                    <span class="value-text" id="emailAddress">john.smith@email.com</span>
                                    {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <div class="form-control-readonly">
                                    <i class="fa-solid fa-phone"></i>
                                    <span class="value-text" id="phoneNumber">(555) 123-4567</span>
                                    {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <div class="form-control-readonly">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="value-text" id="city">Los Angeles</span> {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="prefecture" class="form-label">Prefecture</label>
                                <div class="form-control-readonly">
                                    <i class="fa-solid fa-map"></i>
                                    <span class="value-text" id="prefecture">California</span> {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card p-4">
                    <h4 class="card-title mb-4 text-muted">Change Password</h4>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <div class="input-group input-group-custom">
                                    <input type="password" class="form-control" id="currentPassword"
                                        placeholder="Enter current password">
                                    <span class="input-group-text input-group-text-custom toggle-password"
                                        data-target="currentPassword">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="newPassword" class="form-label">New Password</label>
                                <div class="input-group input-group-custom">
                                    <input type="password" class="form-control" id="newPassword"
                                        placeholder="Enter new password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="confirmNewPassword" class="form-label">Confirm Password</label>
                                <div class="input-group input-group-custom">
                                    <input type="password" class="form-control" id="confirmNewPassword"
                                        placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-continue">Update Password</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/mypage.profile.js') }}" defer></script>
    @endpush



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 現在のパスワードフィールドの目玉アイコンのみを対象にする
            const togglePasswordIcon = document.querySelector('.toggle-password[data-target="currentPassword"]');

            if (togglePasswordIcon) { // 目玉アイコンが存在する場合のみイベントリスナーを設定
                togglePasswordIcon.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const passwordInput = document.getElementById(targetId);
                    const eyeIcon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text'; 
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            }
        });
    </script>


   
</body>

</html>
