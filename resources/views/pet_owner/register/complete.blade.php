    @extends('layouts.pet_owner')

    @section('title', 'Register Complete')

    @push('styles')
        <style>
            /* Step（JuriバージョンがCSSに入ってきたら撤去 */
            .step-item-active .step-circle {
                background-color: #ab8b73;
                border-color: #ab8b73;
                color: #fff;
                position: relative;
                z-index: 2;
            }

            .step-item-active .step-text {
                color: #ab8b73;
                font-weight: bold;
                position: relative;
                z-index: 2;
                background-color: #FEFCF1;
            }

            .step-item-inactive .step-circle {
                background-color: #e0e0e0;
                border-color: #e0e0e0;
                color: #fff;
                position: relative;
                z-index: 2;
            }

            .step-item-inactive .step-text {
                color: #e0e0e0;
                position: relative;
                z-index: 2;
                background-color: #FEFCF1;
            }

            .w-40px {
                width: 40px;
            }

            .h-40px {
                height: 40px;
            }

            .step-line {
                flex-grow: 1;
                height: 3px;
                background-color: #e0e0e0;
                margin: 0 20px;
                align-self: flex-start;
                margin-top: 19px;
                z-index: -1;
            }

            .step-indicator {
                position: relative;
                z-index: 1;
            }

            /* 完了画面専用スタイル */
            .check-circle {
                background-color: #e6fae6;
                color: #5cb85c;
                width: 80px;
                height: 80px;
                font-size: 3rem;
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
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="step-text mt-2 fs-6">Pet Owner</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-active step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="step-text mt-2 fs-6">Pets</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-active step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="step-text mt-2 fs-6">Confirm</div>
            </div>
            <div class="step-line"></div>
            <div class="d-flex flex-column align-items-center step-item-active step-item">
                <div
                    class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                    5</div>
                <div class="step-text mt-2 fs-6">Complete</div>
            </div>
        </nav>

        {{-- Card --}}
        <div class="card p-4 mb-4 shadow-sm">
            {{-- check-circle --}}
            <div class="check-circle d-flex justify-content-center align-items-center rounded-circle mx-auto mb-4">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="complete-title text-center mb-3 fw-bold">Welcome to Trimly!</h2>
            <p class="complete-message text-center mb-4">Your registration is complete. You can now manage your pets and
                book appointments.</p>

            <a href="#" class="btn btn-primary d-block mx-auto">
                Go to My Page <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
    @endsection
