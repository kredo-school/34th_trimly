    @extends('layouts.pet_owner')

    @section('title', 'Register PetOwner')

    @push('styles')
        <style>
            /* 独自スタイルとしてBlade内に残すCSS */
            /* Step（JuriバージョンがCSSに入ってきたら撤去 */
            .step-item-active .step-circle {
                background-color: #ab8b73;
                /* アクティブなステップの色 */
                border-color: #ab8b73;
                color: #fff;
                /* 数字の色 */
                position: relative;
                /* z-indexを効かせるため */
                z-index: 2;
                /* 線より手前に来るように */
            }

            .step-item-active .step-text {
                color: #ab8b73;
                /* アクティブなステップのテキスト色 */
                font-weight: bold;
                position: relative;
                /* z-indexを効かせるため */
                z-index: 2;
                /* 線より手前に来るように */
                background-color: #FEFCF1;
                /*bodyと同じ背景色を設定して線が文字を透けないように */
            }

            .step-item-inactive .step-circle {
                background-color: #e0e0e0;
                /* 未完了ステップの背景色 */
                border-color: #e0e0e0;
                color: #fff;
                /* 数字の色 */
                position: relative;
                /* z-indexを効かせるため */
                z-index: 2;
                /* ★追加: 線より手前に来るように */
            }

            .step-item-inactive .step-text {
                color: #e0e0e0;
                /* 未完了ステップのテキスト色 */
                position: relative;
                z-index: 2;
                background-color: #FEFCF1;
            }

            /* ステップ円の固定サイズ*/
            .w-40px {
                width: 40px;
            }

            .h-40px {
                height: 40px;
            }

            /* ステップ間の線 */
            .step-line {
                flex-grow: 1;
                /* 親のFlexboxコンテナ内で利用可能なスペースを埋める */
                height: 3px;
                /* 線の太さ */
                background-color: #e0e0e0;
                /* 線の色 */
                margin: 0 20px;
                /* 線と丸の間のスペース */
                align-self: flex-start;
                /* 親のFlexアイテムの上端に寄せる */
                margin-top: 19px;
                /* step-circle (40px) の中心に線が来るように調整 (40px/2 - 2px/2 = 19px) */
                z-index: -1;
                /*線を円やテキストの裏に隠す */
            }

            /* ★step-indicatorにz-indexの基準を設定 */
            .step-indicator {
                position: relative;
                /* 子要素のz-indexの基準とする */
                z-index: 1;
                /* 他の要素と重なったときの順序 */
            }


            /* Inputフォームのデザイン */
            .input-group-custom {
                border: 1px solid var(--color-border);
                border-radius: var(--radius-md);
                overflow: hidden;
            }

            .input-group-text-custom {
                background-color: var(--color-background);
                border: none;
                color: var(--color-text-secondary);
                padding-right: var(--spacing-sm);
            }

            .input-group .form-control {
                background-color: var(--color-background);
                border: none;
                border-radius: 0;
                padding-left: 0;
            }

            /*目玉アイコン */
            .toggle-password {
                cursor: pointer;
            }

            /* バックボタンのデザイン */
            .btn-back {
                background-color: #FEFCF1;
                border: 1px solid #ccc;
                color: #6c757d;
                font-weight: bold;
                border-radius: 8px;
                padding: 12px 25px;
            }
        </style>
    @endpush

    @section('header')
        @include('pet_owner.register.header')
    @endsection


    @section('content')
        {{-- Step --}}
        <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
            <div class="d-flex flex-column align-items-center step-item-active step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="step-text mt-2 fs-6">Salon Code</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-active step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    2</div>
                <div class="step-text mt-2 fs-6">Pet Owner</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    3</div>
                <div class="step-text mt-2 fs-6">Pets</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    4</div>
                <div class="step-text mt-2 fs-6">Confirm</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    5</div>
                <div class="step-text mt-2 fs-6">Complete</div>
            </div>
        </nav>

        {{-- Card --}}
        <div class="card p-4 mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-start mb-3 fw-bold"><i class="fa-solid fa-user me-2"></i>Pet
                    Owner Information</h4>
                <p class="card-subtitle text-muted text-start mb-4">Tell us about yourself</p>

                <form action="{{ route('pet_owner.register.petowner.post') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="firstName" class="form-label ">First Name <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="Enter first name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="Enter last name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="emailAddress" class="form-label ">Email Address <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control" id="emailAddress" name="email"
                                    placeholder="Enter email address" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="phoneNumber" class="form-label ">Phone Number <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                    placeholder="(555) 123-4567" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="city" class="form-label ">City <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                </span>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Enter your city" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="prefecture" class="form-label">Prefecture <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-map"></i>
                                </span>
                                <select class="form-select form-control" id="prefecture" name="prefecture" required>
                                    <option selected disabled value="">Select prefecture</option>
                                    <option>Tokyo</option>
                                    <option>Osaka</option>
                                    <option>Nagoya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Create password" required>
                                <span class="input-group-text input-group-text-custom toggle-password"
                                    data-target="password">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="confirmPassword" class="form-label">Confirm Password
                                <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="confirmPassword"
                                    name="password_confirmation" placeholder="Confirm password" required>
                                <span class="input-group-text input-group-text-custom toggle-password"
                                    data-target="confirmPassword">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-back">
                            <i class="fa-solid fa-arrow-left me-2"></i>Back
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Continue <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="{{ asset('js/pet_owner/register.pet_owner.js') }}" defer></script>
    @endpush
