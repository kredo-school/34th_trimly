       @extends('layouts.pet_owner')

       @section('title', 'MyPage Profile')

       @push('styles')
           <style>
           </style>
       @endpush

       @section('header')
           @include('mypage.header.mypage')
       @endsection

       @section('content')
           <div class="card p-4 mb-4">
               <div class="d-flex justify-content-between align-items-center mb-4">
                   <h4 class="mb-0"><i class="fa-solid fa-user me-1"></i>Pet Owner Information</h4>
                   {{-- edit button --}}
                   <a href="{{ route('mypage.profile.edit') }}" class="btn btn-primary">
                       <i class="fa-regular fa-pen-to-square"></i>
                   </a>
               </div>

            {{--Profile--}}
               <div class="row g-3">
                   <div class="col-md-6">
                       <label for="firstName" class="form-label">First Name</label>
                       <div class="form-control-readonly">
                           <i class="fa-solid fa-user"></i>
                           <span class="value-text" id="firstName">{{ $petOwner->firstname }}</span>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="lastName" class="form-label">Last Name</label>
                       <div class="form-control-readonly">
                           <i class="fa-solid fa-user"></i>
                           <span class="value-text" id="lastName">{{ $petOwner->lastname }}</span>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="email_address" class="form-label">Email Address</label>
                       <div class="form-control-readonly">
                           <i class="fa-solid fa-envelope"></i>
                           <span class="value-text" id="email_address">{{ $petOwner->email_address }}</span>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="phone" class="form-label">Phone Number</label>
                       <div class="form-control-readonly">
                           <i class="fa-solid fa-phone"></i>
                           <span class="value-text" id="phone">{{ $petOwner->phone }}</span>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="city" class="form-label">City</label>
                       <div class="form-control-readonly">
                           <i class="fa-solid fa-location-dot"></i>
                           <span class="value-text" id="city">{{ $petOwner->city }}</span>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="prefecture" class="form-label">Prefecture</label>
                       <div class="form-control-readonly">
                           <i class="fa-solid fa-map"></i>
                           <span class="value-text" id="prefecture">{{ $petOwner->prefecture }}</span>
                       </div>
                   </div>
               </div>
           </div>

           {{--Password reset--}}
           <div class="card p-4">
               <h4 class="mb-4"><i class="fa-solid fa-lock me-2"></i>Change Password</h4>

               <form action="{{ route('mypage.password.update') }}" method="POST">
                   @csrf

                   <div class="row g-3">
                       <div class="col-md-4">
                           <label for="currentPassword" class="form-label">Current Password</label>
                           <div class="input-group input-group-custom">
                               <input type="password" class="form-control" id="currentPassword" name="current_password"
                                   placeholder="Enter current password">
                               <span class="input-group-text input-group-text-custom toggle-password"
                                   data-target="currentPassword">
                                   <i class="fa-solid fa-eye-slash"></i>
                               </span>
                           </div>
                           @error('current_password')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-4">
                           <label for="newPassword" class="form-label">New Password</label>
                           <div class="input-group input-group-custom">
                               <input type="password" class="form-control" id="newPassword" name="new_password"
                                   placeholder="Enter new password">
                           </div>
                           @error('new_password')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-4">
                           <label for="confirmNewPassword" class="form-label">Confirm Password</label>
                           <div class="input-group input-group-custom">
                               <input type="password" class="form-control" id="confirmNewPassword"
                                   name="new_password_confirmation" placeholder="Confirm new password">
                           </div>
                       </div>
                       @error('new_password_confirmation')
                           <div class="text-danger mt-1">{{ $message }}</div>
                       @enderror
                   </div>
                   <div class="d-flex justify-content-end mt-4">
                       <button type="submit" class="btn btn-primary">Update Password</button>
                   </div>
                   @if (session('status'))
                       <div class="alert alert-success">
                           {{ session('status') }}
                       </div>
                   @endif
               </form>
           </div>
       @endsection

       @push('scripts')
           <script src="{{ asset('js/pet_owner/mypage.profile.js') }}" defer></script>
       @endpush
