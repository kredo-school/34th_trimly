@extends('layouts.pet_owner')

@section('title', 'MyPage Reservations')

@push('styles')
    <style>
        /* セクションヘッダー */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        /* appointment-card */
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
            align-items: flex-start;
            text-align: left;
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

        /* status */
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

        /* actions */
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
@endpush

@section('header')
    @include('mypage.header.mypage')
@endsection

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="card p-4 mb-4 shadow-sm">
                {{-- Upcoming Appointments セクション --}}
                <div class="mb-2">
                    <div class="section-header">
                        <div>
                            <h4 class="fw-bold">Upcoming Appointments</h4>
                            <p>Your scheduled grooming appointments</p>
                        </div>
                        <a href="/mypage/reservation/new" class="btn btn-primary">New Appointment</a>
                    </div>

                    {{-- 今後の予約情報を foreach ループで表示 --}}
                    {{-- @foreach ($upcomingAppointments as $appointment) --}}

                    {{-- ダミーデータ1 (Upcoming) --}}
                    <div class="appointment-card">
                        <div class="appointment-info">
                            <span class="status-badge status-upcoming"><i
                                    class="fa-regular fa-clock me-2"></i>Upcoming</span>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editReserveModal1">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                {{-- delete-button --}}
                                <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteReserveModal1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ダミーデータ2 (Upcoming) --}}
                    <div class="appointment-card">
                        <div class="appointment-info">
                            <span class="status-badge status-upcoming"><i
                                    class="fa-regular fa-clock me-2"></i>Upcoming</span>
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
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                {{-- delete-button --}}
                                <button type="button" class="btn pet-action-btn text-danger">
                                    <i class="fa-solid fa-trash-can"></i>
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
                        <h4 class="fw-bold">Appointment History</h4>
                        <p>Your past and cancelled appointments</p>
                    </div>
                </div>

                {{-- 過去の予約情報を foreach ループで表示 --}}
                {{-- @foreach ($historyAppointments as $appointment) --}}

                {{-- ダミーデータ3 (Completed) --}}
                <div class="appointment-card">
                    <div class="appointment-info">
                        <span class="status-badge status-completed"><i
                                class="fa-regular fa-circle-check me-2"></i>Completed</span>
                        <div class="appointment-details">
                            <div class="appointment-title">Full Grooming Package - Bella</div>
                            <div class="appointment-subtitle">Puppy Palace Downtown</div>
                            <div class="appointment-date">12/15/2023 at 11:00 AM</div>
                        </div>
                    </div>
                    <div class="appointment-actions">
                        <span class="price">$85</span>
                        {{-- Rebook --}}
                        <button type="button" class="btn btn-action btn-again" data-bs-toggle="modal"
                            data-bs-target="#rebookReserveModal1">
                            Book Again
                        </button>
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

            {{-- Include the modal here --}}
            @include('mypage.modal.delete-reserve')
            @include('mypage.modal.edit-reserve')
            @include('mypage.modal.rebook-reserve')
        </div>
    </div>
@endsection
