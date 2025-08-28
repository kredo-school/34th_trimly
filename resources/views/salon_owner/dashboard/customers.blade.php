@extends('layouts.navigation')

@section('title', 'Customers')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Base CSS Files -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
   <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <!-- Search Section -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="owner-search-section">
                <!-- Search Input -->
                <div class="position-relative flex-grow-1 owner-customers-search-max-width">
                    <i class="fa-solid fa-magnifying-glass owner-search-icon"></i>
                    <input type="text" class="owner-search-input" placeholder="Search customers..." id="searchInput" />
                </div>
            </div>
        </div>
    </div>

    <!-- Customers Grid -->
    <div class="row" id="customersGrid">
        <!-- Customer Card 1 - Sarah Johnson -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Customer Header -->
                    <div class="d-flex justify-content-between align-items-start mb-3 owner-customer-header">
                        <div>
                            <h5 class="mb-1">Sarah Johnson</h5>
                            <p class="text-muted owner-customer-member-since">Member since January 2023</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-ghost btn-sm owner-action-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can me-2"></i>Delete Customer</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Customer Contact Info -->
                    <div class="owner-customer-contact-info">
                        <div class="owner-customer-contact-item">
                            <i class="fa-solid fa-envelope text-muted"></i>
                            <span>sarah@example.com</span>
                        </div>
                        <div class="owner-customer-contact-item">
                            <i class="fa-solid fa-phone text-muted"></i>
                            <span>(555) 123-4567</span>
                        </div>
                        <div class="owner-customer-contact-item">
                            <i class="fa-solid fa-location-dot text-muted"></i>
                            <span>123 Oak Street, Downtown</span>
                        </div>
                    </div>
            
                    <!-- Pet Information -->
                    <div class="owner-pet-section">
                        <h6 class="mb-2">Pets</h6>
                       
                        <div>
                            <span class="owner-pet-name">Buddy</span><br>
                            <span class="text-muted owner-pet-details">Golden Retriever • 3 years • Large</span>
                            <div class="text-muted owner-pet-notes">Very friendly, loves treats</div>
                        </div>
                    </div>

                    <!-- Customer Stats -->
                    <div class="owner-customer-stats">
                        <div class="owner-stats-grid">
                            <div class="owner-stat-item">
                                <div class="owner-stat-value">1</div>
                                <div class="text-muted owner-stat-label">Total Visits</div>
                            </div>
                            <div class="owner-stat-item">
                                <div class="owner-stat-value">$85</div>
                                <div class="text-muted owner-stat-label">Total Spent</div>
                            </div>
                            <div class="owner-stat-item">
                                <div class="owner-stat-value">Today</div>
                                <div class="text-muted owner-stat-label">Last Visit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Card 2 - Mike Thompson -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Customer Header -->
                    <div class="d-flex justify-content-between align-items-start mb-3 owner-customer-header">
                        <div>
                            <h5 class="mb-1">Mike Thompson</h5>
                            <p class="text-muted owner-customer-member-since">Member since March 2024</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-ghost btn-sm owner-action-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can me-2"></i>Delete Customer</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Customer Contact Info -->
                    <div class="owner-customer-contact-info">
                        <div class="owner-customer-contact-item">
                            <i class="fa-solid fa-envelope text-muted"></i>
                            <span>mike@example.com</span>
                        </div>
                        <div class="owner-customer-contact-item">
                            <i class="fa-solid fa-phone text-muted"></i>
                            <span>(555) 987-6543</span>
                        </div>
                        <div class="owner-customer-contact-item">
                            <i class="fa-solid fa-location-dot text-muted"></i>
                            <span>456 Pine Avenue, Uptown</span>
                        </div>
                    </div>

                    <!-- Pet Information -->
                    <div class="owner-pet-section">
                        <h6 class="mb-2">Pets</h6>
                        <div>
                            <span class="owner-pet-name">Luna</span><br>
                            <span class="text-muted owner-pet-details">Toy Poodle • 5 years • Small</span>
                            <div class="text-muted owner-pet-notes">Sensitive around paws, prefers gentle handling</div>
                        </div>
                    </div>

                    <!-- Customer Stats -->
                    <div class="owner-customer-stats">
                        <div class="owner-stats-grid">
                            <div class="owner-stat-item">
                                <div class="owner-stat-value">8</div>
                                <div class="text-muted owner-stat-label">Total Visits</div>
                            </div>
                            <div class="owner-stat-item">
                                <div class="owner-stat-value">$520</div>
                                <div class="text-muted owner-stat-label">Total Spent</div>
                            </div>
                            <div class="owner-stat-item">
                                <div class="owner-stat-value">Yesterday</div>
                                <div class="text-muted owner-stat-label">Last Visit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (hidden by default) -->
        <div id="emptyState" class="col-12 text-center owner-empty-state-hidden">
            <div class="owner-empty-state">
                <i class="fa-regular fa-address-book text-muted"></i>
                <h5 class="text-muted">No customers found</h5>
                <p class="text-muted">Try adjusting your search criteria.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
@endpush