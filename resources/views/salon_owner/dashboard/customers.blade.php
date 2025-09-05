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
        <!-- Loading spinner -->
        <div class="col-12 text-center" id="loadingSpinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Empty State (hidden by default) -->
    <div id="emptyState" class="col-12 text-center owner-empty-state-hidden" style="display: none;">
        <div class="owner-empty-state">
            <i class="fa-regular fa-address-book text-muted"></i>
            <h5 class="text-muted">No customers found</h5>
            <p class="text-muted">Try adjusting your search criteria.</p>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this customer? This action cannot be undone.</p>
                <input type="hidden" id="deleteCustomerId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Remove Customer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
<script src="{{ asset('js/owner/customers.js') }}" defer></script>
@endpush