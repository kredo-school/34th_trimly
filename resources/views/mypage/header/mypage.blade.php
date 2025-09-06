
<header class="bg-white mb-2 custom-app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="d-flex align-items-center w-100" style="padding-left:0;padding-right:0;">
            {{-- <a class="navbar-brand d-flex align-items-center p-0" href="#"> --}}
                <div class="logo">
                    <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
                    <span class="logo-text">Trimly</span>
                </div>
            {{-- </a> --}}
            <button class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
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
