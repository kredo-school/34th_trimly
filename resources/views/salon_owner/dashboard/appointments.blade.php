@extends('layouts.navigation')

@section('title', 'Appointments')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Salon Owner CSS Files Only -->
    <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('salon_owner.appointments') }}" id="filterForm">
                <input type="hidden" name="date" value="{{ request('date', \Carbon\Carbon::today()->toDateString()) }}">
                
                <div class="owner-search-section">
                    <!-- Search Input -->
                    <div class="position-relative flex-grow-1 owner-search-max-width">
                        <i class="fa-solid fa-magnifying-glass owner-search-icon"></i>
                        <input type="text" name="search" class="owner-search-input" 
                               placeholder="Search appointments..." 
                               value="{{ request('search') }}" 
                               id="searchInput" />
                    </div>
                    
                    <!-- Filter Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-secondary owner-status-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-2"></i>
                            @if(request('status') == 'confirmed')
                                Confirmed
                            @elseif(request('status') == 'completed')
                                Completed
                            @elseif(request('status') == 'cancelled')
                                Cancelled
                            @else
                                All Status
                            @endif
                            <i class="fa-solid fa-chevron-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-status="">All Status</a></li>
                            <li><a class="dropdown-item" href="#" data-status="confirmed">Confirmed</a></li>
                            <li><a class="dropdown-item" href="#" data-status="completed">Completed</a></li>
                            <li><a class="dropdown-item" href="#" data-status="cancelled">Cancelled</a></li>
                        </ul>
                    </div>
                </div>
                
                <input type="hidden" name="status" id="statusInput" value="{{ request('status') }}">
            </form>
        </div>
    </div>

    <!-- Appointments Card -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">{{ $displayDate ?? "Today's Appointments" }}</h4>
            
            <div id="appointmentsList">
                @if(isset($appointments) && $appointments->count() > 0)
                    @foreach($appointments as $appointment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="owner-appointment-item" data-status="{{ $appointment->status == 1 ? 'confirmed' : ($appointment->status == 2 ? 'cancelled' : 'completed') }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Customer Avatar -->
                                        <div class="owner-customer-avatar owner-avatar-{{ $appointment->status == 1 ? 'confirmed' : ($appointment->status == 2 ? 'cancelled' : 'completed') }}">
                                            <i class="fa-solid fa-scissors"></i>
                                        </div>
                                        
                                        <!-- Customer Details -->
                                        <div class="owner-customer-details">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <h5 class="owner-customer-name mb-0 me-auto">{{ $appointment->pet->owner->firstname }} {{ $appointment->pet->owner->lastname }}</h5>
                                                <span class="badge owner-badge-{{ $appointment->status == 1 ? 'confirmed' : ($appointment->status == 2 ? 'cancelled' : 'completed') }} ms-4">
                                                    {{ $appointment->status == 1 ? 'Confirmed' : ($appointment->status == 2 ? 'Cancelled' : 'Completed') }}
                                                </span>
                                            </div>
                                            <div class="owner-service-info text-muted">{{ $appointment->serviceItem->servicename }} • {{ $appointment->pet->name }}</div>
                                            <div class="owner-appointment-time text-muted">
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time_start)->format('g:i A') }}  
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time_end)->format('g:i A') }}
                                                @php
                                                    $start = \Carbon\Carbon::parse($appointment->appointment_time_start);
                                                    $end = \Carbon\Carbon::parse($appointment->appointment_time_end);
                                                    $duration = $start->diff($end);
                                                @endphp
                                                ({{ $duration->h }}h {{ $duration->i > 0 ? $duration->i . 'm' : '' }})
                                                <span class="mx-2">    </span>
                                                <i class="fa-solid fa-phone"></i> {{ $appointment->pet->owner->phone }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions Only -->
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <button class="btn btn-ghost btn-sm owner-action-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-edit me-2"></i>Edit Appointment</a></li>
                                                @if($appointment->status == 1)
                                                <li>
                                                    <a class="dropdown-item text-danger cancel-appointment" href="#" 
                                                       data-id="{{ $appointment->id }}"
                                                       data-customer="{{ $appointment->pet->owner->firstname }} {{ $appointment->pet->owner->lastname }}"
                                                       data-service="{{ $appointment->serviceItem->servicename }}">
                                                        <i class="fa-solid fa-trash-can me-2"></i>Cancel Appointment
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Empty State -->
                    <div id="emptyState" class="owner-empty-state text-center">
                        <i class="fa-regular fa-calendar-xmark text-muted"></i>
                        <h5 class="text-muted">No appointments found</h5>
                        <p class="text-muted">Try adjusting your search or filter criteria.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

