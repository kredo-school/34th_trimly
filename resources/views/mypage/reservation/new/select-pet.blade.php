{{-- Select pet page for reservation process @ Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Select Pet')

@section('header')
    @include('users.profile.header')
@endsection

@section('content')
    {{-- Step bar for the reservation process @ Juri --}}
    <div class="steps">
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">✓</div>
            </div>
            <div class="step-label">Salon</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">✓</div>
            </div>
            <div class="step-label">Service</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step">
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
            <h1 class="card-title pet-title">Select Your Pet</h1>
            <p class="card-subtitle">Choose from your registered pets</p>
            
            <div class="pet-grid">
                @foreach($pets as $pet)
                <div class="pet-item" data-pet-id="{{ $pet['id'] }}">
                    <h3 class="pet-name">{{ $pet['name'] }}</h3>
                    
                    <div class="pet-info">
                        <div class="info-row">
                            <span class="info-label">Breed:</span>
                            <span class="info-value">{{ $pet['breed'] }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Age:</span>
                            <span class="info-value">{{ $pet['age'] }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Size:</span>
                            <span class="info-value">{{ $pet['size'] }}</span>
                        </div>
                    </div>
                    
                    <div class="special-needs">
                        <p class="special-needs-label">Special needs:</p>
                        <p class="special-needs-text">{{ $pet['special_needs'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="actions">
                <a href="/mypage/reservation/new/service" class="btn btn-back">← Back</a>
                <button class="btn btn-continue" id="continueBtn" disabled>Continue →</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const petItems = document.querySelectorAll('.pet-item');
            const continueBtn = document.getElementById('continueBtn');
            let selectedPetId = null;

            petItems.forEach(item => {
                item.addEventListener('click', function() {
                    petItems.forEach(pi => pi.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedPetId = this.dataset.petId;
                    continueBtn.disabled = false;
                });
            });

            continueBtn.addEventListener('click', function() {
                if (selectedPetId) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const salonId = urlParams.get('salon_id');
                    const serviceId = urlParams.get('service_id');
                    window.location.href = `/mypage/reservation/new/schedule?salon_id=${salonId}&service_id=${serviceId}&pet_id=${selectedPetId}`;
                }
            });
        });
    </script>
@endsection