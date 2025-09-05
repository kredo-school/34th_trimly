<header class="bg-white shadow-sm mb-2 custom-app-header">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center p-0" href="#">
            <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="me-2 logo">
            <p class="fw-bold text-muted mb-0 fs-5">Trimly</p>
        </a>



        <form class="d-flex ms-lg-auto" action="{{ route('pet_owner.logout') }}" method="POST">
            @csrf
            <button class="btn btn-logout" type="submit">Logout</button>
        </form>
    </div>
    </div>
</header>
