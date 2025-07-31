<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My salons</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <style>
        .salon-code-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 15px; /* 各アイテム間のスペース */
        }
        .salon-code-info {
            display: flex;
            align-items: center;
            gap: 15px; /* アイコンとテキストの間 */
        }
        .salon-code-icon {
            color: #a68c76;
            font-size: 1.2rem;
        }
        .salon-name {
            font-weight: bold;
            font-size: 1.1rem;
            color: #6c757d;
        }
        .salon-details {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .salon-code-status {
            font-size: 0.75rem;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 5px;
            background-color: #dcfce6; /* Light blue for Active */
            color: #166434; /* Blue text */
        }
       

    </style>
</head>

<body>
    @include('mypage.header.mypage')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">

                <div class="card p-4 mb-4 shadow-sm">

                    <div>
                        <h4 class="card-title text-start mb-3 fw-bold text-muted">Add Salon Code</h4>
                        <p class="card-subtitle text-muted text-start mb-4">Enter a salon code to link a new salon to
                            your account</p>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-inline"
                                placeholder="Enter salon code (e.g., ABC123)" aria-label="Salon Code" name="salon_code"
                                required>
                            <button class="btn btn-continue" type="submit">
                                <i class="fa-solid fa-plus me-2"></i> Add Code
                            </button>
                        </div>
                    </form>
                </div>

                <h4 class="card-header-main mb-3 text-muted fw-bold">Your Salon Codes</h3>

                {{-- Salon List --}}
                <div id="salon-codes-list">
                    {{-- @foreach ($salonCodes as $salonCode) --}}

                    {{-- ダミーデータ1 --}}
                    <div class="salon-code-item">
                        <div class="salon-code-info">
                            <i class="fa-regular fa-building salon-code-icon"></i>
                            <span class="salon-code-status">Active</span>
                            <div>
                                <div class="salon-name">Puppy Palace Downtown</div>
                                <div class="salon-details">Code: PP02024</div>
                                <div class="salon-details">Added: 10/01/2024</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteSalonModal1">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                    {{-- ダミーデータ2 --}}
                    <div class="salon-code-item">
                        <div class="salon-code-info">
                            <i class="fa-regular fa-building salon-code-icon"></i>
                            <span class="salon-code-status">Active</span>
                            <div>
                                <div class="salon-name">Furry Friends Salon</div>
                                <div class="salon-details">Code: FF52823</div>
                                <div class="salon-details">Added: 05/12/2023</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteSalonModal2">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                    {{-- @endforeach --}}

                    {{-- @empty($salonCodes) --}}
                    {{-- <div class="text-center text-muted mt-5">
                        <p>No salon codes registered yet.</p>
                    </div> --}}
                    {{-- @endempty --}}
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

        {{-- Include the modal here --}}    
        @include('mypage.modal.delete-salon')

</body>

</html>
