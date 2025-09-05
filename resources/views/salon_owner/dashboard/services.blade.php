<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Services - Trimly Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation-salon-owner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
</head>

<body class="body-layout">
    <!-- Header Section -->
    <header class="bg-white shadow-sm mb-2"> 
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <!-- Left side: Logo and Brand -->
                <a class="navbar-brand"> 
                    <div class="logo me-1">
                        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo" class="img-fluid logo-image">
                    </div>
                    <div class="brand-text">
                        <p class="main-title fw-bold text-muted mb-0 fs-5">Trimly Admin</p>
                        <p class="subtitle text-muted mb-0 subtitle-text">{{ session('salon_name', 'Salon') }}</p>
                    </div>
                </a>

                <!-- Center: Menu Dropdown -->
                <div class="menu-dropdown">
                    <button class="menu-btn" onclick="toggleMenu()" id="menuBtn">
                        Menu <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="menu-dropdown-content" id="menuDropdown">
                        <a href="/dashboard-salonowner/appointments" class="menu-dropdown-item">
                            <i class="fa-regular fa-calendar"></i> Appointments
                        </a>
                        <a href="/dashboard-salonowner/customers" class="menu-dropdown-item">
                            <i class="fa-regular fa-user"></i> Customers
                        </a>
                        <a href="/salon-owner/calendar" class="menu-dropdown-item">
                            <i class="fa-regular fa-calendar-days"></i> Calendar
                        </a>
                        <a href="/dashboard-salonowner/services" class="menu-dropdown-item active">
                            <i class="fa-solid fa-scissors"></i> Services
                        </a>
                        <a href="/dashboard-salonowner/settings" class="menu-dropdown-item">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </div>
                </div>

                <!-- Right side: Salon Code and Logout -->
                <div class="header-actions">
                    <!-- Salon Code Button with Modal Trigger -->
                    <a href="#" class="btn-salon-code d-none d-sm-flex btn-owner-back" data-bs-toggle="modal" data-bs-target="#salonCodeModal">
                        <i class="fa-solid fa-key me-2"></i>
                        <span>Salon Code</span>
                    </a>
                    
                    <!-- Logout Form -->
                    <form id="logoutForm" action="/salon-owner/logout" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-salon-code d-none d-sm-flex btn-owner-back" style="border: none;">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>
                            <span class="d-none d-sm-inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="container">
            <!-- Add Service Button -->
            <div class="owner-add-service-container">
                <button class="btn btn-owner-continue" id="addServiceBtn" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <i class="fa-solid fa-plus me-2"></i><span>Add Service</span>
                </button>
            </div>

            <!-- Current Services Card Container -->
            <div class="card">
                <div class="card-body">
                    <!-- Header Section inside card -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="mb-1">Current Services</h4>
                            <p class="text-muted mb-0">Manage your existing services</p>
                        </div>
                    </div>
                    
                    <!-- Services List -->
                    <div id="servicesGrid">
                        <!-- Loading spinner -->
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Empty State -->
                    <div id="emptyState" class="text-center owner-empty-state-hidden" style="display: none;">
                        <div class="owner-empty-state">
                            <i class="fa-solid fa-scissors text-muted"></i>
                            <h5 class="text-muted">No services found</h5>
                            <p class="text-muted">Add your first service to get started.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Service Modal -->
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addServiceForm" action="{{ route('salonowner.services.post') }}" method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="serviceName" class="form-label">Service Name *</label>
                                    <input type="text" class="form-control" id="serviceName" placeholder="e.g. Full Grooming Package" required>
                                    <div class="invalid-feedback">Please provide a service name.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="serviceCategory" class="form-label">Category *</label>
                                    <input type="text" class="form-control" id="serviceCategory" placeholder="e.g. Complete Service" required>
                                    <div class="invalid-feedback">Please provide a category.</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="serviceDuration" class="form-label">Duration (minutes) *</label>
                                    <input type="number" class="form-control" id="serviceDuration" placeholder="60" min="15" required>
                                    <div class="invalid-feedback">Minimum duration is 15 minutes.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="servicePrice" class="form-label">Price ($) *</label>
                                    <input type="number" class="form-control" id="servicePrice" placeholder="0" step="0.01" min="0" required>
                                    <div class="invalid-feedback">Please provide a valid price.</div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="serviceDescription" class="form-label">Description *</label>
                                <textarea class="form-control" id="serviceDescription" rows="3" placeholder="Describe your service..." required></textarea>
                                <div class="invalid-feedback">Please provide a service description.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Service Features</label>
                                <div class="row mt-2 operating-days">
                                    @if(isset($serviceFeatures) && count($serviceFeatures) > 0)
                                        @php
                                            $featuresPerColumn = ceil(count($serviceFeatures) / 3);
                                            $columns = array_chunk($serviceFeatures->toArray(), $featuresPerColumn);
                                        @endphp
                                        
                                        @foreach($columns as $columnFeatures)
                                            <div class="col-md-4">
                                                @foreach($columnFeatures as $feature)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" 
                                                               id="feature_{{ $feature->id }}"
                                                               name="features[]" 
                                                               value="{{ $feature->id }}">
                                                        <label class="form-check-label" for="feature_{{ $feature->id }}">
                                                            {{ $feature->display_name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-owner-back" data-bs-dismiss="modal">Cancel</button>
                        <button type="button submit" class="btn btn-owner-continue" id="saveServiceBtn">
                            <i class="fa-solid fa-save me-2"></i>Save Service
                        </button>
                    </div>
                   </form>
                </div>
            </div>
        </div>

        <!-- Edit Service Modal -->
        <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editServiceForm" class="needs-validation" novalidate>
                            <input type="hidden" id="editServiceId">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="editServiceName" class="form-label">Service Name *</label>
                                    <input type="text" class="form-control" id="editServiceName" required>
                                    <div class="invalid-feedback">Please provide a service name.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="editServiceCategory" class="form-label">Category *</label>
                                    <input type="text" class="form-control" id="editServiceCategory" required>
                                    <div class="invalid-feedback">Please provide a category.</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="editServiceDuration" class="form-label">Duration (minutes) *</label>
                                    <input type="number" class="form-control" id="editServiceDuration" min="15" required>
                                    <div class="invalid-feedback">Minimum duration is 15 minutes.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="editServicePrice" class="form-label">Price ($) *</label>
                                    <input type="number" class="form-control" id="editServicePrice" step="0.01" min="0" required>
                                    <div class="invalid-feedback">Please provide a valid price.</div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="editServiceDescription" class="form-label">Description *</label>
                                <textarea class="form-control" id="editServiceDescription" rows="3" required></textarea>
                                <div class="invalid-feedback">Please provide a service description.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Service Features</label>
                                <div class="row mt-2 operating-days">
                                    @if(isset($serviceFeatures) && count($serviceFeatures) > 0)
                                        @php
                                            $featuresPerColumn = ceil(count($serviceFeatures) / 3);
                                            $columns = array_chunk($serviceFeatures->toArray(), $featuresPerColumn);
                                        @endphp
                                        
                                        @foreach($columns as $columnFeatures)
                                            <div class="col-md-4">
                                                @foreach($columnFeatures as $feature)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" 
                                                               id="edit_feature_{{ $feature->id }}"
                                                               name="edit_features[]" 
                                                               value="{{ $feature->id }}">
                                                        <label class="form-check-label" for="edit_feature_{{ $feature->id }}">
                                                            {{ $feature->display_name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-salon-code" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times me-2"></i>Cancel
                        </button>
                        <button type="button" class="btn btn-owner-continue" id="saveEditServiceBtn">
                            <i class="fa-solid fa-save me-2"></i>Save Changes
                        </button>
                    </div>
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
                        <p>Are you sure you want to delete this service? This action cannot be undone.</p>
                        <input type="hidden" id="deleteServiceId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete Service</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salon Code Modal -->
        <div class="modal fade" id="salonCodeModal" tabindex="-1" aria-labelledby="salonCodeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salonCodeModalLabel">Your Salon Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="salon-code-display" id="salonCodeDisplay">
                            {{ session('salon_code', 'N/A') }}
                        </div>
                        <button class="btn btn-copy-code" id="copyCodeBtn" onclick="copySalonCode()">
                            <i class="fa-regular fa-copy me-2"></i>Copy Code
                        </button>
                        <p class="modal-description">Share this code with your customers to allow them to book appointments.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
    <script src="{{ asset('js/owner/service-api.js') }}" defer></script>
    
    <script>
        // Menu toggle function
        function toggleMenu() {
            const dropdown = document.getElementById('menuDropdown');
            dropdown.classList.toggle('show');
        }
        
        // Copy salon code function
        function copySalonCode() {
            const salonCode = document.getElementById('salonCodeDisplay').textContent.trim();
            navigator.clipboard.writeText(salonCode).then(function() {
                alert('Salon code copied to clipboard!');
            });
        }
        
        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.menu-btn')) {
                const dropdowns = document.getElementsByClassName("menu-dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>