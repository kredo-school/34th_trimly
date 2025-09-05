@extends('layouts.pet_owner')

@section('title', 'MyPage Add-Pet')

@push('styles')
    <style>
    </style>
@endpush

@section('header')
    @include('mypage.header.add-pet')
@endsection

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <a href="{{ route('mypage.pets.index') }}"><i class="fa-solid fa-arrow-left me-2 mb-2"></i>Back to My Pets</a>
            <h2 class="text-start fw-bold">Add New Pet</h2>
            <p class="text-start mb-4">Tell us about your beloved pets</p>
            <div class="card p-4 mb-4 shadow-sm">
                <div class="card-body">
                    <div>
                        <h4 class="text-start mb-3 fw-bold"><i class="fa-regular fa-heart me-2"></i>Pet
                            Information</h4>
                        <p class="text-start">Enter your pet's details below</p>
                    </div>
                </div>

                {{-- Success message display --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('mypage.pets.store') }}" method="post">
                    @csrf

                    <div class="pet-card" id="petCard1">
                        <h5 class="fw-bold mb-3"><i class="fa-regular fa-heart me-2"></i>Pet details</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                <label for="name" class="form-label">Pet Name <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter pet's name"
                                        value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label for="breed" class="form-label">Breed <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <input type="text" class="form-control @error('breed') is-invalid @enderror"
                                        id="breed" name="breed" placeholder="Enter breed" value="{{ old('breed') }}"
                                        required>
                                </div>
                                @error('breed')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <select class="form-select form-control @error('age') is-invalid @enderror"
                                        id="age" name="age" required>
                                        <option selected disabled value="">Select age</option>
                                        <option value="0-1 year" {{ old('age') == '0-1 year' ? 'selected' : '' }}>0-1
                                            year</option>
                                        <option value="1-3 years" {{ old('age') == '1-3 years' ? 'selected' : '' }}>1-3
                                            years</option>
                                        <option value="3-7 years" {{ old('age') == '3-7 years' ? 'selected' : '' }}>3-7
                                            years</option>
                                        <option value="7+ years" {{ old('age') == '7+ years' ? 'selected' : '' }}>7+
                                            years</option>
                                    </select>
                                </div>
                                @error('age')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label for="weight" class="form-label">Weight <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <select class="form-select form-control @error('weight') is-invalid @enderror"
                                        id="weight" name="weight" required>
                                        <option selected disabled value="">Select weight range</option>
                                        <option value="0-5 kg" {{ old('weight') == '0-5 kg' ? 'selected' : '' }}>0-5 kg
                                        </option>
                                        <option value="5-10 kg" {{ old('weight') == '5-10 kg' ? 'selected' : '' }}>5-10
                                            kg</option>
                                        <option value="10-20 kg" {{ old('weight') == '10-20 kg' ? 'selected' : '' }}>
                                            10-20 kg</option>
                                        <option value="20+ kg" {{ old('weight') == '20+ kg' ? 'selected' : '' }}>20+ kg
                                        </option>
                                    </select>
                                </div>
                                @error('weight')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <select class="form-select form-control @error('gender') is-invalid @enderror"
                                    id="gender" name="gender" required>
                                    <option selected disabled value="">Select gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="Unknown" {{ old('gender') == 'Unknown' ? 'selected' : '' }}>Unknown
                                    </option>
                                </select>
                            </div>
                            @error('gender')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="notes" class="form-label">Special Needs or Notes</label>
                            <div class="input-group input-group-custom">
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3"
                                    placeholder="Any special care instructions, behavioral notes, medical conditions, etc.">{{ old('notes') }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        {{-- Cancel --}}
                        <a href="{{ route('mypage.pets.index') }}" class="btn btn-cancel">
                            <i class="fa-solid fa-arrow-left me-2"></i>Cancel
                        </a>
                        {{-- Add Pet --}}
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-regular fa-floppy-disk me-2"></i>Add Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
