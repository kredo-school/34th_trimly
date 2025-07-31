<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">

</head>

  <style>
        /* ロゴ */
        .logo { 
            width: 80px; 
            height: 80px;
        }
        /* ナビゲーションリンクのスタイル */
        .navbar-nav .nav-item .nav-link { 
            color: #666 !important; /*  文字色を茶色に強制 (image_54bbc4.png) */
            font-weight: bold; 
            margin-right: 20px;
            font-size: 1rem;
            /* heightの高さが縮まる場合は、上下のpaddingを調整 */
             padding-top: 8px !important;
             padding-bottom: 8px !important; 
        }
        .navbar-nav .nav-item .nav-link:hover { 
            color: #c8a882 !important; 
        }
        .navbar-nav .nav-item .nav-link i { 
            color: #666 !important; 
        }

        .navbar-nav .nav-item .nav-link i:hover { 
            color: #c8a882 !important; 
        }

        /* ログアウトボタンのスタイル */
        .btn-logout {
            background-color: #FEFCF1;
            color: #666;
            border: 1px solid #e0e0e0;
            height: 40px; 
            padding: 0 20px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .btn-logout:hover {
            background-color: #e0e0e0;
            color: #6c757d;
        }

        /* ヘッダー全体の高さと背景色などの調整 */
        header.bg-white {
            background-color: white; 
            border-bottom: 1px solid #e0e0e0 !important; 
            padding: 5px 0 !important; 
            height: auto !important; /*高さを自動に任せるか、固定する場合はここで指定 */
            min-height: 50px; /* 最低限の高さを設定 (ロゴやリンクの高さに合わせて調整) */
        }
        header .navbar {
            padding: 0 !important; /* navbarのデフォルトパディングをリセット */
            height: 100%; /* 親のheaderに高さを合わせる */
        }
        header .container-fluid {
            height: 100%; /* 親のnavbarに高さを合わせる */
            display: flex;
            align-items: center;
            justify-content: space-between; /* ★修正: ロゴ、ナビ、ログアウトを左右に配置 */
            padding-left: var(--bs-gutter-x, 1.5rem); /* Bootstrapデフォルトの左右パディング */
            padding-right: var(--bs-gutter-x, 1.5rem);
        }
        header .navbar-brand {
            height: 100%;
            display: flex;
            align-items: center;
            margin-right: 0 !important; /* デフォルトマージンをリセット */
        }
        header .navbar-brand p { /* Trimly テキストのpタグにマージンを適用 */
            margin-bottom: 0 !important; /* pタグのデフォルト下マージンを削除 */
            margin-left: 2px; /* ロゴとの間隔 */
        }

       
        /* デスクトップでナビゲーションを中央、ログアウトボタンを右に */
        .navbar-collapse {
            display: flex; /* Flexboxコンテナ */
            flex-grow: 1; /* 残りのスペースを全て占める */
            justify-content: center; /* ナビゲーションリンクを中央に寄せる */
            align-items: center; /* 垂直中央揃え */
        }
        .navbar-collapse .custom-nav-links {
            margin-left: auto; /* ナビゲーションを中央に */
            margin-right: auto; /* ナビゲーションを中央に */
        }
        .navbar-collapse form.d-flex.ms-lg-auto {
            margin-left: auto !important; /* ログアウトボタンを右端に強制 */
            flex-shrink: 0; /* 縮まないように */
        }

        /* レスポンシブ対応の調整 (ハンバーガーメニュー展開時) */
        @media (max-width: 991.98px) {
            header.bg-white {
                height: auto !important; /* モバイル時は高さを自動調整 */
                padding: 10px 0 !important; /* モバイル時の上下パディング */
            }
            header .container-fluid {
                flex-wrap: wrap; /* 要素を折り返す */
                justify-content: space-between; /* ロゴとトグルボタンを左右に */
            }
            .navbar-toggler {
                margin-left: auto; /* トグルボタンを右に寄せる */
            }
            .navbar-collapse {
                width: 100%; /* メニューの幅を100%に */
                justify-content: center !important; /* モバイルメニュー全体を中央寄せ */
                flex-direction: column; /* 縦並び */
                align-items: center; /* 垂直中央揃え */
                margin-top: 15px;
                border-top: 1px solid #e9ecef;
                padding-top: 15px;
            }
            .navbar-collapse .custom-nav-links {
                margin-left: 0 !important; /* モバイル時は中央寄せ解除 */
                margin-right: 0 !important; /* モバイル時は中央寄せ解除 */
                margin-bottom: 15px;
                width: 100%; /* ナビゲーションリンクの幅を100%に */
            }
            .navbar-collapse .custom-nav-links .nav-item {
                width: 100%;
                justify-content: center; /* 各リンクを中央寄せ */
                margin-right: 0;
            }
            .navbar-collapse form.d-flex.ms-lg-auto {
                margin-left: 0 !important; /* モバイル時は右寄せ解除 */
                width: 100%;
                justify-content: center; /* ボタンを中央寄せ */
            }
        }
    </style>
</head>
<body>
    <header class="bg-white shadow-sm mb-2 custom-app-header"> 
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center p-0" href="#"> 
                    <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="me-2 logo"> 
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p>
                </a>

                <button class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav"> 
                    <ul class="navbar-nav mb-2 mb-lg-0 custom-nav-links"> 
                        <li class="nav-item ">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-user me-1"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-heart me-1"></i> My Pets
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-store me-1"></i> My Salons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-calendar-alt me-1"></i> Reservations
                            </a>
                        </li>
                    </ul>
                    
                    <form class="d-flex ms-lg-auto" action="#" method="POST">
                        @csrf
                        <button class="btn btn-logout" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>