    @extends('layouts.pet_owner')

    @section('title', 'MyPage Pet-Edit')

    @push('styles')
        <style>
        </style>
    @endpush

    @section('header')
        @include('mypage.header.mypage')
    @endsection

    @section('content')
        <div class="container my-4">
            {{-- Success message display --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                {{-- Edit form container --}}
                <div class="col-12 col-md-10 col-lg-8">
                    <a href="{{ route('mypage.pets.index') }}" class="mb-4"><i class="fa-solid fa-arrow-left me-2"></i>Back
                        to My Pets</a>
                    <div class="card p-4">
                        <div class="pet-card-header d-flex justify-content-between align-items-center mb-4">
                            <div class="pet-name-display d-flex align-items-center">
                                <h5 class="mb-0 fw-bold d-flex align-items-center">
                                    <i class="fa-solid fa-heart me-2 fs-3"></i>
                                    {{ $pet->name }}
                                </h5>
                            </div>
                            <div class="pet-actions">
                                <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal"
                                    data-bs-target="#deletePetModal{{ $pet->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>

                        <form action="{{ route('mypage.pets.update', $pet->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Pet Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control form-control-inline @error('name') is-invalid @enderror"
                                        value="{{ old('name', $pet->name) }}" autofocus>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Breed</label>
                                    <input type="text" name="breed" id="breed"
                                        class="form-control form-control-inline @error('breed') is-invalid @enderror"
                                        value="{{ old('breed', $pet->breed) }}" autofocus>
                                    @error('breed')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Age</label>
                                    <select name="age" id="age"
                                        class="form-select form-control-inline-select @error('age') is-invalid @enderror">
                                        <option value="0-1 year"
                                            {{ old('age', $pet->age) == '0-1 year' ? 'selected' : '' }}>0-1 year
                                        </option>
                                        <option value="1-3 years"
                                            {{ old('age', $pet->age) == '1-3 years' ? 'selected' : '' }}>1-3 years
                                        </option>
                                        <option value="3-7 years"
                                            {{ old('age', $pet->age) == '3-7 years' ? 'selected' : '' }}>3-7 years
                                        </option>
                                        <option value="7+ years"
                                            {{ old('age', $pet->age) == '7+ years' ? 'selected' : '' }}>7+ years
                                        </option>
                                    </select>
                                    @error('age')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Weight</label>
                                    <select name="weight" id="weight"
                                        class="form-select form-control-inline-select @error('weight') is-invalid @enderror">
                                        <option value="0-5 kg"
                                            {{ old('weight', $pet->weight) == '0-5 kg' ? 'selected' : '' }}>0-5 kg
                                        </option>
                                        <option value="5-10 kg"
                                            {{ old('weight', $pet->weight) == '5-10 kg' ? 'selected' : '' }}>5-10 kg
                                        </option>
                                        <option value="10-20 kg"
                                            {{ old('weight', $pet->weight) == '10-20 kg' ? 'selected' : '' }}>10-20 kg
                                        </option>
                                        <option value="20+ kg"
                                            {{ old('weight', $pet->weight) == '20+ kg' ? 'selected' : '' }}>20+ kg
                                        </option>
                                    </select>
                                    @error('weight')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" id="gender"
                                        class="form-select form-control-inline-select @error('gender') is-invalid @enderror">
                                        <option value="Male"
                                            {{ old('gender', $pet->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female"
                                            {{ old('gender', $pet->gender) == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Unknown"
                                            {{ old('gender', $pet->gender) == 'Unknown' ? 'selected' : '' }}>Unknown
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Special Needs or Notes</label>
                                    <textarea name="notes" id="notes"
                                        class="form-control form-control-textarea-inline @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $pet->notes) }}</textarea>
                                    @error('notes')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('mypage.pets.index') }}" class="btn btn-cancel me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-regular fa-floppy-disk me-2"></i>Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="deletePetModal{{ $pet->id }}" tabindex="-1"
            aria-labelledby="deletePetModalLabel{{ $pet->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-danger">
                    <div class="modal-header border-danger">
                        <div class="h5 modal-title text-danger" id="deletePetModalLabel{{ $pet->id }}">
                            Remove Pet
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to remove <span class="fw-bold">{{ $pet->name }}</span>?</p>
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
    @endsection
