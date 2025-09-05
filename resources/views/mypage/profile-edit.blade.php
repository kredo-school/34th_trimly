       @extends('layouts.pet_owner')

       @section('title', 'MyPage Profile-Edit')

       @push('styles')
           <style>
           </style>
       @endpush

       @section('header')
           @include('mypage.header.mypage')
       @endsection

       @section('content')

           @if (session('success'))
               <div class="alert alert-success">
                   {{ session('success') }}
               </div>
           @endif

           <div class="card p-4 mb-4">
               <h4 class="mb-4"><i class="fa-solid fa-user me-1"></i>Pet Owner Information</h4>

               {{-- Edit profile --}}
               <form action="{{ route('mypage.profile.update') }}" method="POST">
                   @csrf
                   @method('PATCH')

                   <div class="row g-3">
                       <div class="col-md-6">
                           <label for="firstName" class="form-label">First Name</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-user"></i>
                               </span>
                               <input type="text" name="firstName" id="firstName"
                                   class="form-control form-control-inline"
                                   value="{{ old('firstName', $petOwner->firstname) }}" autofocus>
                           </div>
                           @error('firstName')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>

                       <div class="col-md-6">
                           <label for="lastName" class="form-label">Last Name</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-user"></i>
                               </span>
                               <input type="text" name="lastName" id="lastName" class="form-control form-control-inline"
                                   value="{{ old('lastName', $petOwner->lastname) }}" autofocus>
                           </div>
                           @error('lastName')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-6">
                           <label for="emailAddress" class="form-label">Email Address</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-envelope"></i>
                               </span>
                               <input type="email" name="email_address" id="email_address"
                                   class="form-control form-control-inline"
                                   value="{{ old('email_address', $petOwner->email_address) }}" autofocus>
                           </div>
                           @error('email_address')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-6">
                           <label for="phoneNumber" class="form-label">Phone Number</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-phone"></i>
                               </span>
                               <input type="tel" name="phone" id="phone" class="form-control form-control-inline"
                                   value="{{ old('phone', $petOwner->phone) }}" autofocus>
                           </div>
                           @error('phoneNumber')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-6">
                           <label for="city" class="form-label">City</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-location-dot"></i>
                               </span>
                               <input type="text" name="city" id="city" class="form-control form-control-inline"
                                   value="{{ old('city', $petOwner->city) }}">
                           </div>
                           @error('city')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-6">
                           <label for="prefecture" class="form-label">Prefecture</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-map"></i>
                               </span>
                               <select name="prefecture" id="prefecture" class="form-select form-control-inline-select">
                                   <option value="Tokyo"
                                       {{ old('prefecture', $petOwner->prefecture) == 'Tokyo' ? 'selected' : '' }}>Tokyo
                                   </option>
                                   <option value="Osaka"
                                       {{ old('prefecture', $petOwner->prefecture) == 'Osaka' ? 'selected' : '' }}>Osaka
                                   </option>
                                   <option value="Nagoya"
                                       {{ old('prefecture', $petOwner->prefecture) == 'Nagoya' ? 'selected' : '' }}>Nagoya
                                   </option>
                               </select>
                           </div>
                           @error('prefecture')
                               <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                       </div>

                       <div class="d-flex justify-content-end mt-4">
                           <a href="{{ route('mypage.profile') }}" class="btn btn-cancel me-2">
                               <i class="fa-solid fa-arrow-left me-2"></i>Cancel
                           </a>
                           <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save
                               Changes</button>
                       </div>
                   </div>
               </form>
           </div>

           {{-- Password reset --}}
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
