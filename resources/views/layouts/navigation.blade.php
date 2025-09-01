<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Trimly Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS - Remove styles.css since it's causing conflicts -->
    <!-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation-salon-owner.css') }}" rel="stylesheet">
    
    <!-- Base CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Page-specific styles -->
    @stack('styles')
</head>

<body class="body-layout">

    @php
    echo "<!-- Debug: Session Data -->";
    echo "<!-- salon_code: " . session('salon_code', 'EMPTY') . " -->";
    echo "<!-- salon_name: " . session('salon_name', 'EMPTY') . " -->";
    echo "<!-- salon_owner_id: " . session('salon_owner_id', 'EMPTY') . " -->";
@endphp

    <!-- Header Section -->
    <header class="bg-white shadow-sm mb-2"> 
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <!-- Left side: Logo and Brand -->
                <a class="navbar-brand"> 
                    <div class="logo me-1">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="img-fluid logo-image">
                    </div>
                    <div class="brand-text">
                        <p class="main-title fw-bold text-muted mb-0 fs-5">Trimly Admin</p>
                        <p class="subtitle text-muted mb-0 subtitle-text">{{ session('salon_name', 'Salon Name') }}</p>
                    </div>
                </a>

                <!-- Center: Menu Dropdown -->
                <div class="menu-dropdown">
                    <button class="menu-btn" onclick="toggleMenu()" id="menuBtn">
                        Menu <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="menu-dropdown-content" id="menuDropdown">
                        <a href="/dashboard-salonowner/appointments" class="menu-dropdown-item {{ request()->is('dashboard-salonowner/appointments') ? 'active' : '' }}">
                            <i class="fa-regular fa-calendar"></i> Appointments
                        </a>
                        <a href="/dashboard-salonowner/customers" class="menu-dropdown-item {{ request()->is('dashboard-salonowner/customers') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i> Customers
                        </a>
                        <a href="/dashboard-salonowner/calendar" class="menu-dropdown-item {{ request()->is('dashboard-salonowner/calendar') ? 'active' : '' }}">
                            <i class="fa-regular fa-calendar-days"></i> Calendar
                        </a>
                        <a href="/dashboard-salonowner/services" class="menu-dropdown-item {{ request()->is('dashboard-salonowner/services') ? 'active' : '' }}">
                            <i class="fa-solid fa-scissors"></i> Services
                        </a>
                        <a href="/dashboard-salonowner/settings" class="menu-dropdown-item {{ request()->is('dashboard-salonowner/settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </div>
                </div>

                <!-- Right side: Salon Code and Logout -->
                <div class="header-actions">
                    <!-- Salon Code Button with Modal Trigger -->
                    <a href="#" class="btn-salon-code d-none d-sm-flex btn-owner-back" data-bs-toggle="modal" data-bs-target="#salonCodeModal">
                        <i class="fa-solid fa-key me-2"></i>
                        <span>Salon Code</span>
                    </a>
                    
                  <!-- Logout Form -->
             <form id="logoutForm" action="/salon-owner/logout" method="POST" style="display: inline;">
                 @csrf
                   <button type="submit" class="btn-salon-code d-none d-sm-flex btn-owner-back" style="border: none;">
                     <i class="fa-solid fa-right-from-bracket me-2"></i>
                  <span class="d-none d-sm-inline">Logout</span>
                </button>
    </form>
</div>
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        @yield('content')
    </main>

   <!-- Salon Code Modal -->
<div class="modal fade" id="salonCodeModal" tabindex="-1" aria-labelledby="salonCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salonCodeModalLabel">Your Salon Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Salon Code Display -->
                <div class="salon-code-display" id="salonCodeDisplay">
                    {{ session('salon_code', 'NO CODE') }}
                </div>
                    
                    <!-- Copy Button -->
                    <button class="btn btn-copy-code" id="copyCodeBtn">
                        <i class="fa-regular fa-copy me-2"></i>Copy Code
                    </button>
                    
                    <!-- Description -->
                    <p class="modal-description">Share this code with your customers to allow them to book appointments.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
</body>
</html>