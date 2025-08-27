    @extends('layouts.pet_owner')

    @section('title', 'Register Confirm')

    @push('styles')
        <style>
            /* InputForm */
            .info-section {
                background-color: #f9f5f2;
                border-radius: 8px;
                padding: 20px;
                margin-top: 30px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
                text-align: left;
            }

            .info-section h5 {
                color: #6c757d;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .info-pair {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 8px;
            }

            .info-pair .info-label,
            .info-pair .info-value {
                flex-grow: 1;
            }

            .info-pair .info-label {
                flex-basis: auto;
                text-align: left;
                color: #6c757d;
            }

            .info-pair .info-value {
                flex-basis: auto;
                text-align: left;
            }

            .info-item-row {
                margin-bottom: 8px;
            }

            .info-value.full-width {
                text-align: left;
            }

            .pet-info-item {
                font-weight: bold;
                color: #6c757d;
                font-size: 1.15rem;
                margin-bottom: 5px;
            }

            .pet-sub-info {
                color: #888;
                font-size: 0.95rem;
                margin-bottom: 15px;
                display: block;
            }

            .pet-separator {
                border-bottom: 1px dashed #e9ecef;
                margin: 20px 0;
            }

            .pet-separator:last-child {
                display: none;
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
                    <div class="step inactive">
                        <div class="step-number">5</div>
                    </div>
                    <div class="step-label">Complete</div>
                </div>
            </div>
        </nav>

        {{-- Card --}}
        <div class="card p-4 mb-4 shadow-sm">
            <div class="card-body">
                <div>
                    <h4 class="text-start mb-3 fw-bold"><i class="fa-solid fa-check me-2" style="color:#ab8b73"></i>Confirm
                        Registration</h4>
                    <p class="text-start mb-4">Please review your information before completing
                        registration</p>
                </div>

                <form action="{{ route('pet_owner.register.confirm.post') }}" method="POST">
                    @csrf

                    {{-- ▼ 追加：共通エラー表示 --}}
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- ▲ 追加ここまで --}}

                    {{-- Salon Code Section --}}
                    <div class="info-section">
                        <h5 class="text-start">Salon Code</h5>
                        <div class="info-item">
                            <div class="info-value full-width">{{ $salonCode }}</div>
                        </div>
                    </div>

                    {{-- Personal Information Section --}}
                    <div class="info-section">
                        <h5 class="text-start">Personal Information</h5>
                        {{-- name&Email --}}
                        <div class="row info-item-row">
                            <div class="col-6">
                                <div class="info-pair">
                                    <div class="info-label">Name</div>
                                    <div class="info-value">{{ $petOwner['lastName'] }} {{ $petOwner['firstName'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-pair">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">{{ $petOwner['email'] }}</div>
                                </div>
                            </div>
                        </div>
                        {{-- Phone&Location --}}
                        <div class="row info-item-row">
                            <div class="col-6">
                                <div class="info-pair">
                                    <div class="info-label">Phone</div>
                                    <div class="info-value">{{ $petOwner['phoneNumber'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-pair">
                                    <div class="info-label">Location</div>
                                    <div class="info-value">{{ $petOwner['city'] }}, {{ $petOwner['prefecture'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pet Information Section --}}
                    <div class="info-section">
                        <h5 class="text-start">Pet Information</h5>
                        @forelse($pets as $index => $pet)
                            <div class="pet-details-compact">
                                <div class="pet-info-item">Pet {{ $index + 1 }} : {{ $pet['pet_name'] }}</div>
                                <div class="pet-sub-info">
                                    {{ $pet['breed'] }} • {{ $pet['age'] }} • {{ $pet['weight'] }} •
                                    {{ $pet['gender'] }}
                                </div>
                                @if ($pet['special_notes'])
                                    <div class="info-pair">
                                        <div class="info-label">Special Notes:</div>
                                        <div class="info-value">{{ $pet['special_notes'] }}</div>
                                    </div>
                                @endif
                            </div>
                            @if (!$loop->last)
                                <div class="pet-separator"></div>
                            @endif
                        @empty
                            <p class="text-muted text-center">No pet information entered.</p>
                        @endforelse
                    </div>

                    {{-- Terms of Service Checkbox --}}
                    <div class="my-4 form-check text-start">
                        <input type="checkbox" class="form-check-input" id="termsConsent" name="terms_consent"
                            {{ old('terms_consent') ? 'checked' : '' }} required>
                        <label class="form-check-label" for="termsConsent">I agree to the Terms of Service and Privacy
                            Policy</label>
                    </div>

                    {{-- Navigation Buttons --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('pet_owner.register.pet') }}" class="btn btn-back">
                            <i class="fa-solid fa-arrow-left me-2"></i>Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Complete Registration <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    @endsection
