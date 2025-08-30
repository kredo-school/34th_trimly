{{-- =====================================================
   * Services Page - Salon Owner Dashboard
   * Manage existing services with edit/delete functionality
   ===================================================== --}}

   @extends('layouts.navigation')

   @section('title', 'Services')
   
   @push('styles')
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
       integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
       crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link rel="stylesheet" href="{{ asset('css/app.css') }}">
       <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
       <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
@endpush
   
@section('content')
<div class="container">
    <!-- Add Service Button - positioned at the very top, right aligned -->
    <div class="owner-add-service-container">
        <button class="btn btn-owner-continue" id="addServiceBtn">
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
                   <!-- Service Card 1 - Full Grooming Package -->
                   <div class="card service-card mb-3">
                       <div class="card-body p-4">
                           <div class="d-flex justify-content-between align-items-start mb-3">
                               <div>
                                   <h5 class="mb-1 fw-bold">Full Grooming Package</h5>
                                   <span class="badge bg-secondary text-white px-2 py-1 small">Complete Service</span>
                               </div>
                               <div class="d-flex gap-2">
                                   <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back" data-service="full-grooming">
                                       <i class="fa-solid fa-edit me-1"></i>Edit
                                   </button>
                                   <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back px-3 delete-btn">
                                       <i class="fa-solid fa-trash me-1"></i>Delete
                                   </button>
                               </div>
                           </div>
                           
                           <div class="d-flex align-items-center text-muted mb-3 owner-service-info">
                               <i class="fa-regular fa-clock me-2"></i>
                               <span class="me-4">90-120 minutes</span>
                               <i class="fa-solid fa-dollar-sign me-2"></i>
                               <span class="me-4">65.00</span>
                               <i class="fa-solid fa-scissors me-2"></i>
                               <span>10 features</span>
                           </div>
                           
                           <p class="text-muted mb-3 owner-service-description">Complete grooming service including bath, haircut, nail trim, and ear cleaning for a full spa experience.</p>
                           
                           <div class="mb-0">
                               <h6 class="text-dark mb-2 fw-bold owner-features-header">INCLUDED FEATURES:</h6>
                               <div class="d-flex flex-wrap gap-2">
                                   <span class="badge feature-badge">Bath & Shampoo</span>
                                   <span class="badge feature-badge">Nail Trim</span>
                                   <span class="badge feature-badge">Ear Cleaning</span>
                                   <span class="badge feature-badge">Hair Cut & Styling</span>
                                   <span class="badge feature-badge">Brushing & De-matting</span>
                                   <span class="badge feature-badge">Professional Drying</span>
                                   <span class="badge feature-badge">Perfuming & Deodorizing</span>
                                   <span class="badge feature-badge">Paw Pad Trim</span>
                                   <span class="badge feature-badge">Sanitary Trim</span>
                                   <span class="badge feature-badge">Coat Conditioning</span>
                               </div>
                           </div>
                       </div>
                   </div>
   
                   <!-- Service Card 2 - Basic Bath & Brush -->
                   <div class="card service-card mb-3">
                       <div class="card-body p-4">
                           <div class="d-flex justify-content-between align-items-start mb-3">
                               <div>
                                   <h5 class="mb-1 fw-bold">Basic Bath & Brush</h5>
                                   <span class="badge bg-secondary text-white px-2 py-1 small">Basic Grooming</span>
                               </div>
                               <div class="d-flex gap-2">
                                   <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back" data-service="basic-bath">
                                       <i class="fa-solid fa-edit me-1"></i>Edit
                                   </button>
                                   <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back delete-btn">
                                       <i class="fa-solid fa-trash me-1"></i>Delete
                                   </button>
                               </div>
                           </div>
                           
                           <div class="d-flex align-items-center text-muted mb-3 owner-service-info">
                               <i class="fa-regular fa-clock me-2"></i>
                               <span class="me-4">45 minutes</span>
                               <i class="fa-solid fa-dollar-sign me-2"></i>
                               <span class="me-4">35.00</span>
                               <i class="fa-solid fa-scissors me-2"></i>
                               <span>3 features</span>
                           </div>
                           
                           <p class="text-muted mb-3 owner-service-description">Essential bath and brushing service to keep your pet clean and fresh.</p>
                           
                           <div class="mb-0">
                               <h6 class="text-dark mb-2 fw-bold owner-features-header">INCLUDED FEATURES:</h6>
                               <div class="d-flex flex-wrap gap-2">
                                   <span class="badge feature-badge">Bath & Shampoo</span>
                                   <span class="badge feature-badge">Brushing & De-matting</span>
                                   <span class="badge feature-badge">Professional Drying</span>
                               </div>
                           </div>
                       </div>
                   </div>
   
                   <!-- Service Card 3 - Nail Trim Only -->
                   <div class="card service-card mb-3">
                       <div class="card-body p-4">
                           <div class="d-flex justify-content-between align-items-start mb-3">
                               <div>
                                   <h5 class="mb-1 fw-bold">Nail Trim Only</h5>
                                   <span class="badge bg-secondary text-white px-2 py-1 small">Add-on Service</span>
                               </div>
                               <div class="d-flex gap-2">
                                   <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back" data-service="nail-trim">
                                       <i class="fa-solid fa-edit me-1"></i>Edit
                                   </button>
                                   <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back delete-btn">
                                       <i class="fa-solid fa-trash me-1"></i>Delete
                                   </button>
                               </div>
                           </div>
                           
                           <div class="d-flex align-items-center text-muted mb-3 owner-service-info">
                               <i class="fa-regular fa-clock me-2"></i>
                               <span class="me-4">15 minutes</span>
                               <i class="fa-solid fa-dollar-sign me-2"></i>
                               <span class="me-4">15.00</span>
                               <i class="fa-solid fa-scissors me-2"></i>
                               <span>2 features</span>
                           </div>
                           
                           <p class="text-muted mb-3 owner-service-description">Quick and safe nail trimming service for your pet's comfort and health.</p>
                           
                           <div class="mb-0">
                               <h6 class="text-dark mb-2 fw-bold owner-features-header">INCLUDED FEATURES:</h6>
                               <div class="d-flex flex-wrap gap-2">
                                   <span class="badge feature-badge">Nail Trim</span>
                                   <span class="badge feature-badge">Paw Claw Trim</span>
                               </div>
                           </div>
                       </div>
                   </div>
   
                   <!-- Empty State (hidden by default) -->
                   <div id="emptyState" class="text-center owner-empty-state-hidden">
                       <div class="owner-empty-state">
                           <i class="fa-solid fa-scissors text-muted"></i>
                           <h5 class="text-muted">No services found</h5>
                           <p class="text-muted">Add your first service to get started.</p>
                       </div>
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
            <div class="modal-body">
                <form id="addServiceForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="serviceName" class="form-label">Service Name *</label>
                            <input type="text" class="form-control" id="serviceName" placeholder="e.g. Full Grooming Package" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="serviceCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="serviceCategory" placeholder="e.g. Complete Service">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="serviceDuration" class="form-label">Duration (minutes) *</label>
                            <input type="number" class="form-control" id="serviceDuration" placeholder="60" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="servicePrice" class="form-label">Price ($) *</label>
                            <input type="number" class="form-control" id="servicePrice" placeholder="0" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="serviceDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="serviceDescription" rows="3" placeholder="Describe your service..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Service Features</label>
                        <div class="row mt-2 operating-days">
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="bathShampoo">
                                    <label class="form-check-label" for="bathShampoo">Bath & Shampoo</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="nailTrim">
                                    <label class="form-check-label" for="nailTrim">Nail Trim</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="desheddingTreatment">
                                    <label class="form-check-label" for="desheddingTreatment">De-shedding Treatment</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="nailPolish">
                                    <label class="form-check-label" for="nailPolish">Nail Polish</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="professionalCut" checked>
                                    <label class="form-check-label" for="professionalCut">Professional Cut</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="earCleaning" checked>
                                    <label class="form-check-label" for="earCleaning">Ear Cleaning</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="fleaTickTreatment">
                                    <label class="form-check-label" for="fleaTickTreatment">Flea & Tick Treatment</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="bowBandana">
                                    <label class="form-check-label" for="bowBandana">Bow/Bandana</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="blowDry">
                                    <label class="form-check-label" for="blowDry">Blow Dry</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="teethCleaning">
                                    <label class="form-check-label" for="teethCleaning">Teeth Cleaning</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="aromatherapy">
                                    <label class="form-check-label" for="aromatherapy">Aromatherapy</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gentleHandling">
                                    <label class="form-check-label" for="gentleHandling">Gentle Handling</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-owner-back" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-owner-continue" id="saveServiceBtn">
                    <i class="fa-solid fa-save me-2"></i>Save Service
                </button>
            </div>
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
                <form id="editServiceForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editServiceName" class="form-label">Service Name *</label>
                            <input type="text" class="form-control" id="editServiceName" value="Full Grooming Package" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editServiceCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="editServiceCategory" value="Complete Service">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editServiceDuration" class="form-label">Duration (minutes) *</label>
                            <input type="number" class="form-control" id="editServiceDuration" value="90" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editServicePrice" class="form-label">Price ($) *</label>
                            <input type="number" class="form-control" id="editServicePrice" value="85.00" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editServiceDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editServiceDescription" rows="3">Complete grooming service including bath, haircut, nail trim, and ear cleaning for a full spa experience.</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Service Features</label>
                        <div class="row mt-2 operating-days">
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editBathShampoo" checked>
                                    <label class="form-check-label" for="editBathShampoo">Bath & Shampoo</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editNailTrim" checked>
                                    <label class="form-check-label" for="editNailTrim">Nail Trim</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editDesheddingTreatment" checked>
                                    <label class="form-check-label" for="editDesheddingTreatment">De-shedding Treatment</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editNailPolish" checked>
                                    <label class="form-check-label" for="editNailPolish">Nail Polish</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editProfessionalCut" checked>
                                    <label class="form-check-label" for="editProfessionalCut">Professional Cut</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editEarCleaning" checked>
                                    <label class="form-check-label" for="editEarCleaning">Ear Cleaning</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editFleaTickTreatment" checked>
                                    <label class="form-check-label" for="editFleaTickTreatment">Flea & Tick Treatment</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editBowBandana">
                                    <label class="form-check-label" for="editBowBandana">Bow/Bandana</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editBlowDry" checked>
                                    <label class="form-check-label" for="editBlowDry">Blow Dry</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editTeethCleaning">
                                    <label class="form-check-label" for="editTeethCleaning">Teeth Cleaning</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editAromatherapy" checked>
                                    <label class="form-check-label" for="editAromatherapy">Aromatherapy</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="editGentleHandling" checked>
                                    <label class="form-check-label" for="editGentleHandling">Gentle Handling</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-salon-code" data-bs-dismiss="modal">
                    <i class="fa-solid fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-owner-continue" id="saveEditServiceBtn">
                    <i class="fa-solid fa-save me-2"></i>Save Service
                </button>
            </div>
        </div>
    </div>
</div>

   @endsection
   
   @push('scripts')
   <script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
   <script src="{{ asset('js/owner/service-api.js') }}" defer></script>

   @endpush