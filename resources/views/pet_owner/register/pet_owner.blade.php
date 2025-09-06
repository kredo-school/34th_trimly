@extends('layouts.pet_owner')

@section('title', 'Register PetOwner')

@push('styles')
    <style>
    
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
                <div class="step inactive">
                    <div class="step-number">3</div>
                </div>
                <div class="step-label">Pets</div>
            </div>
            <div class="step-line"></div>
            <div class="step-wrapper">
                <div class="step inactive">
                    <div class="step-number">4</div>
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
            <h4 class="text-start mb-3 fw-bold"><i class="fa-solid fa-user me-2"></i>Pet
                Owner Information</h4>
            <p class="text-start mb-4">Tell us about yourself</p>

            <form action="{{ route('pet_owner.register.petowner.post') }}" method="post">
                @csrf
              
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              
                <div class="row">
                    <div class="col-md-6 mb-3 text-start">
                        <label for="firstName" class="form-label ">First Name <span class="text-danger">*</span></label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text input-group-text-custom">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="firstName" name="firstName"
                                placeholder="Enter first name" value="{{ old('firstName', $petOwner['firstName'] ?? '') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 text-start">
                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text input-group-text-custom">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                placeholder="Enter last name" value="{{ old('lastName', $petOwner['lastName'] ?? '') }}"
                                required>
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
                                placeholder="Enter email address" value="{{ old('email', $petOwner['email'] ?? '') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 text-start">
                        <label for="phoneNumber" class="form-label ">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text input-group-text-custom">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                placeholder="09012345678" value="{{ old('phoneNumber', $petOwner['phoneNumber'] ?? '') }}"
                                required>
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
                                placeholder="Enter your city" value="{{ old('city', $petOwner['city'] ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 text-start">
                        <label for="prefecture" class="form-label">Prefecture <span class="text-danger">*</span></label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text input-group-text-custom">
                                <i class="fa-solid fa-map"></i>
                            </span>
                            <select class="form-select form-control" id="prefecture" name="prefecture" required>
                                <option disabled value="">Select prefecture</option>
                                @foreach (['Tokyo', 'Osaka', 'Nagoya'] as $pref)
                                    <option value="{{ $pref }}" + @selected(old('prefecture', $petOwner['prefecture'] ?? '') === $pref)>
                                        {{ $pref }}
                                    </option>
                                @endforeach
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
                            <span class="input-group-text input-group-text-custom toggle-password" data-target="password">
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
                        @error('password')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pet_owner.register.saloncode') }}" class="btn btn-back">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-continue" id="continueBtn" disabled>
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
