@extends('layouts.pet_owner')

@section('title', 'MyPage Reservations')

@push('styles')
    <style>
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
                            <h4 class="fw-bold"><i class="fa-solid fa-calendar-alt me-1"></i>Upcoming Appointments</h4>
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
