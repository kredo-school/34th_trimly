<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mypage Pet Edit</title>
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
    
       .form-control-inline {
            background-color: #FEFCF1 !important; /* 背景色を追加 */
            border: 1px solid #e0e0e0; /* 既存の読み取り専用フィールドと揃えるためにボーダーを追加 */
            border-radius: 10px; /* 既存の読み取り専用フィールドと揃えるために角丸を追加 */
            padding: 12px 15px; /* 既存の読み取り専用フィールドと揃えるためにパディングを追加 */
            color: #333; /* テキストの色 */
            font-size: 1rem;
            height: auto;
            flex-grow: 1;
            box-shadow: none; /*デフォルトの focus 時の影を削除*/
        }
       

        .form-control-inline-select {
            background-color: #FEFCF1 !important; /* 背景色を追加 */
            border: 1px solid #e0e0e0; /* ボーダーを追加 */
            border-radius: 10px; /* 角丸を追加 */
            padding: 12px 15px; /* パディングを追加 */
            color: #333; /* テキストの色 */
            font-size: 1rem;
            height: auto;
            flex-grow: 1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

       
        .form-control-textarea-inline {
            background-color: #FEFCF1 !important; /* 背景色を追加 */
            border: 1px solid #e0e0e0; /* ボーダーを追加 */
            border-radius: 10px; /* 角丸を追加 */
            padding: 12px 15px; /* パディングを追加 */
            color: #333; /* テキストの色 */
            font-size: 1rem;
            height: auto;
            min-height: 100px;
            flex-grow: 1;
            resize: vertical;
            box-shadow: none; /* デフォルトの focus 時の影を削除 */
        }

        
        /* キャンセルボタンのスタイル */
        .btn-cancel {
            background-color: #FEFCF1 !important;
            color: #666;
            border: 1px solid #e0e0e0;
            height: 40px;
            padding: 0 20px;
        }
        .btn-cancel:hover {
            background-color: #e0e0e0;
            color: #6c757d;
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
           
            {{-- @foreach($pets as $pet)  --}}
            <div class="col-12 col-md-6"> 
                <div class="card p-4">
                    <div class="pet-card-header d-flex justify-content-between align-items-center mb-4"">
                        <div class="pet-name-display fs-3">
                            <i class="fa-solid fa-heart"></i>
                            <span>#</span> 
                        </div>
                        <div class="pet-actions">
                            {{--delete-button--}}
                            <button type="button" class="btn pet-action-btn text-danger" data-bs-toggle="modal" data-bs-target="#deletePetModal1">
                                <i class="fa-solid fa-trash-can"></i> 
                            </button>
                        </div>
                     
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row"> 
                            <div class="col-md-6">
                                <label class="form-label">Pet Name</label>
                                <input type="text" name="petName" id="petName" class="form-control form-control-inline" value="John" autofocus>{{-- DBからのデータ表示 --}}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Breed</label>
                                <input type="text" name="breed1" id="breed" class="form-control form-control-inline" value="Smith" autofocus>{{-- DBからのデータ表示 --}}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Age</label>
                                <select name="age" id="age" class="form-select form-control-inline-select">
                                    <option value="0-1 year" selected>0-1 year</option>
                                    <option value="1-3 years">1-3 years</option>
                                    <option value="3-7 years">3-7 years</option>
                                    <option value="7+ years">7+ years</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Weight</label>
                               <select name="weight" id="weight" class="form-select form-control-inline-select">
                                    <option value="0-5 kg" selected>0-5 kg</option>
                                    <option value="5-10 kg">5-10 kg</option>
                                    <option value="3-7 years">3-7 years</option>
                                    <option value="10-20 kg">10-20 kg</option>
                                </select>
                            </div>
                            <div class="col-12"> 
                                <label class="form-label">Gender</label>
                                <select name="weight" id="weight" class="form-select form-control-inline-select">
                                    <option value="Male" selected>0-5 kg</option>
                                    <option value="Female">5-10 kg</option>
                                    <option value="Unknown">3-7 years</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <label class="form-label">Special Needs or Notes</label>
                                 <textarea name="specialNotes" id="specialNotes" class="form-control form-control-textarea-inline" rows="3">#</textarea>                   
                            </div>

                             <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-cancel me-2">Cancel</button>
                                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save Changes</button>
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