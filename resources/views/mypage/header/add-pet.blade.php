
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
