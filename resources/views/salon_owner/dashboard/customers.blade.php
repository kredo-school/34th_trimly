{{-- =====================================================
   * To do
   *Need to modify icon place and UI 
   * Horizen

   ===================================================== --}}


{{-- Question>> How many options appear when clicking the vertical ellipsis?--}}

@extends('layouts.navigation')

@section('title', 'Customers')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Base CSS Files -->
   <!-- Base CSS Files -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
   <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
    <!-- Page Specific CSS -->
    <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <!-- Search Section -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="owner-search-section">
                <!-- Search Input -->
                <div class="position-relative flex-grow-1" style="max-width: 400px;">
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
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1">Sarah Johnson</h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Member since January 2023</p>
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
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-envelope text-muted me-2" style="width: 16px;"></i>
                            <span style="font-size: 0.9rem;">sarah@example.com</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-phone text-muted me-2" style="width: 16px;"></i>
                            <span style="font-size: 0.9rem;">(555) 123-4567</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-location-dot text-muted me-2" style="width: 16px;"></i>
                            <span style="font-size: 0.9rem;">123 Oak Street, Downtown</span>
                        </div>
                    </div>
            
                    <!-- Pet Information -->
                    <div class="pet-section mb-3">
                        <h6 class="mb-2">Pets</h6>
                       
                        <div>
                            <span class="fw-bold">Buddy</span><br>
                            <span class="text-muted" style="font-size: 0.9rem;">Golden Retriever • 3 years • Large</span>
                            <div class="text-muted" style="font-size: 0.85rem; ">Very friendly, loves treats</div>
                        </div>
                    </div>

                    <!-- Customer Stats -->
                    <div class="bg-light p-3 rounded">
                        <div class="d-flex justify-content-around text-center">
                            <div class="flex-fill">
                                <div class="fw-bold" style="font-size: 0.9rem;">1</div>
                                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; line-height: 1.2;">Total Visits</div>
                            </div>
                            <div class="flex-fill">
                                <div class="fw-bold" style="font-size: 0.9rem;">$85</div>
                                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; line-height: 1.2;">Total Spent</div>
                            </div>
                            <div class="flex-fill">
                                <div class="fw-bold" style="font-size: 0.9rem;">Today</div>
                                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; line-height: 1.2;">Last Visit</div>
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
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1">Mike Thompson</h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Member since March 2024</p>
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
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-envelope text-muted me-2" style="width: 16px;"></i>
                            <span style="font-size: 0.9rem;">mike@example.com</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-phone text-muted me-2" style="width: 16px;"></i>
                            <span style="font-size: 0.9rem;">(555) 987-6543</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-location-dot text-muted me-2" style="width: 16px;"></i>
                            <span style="font-size: 0.9rem;">456 Pine Avenue, Uptown</span>
                        </div>
                    </div>

                    <!-- Pet Information -->
                    <div class="pet-section mb-3">
                        <h6 class="mb-2">Pets</h6>
                        <div>
                            <span class="fw-bold">Luna</span><br>
                            <span class="text-muted" style="font-size: 0.9rem;">Toy Poodle • 5 years • Small</span>
                            <div class="text-muted" style="font-size: 0.85rem; ">Sensitive around paws, prefers gentle handling</div>
                        </div>
                    </div>

                    <!-- Customer Stats -->
                    <div class="bg-light p-3 rounded">
                        <div class="d-flex justify-content-around text-center">
                            <div class="flex-fill">
                                <div class="fw-bold" style="font-size: 0.9rem;">8</div>
                                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; line-height: 1.2;">Total Visits</div>
                            </div>
                            <div class="flex-fill">
                                <div class="fw-bold" style="font-size: 0.9rem;">$520</div>
                                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; line-height: 1.2;">Total Spent</div>
                            </div>
                            <div class="flex-fill">
                                <div class="fw-bold" style="font-size: 0.9rem;">2 weeks ago</div>
                                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; line-height: 1.2;">Last Visit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (hidden by default) -->
        <div id="emptyState" class="col-12 text-center" style="display: none;">
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const searchInput = document.getElementById('searchInput');
    const customerCards = document.querySelectorAll('.card');
    const emptyState = document.getElementById('emptyState');

    // Search functionality
    searchInput.addEventListener('input', function() {
        filterCustomers();
    });

    // Filter function
    function filterCustomers() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        customerCards.forEach(card => {
            // Skip the search card and empty state
            if (card.closest('#emptyState') || card.closest('.owner-search-section')) {
                return;
            }

            const customerName = card.querySelector('h5').textContent.toLowerCase();
            const customerEmail = card.querySelector('span').textContent.toLowerCase();
            const petName = card.querySelector('.pet-section .fw-bold').textContent.toLowerCase();

            const matchesSearch = customerName.includes(searchTerm) || 
                                customerEmail.includes(searchTerm) || 
                                petName.includes(searchTerm);

            const cardContainer = card.closest('.col-md-6');
            if (matchesSearch) {
                cardContainer.style.display = 'block';
                visibleCount++;
            } else {
                cardContainer.style.display = 'none';
            }
        });

        // Show/hide empty state
        if (visibleCount === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }

    // Dropdown item handlers
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const customerCard = this.closest('.card');
            const customerName = customerCard.querySelector('h5').textContent;
            const action = this.textContent.trim();
            
            switch(true) {
                case action.includes('Delete'):
                    if (confirm(`Are you sure you want to delete customer ${customerName}?`)) {
                        console.log('Deleting customer:', customerName);
                    }
                    break;
            }
        });
    });

    console.log('Customers page loaded successfully');
});
</script>
@endpush