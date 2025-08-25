       @extends('layouts.pet_owner')

       @section('title', 'MyPage Profile-Edit')

       @push('styles')
           <style>
               /* InputField */
               .form-control-readonly {
                   background-color: #FEFCF1;
                   border: 1px solid #e0e0e0;
                   border-radius: 10px;
                   padding: 12px 15px;
                   color: #333;
                   font-size: 1rem;
                   display: flex;
                   align-items: center;
                   min-height: calc(2.25rem + 2px);
                   /* Bootstrap form-control の高さに合わせる */
               }

               .form-control-readonly .fa-solid {
                   color: #a68c76;
                   margin-right: 10px;
               }

               .form-control-readonly .value-text {
                   flex-grow: 1;
                   /* テキストが残りのスペースを占める */
                   color: #adb5bd;
               }

               .input-group-custom-edit {
                   display: flex;
                   align-items: center;
                   border: 1px solid #e0e0e0;
                   /* form-control-readonly と同じボーダー */
                   border-radius: 10px;
                   /* form-control-readonly と同じ角丸 */
                   background-color: #FEFCF1;
                   /* form-control-readonly と同じ背景色 */
                   min-height: calc(2.25rem + 2px);
                   /* Bootstrap form-control の高さに合わせる */
                   overflow: hidden;
                   /* 角丸からはみ出さないように */
               }

               .input-group-custom-edit .input-group-text-custom-edit {
                   background-color: transparent;
                   border: none;
                   color: #a68c76;
                   padding-left: 15px;
                   padding-right: 0;
                   display: flex;
                   align-items: center;
               }

               .input-group-custom-edit .form-control-inline {
                   background-color: transparent;
                   border: none;
                   box-shadow: none;
                   padding-left: 5px;
                   padding-right: 15px;
                   color: #333;
                   height: auto;
                   flex-grow: 1;
               }

               .input-group-custom-edit .form-control-inline-select {
                   background-color: transparent;
                   border: none;
                   box-shadow: none;
                   padding-left: 5px;
                   padding-right: 15px;
                   color: #333;
                   height: auto;
                   flex-grow: 1;
               }

               /* 目玉アイコン */
               .input-group-custom .toggle-password {
                   background-color: #FEFCF1;
                   border-left: none;
                   /* input との間のボーダーは不要 */
                   color: #a68c76;
                   /* アイコンの色 (画像に合わせて) */
                   cursor: pointer;
                   height: calc(2.25rem + 2px);
                   /* Bootstrap form-control の高さに合わせる */
                   display: flex;
                   align-items: center;
                   justify-content: center;
                   padding-left: 10px;
                   padding-right: 15px;
               }

               /* input がフォーカスされた時の .toggle-password のボーダースタイル */
               .input-group-custom .form-control:focus+.toggle-password {
                   border-color: #a68c76;
                   /* フォーカス時の枠線色を合わせる */
                   box-shadow: 0 0 0 0.25rem rgba(166, 140, 118, 0.25);
                   /* フォーカス時の影を合わせる */
               }

               /* input-group自体にボーダーと角丸を適用 */
               .input-group-custom {
                   border: 1px solid #e0e0e0;
                   border-radius: 8px;
                   overflow: hidden;
               }

               /* input-group-textの背景色とボーダーを調整 */
               .input-group-text-custom {
                   background-color: #FEFCF1;
                   border: none;
                   color: #6c757d;
                   padding-right: 8px;
                   padding: 0.75rem 1rem;
                   /* アイコン側のパディングも調整して高さを揃える */
               }

               /* input-group内のform-controlのボーダーと角丸を調整 */
               .input-group .form-control {
                   background-color: #FEFCF1;
                   border: none;
                   border-radius: 0;
                   /* 角丸を削除 (input-group-customに任せる) */
               }

               /* Cancelbutton */
               .btn-cancel {
                   background-color: #FEFCF1 !important;
                   color: #666;
                   border: 1px solid #e0e0e0;
                   height: 40px;
                   padding: 0 20px;
               }

               .btn-cancel:hover {
                   background-color: #e0e0e0;
                   color: #6c757d;
               }
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
               <h4 class="card-title mb-4">Pet Owner Information</h4>

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
                               <input type="tel" name="phone" id="phone"
                                   class="form-control form-control-inline"
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
                           <button type="button" class="btn btn-cancel me-2">Cancel</button>
                           <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save
                               Changes</button>
                       </div>
                   </div>
               </form>
           </div>

           {{-- Password reset --}}
           <div class="card p-4">
               <h4 class="card-title mb-4">Change Password</h4>
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
