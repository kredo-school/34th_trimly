    <style>
        /* ヘッダー寸法: users.profile.header に合わせる */
        .custom-app-header {
            background-color: #ffffff;
            padding: 16px 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        /* ロゴ（users.profile.header と統一） */
        .custom-app-header .navbar-brand { padding: 0 !important; margin: 0 !important; line-height: 1; font-size: 1rem; }
        .custom-app-header .logo { display: flex; align-items: center; gap: 10px; }
        .custom-app-header .logo img { height: 40px; width: auto; display: block; }
        .custom-app-header .logo-text { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: #333; display: inline-block; line-height: 1; }

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
            font-weight: 600;
            margin-right: 16px;
            font-size: 14px; /* users.profile.header のテキスト感に寄せる */
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
        /* グローバル .navbar の影を打ち消す */
        .custom-app-header .navbar {
            box-shadow: none !important;
            background-color: transparent;
            position: static; /* disable sticky from global */
            padding-top: 0;   /* remove bootstrap default 0.5rem */
            padding-bottom: 0;/* remove bootstrap default 0.5rem */
            padding-left: 0;
            padding-right: 0;
            min-height: auto;
        }
    </style>


    <header class="bg-white mb-2 custom-app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="d-flex align-items-center w-100" style="padding-left:0;padding-right:0;">
                <a class="navbar-brand d-flex align-items-center p-0" href="#">
                    <div class="logo">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
                        <span class="logo-text">Trimly</span>
                    </div>
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
