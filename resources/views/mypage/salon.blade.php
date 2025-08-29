@extends('layouts.pet_owner')

@section('title', 'MyPage Salons')

@push('styles')
    <style>
        /*Input Form*/
        /* input-group自体にボーダーと角丸を適用 */
        .input-group-custom {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        /* input-group-textの背景色とボーダーを調整 */
        .input-group-text-custom {
            background-color: #FEFCF1;
            border: none;
            color: #6c757d;
            padding-right: 8px;
            padding: 0.75rem 1rem;
            /* アイコン側のパディングも調整して高さを揃える */
        }

        /* input-group内のform-controlのボーダーと角丸を調整 */
        .input-group .form-control {
            background-color: #FEFCF1;
            border: none;
            border-radius: 0;
            /* 角丸を削除 (input-group-customに任せる) */
        }

        /*Salon info*/
        .salon-code-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 15px;
            /* 各アイテム間のスペース */
        }

        .salon-code-info {
            display: flex;
            align-items: center;
            gap: 15px;
            /* アイコンとテキストの間 */
        }

        .salon-code-icon {
            color: #a68c76;
            font-size: 1.2rem;
        }

        .salon-name {
            font-weight: bold;
            font-size: 1.1rem;
            color: #6c757d;
        }

        .salon-details {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .salon-code-status {
            font-size: 0.75rem;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 5px;
            background-color: #dcfce6;
            /* Light blue for Active */
            color: #166434;
            /* Blue text */
        }
    </style>
@endpush

@section('header')
    @include('mypage.header.mypage')
@endsection


@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="card p-4 mb-4 shadow-sm">
                <div>
                    <h4 class="text-start mb-3 fw-bold">Add Salon Code</h4>
                    <p class="text-start mb-4">Enter a salon code to link a new salon to
                        your account</p>
                </div>

                {{-- Flash / Validation --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('mypage.salon.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-inline"
                            placeholder="Enter salon code (e.g., ABC123)" aria-label="Salon Code" name="salon_code"
                            value="{{ old('salon_code') }}" required>
                        <button class="btn btn-primary" type="submit">
                            <i class="fa-solid fa-plus me-2"></i> Add Code
                        </button>
                    </div>
                </form>
            </div>

            <h4 class="card-header-main my-3 fw-bold"><i class="fa-solid fa-store me-1"></i>Your Salon Codes</h4>

            {{-- Salon List --}}
            <div id="salon-codes-list">
                @forelse ($salonCodes as $salonCode)
                    <div class="salon-code-item">
                        <div class="salon-code-info">
                            <i class="fa-regular fa-building salon-code-icon"></i>
                            <span class="salon-code-status">Active</span>
                            <div>
                                <div class="salon-name">{{ $salonCode->salon->salonname ?? 'Unknown Salon' }}</div>
                                <div class="salon-details">Code: {{ $salonCode->salon_code }}</div>
                                <div class="salon-details">Added: {{ optional($salonCode->created_at)->format('Y/m/d') }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            {{-- Delete--}}
                            <button type="button" class="btn text-danger" + data-bs-toggle="modal"
                                data-bs-target="#deleteSalonModal{{ $salonCode->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                    {{-- Modal--}}
                    <div class="modal fade" id="deleteSalonModal{{ $salonCode->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content border-danger">
                                <div class="modal-header border-danger">
                                    <h5 class="modal-title text-danger">Remove Salon Code</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to remove <span
                                            class="fw-bold">{{ $salonCode->salon_code }}</span>?</p>
                                    <p class="fw-light mb-0">
                                        This will unlink you from <span
                                            class="fw-bold">{{ $salonCode->salon->salonname ?? 'this salon' }}</span> and cannot
                                        be undone.
                                    </p>
                                </div>
                                <div class="modal-footer border-0">
                                    <form action="{{ route('mypage.salon.destroy', $salonCode) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger btn-sm">Remove Code</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted mt-4">
                        <p>No salon codes registered yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
