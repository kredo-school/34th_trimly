    @extends('layouts.pet_owner')

    @section('title', 'MyPage Pet')

    @push('styles')
        <style>
        </style>
    @endpush

    @section('header')
        @include('mypage.header.mypage')
    @endsection

    @section('content')
        <div class="container my-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('mypage.pets.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Add Pet
                </a>
            </div>

            <div class="row g-4">
                @forelse ($pets as $pet)
                    <div class="col-12 col-md-6">
                        <div class="card p-4">
                            <div class="pet-card-header d-flex justify-content-between align-items-center mb-4">
                                <div class="pet-name-display d-flex align-items-center">
                                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                                        <i class="fa-solid fa-heart me-2 fs-3"></i>
                                        {{ $pet->name }}
                                    </h5>
                                </div>
                                <div class="pet-actions">
                                    {{-- edit-button --}}
                                    <a href="{{ route('mypage.pets.edit', $pet->id) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    {{-- delete-button --}}
                                    <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deletePetModal{{ $pet->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Pet Name</label>
                                    <div class="form-control-readonly">
                                        <span class="value-text">{{ $pet->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Breed</label>
                                    <div class="form-control-readonly">
                                        <span class="value-text">{{ $pet->breed }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Age</label>
                                    <div class="form-control-readonly">
                                        <span class="value-text">{{ $pet->age }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Weight</label>
                                    <div class="form-control-readonly">
                                        <span class="value-text">{{ $pet->weight }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Gender</label>
                                    <div class="form-control-readonly">
                                        <span class="value-text">{{ $pet->gender }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Special Needs or Notes</label>
                                    <div class="form-control-readonly" style="min-height: 100px;">
                                        <span class="value-text">{{ $pet->notes }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modal section --}}
                    <div class="modal fade" id="deletePetModal{{ $pet->id }}" tabindex="-1"
                        aria-labelledby="deletePetModalLabel{{ $pet->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content border-danger">
                                <div class="modal-header border-danger">
                                    <div class="h5 modal-title text-danger" id="deletePetModalLabel{{ $pet->id }}">
                                        Remove Pet
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to remove <span class="fw-bold">{{ $pet->name }}</span>?
                                    </p>
                                    <p class="fw-light">This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer border-0">
                                    <form action="{{ route('mypage.pets.destroy', $pet->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted mt-5">
                        <p>No pets registered yet. Click "Add Pet" to get started!</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endsection
