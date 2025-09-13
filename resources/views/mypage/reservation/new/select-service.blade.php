{{-- Select service page for reservation process @ Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Select Service')

@push('styles')
    <style>
        /* サービス選択ページの幅を広げる */
        /* Custom styles for service selection page @Juri */
        .col-lg-8 {
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
        
        /* コンテナの左右パディングを減らす */
        .container {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
        
        @media (min-width: 768px) {
            .container {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }
        
        @media (min-width: 1200px) {
            .container {
                padding-left: 30px !important;
                padding-right: 30px !important;
            }
        }
        
        @media (min-width: 1400px) {
            .col-lg-8 {
                max-width: 98% !important;
                flex: 0 0 98% !important;
            }
            .container {
                padding-left: 40px !important;
                padding-right: 40px !important;
            }
        }
    </style>
@endpush

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
            <h1 class="card-title service-title"><i class="fas fa-scissors me-2" style="color: #b08968;"></i>Choose Your Service</h1>
            <p class="card-subtitle">Select the service for your pet</p>

            <div class="service-grid">
                @foreach($services as $service)
                <div class="service-item" data-service-id="{{ $service['id'] }}">
                    <div class="service-header">
                        <h3 class="service-name">{{ $service['name'] }}</h3>
                        <div class="service-price">${{ $service['price'] }}</div>
                    </div>
                    <p class="service-description">{{ $service['description'] }}</p>
                    <div class="service-duration">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M8 4V8L10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        {{ $service['duration'] }}
                    </div>
                    <div class="service-includes">
                        <p class="includes-label">Includes:</p>
                        <ul class="includes-list">
                            @foreach($service['includes'] as $include)
                            <li>{{ $include }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="actions">
                <a href="{{ route('reservation.select-salon') }}" class="btn btn-back">← Back</a>
                <button class="btn btn-continue" id="continueBtn" disabled>Continue →</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceItems = document.querySelectorAll('.service-item');
            const continueBtn = document.getElementById('continueBtn');
            let selectedServiceId = null;

            serviceItems.forEach(item => {
                item.addEventListener('click', function() {
                    serviceItems.forEach(si => si.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedServiceId = this.dataset.serviceId;
                    continueBtn.disabled = false;
                });
            });

            continueBtn.addEventListener('click', function() {
                if (selectedServiceId) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const salonId = urlParams.get('salon_id');
                    window.location.href = `/mypage/reservation/new/pet?salon_id=${salonId}&service_id=${selectedServiceId}`;
                }
            });
        });
    </script>

@endsection