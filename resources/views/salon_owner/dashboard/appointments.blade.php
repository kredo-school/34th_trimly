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
                                                <i class="fa-regular fa-clock"></i> 
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time_start)->format('g:i A') }} - 
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time_end)->format('g:i A') }}
                                                @php
                                                    $start = \Carbon\Carbon::parse($appointment->appointment_time_start);
                                                    $end = \Carbon\Carbon::parse($appointment->appointment_time_end);
                                                    $duration = $start->diff($end);
                                                @endphp
                                                ({{ $duration->h }}h {{ $duration->i > 0 ? $duration->i . 'm' : '' }})
                                                <span class="mx-2">•</span>
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
                                                <li>
                                                    <a class="dropdown-item edit-appointment" href="#"
                                                       data-id="{{ $appointment->id }}"
                                                       data-customer="{{ $appointment->pet->owner->firstname }} {{ $appointment->pet->owner->lastname }}"
                                                       data-service="{{ $appointment->serviceItem->servicename }}"
                                                       data-service-id="{{ $appointment->service_item_id }}"
                                                       data-pet-id="{{ $appointment->pet_id }}"
                                                       data-date="{{ $appointment->appointment_date }}"
                                                       data-start-time="{{ \Carbon\Carbon::parse($appointment->appointment_time_start)->format('H:i') }}"
                                                       data-end-time="{{ \Carbon\Carbon::parse($appointment->appointment_time_end)->format('H:i') }}"
                                                       data-status="{{ $appointment->status }}">
                                                        <i class="fa-solid fa-edit me-2"></i>Edit Appointment
                                                    </a>
                                                </li>
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

<!-- Edit Appointment Modal -->
<div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAppointmentModalLabel">Edit Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAppointmentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editAppointmentId" name="id">

                    <!-- Customer -->
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <input type="text" class="form-control" id="editCustomerName" readonly style="background-color: #f8f9fa;">
                    </div>

                    <!-- Pet Selection -->
                    <div class="mb-3">
                        <label for="editPetId" class="form-label">Pet Name <span class="text-danger">*</span></label>
                        <select class="form-control" id="editPetId" name="pet_id" required>
                            <option value="">Select pet</option>
                            @if(isset($pets))
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" data-owner-id="{{ $pet->owner_id }}">
                                        {{ $pet->name }} ({{ $pet->owner->firstname }} {{ $pet->owner->lastname }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Service Selection -->
                    <div class="mb-3">
                        <label for="editServiceId" class="form-label">Service <span class="text-danger">*</span></label>
                        <select class="form-control" id="editServiceId" name="service_item_id" required>
                            <option value="">Select service</option>
                            @if(isset($services))
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-duration="{{ $service->duration ?? 30 }}">
                                        {{ $service->servicename }} ({{ $service->duration ?? 30 }} min)
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="mb-3">
                        <label for="editDate" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="editDate" name="appointment_date" required>
                    </div>

                    <!-- Start Time -->
                    <div class="mb-3">
                        <label for="editStartTime" class="form-label">Start Time <span class="text-danger">*</span></label>
                        <select class="form-control" id="editStartTime" name="appointment_time_start" required>
                            <option value="">Select start time</option>
                            @php
                                $startHour = 9;
                                $endHour = 18;
                                for ($hour = $startHour; $hour < $endHour; $hour++) {
                                    foreach (['00', '30'] as $minute) {
                                        $time24 = sprintf("%02d:%s", $hour, $minute);
                                        $time12 = date("g:i A", strtotime($time24));
                                        echo "<option value=\"{$time24}\">{$time12}</option>";
                                    }
                                }
                                $finalTime24 = sprintf("%02d:00", $endHour);
                                $finalTime12 = date("g:i A", strtotime($finalTime24));
                                echo "<option value=\"{$finalTime24}\">{$finalTime12}</option>";
                            @endphp
                        </select>
                    </div>

                    <!-- End Time -->
                    <div class="mb-3">
                        <label class="form-label">End Time (Auto-calculated)</label>
                        <input type="text" class="form-control" id="editEndTimeDisplay" readonly style="background-color: #f8f9fa;">
                        <small class="text-muted">End time will be calculated based on selected service duration</small>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="1">Confirmed</option>
                            <option value="2">Cancelled</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-salon-code" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-owner-continue">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
@endpush