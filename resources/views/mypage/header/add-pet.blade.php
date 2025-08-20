
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
