<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyPage Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">
    <style>
        /* ロゴ画像のサイズ調整 */
        .logo {
            width: 80px;
            height: 80px;
        }

        /* ログアウトボタンのスタイル */
        .btn-logout {
            background-color: #FEFCF1;
            color: #666;
            border: 1px solid #e0e0e0;
            height: 40px;
            padding: 0 20px;
        }
        .btn-logout:hover {
            background-color: #e0e0e0;
            color: #6c757d;
        }

        /* ナビゲーションリンクのスタイル */
        .navbar-nav .nav-item .nav-link {
            color: #666;
            font-weight: bold;
            margin-right: 20px;
            font-size: 1rem;
            padding-top: 8px;
            padding-bottom: 8px;
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #c8a882;
        }
        .navbar-nav .nav-item .nav-link i {
            color: #666;
        }
        .navbar-nav .nav-item .nav-link i:hover {
            color: #c8a882;
        }

        /* レスポンシブ対応の調整 */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                flex-direction: column;
                align-items: center;
                margin-top: 15px;
                border-top: 1px solid #e9ecef;
                padding-top: 15px;
            }
            .navbar-collapse .custom-nav-links,
            .navbar-collapse form.d-flex.ms-lg-auto {
                margin: 0 !important;
                width: 100%;
            }
            .navbar-collapse .nav-item {
                justify-content: center;
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
                    <div class="d-flex flex-grow-1 justify-content-center">
                        <ul class="navbar-nav mb-2 mb-lg-0">
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
                    </div>
                    <form class="d-flex ms-auto" action="#" method="POST">
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