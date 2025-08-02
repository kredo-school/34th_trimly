<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mypage Profile-Edit</title>
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
        .form-control{
            border: none;
            background-color: #FEFCF1; 
        }
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
            min-height: calc(2.25rem + 2px); /* Bootstrap form-control の高さに合わせる */
        }
        .form-control-readonly .fa-solid {
            color: #a68c76; 
            margin-right: 10px;
        }
        .form-control-readonly .value-text {
            flex-grow: 1; /* テキストが残りのスペースを占める */
            color: #adb5bd; 
        }

        .input-group-custom-edit {
            display: flex;
            align-items: center;
            border: 1px solid #e0e0e0; /* form-control-readonly と同じボーダー */
            border-radius: 10px; /* form-control-readonly と同じ角丸 */
            background-color: #FEFCF1; /* form-control-readonly と同じ背景色 */
            min-height: calc(2.25rem + 2px); /* Bootstrap form-control の高さに合わせる */
            overflow: hidden; /* 角丸からはみ出さないように */
        }
        .input-group-custom-edit .input-group-text-custom-edit {
            background-color: transparent; /* 背景透明 */
            border: none; /* ボーダーなし */
            color: #a68c76; /* アイコンの色 */
            padding-left: 15px; /* 左のパディング */
            padding-right: 0; /* アイコンの右のパディングはなし */
            display: flex; /* アイコンを中央揃えにするため */
            align-items: center;
        }
        .input-group-custom-edit .form-control-inline {
            background-color: transparent; /* 背景透明 */
            border: none; /* ボーダーなし */
            box-shadow: none; /* フォーカス時の影を削除 */
            padding-left: 5px; /* アイコンとの間隔を調整 */
            padding-right: 15px; /* 右のパディング */
            color: #333; /* テキストの色 */
            height: auto; /* 高さは親要素に合わせる */
            flex-grow: 1; /* 残りのスペースを埋める */
        }

        .input-group-custom-edit .form-control-inline-select { /* select タグ用 */
            background-color: transparent; /* 背景透明 */
            border: none; /* ボーダーなし */
            box-shadow: none; /* フォーカス時の影を削除 */
            padding-left: 5px; /* アイコンとの間隔を調整 */
            padding-right: 15px; /* 右のパディング */
            color: #333; /* テキストの色 */
            height: auto; /* 高さは親要素に合わせる */
            flex-grow: 1; /* 残りのスペースを埋める */
            
        }

        /* 目玉アイコンは .toggle-password が付与されている部分にのみ適用 */
        .input-group-custom .toggle-password {
            background-color: #FEFCF1; 
            border-left: none; /* input との間のボーダーは不要 */
            color: #a68c76; /* アイコンの色 (画像に合わせて) */
            cursor: pointer;
            height: calc(2.25rem + 2px); /* Bootstrap form-control の高さに合わせる */
            display: flex;
            align-items: center;
            justify-content: center; 
            padding-left: 10px;
            padding-right: 15px;
        }
        /* input がフォーカスされた時の .toggle-password のボーダースタイル */
        .input-group-custom .form-control:focus + .toggle-password {
            border-color: #a68c76; /* フォーカス時の枠線色を合わせる */
            box-shadow: 0 0 0 0.25rem rgba(166, 140, 118, 0.25); /* フォーカス時の影を合わせる */
        }

        /* レスポンシブ調整 */
        @media (max-width: 767.98px) { /* mdブレイクポイント以下 */
            .card {
                padding: 20px; /* モバイルでのパディングを調整 */
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
                    <h4 class="card-title mb-4 text-muted">Pet Owner Information</h4>

                    <form action="#" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                {{-- div.input-group に変更し、アイコンと入力フィールドを一体化 --}}
                                <div class="input-group input-group-custom-edit">
                                    <span class="input-group-text input-group-text-custom-edit">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" name="firstName" id="firstName" class="form-control form-control-inline" value="John" autofocus>{{-- DBからのデータ表示 --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <div class="input-group input-group-custom-edit">
                                    <span class="input-group-text input-group-text-custom-edit">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" name="lastName" id="lastName" class="form-control form-control-inline" value="Smith" autofocus>{{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <div class="input-group input-group-custom-edit">
                                    <span class="input-group-text input-group-text-custom-edit">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" name="emailAddress" id="emailAddress" class="form-control form-control-inline" value="john.smith@email.com" autofocus>{{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <div class="input-group input-group-custom-edit">
                                    <span class="input-group-text input-group-text-custom-edit">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control form-control-inline" value="(555) 123-4567" autofocus>{{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                 <div class="input-group input-group-custom-edit">
                                    <span class="input-group-text input-group-text-custom-edit">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </span>
                                    <input type="text" name="city" id="city" class="form-control form-control-inline" value="Los Angeles"> {{-- DBからのデータ表示 --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="prefecture" class="form-label">Prefecture</label>
                                <div class="input-group input-group-custom-edit">
                                    <span class="input-group-text input-group-text-custom-edit">
                                        <i class="fa-solid fa-map"></i>
                                    </span>
                                    <select name="prefecture" id="prefecture" class="form-select form-control-inline-select">
                                        <option value="California" selected>California</option>
                                        <option value="New York">New York</option>
                                        <option value="Texas">Texas</option>
                                        {{-- オプションを追加 --}}
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-cancel me-2">Cancel</button>
                                <button type="submit" class="btn btn-save"><i class="fa-regular fa-floppy-disk"></i>Save Changes</button>
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
                                    <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
                                    <span class="input-group-text input-group-text-custom toggle-password" data-target="currentPassword">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="newPassword" class="form-label">New Password</label>
                                <div class="input-group input-group-custom">
                                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <label for="confirmNewPassword" class="form-label">Confirm Password</label>
                                <div class="input-group input-group-custom">
                                    <input type="password" class="form-control" id="confirmNewPassword" placeholder="Confirm new password">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous"></script>

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