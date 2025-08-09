<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My reservations</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

    <style>
        /* ページ全体のスタイル */
        .page-container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* セクションヘッダー */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6c757d;
            margin: 0;
        }

        .section-header p {
            font-size: 0.9rem;
            color: #6c757d;
            margin: 0;
        }

        /* 予約情報カードのスタイル */
        .appointment-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .appointment-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .appointment-details {
            display: flex;
            flex-direction: column;
        }

        .appointment-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .appointment-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .appointment-date {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* 状態バッジ */
        .status-badge {
            font-size: 0.75rem;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 5px;
        }
        .status-upcoming {
            background-color: #e0f2f7;
            color: #007bff;
        }
        .status-completed {
            background-color: #e6f8ee;
            color: #28a745;
        }
        .status-cancelled {
            background-color: #fce6e6;
            color: #dc3545;
        }

        /* アクションエリア */
        .appointment-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .appointment-actions .price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #6c757d;
            margin-right: 15px;
        }

         .btn-again {
            background-color: #FEFCF1 !important;
            color: #666 !important;
            border: 1px solid #e0e0e0;
            height: 40px; 
            padding: 0 20px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .btn-again:hover {
            background-color: #e0e0e0;
            color: #6c757d;
        }
    </style>
</head>

<body>
    @include('mypage.header.mypage')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card p-4 mb-4 shadow-sm">
                    {{-- Upcoming Appointments セクション --}}
                    <div class="mb-2">
                        <div class="section-header">
                            <div>
                                <h2>Upcoming Appointments</h2>
                                <p>Your scheduled grooming appointments</p>
                            </div>
                            <a href="#" class="btn btn-primary">New Appointment</a>
                        </div>

                        {{--今後の予約情報を foreach ループで表示 --}}
                        {{-- @foreach ($upcomingAppointments as $appointment) --}}

                        {{-- ダミーデータ1 (Upcoming) --}}
                        <div class="appointment-card">
                            <div class="appointment-info">
                                <span class="status-badge status-upcoming"><i class="fa-regular fa-clock me-2"></i>Upcoming</span>
                                <div class="appointment-details">
                                    <div class="appointment-title">Full Grooming Package - Bella</div>
                                    <div class="appointment-subtitle">Puppy Palace Downtown</div>
                                    <div class="appointment-date">07/19/2024 at 10:00 AM</div>
                                </div>
                            </div>
                            <div class="appointment-actions">
                                <span class="price">$85</span>
                                <div class="pet-actions">
                                    {{-- edit-button --}}
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editReserveModal1">
                                       <i class="fa-regular fa-pen-to-square"></i>Edit
                                    </button>
                                    {{-- delete-button --}}
                                    <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal" data-bs-target="#deleteReserveModal1">
                                        <i class="fa-solid fa-trash-can"></i>Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- ダミーデータ2 (Upcoming) --}}
                        <div class="appointment-card">
                            <div class="appointment-info">
                                <span class="status-badge status-upcoming"><i class="fa-regular fa-clock me-2"></i>Upcoming</span>
                                <div class="appointment-details">
                                    <div class="appointment-title">Basic Trim - Max</div>
                                    <div class="appointment-subtitle">Furry Friends Salon</div>
                                    <div class="appointment-date">07/09/2024 at 2:00 PM</div>
                                </div>
                            </div>
                            <div class="appointment-actions">
                                <span class="price">$45</span>
                                <div class="pet-actions">
                                    {{-- edit-button --}}
                                    <button type="button" class="btn btn-primary">
                                      <i class="fa-regular fa-pen-to-square"></i>Edit
                                    </button>
                                    {{-- delete-button --}}
                                    <button type="button" class="btn pet-action-btn text-danger">
                                        <i class="fa-solid fa-trash-can"></i>Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- @endforeach --}}
                    </div>
                </div>

                {{-- Appointment History セクション --}}
                <div class="card p-4 mb-4 shadow-sm">
                    <div class="section-header">
                        <div>
                            <h2 class="text-muted">Appointment History</h2>
                            <p class="text-muted">Your past and cancelled appointments</p>
                        </div>
                    </div>

                    {{--過去の予約情報を foreach ループで表示 --}}
                    {{-- @foreach ($historyAppointments as $appointment) --}}

                    {{-- ダミーデータ3 (Completed) --}}
                    <div class="appointment-card">
                        <div class="appointment-info">
                            <span class="status-badge status-completed"><i class="fa-regular fa-circle-check me-2"></i>Completed</span>
                            <div class="appointment-details">
                                <div class="appointment-title">Full Grooming Package - Bella</div>
                                <div class="appointment-subtitle">Puppy Palace Downtown</div>
                                <div class="appointment-date">12/15/2023 at 11:00 AM</div>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <span class="price">$85</span>
                        {{--Rebook--}}
                            <a href="#" class="btn btn-action btn-again" data-bs-toggle="modal" data-bs-target="#editReserveModal1">Book Again</a>
                        </div>
                    </div>

                    {{-- ダミーデータ4 (Cancelled) --}}
                    <div class="appointment-card">
                        <div class="appointment-info">
                            <span class="status-badge status-cancelled"><i class="fa-solid fa-xmark me-2"></i>Cancelled</span>
                            <div class="appointment-details">
                                <div class="appointment-title">Nail Trimming - Max</div>
                                <div class="appointment-subtitle">Quick Paws Express</div>
                                <div class="appointment-date">12/10/2023 at 3:00 PM</div>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <span class="price">$25</span>
                        </div>
                    </div>

                    {{-- @endforeach --}}
                </div>

            </div>

            {{-- Include the modal here --}}
            @include('mypage.modal.delete-reserve')
            @include('mypage.modal.edit-reserve')

</body>

</html>
