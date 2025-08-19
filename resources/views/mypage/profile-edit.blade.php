       @extends('layouts.pet_owner')

       @section('title', 'MyPage Profile-Edit')

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
                   /* 背景透明 */
                   border: none;
                   /* ボーダーなし */
                   color: #a68c76;
                   /* アイコンの色 */
                   padding-left: 15px;
                   /* 左のパディング */
                   padding-right: 0;
                   /* アイコンの右のパディングはなし */
                   display: flex;
                   /* アイコンを中央揃えにするため */
                   align-items: center;
               }

               .input-group-custom-edit .form-control-inline {
                   background-color: transparent;
                   /* 背景透明 */
                   border: none;
                   /* ボーダーなし */
                   box-shadow: none;
                   /* フォーカス時の影を削除 */
                   padding-left: 5px;
                   /* アイコンとの間隔を調整 */
                   padding-right: 15px;
                   /* 右のパディング */
                   color: #333;
                   /* テキストの色 */
                   height: auto;
                   /* 高さは親要素に合わせる */
                   flex-grow: 1;
                   /* 残りのスペースを埋める */
               }

               .input-group-custom-edit .form-control-inline-select {
                   /* select タグ用 */
                   background-color: transparent;
                   /* 背景透明 */
                   border: none;
                   /* ボーダーなし */
                   box-shadow: none;
                   /* フォーカス時の影を削除 */
                   padding-left: 5px;
                   /* アイコンとの間隔を調整 */
                   padding-right: 15px;
                   /* 右のパディング */
                   color: #333;
                   /* テキストの色 */
                   height: auto;
                   /* 高さは親要素に合わせる */
                   flex-grow: 1;
                   /* 残りのスペースを埋める */

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

               /* キャンセルボタンのスタイル */
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
           <div class="card p-4 mb-4">
               <h4 class="card-title mb-4">Pet Owner Information</h4>

               <form action="#" method="POST">
                   @csrf
                   @method('PATCH')

                   <div class="row g-3">
                       <div class="col-md-6">
                           <label for="firstName" class="form-label">First Name</label>
                           {{-- div.input-group に変更し、アイコンと入力フィールドを一体化 --}}
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-user"></i>
                               </span>
                               <input type="text" name="firstName" id="firstName"
                                   class="form-control form-control-inline" value="John" autofocus>{{-- DBからのデータ表示 --}}
                           </div>
                       </div>

                       <div class="col-md-6">
                           <label for="lastName" class="form-label">Last Name</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-user"></i>
                               </span>
                               <input type="text" name="lastName" id="lastName" class="form-control form-control-inline"
                                   value="Smith" autofocus>{{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="emailAddress" class="form-label">Email Address</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-envelope"></i>
                               </span>
                               <input type="email" name="emailAddress" id="emailAddress"
                                   class="form-control form-control-inline" value="john.smith@email.com"
                                   autofocus>{{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="phoneNumber" class="form-label">Phone Number</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-phone"></i>
                               </span>
                               <input type="tel" name="phoneNumber" id="phoneNumber"
                                   class="form-control form-control-inline" value="(555) 123-4567"
                                   autofocus>{{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="city" class="form-label">City</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-location-dot"></i>
                               </span>
                               <input type="text" name="city" id="city" class="form-control form-control-inline"
                                   value="Los Angeles">
                               {{-- DBからのデータ表示 --}}
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label for="prefecture" class="form-label">Prefecture</label>
                           <div class="input-group input-group-custom-edit">
                               <span class="input-group-text input-group-text-custom-edit">
                                   <i class="fa-solid fa-map"></i>
                               </span>
                               <select name="prefecture" id="prefecture" class="form-select form-control-inline-select">
                                   <option value="California" selected>California</option>
                                   <option value="New York">New York</option>
                                   <option value="Texas">Texas</option>
                                   {{-- オプションを追加 --}}
                               </select>
                           </div>
                       </div>

                       <div class="d-flex justify-content-end mt-4">
                           <button type="button" class="btn btn-cancel me-2">Cancel</button>
                           <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save
                               Changes</button>
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
