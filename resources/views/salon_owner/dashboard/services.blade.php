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
   <!-- Base CSS Files -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
   <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
   <!-- Page Specific CSS -->
   <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
   <link href="{{ asset('css/navigation-salon-owner.css') }}" rel="stylesheet">
   
   
   @endpush
   
   @section('content')
   <div class="container">
       <!-- Current Services Card Container -->
       <div class="card">
           <div class="card-body">
               <!-- Header Section -->
               <div class="d-flex justify-content-between align-items-center mb-4">
                   <div>
                       <h4 class="mb-1">Current Services</h4>
                       <p class="text-muted mb-0">Manage your existing services</p>
                   </div>
                   <button class="btn btn-owner-continue">
                       <i class="fa-solid fa-plus me-2"></i>Add Service
                   </button>
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
                                   <button class="btn btn-salon-code px-3" data-service="full-grooming">
                                       <i class="fa-solid fa-edit me-1"></i>Edit
                                   </button>
                                   <button class="btn btn-salon-code px-3 delete-btn">
                                       <i class="fa-solid fa-trash me-1"></i>Delete
                                   </button>
                               </div>
                           </div>
                           
                           <div class="d-flex align-items-center text-muted mb-3" style="font-size: 0.9rem;">
                               <i class="fa-regular fa-clock me-2"></i>
                               <span class="me-4">90-120 minutes</span>
                               <i class="fa-solid fa-dollar-sign me-2"></i>
                               <span class="me-4">65.00</span>
                               <i class="fa-solid fa-scissors me-2"></i>
                               <span>10 features</span>
                           </div>
                           
                           <p class="text-muted mb-3" style="font-size: 0.95rem;">Complete grooming service including bath, haircut, nail trim, and ear cleaning for a full spa experience.</p>
                           
                           <div class="mb-0">
                               <h6 class="text-dark mb-2 fw-bold" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">INCLUDED FEATURES:</h6>
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
                                   <button class="btn btn-salon-code px-3" data-service="basic-bath">
                                       <i class="fa-solid fa-edit me-1"></i>Edit
                                   </button>
                                   <button class="btn btn-salon-code px-3 delete-btn">
                                       <i class="fa-solid fa-trash me-1"></i>Delete
                                   </button>
                               </div>
                           </div>
                           
                           <div class="d-flex align-items-center text-muted mb-3" style="font-size: 0.9rem;">
                               <i class="fa-regular fa-clock me-2"></i>
                               <span class="me-4">45 minutes</span>
                               <i class="fa-solid fa-dollar-sign me-2"></i>
                               <span class="me-4">35.00</span>
                               <i class="fa-solid fa-scissors me-2"></i>
                               <span>3 features</span>
                           </div>
                           
                           <p class="text-muted mb-3" style="font-size: 0.95rem;">Essential bath and brushing service to keep your pet clean and fresh.</p>
                           
                           <div class="mb-0">
                               <h6 class="text-dark mb-2 fw-bold" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">INCLUDED FEATURES:</h6>
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
                                   <button class="btn btn-salon-code px-3" data-service="nail-trim">
                                       <i class="fa-solid fa-edit me-1"></i>Edit
                                   </button>
                                   <button class="btn btn-salon-code px-3 delete-btn">
                                       <i class="fa-solid fa-trash me-1"></i>Delete
                                   </button>
                               </div>
                           </div>
                           
                           <div class="d-flex align-items-center text-muted mb-3" style="font-size: 0.9rem;">
                               <i class="fa-regular fa-clock me-2"></i>
                               <span class="me-4">15 minutes</span>
                               <i class="fa-solid fa-dollar-sign me-2"></i>
                               <span class="me-4">15.00</span>
                               <i class="fa-solid fa-scissors me-2"></i>
                               <span>2 features</span>
                           </div>
                           
                           <p class="text-muted mb-3" style="font-size: 0.95rem;">Quick and safe nail trimming service for your pet's comfort and health.</p>
                           
                           <div class="mb-0">
                               <h6 class="text-dark mb-2 fw-bold" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">INCLUDED FEATURES:</h6>
                               <div class="d-flex flex-wrap gap-2">
                                   <span class="badge feature-badge">Nail Trim</span>
                                   <span class="badge feature-badge">Paw Claw Trim</span>
                               </div>
                           </div>
                       </div>
                   </div>
   
                   <!-- Empty State (hidden by default) -->
                   <div id="emptyState" class="text-center" style="display: none;">
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
                           <div class="col-md-8 mb-3">
                               <label for="serviceName" class="form-label">Service Name</label>
                               <input type="text" class="form-control" id="serviceName" placeholder="Enter service name" required>
                           </div>
                           <div class="col-md-4 mb-3">
                               <label for="servicePrice" class="form-label">Price ($)</label>
                               <input type="number" class="form-control" id="servicePrice" placeholder="0.00" step="0.01" required>
                           </div>
                       </div>
                       
                       <div class="row">
                           <div class="col-md-6 mb-3">
                               <label for="serviceDuration" class="form-label">Duration (minutes)</label>
                               <input type="number" class="form-control" id="serviceDuration" placeholder="60" required>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="serviceType" class="form-label">Service Type</label>
                               <select class="form-control" id="serviceType" required>
                                   <option value="">Select type</option>
                                   <option value="Complete Service">Complete Service</option>
                                   <option value="Basic Grooming">Basic Grooming</option>
                                   <option value="Add-on Service">Add-on Service</option>
                               </select>
                           </div>
                       </div>
                       
                       <div class="mb-3">
                           <label for="serviceDescription" class="form-label">Description</label>
                           <textarea class="form-control" id="serviceDescription" rows="3" placeholder="Describe your service..."></textarea>
                       </div>
                       
                       <div class="mb-3">
                           <label class="form-label">Service Features</label>
                           <div class="row">
                               <div class="col-md-4 mb-2">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="bathShampoo">
                                       <label class="form-check-label" for="bathShampoo">Bath & Shampoo</label>
                                   </div>
                               </div>
                               <div class="col-md-4 mb-2">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="fullTrim">
                                       <label class="form-check-label" for="fullTrim">Full Trim</label>
                                   </div>
                               </div>
                               <div class="col-md-4 mb-2">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="earCleaning">
                                       <label class="form-check-label" for="earCleaning">Ear Cleaning</label>
                                   </div>
                               </div>
                               <div class="col-md-4 mb-2">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="nailTrim">
                                       <label class="form-check-label" for="nailTrim">Nail Trim</label>
                                   </div>
                               </div>
                               <div class="col-md-4 mb-2">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="brushing">
                                       <label class="form-check-label" for="brushing">Brushing & De-matting</label>
                                   </div>
                               </div>
                               <div class="col-md-4 mb-2">
                                   <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="styling">
                                       <label class="form-check-label" for="styling">Professional Styling</label>
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
                   <button type="button" class="btn btn-owner-continue" id="saveServiceBtn">
                       <i class="fa-solid fa-save me-2"></i>Save Service
                   </button>
               </div>
           </div>
       </div>
   </div>
   @endsection
   
   @push('scripts')
   <script>
   document.addEventListener('DOMContentLoaded', function() {
       // Add Service Button
       const addServiceBtn = document.querySelector('.btn-owner-continue');
       addServiceBtn.addEventListener('click', function() {
           const modal = new bootstrap.Modal(document.getElementById('addServiceModal'));
           modal.show();
       });
   
       // Save Service Button
       document.getElementById('saveServiceBtn').addEventListener('click', function() {
           const form = document.getElementById('addServiceForm');
           if (form.checkValidity()) {
               // Here you would typically send data to server
               alert('Service added successfully!');
               
               // Close modal
               const modal = bootstrap.Modal.getInstance(document.getElementById('addServiceModal'));
               modal.hide();
               
               // Reset form
               form.reset();
           } else {
               form.reportValidity();
           }
       });
   
       // Edit Service Buttons
       document.querySelectorAll('.btn-salon-code[data-service]').forEach(btn => {
           btn.addEventListener('click', function() {
               const serviceId = this.getAttribute('data-service');
               alert(`Edit service: ${serviceId}`);
               // Here you would open edit modal or navigate to edit page
           });
       });
   
       // Delete Service Actions
       document.querySelectorAll('.btn-salon-code.delete-btn').forEach(btn => {
           btn.addEventListener('click', function(e) {
               e.preventDefault();
               
               const serviceCard = this.closest('.card');
               const serviceName = serviceCard.querySelector('h5').textContent;
               
               if (confirm(`Are you sure you want to delete "${serviceName}"?`)) {
                   // Here you would typically send delete request to server
                   serviceCard.closest('.card.service-card').remove();
                   console.log(`Deleted service: ${serviceName}`);
               }
           });
       });
   
       console.log('Services page loaded successfully');
   });
   </script>
   @endpush