    <style>
        /* ロゴ画像のサイズ調整 */
        .logo {
            width: 80px;
            height: 80px;
        }

        /* ログアウトボタンのスタイル */
        .btn-logout {
            background-color: #FEFCF1 !important;
            color: #666 !important;
            border: 1px solid #e0e0e0 !important;
            height: 40px;
            padding: 0 20px !important;
        }
        .btn-logout:hover {
            background-color: #e0e0e0 !important;
            color: #6c757d !important;
        }

        /* ナビゲーションリンクのスタイル */
        .navbar-nav .nav-item .nav-link {
            color: #666 !important;
            font-weight: bold;
            margin-right: 20px;
            font-size: 1rem;
            padding-top: 8px;
            padding-bottom: 8px;
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


    <header class="bg-white shadow-sm mb-2 custom-app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center p-0" href="#">
                    <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="logo">
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p>
                </a>
                <button class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="d-flex flex-grow-1 justify-content-center">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('mypage.profile') }}">
                                    <i class="fa-solid fa-user me-1"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mypage.pets.index') }}">
                                    <i class="fa-solid fa-heart me-1"></i> My Pets
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('mypage.salon') }}">
                                    <i class="fa-solid fa-store me-1"></i> My Salons
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mypage.reservation.index') }}">
                                    <i class="fa-solid fa-calendar-alt me-1"></i> Reservations
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form class="d-flex ms-auto" action="{{ route('pet_owner.logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-logout" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
