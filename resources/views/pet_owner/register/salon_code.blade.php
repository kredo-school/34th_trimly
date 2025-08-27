@extends('layouts.pet_owner')

@section('title', 'Register SalonCode')

@push('styles')
    <style>
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
                <div class="step inactive">
                    <div class="step-number">2</div>
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
            <h4 class="text-start mb-3 fw-bold"><i class="fa-solid fa-key me-2"></i>Enter Salon Code</h4>
            <p class="text-start mb-4">Please enter the invitation code provided by your salon</p>

            <form action="{{ route('pet_owner.register.saloncode.post') }}" method="post">
                @csrf

                {{-- ▼ 追加：共通エラー表示 --}}
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                            /ul>
                    </div>
                @endif
                {{-- ▲ 追加ここまで --}}

                {{-- success --}}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3 text-start">
                    <label for="salonCode" class="form-label">Salon Invitation Code <span
                            class="text-danger">*</span></label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-key"></i></span>
                        <input type="text" class="form-control text-center fw-bold" id="salonCode" name="salonCode"
                            placeholder="Enter your salon code"
                            value="{{ old('salonCode', session('registration_data.salon_code')) }}" required>
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
