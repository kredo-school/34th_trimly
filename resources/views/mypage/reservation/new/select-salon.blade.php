{{-- Create a new Blade template for selecting a salon in the reservation process by Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Select Salon')


@section('header')
    @include('users.profile.header')
@endsection

@section('content')
    {{-- Step bar for the reservation process @ Juri --}}
    <div class="steps">
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">1</div>
            </div>
            <div class="step-label">Salon</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
                <div class="step-number">2</div>
            </div>
            <div class="step-label">Service</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
                <div class="step-number">3</div>
            </div>
            <div class="step-label">Pet</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
                <div class="step-number">4</div>
            </div>
            <div class="step-label">Schedule</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
                <div class="step-number">5</div>
            </div>
            <div class="step-label">Confirm</div>
        </div>
    </div>

    <main class="main-content">
        <div class="card">
            <h1 class="card-title"><i class="fa-solid fa-building me-2" style="color: #b08968;"></i>Select Your Salon</h1>
            <p class="card-subtitle">Choose from your registered salons</p>
            
            <div class="salon-list">
                @foreach($salons as $salon)
                <div class="salon-item" data-salon-id="{{ $salon['id'] }}">
                    <div class="salon-icon"><i class="fa-solid fa-building" style="color: #b08968;"></i></div>
                    <div class="salon-details">
                        <div class="salon-name">{{ $salon['name'] }}</div>
                        <div class="salon-info">Code: {{ $salon['code'] }}</div>
                        <div class="salon-info">Registered: {{ $salon['registered_date'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="actions">
                <a href="/mypage/reservation" class="btn btn-back">← Back</a>
                <button class="btn btn-continue" id="continueBtn" disabled>Continue →</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salonItems = document.querySelectorAll('.salon-item');
            const continueBtn = document.getElementById('continueBtn');
            let selectedSalonId = null;

            salonItems.forEach(item => {
                item.addEventListener('click', function() {
                    salonItems.forEach(si => si.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedSalonId = this.dataset.salonId;
                    continueBtn.disabled = false;
                });
            });

            continueBtn.addEventListener('click', function() {
                if (selectedSalonId) {
                    window.location.href = `/mypage/reservation/new/service?salon_id=${selectedSalonId}`;
                }
            });
        });
    </script>
@endsection
