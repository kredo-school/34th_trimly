@extends('layouts.navigation')

@section('title', 'Appointments')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Base CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
    <!-- Page Specific CSS -->
    <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="owner-search-section">
                <!-- Search Input -->
                <div class="position-relative flex-grow-1" style="max-width: 400px;">
                    <i class="fa-solid fa-magnifying-glass owner-search-icon"></i>
                    <input type="text" class="owner-search-input" placeholder="Search appointments..." id="searchInput" />
                </div>
                
                <!-- Filter Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-secondary owner-status-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter me-2"></i>All Status <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-status="">All Status</a></li>
                        <li><a class="dropdown-item" href="#" data-status="confirmed">Confirmed</a></li>
                        <li><a class="dropdown-item" href="#" data-status="completed">Completed</a></li>
                        <li><a class="dropdown-item" href="#" data-status="cancelled">Cancelled</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointments Card -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Today's Appointments</h4>
            
            <div id="appointmentsList">
                <!-- Appointment Item 1 - CONFIRMED -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="owner-appointment-item" data-status="confirmed">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Customer Avatar - Confirmed Status -->
                                    <div class="owner-customer-avatar owner-avatar-confirmed">
                                        <i class="fa-solid fa-scissors"></i>
                                    </div>
                                    
                                    <!-- Customer Details -->
                                    <div class="owner-customer-details">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h5 class="owner-customer-name mb-0 me-auto">Sarah Johnson</h5>
                                            <span class="badge owner-badge-confirmed ms-4">Confirmed</span>
                                        </div>
                                        <div class="owner-service-info text-muted">Full Grooming - Buddy</div>
                                        <div class="owner-appointment-time text-muted">9:00 AM - 12:00 (3h 00m)</div>
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
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can me-2"></i>Cancel Appointment</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Item 2 - CONFIRMED -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="owner-appointment-item" data-status="confirmed">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Customer Avatar - Confirmed Status -->
                                    <div class="owner-customer-avatar owner-avatar-confirmed">
                                        <i class="fa-solid fa-scissors"></i>
                                    </div>
                                    
                                    <!-- Customer Details -->
                                    <div class="owner-customer-details">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h5 class="owner-customer-name mb-0 me-auto">Mike Davis</h5>
                                            <span class="badge owner-badge-confirmed ms-4">Confirmed</span>
                                        </div>
                                        <div class="owner-service-info text-muted">Nail Trim - Luna</div>
                                        <div class="owner-appointment-time text-muted">10:30 AM - 11:30 (1h 00m)</div>
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
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can me-2"></i>Cancel Appointment</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Item 3 - COMPLETED -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="owner-appointment-item" data-status="completed">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Customer Avatar - Completed Status -->
                                    <div class="owner-customer-avatar owner-avatar-completed">
                                        <i class="fa-solid fa-scissors"></i>
                                    </div>
                                    
                                    <!-- Customer Details -->
                                    <div class="owner-customer-details">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h5 class="owner-customer-name mb-0 me-auto">Emily Chen</h5>
                                            <span class="badge owner-badge-completed ms-4">Completed</span>
                                        </div>
                                        <div class="owner-service-info text-muted">Bath & Brush - Max</div>
                                        <div class="owner-appointment-time text-muted">1:00 PM - 2:30 (1h 30m)</div>
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
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can me-2"></i>Cancel Appointment</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Item 4 - CANCELLED -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="owner-appointment-item" data-status="cancelled">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Customer Avatar - Cancelled Status -->
                                    <div class="owner-customer-avatar owner-avatar-cancelled">
                                        <i class="fa-solid fa-scissors"></i>
                                    </div>
                                    
                                    <!-- Customer Details -->
                                    <div class="owner-customer-details">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h5 class="owner-customer-name mb-0 me-auto">Tom Wilson</h5>
                                            <span class="badge owner-badge-cancelled ms-4">Cancelled</span>
                                        </div>
                                        <div class="owner-service-info text-muted">Haircut - Bella</div>
                                        <div class="owner-appointment-time text-muted">3:30 PM - 4:30 (1h 00m)</div>
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
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can me-2"></i>Cancel Appointment</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State (hidden by default) -->
                <div id="emptyState" class="owner-empty-state text-center" style="display: none;">
                    <i class="fa-regular fa-calendar-xmark text-muted"></i>
                    <h5 class="text-muted">No appointments found</h5>
                    <p class="text-muted">Try adjusting your search or filter criteria.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Salon Code Modal -->
<div class="modal fade" id="salonCodeModal" tabindex="-1" aria-labelledby="salonCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: none; padding: 2rem 2rem 1rem 2rem;">
                <h5 class="modal-title" id="salonCodeModalLabel" style="color: #666; font-weight: 600;">Your Salon Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 1.5rem; color: #999;">&times;</button>
            </div>
            <div class="modal-body text-center" style="padding: 1rem 2rem 2rem 2rem;">
                <div class="salon-code-display" style="background: linear-gradient(135deg, #d5c4b8 0%, #ab8b73 100%); color: white; padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: bold; letter-spacing: 2px;" id="salonCodeDisplay">
                    TRIMLY2024
                </div>
                <button class="btn" id="copyCodeBtn" style="background-color: #ab8b73; color: white; border: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 500; transition: all 0.2s ease; margin-bottom: 1rem; width: 100%;">
                    <i class="fa-solid fa-copy me-2"></i>Copy Code
                </button>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Share this code with your customers to allow them to book appointments.</p>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('js/owner/dashboard.js') }}" defer></script>

@push('scripts')

@endpush