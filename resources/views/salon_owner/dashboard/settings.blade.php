{{-- =====================================================
   * Salon Settings Page - Following register design pattern
   * Matching the attached image layout
   ===================================================== --}}

   @extends('layouts.navigation')

   @section('title', 'Salon Settings')
   
   @push('styles')
       <!-- Font Awesome -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
           integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
           crossorigin="anonymous" referrerpolicy="no-referrer" />
       <!-- Base CSS Files -->
       <link rel="stylesheet" href="{{ asset('css/app.css') }}">

       <link href="{{ asset('css/dashboard-salon-owner.css') }}" rel="stylesheet">
       <link href="{{ asset('css/register-salon-owner.css') }}" rel="stylesheet">
   @endpush
   
   @section('content')
   <div class="container-fluid my-4">
       <div class="row justify-content-center">
           <div class="col-12">
               <div class="register-container owner-register-container">
   
                   <!-- Settings Card -->
                   <div class="owner-card p-4 owner-mb-4">
                       <div class="owner-card-body">
                           <h4 class="card-title text-start mb-3 fw-bold">
                               Salon Registration Details
                           </h4>
                           <p class="card-text text-muted text-start mb-4">Update your salon information and business details</p>
   
                           <form action="#" method="post" id="settingsForm">
                               @csrf
                               
                               <!-- Basic Information Section -->
                               <div class="mb-4">
                                   <h4 class="mb-3 fw-bold owner-section-header">Basic Information</h4>
                                   <hr class="mb-4 owner-section-divider">
                                   
                                   <!-- Salon Name and Email Address -->
                                   <div class="row">
                                       <div class="col-md-6 mb-3">
                                           <label for="salonName" class="owner-form-label">Salon Name <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-building"></i>
                                               </span>
                                               <input type="text" class="form-control" id="salonName" name="salonname" 
                                                      value="{{ $salon->salonname ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; Enter your salon name" required>
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                           <label for="emailAddress" class="owner-form-label">Email Address <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-regular fa-envelope"></i>
                                               </span>
                                               <input type="email" class="form-control" id="emailAddress" name="email_address"
                                                      value="{{ $salon->email_address ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; Enter email address" required>
                                           </div>
                                       </div>
                                   </div>
   
                                   <!-- Owner Names -->
                                   <div class="row">
                                       <div class="col-md-6 mb-3">
                                           <label for="ownerFirstName" class="owner-form-label">Owner First Name <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-user"></i>
                                               </span>
                                               <input type="text" class="form-control" id="ownerFirstName" name="firstname"
                                                      value="{{ $salon->firstname ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; Enter first name" required>
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                           <label for="ownerLastName" class="owner-form-label">Owner Last Name <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-user"></i>
                                               </span>
                                               <input type="text" class="form-control" id="ownerLastName" name="lastname"
                                                      value="{{ $salon->lastname ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; Enter last name" required>
                                           </div>
                                       </div>
                                   </div>
   
                                   <!-- Phone Number -->
                                   <div class="row">
                                       <div class="col-12 mb-3">
                                           <label for="phoneNumber" class="owner-form-label">Phone Number <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-phone"></i>
                                               </span>
                                               <input type="tel" class="form-control" id="phoneNumber" name="phone"
                                                      value="{{ $salon->phone ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; (555) 123-4567" required>
                                           </div>
                                       </div>
                                   </div>
                               </div>
   
                               <!-- Business Address Section -->
                               <div class="mb-4">
                                   <h4 class="mb-3 fw-bold owner-section-header">Business Address</h4>
                                   <hr class="mb-4 owner-section-divider">
                                   
                                   <!-- Street Address -->
                                   <div class="row">
                                       <div class="col-12 mb-3">
                                           <label for="businessAddress" class="owner-form-label">Street Address <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-location-dot"></i>
                                               </span>
                                               <input type="text" class="form-control" id="businessAddress" name="business_address"
                                                      value="{{ $salon->business_address ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; Enter street address" required>
                                           </div>
                                       </div>
                                   </div>
   
                                   <!-- City and State -->
                                   <div class="row">
                                       <div class="col-md-6 mb-3">
                                           <label for="city" class="owner-form-label">City <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <input type="text" class="form-control" id="city" name="city"
                                                      value="{{ $salon->city ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; Enter city" required>
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                           <label for="state" class="owner-form-label">State <span class="text-danger">*</span></label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <select class="form-control" id="state" name="state" required>
                                                   <option value="">&nbsp;&nbsp;&nbsp;Select state</option>
                                                   <option value="CA" {{ ($salon->state ?? '') == 'CA' ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;California</option>
                                                   <option value="NY" {{ ($salon->state ?? '') == 'NY' ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;New York</option>
                                                   <option value="TX" {{ ($salon->state ?? '') == 'TX' ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;Texas</option>
                                                   <option value="FL" {{ ($salon->state ?? '') == 'FL' ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;Florida</option>
                                                   <option value="IL" {{ ($salon->state ?? '') == 'IL' ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;Illinois</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                               </div>
   
                               <!-- Security Section -->
                               <div class="mb-4">
                                   <h4 class="mb-3 fw-bold owner-section-header">Security</h4>
                                   <hr class="mb-4 owner-section-divider">
                                   
                                   <!-- New Password -->
                                   <div class="row">
                                       <div class="col-md-6 mb-3">
                                           <label for="password" class="owner-form-label">New Password</label>
                                           <div class="owner-input-group owner-input-group-custom owner-password-container">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-lock"></i>
                                               </span>
                                               <input type="password" class="form-control" id="password" name="password"
                                                      placeholder="&nbsp;&nbsp;&nbsp; Create password">
                                               <button type="button" class="owner-password-toggle" onclick="toggleOwnerPassword('password')">
                                                   <i class="fa-solid fa-eye"></i>
                                               </button>
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                           <label for="confirmPassword" class="owner-form-label">Confirm Password</label>
                                           <div class="owner-input-group owner-input-group-custom owner-password-container">
                                               <span class="owner-input-group-text-custom">
                                                   <i class="fa-solid fa-lock"></i>
                                               </span>
                                               <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                                                      placeholder="&nbsp;&nbsp;&nbsp; Confirm new password">
                                               <button type="button" class="owner-password-toggle" onclick="toggleOwnerPassword('confirmPassword')">
                                                   <i class="fa-solid fa-eye"></i>
                                               </button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
   
                               <!-- Business Hours Section -->
                               <div class="mb-4">
                                   <h4 class="mb-3 fw-bold owner-section-header">Business Hours</h4>
                                   <hr class="mb-4 owner-section-divider">
                                   
                                   <!-- Operating Days -->
                                   <div class="mb-3">
                                       <label class="owner-form-label">Operating Days</label>
                                       <div class="row mt-2 operating-days">
                                           @php
                                               $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                           @endphp
                                           @foreach($days as $day)
                                               <div class="col-md-3 col-6 mb-2">
                                                   <div class="form-check">
                                                       <input class="form-check-input" type="checkbox" 
                                                              id="{{ $day }}" name="operating_days[]" 
                                                              value="{{ $day }}"
                                                              {{ in_array($day, $openDays ?? []) ? 'checked' : '' }}>
                                                       <label class="form-check-label" for="{{ $day }}">
                                                           {{ ucfirst($day) }}
                                                       </label>
                                                   </div>
                                               </div>
                                           @endforeach
                                       </div>
                                   </div>
   
                                   <!-- Operating Hours -->
                                   <div class="row">
                                       <div class="col-md-6 mb-3">
                                           <label for="startTime" class="owner-form-label">Start Time</label>
                                           <div class="position-relative">
                                               <input type="time" class="form-control owner-search-input owner-time-input" 
                                                      id="startTime" name="open_time"
                                                      value="{{ substr($salon->open_time ?? '09:00', 0, 5) }}">
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                           <label for="endTime" class="owner-form-label">End Time</label>
                                           <div class="position-relative">
                                               <input type="time" class="form-control owner-search-input owner-time-input" 
                                                      id="endTime" name="close_time"
                                                      value="{{ substr($salon->close_time ?? '18:00', 0, 5) }}">
                                           </div>
                                       </div>
                                   </div>
                               </div>
   
                               <!-- Optional Information Section -->
                               <div class="mb-4">
                                   <h4 class="mb-3 fw-bold owner-section-header">Optional Information</h4>
                                   <hr class="mb-4 owner-section-divider">
                                   
                                   <!-- Website -->
                                   <div class="row">
                                       <div class="col-md-6 mb-3">
                                           <label for="website" class="owner-form-label">Website</label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <input type="url" class="form-control" id="website" name="website"
                                                      value="{{ $salon->website ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp;www.yourwebsite.com">
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                           <label for="businessLicense" class="owner-form-label">Business License Number</label>
                                           <div class="owner-input-group owner-input-group-custom">
                                               <input type="text" class="form-control" id="businessLicense" name="licencenum"
                                                      value="{{ $salon->licencenum ?? '' }}" 
                                                      placeholder="&nbsp;&nbsp;&nbsp; BL123456789">
                                           </div>
                                       </div>
                                   </div>
   
                                   <!-- Description -->
                                   <div class="row">
                                       <div class="col-12 mb-4">
                                           <label for="description" class="owner-form-label">Description</label>
                                           <textarea class="form-control owner-textarea" id="description" name="description" 
                                                     rows="4" placeholder="Describe your salon, services, and what makes you special...">{{ $salon->description ?? '' }}</textarea>
                                       </div>
                                   </div>
                               </div>
   
                               <!-- Action Buttons -->
                               <div class="d-flex justify-content-end owner-action-buttons">
                                   <button type="button" class="btn btn-salon-code d-none d-sm-flex btn-owner-back" id="cancelBtn">Cancel</button>
                                   
                                   <button type="submit" class="btn btn-owner-continue">
                                       <i class="fa-solid fa-save me-2"></i>Save Changes
                                   </button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   @endsection
   
   @push('scripts')
   <script src="{{ asset('js/owner/dashboard.js') }}" defer></script>
   <script src="{{ asset('js/owner/settings-api.js') }}" defer></script>
   
   @endpush