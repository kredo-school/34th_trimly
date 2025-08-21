@extends('layouts.pet_owner')

@section('title', 'Register SalonCode')

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
.w-40px { width: 40px; }
.h-40px { height: 40px; }
.step-line {
    flex-grow: 1;
    height: 3px;
    background-color: #e0e0e0;
    margin: 0 20px;
    align-self: flex-start;
    margin-top: 19px;
    z-index: -1;
}
.step-indicator { position: relative; z-index: 1; }

/* Input Form */
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
</style>
@endpush

@section('header')
    @include('pet_owner.register.header')
@endsection

@section('content')
    {{-- Step--}}
    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
        <div class="d-flex flex-column align-items-center step-item-active step-item">
            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">1</div>
            <div class="step-text mt-2 fs-6">Salon Code</div>
        </div>
        <div class="step-line"></div>
        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">2</div>
            <div class="step-text mt-2 fs-6">Pet Owner</div>
        </div>
        <div class="step-line"></div>
        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">3</div>
            <div class="step-text mt-2 fs-6">Pets</div>
        </div>
        <div class="step-line"></div>
        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">4</div>
            <div class="step-text mt-2 fs-6">Confirm</div>
        </div>
        <div class="step-line"></div>
        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
            <div class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">5</div>
            <div class="step-text mt-2 fs-6">Complete</div>
        </div>
    </nav>

    {{-- Card --}}
    <div class="card p-4 mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="card-title text-start mb-3 fw-bold"><i class="fa-solid fa-key me-2"></i>Enter Salon Code</h4>
            <p class="card-subtitle text-start mb-4">Please enter the invitation code provided by your salon</p>

            <form action="{{ route('pet_owner.register.saloncode.post') }}" method="post">
                @csrf

                {{-- success --}}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3 text-start">
                    <label for="salonCode" class="form-label">Salon Invitation Code <span class="text-danger">*</span></label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-key"></i></span>
                        <input type="text" class="form-control text-center fw-bold" id="salonCode" name="salonCode" placeholder="Enter your salon code" required>
                    </div>

                    {{-- error --}}
                    @error('salonCode')
                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary mb-3">
                        Continue <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
