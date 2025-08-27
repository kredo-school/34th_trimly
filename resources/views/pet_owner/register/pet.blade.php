@extends('layouts.pet_owner')

@section('title', 'Register Pet')

@push('styles')
    <style>
        /* InputForm */
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

        /* Add pet Button */
        .btn-add-pet {
            background-color: #FEFCF1;
            color: #666;
            font-weight: bold;
            border: 2px solid #e0e0e0;
        }

        .btn-add-pet:hover {
            background-color: #f5f5f5;
        }

        /* PetCard */
        .pet-card {
            background-color: #f9f5f2;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        /* placeholder */
        .input-group-custom .form-control {
            padding-left: 10px;
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="text-start  mb-3 fw-bold"><i class="fa-regular fa-heart text-danger me-2"></i>Pet Information
                    </h4>
                    <p class="text-start mb-4">Tell us about your beloved pets
                    </p>
                </div>
                <button type="button" class="btn btn-add-pet"><i class="fa-solid fa-plus me-2"></i>Add
                    Pet</button>
            </div>


            <form action="{{ route('pet_owner.register.pet.post') }}" method="post" id="petRegistrationForm">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="pet-card" id="petCard1">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-muted mb-0">Pet 1</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-pet-button"
                            data-target-card="petCard1" style="display: none;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="petName1" class="form-label">Pet Name <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <input type="text" class="form-control" id="petName1" name="pets[0][pet_name]"
                                    placeholder="Enter pet's name"
                                    value="{{ old('pets.0.pet_name', $pets[0]['pet_name'] ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="breed1" class="form-label">Breed <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <input type="text" class="form-control" id="breed1" name="pets[0][breed]"
                                    placeholder="Enter breed" value="{{ old('pets.0.breed', $pets[0]['breed'] ?? '') }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="age1" class="form-label">Age <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                @php $age0 = old('pets.0.age', $pets[0]['age'] ?? '') @endphp
                                <select class="form-select form-control" id="age1" name="pets[0][age]" required>
                                    <option disabled value="">Select age</option>
                                    @foreach (['0-1 year', '1-3 years', '3-7 years', '7+ years'] as $opt)
                                        <option value="{{ $opt }}" @selected($age0 === $opt)>
                                            {{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="weight1" class="form-label">Weight <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                @php $wt0 = old('pets.0.weight', $pets[0]['weight'] ?? '') @endphp
                                <select class="form-select form-control" id="weight1" name="pets[0][weight]" required>
                                    <option disabled value="">Select weight range</option>
                                    @foreach (['0-5 kg', '5-10 kg', '10-20 kg', '20+ kg'] as $opt)
                                        <option value="{{ $opt }}" @selected($wt0 === $opt)>
                                            {{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="gender1" class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="input-group input-group-custom">
                            @php $gd0 = old('pets.0.gender', $pets[0]['gender'] ?? '') @endphp
                            <select class="form-select form-control" id="gender1" name="pets[0][gender]" required>
                                <option disabled value="">Select gender</option>
                                @foreach (['Male', 'Female', 'Unknown'] as $opt)
                                    <option value="{{ $opt }}" @selected($gd0 === $opt)>{{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="specialNotes1" class="form-label">Special Needs or
                            Notes</label>
                        <div class="input-group input-group-custom">
                            <textarea class="form-control" id="specialNotes1" name="pets[0][special_notes]" rows="3"
                                placeholder="Any special care instructions, behavioral notes, medical conditions, etc.">{{ old('pets.0.special_notes', $pets[0]['special_notes'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- A container where new pet cards are expected to be added by JavaScript. --}}
                <div id="petCardsContainer"></div>


                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pet_owner.register.petowner') }}" class="btn btn-back">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pet_owner/register.add_pet.js') }}" defer></script>
@endpush
