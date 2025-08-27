<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Trimly')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Header Section -->
    <header class="bg-white shadow-sm mb-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 d-flex align-items-center">
                    <div class="logo me-1">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="img-fluid">
                    </div>
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p>
                </div>
                <div class="col-6 text-end">
                    <p class="text-muted mb-0 me-2 fs-6">Salon Registration</p>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    @stack('scripts')
</body>
</html>