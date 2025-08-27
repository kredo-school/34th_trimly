    @extends('layouts.pet_owner')

    @section('title', 'Register Complete')

    @push('styles')
        <style>
            /* Check Circle */
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
        <nav class="d-flex justify-content-between align-items-center mt-2 mb-5">
            <div class="steps">
                <div class="step-wrapper">
                    <div class="step">
                        <div class="step-number">✓</div>
                    </div>
                    <div class="step-label">Salon Code</div>
                </div>
                <div class="step-line"></div>
                <div class="step-wrapper">
                    <div class="step">
                        <div class="step-number">✓</div>
                    </div>
                    <div class="step-label">Pet Owner</div>
                </div>
                <div class="step-line"></div>
                <div class="step-wrapper">
                    <div class="step">
                        <div class="step-number">✓</div>
                    </div>
                    <div class="step-label">Pets</div>
                </div>
                <div class="step-line"></div>
                <div class="step-wrapper">
                    <div class="step">
                        <div class="step-number">✓</div>
                    </div>
                    <div class="step-label">Confirm</div>
                </div>
                <div class="step-line"></div>
                <div class="step-wrapper">
                    <div class="step">
                        <div class="step-number">✓</div>
                    </div>
                    <div class="step-label">Complete</div>
                </div>
            </div>
        </nav>
        {{-- Card --}}
        <div class="card p-4 mb-4 shadow-sm">
            {{-- check-circle --}}
            <div class="check-circle d-flex justify-content-center align-items-center rounded-circle mx-auto mb-4">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="complete-title text-center mb-3">Welcome to Trimly!</h2>
            <p class="complete-message text-center mb-4">Your registration is complete. You can now manage your pets and
                book appointments.</p>

            <a href="{{ route('mypage.profile') }}" class="btn btn-primary d-block mx-auto">
                Go to My Page <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
    @endsection
