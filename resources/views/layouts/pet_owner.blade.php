<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trymly') }} | @yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" /> --}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

    <!-- Vite (必要なら有効に) -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- ページ固有CSS -->
    @stack('styles')
</head>

<body>
    <!-- ヘッダー -->
    @includeWhen(View::exists('pet_owner.register.header'), 'pet_owner.register.header')

    <!-- メインコンテンツ -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">
                    {{-- ページ固有コンテンツ --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- グローバルJS -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- ページ固有JS -->
    @stack('scripts')
</body>

</html>
