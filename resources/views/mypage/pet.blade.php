<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mypage Pet</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}"> --}}

    <style>
        /* 読み取り専用フィールド */
        .form-control-readonly {
            background-color: #FEFCF1;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            color: #333;
            font-size: 1rem;
            display: flex;
            align-items: center;
            min-height: calc(2.25rem + 2px);
            /* Bootstrap form-control の高さに合わせる */
        }

        .form-control-readonly .fa-solid {
            color: #a68c76;
            margin-right: 10px;
        }

        .form-control-readonly .value-text {
            flex-grow: 1;
            /* テキストが残りのスペースを占める */
            color: #adb5bd;
        }
    </style>
</head>

<body>
    @include('mypage.header.mypage')

    <div class="container my-4">
        <div class="d-flex justify-content-end mb-4">
            <button type="button" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add Pet
            </button>
        </div>


        <div class="row g-4">

            {{-- @foreach ($pets as $pet)  --}}
            <div class="col-12 col-md-6">
                <div class="card p-4">
                    <div class="pet-card-header d-flex justify-content-between align-items-center mb-4"">
                        <div class="pet-name-display fs-3">
                            <i class="fa-solid fa-heart"></i>
                            <span>#</span>
                        </div>
                        <div class="pet-actions">
                            {{-- edit-button --}}
                            <button type="button" class="btn btn-primary">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            {{-- delete-button --}}
                            <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal" data-bs-target="#deletePetModal1">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Pet Name</label>
                                <div class="form-control-readonly">
                                    <span class="value-text">#</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Breed</label>
                                <div class="form-control-readonly">
                                    <span class="value-text">#</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Age</label>
                                <div class="form-control-readonly">
                                    <span class="value-text">#</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Weight</label>
                                <div class="form-control-readonly">
                                    <span class="value-text">#</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gender</label>
                                <div class="form-control-readonly">
                                    <span class="value-text">#</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Special Needs or Notes</label>
                                <div class="form-control-readonly" style="min-height: 100px;"> {{-- テキストエリアのように高さを確保 --}}
                                    <span class="value-text">#</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- @endforeach --}}


            {{-- @empty($pets) --}}
            <div class="col-12 text-center text-muted mt-5">
                <p>No pets registered yet. Click "Add Pet" to get started!</p>
            </div>
            {{-- @endempty --}}

        </div>
    </div>
    {{-- Include the modal here --}}
    @include('mypage.modal.delete-pet')
</body>

</html>
