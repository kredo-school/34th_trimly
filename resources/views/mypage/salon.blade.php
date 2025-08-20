@extends('layouts.pet_owner')

@section('title', 'MyPage Salons')

@push('styles')
    <style>
        /*入力フォームのデザイン*/
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

        /*サロンinfoのデザイン*/
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
                            <h4 class="card-title text-start mb-3 fw-bold">Add Salon Code</h4>
                            <p class="card-subtitle text-start mb-4">Enter a salon code to link a new salon to
                                your account</p>
                        </div>

                        <form action="#" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-inline"
                                    placeholder="Enter salon code (e.g., ABC123)" aria-label="Salon Code" name="salon_code"
                                    required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa-solid fa-plus me-2"></i> Add Code
                                </button>
                            </div>
                        </form>
                    </div>

                    <h4 class="card-header-main mb-3 fw-bold">Your Salon Codes</h3>

                        {{-- Salon List --}}
                        <div id="salon-codes-list">
                            {{-- @foreach ($salonCodes as $salonCode) --}}

                            {{-- ダミーデータ1 --}}
                            <div class="salon-code-item">
                                <div class="salon-code-info">
                                    <i class="fa-regular fa-building salon-code-icon"></i>
                                    <span class="salon-code-status">Active</span>
                                    <div>
                                        <div class="salon-name">Puppy Palace Downtown</div>
                                        <div class="salon-details">Code: PP02024</div>
                                        <div class="salon-details">Added: 10/01/2024</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteSalonModal1">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- ダミーデータ2 --}}
                            <div class="salon-code-item">
                                <div class="salon-code-info">
                                    <i class="fa-regular fa-building salon-code-icon"></i>
                                    <span class="salon-code-status">Active</span>
                                    <div>
                                        <div class="salon-name">Furry Friends Salon</div>
                                        <div class="salon-details">Code: FF52823</div>
                                        <div class="salon-details">Added: 05/12/2023</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteSalonModal2">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- @endforeach --}}

                            {{-- @empty($salonCodes) --}}
                            {{-- <div class="text-center text-muted mt-5">
                        <p>No salon codes registered yet.</p>
                    </div> --}}
                            {{-- @endempty --}}
                        </div>
               
            </div>
        </div>
        </div>
        </div>

        {{-- Include the modal here --}}
        @include('mypage.modal.delete-salon')
 @endsection