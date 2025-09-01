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
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="card p-4 mb-4 shadow-sm">
                {{-- Upcoming Appointments --}}
                <div class="mb-2">
                    <div class="section-header">
                        <div>
                            <h4 class="fw-bold">Upcoming Appointments</h4>
                            <p>Your scheduled grooming appointments</p>
                        </div>
                        <a href="/mypage/reservation/new" class="btn btn-primary">New Appointment</a>
                    </div>

                    {{-- Upcoming --}}
                    @foreach ($upcomingAppointments as $appointment)
                        <div class="appointment-card">
                            <div class="appointment-info">
                                <span class="status-badge status-upcoming">
                                    <i class="fa-regular fa-clock me-2"></i>
                                    {{ $appointment->appointmentStatus->display_name }}
                                </span>
                                <div class="appointment-details">
                                    <div class="appointment-title">
                                        {{ $appointment->serviceItem->servicename }} - {{ $appointment->pet->name }}
                                    </div>
                                    <div class="appointment-subtitle">
                                        {{ $appointment->salon->salonname }}
                                    </div>
                                    <div class="appointment-date">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('m/d/Y') }}
                                        at
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time_start)->format('g:i A') }}
                                    </div>
                                </div>
                            </div>
                            <div class="appointment-actions">
                                <span class="price">${{ $appointment->serviceItem->price }}</span>
                                <div class="pet-actions">
                                    {{-- edit-button --}}
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editReserveModal{{ $appointment->id }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    {{-- delete-button --}}
                                    <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteReserveModal{{ $appointment->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @include('mypage.modal.edit-reserve', ['appointment' => $appointment])
                        @include('mypage.modal.delete-reserve', ['appointment' => $appointment])
                    @endforeach
                </div>
            </div>

            {{-- Appointment History --}}
            <div class="card p-4 mb-4 shadow-sm">
                <div class="section-header">
                    <div>
                        <h4 class="fw-bold">Appointment History</h4>
                        <p>Your past and cancelled appointments</p>
                    </div>
                </div>

                @foreach ($historyAppointments as $appointment)
                    <div class="appointment-card">
                        <div class="appointment-info">
                            <span
                                class="status-badge {{ $appointment->status == 2 ? 'status-cancelled' : 'status-completed' }}">
                                <i class="fa-regular fa-circle-check me-2"></i>
                                {{ $appointment->status == 1 && \Carbon\Carbon::parse($appointment->appointment_date)->lt(now())
                                    ? 'Completed'
                                    : $appointment->appointmentStatus->display_name }}
                            </span>
                            <div class="appointment-details">
                                <div class="appointment-title">
                                    {{ $appointment->serviceItem->servicename }} - {{ $appointment->pet->name }}
                                </div>
                                <div class="appointment-subtitle">
                                    {{ $appointment->salon->salonname }}
                                </div>
                                <div class="appointment-date">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('m/d/Y') }}
                                    at {{ \Carbon\Carbon::parse($appointment->appointment_time_start)->format('g:i A') }}
                                </div>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <span class="price">${{ $appointment->serviceItem->price }}</span>
                            @if (
                                $appointment->status == 3 ||
                                    ($appointment->status == 1 && \Carbon\Carbon::parse($appointment->appointment_date)->lt(now())))
                                {{-- completed または 過去日の confirmed のみ再予約 --}}
                                <button type="button" class="btn btn-action btn-again" data-bs-toggle="modal"
                                    data-bs-target="#rebookReserveModal{{ $appointment->id }}">
                                    Book Again
                                </button>
                            @endif

                        </div>
                    </div>
                    @include('mypage.modal.rebook-reserve', [
                        'appointment' => $appointment,
                        'slots' => $availableSlots[$appointment->id] ?? [],
                    ])
                @endforeach
            </div>
        </div>
    </div>
@endsection
