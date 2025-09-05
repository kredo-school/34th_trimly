<style>
    /* ヘッダー寸法: users.profile.header に合わせる */
    .custom-app-header {
        background-color: #ffffff;
        padding: 16px 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    /* ロゴ（users.profile.header と統一） */
    .custom-app-header .navbar-brand {
        padding: 0 !important;
        margin: 0 !important;
        line-height: 1;
        font-size: 1rem;
    }

    .custom-app-header .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .custom-app-header .logo img {
        height: 40px;
        width: auto;
        display: block;
    }

    .custom-app-header .logo-text {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #333;
        display: inline-block;
        line-height: 1;
    }

    /* グローバル .navbar の影を打ち消す（当ヘッダーは nav 使っていないが念のため） */
    .custom-app-header .navbar {
        box-shadow: none !important;
        background: transparent;
        position: static;
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
</style>

<header class="bg-white mb-2 custom-app-header">
    <div class="d-flex align-items-center w-100" style="padding-left:0;padding-right:0;">
        <a class="navbar-brand d-flex align-items-center p-0" href="#">
            <div class="logo">
                <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
                <span class="logo-text">Trimly</span>
            </div>
        </a>



        <form class="d-flex ms-lg-auto" action="{{ route('pet_owner.logout') }}" method="POST">
            @csrf
            <button class="btn btn-logout" type="submit">Logout</button>
        </form>
    </div>
    </div>
</header>
