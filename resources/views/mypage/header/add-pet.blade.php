<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">

</head>

  <style>
        /* ロゴ */
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
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .btn-logout:hover {
            background-color: #e0e0e0;
            color: #6c757d;
        }

       
     
    </style>
</head>
<body>
    <header class="bg-white shadow-sm mb-2 custom-app-header"> 
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center p-0" href="#"> 
                    <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="me-2 logo"> 
                    <p class="fw-bold text-muted mb-0 fs-5">Trimly</p>
                </a>
             
                

                    <form class="d-flex ms-lg-auto" action="#" method="POST">
                        @csrf
                        <button class="btn btn-logout" type="submit">Logout</button>
                    </form>
                </div>
            </div>
    </header>

</body>
</html>