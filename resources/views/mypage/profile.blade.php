       @extends('layouts.pet_owner')

       @section('title', 'MyPage Profile')

       @push('styles')
           <style>
               /* 読み取り専用フィールド */
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

               /* 目玉アイコンは .toggle-password が付与されている部分にのみ適用 */
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
           </style>
       @endpush

       @section('header')
           @include('mypage.header.mypage')
       @endsection

       @section('content')
           <div class="card p-4 mb-4">
               <div class="d-flex justify-content-between align-items-center mb-4">
                   <h4 class="card-title mb-0">Pet Owner Information</h4>
                   {{-- edit button --}}
                   <button class="btn btn-primary">
                       <i class="fa-regular fa-pen-to-square"></i>
                   </button>
               </div>

               <form action="#" method="POST">
                   @csrf

                   <div class="row g-3">
                       <div class="col-md-6">
                           <label for="firstName" class="form-label">First Name</label>
                           <div class="form-control-readonly">
                               <i class="fa-solid fa-user"></i>
                               <span class="value-text" id="firstName">John</span> {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="lastName" class="form-label">Last Name</label>
                           <div class="form-control-readonly">
                               <i class="fa-solid fa-user"></i>
                               <span class="value-text" id="lastName">Smith</span> {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="emailAddress" class="form-label">Email Address</label>
                           <div class="form-control-readonly">
                               <i class="fa-solid fa-envelope"></i>
                               <span class="value-text" id="emailAddress">john.smith@email.com</span>
                               {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="phoneNumber" class="form-label">Phone Number</label>
                           <div class="form-control-readonly">
                               <i class="fa-solid fa-phone"></i>
                               <span class="value-text" id="phoneNumber">(555) 123-4567</span>
                               {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="city" class="form-label">City</label>
                           <div class="form-control-readonly">
                               <i class="fa-solid fa-location-dot"></i>
                               <span class="value-text" id="city">Los Angeles</span>
                               {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="prefecture" class="form-label">Prefecture</label>
                           <div class="form-control-readonly">
                               <i class="fa-solid fa-map"></i>
                               <span class="value-text" id="prefecture">California</span>
                               {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                   </div>
               </form>
           </div>

           <div class="card p-4">
               <h4 class="card-title mb-4">Change Password</h4>
               <form>
                   <div class="row g-3">
                       <div class="col-md-4">
                           <label for="currentPassword" class="form-label">Current Password</label>
                           <div class="input-group input-group-custom">
                               <input type="password" class="form-control" id="currentPassword"
                                   placeholder="Enter current password">
                               <span class="input-group-text input-group-text-custom toggle-password"
                                   data-target="currentPassword">
                                   <i class="fa-solid fa-eye-slash"></i>
                               </span>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <label for="newPassword" class="form-label">New Password</label>
                           <div class="input-group input-group-custom">
                               <input type="password" class="form-control" id="newPassword"
                                   placeholder="Enter new password">
                           </div>
                       </div>
                       <div class="col-md-4">
                           <label for="confirmNewPassword" class="form-label">Confirm Password</label>
                           <div class="input-group input-group-custom">
                               <input type="password" class="form-control" id="confirmNewPassword"
                                   placeholder="Confirm new password">
                           </div>
                       </div>
                   </div>
                   <div class="d-flex justify-content-end mt-4">
                       <button type="submit" class="btn btn-primary">Update Password</button>
                   </div>
               </form>
           </div>
       @endsection

       @push('scripts')
           <script src="{{ asset('js/pet_owner/mypage.profile.js') }}" defer></script>
       @endpush
