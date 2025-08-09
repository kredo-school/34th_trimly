<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Pet</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

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
            padding: 0.75rem 1rem; /* アイコン側のパディングも調整して高さを揃える */
        }
        /* input-group内のform-controlのボーダーと角丸を調整 */
        .input-group .form-control {
            background-color: #FEFCF1;
            border: none;
            border-radius: 0; /* 角丸を削除 (input-group-customに任せる) */
            
        }

        /*カード詳細背景のデザイン*/
        .pet-card {
            background-color: #f9f5f2;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            text-align: left;
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
    @include('mypage.header.add-pet')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                
                <a href="#"><i class="fa-solid fa-arrow-left me-2 mb-2"></i>Back to My Pets</a>
                <h2 class="text-start fw-bold">Add New Pat</h2>
                <p class="text-start mb-4">Tell us about your beloved pets</p>
                <div class="card p-4 mb-4 shadow-sm">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title text-start mb-3 fw-bold"><i class="fa-regular fa-heart me-2"></i>Pet Information</h4>
                            <p class="card-subtitle text-start mb-4">Enter your pet's details below</p>
                        </div>
                    </div>


                    <form action="#" method="post">
                        @csrf

                        <div class="pet-card" id="petCard1">
                            <h5 class="fw-bold mb-3"><i class="fa-regular fa-heart me-2"></i>Pet details</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3 text-start">
                                    <label for="petName1" class="form-label">Pet Name <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <input type="text" class="form-control" id="petName1"
                                            placeholder="Enter pet's name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 text-start">
                                    <label for="breed1" class="form-label">Breed <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <input type="text" class="form-control" id="breed1"
                                            placeholder="Enter breed" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 text-start">
                                    <label for="age1" class="form-label">Age <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <select class="form-select form-control" id="age1" required>
                                            <option selected disabled value="">Select age</option>
                                            <option>0-1 year</option>
                                            <option>1-3 years</option>
                                            <option>3-7 years</option>
                                            <option>7+ years</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 text-start">
                                    <label for="weight1" class="form-label">Weight <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-custom">
                                        <select class="form-select form-control" id="weight1" required>
                                            <option selected disabled value="">Select weight range</option>
                                            <option>0-5 kg</option>
                                            <option>5-10 kg</option>
                                            <option>10-20 kg</option>
                                            <option>20+ kg</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 text-start">
                                <label for="gender1" class="form-label">Gender <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <select class="form-select form-control" id="gender1" required>
                                        <option selected disabled value="">Select gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Unknown</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 text-start">
                                <label for="specialNotes1" class="form-label">Special Needs or Notes</label>
                                <div class="input-group input-group-custom">
                                    <textarea class="form-control" id="specialNotes1" rows="3"
                                        placeholder="Any special care instructions, behavioral notes, medical conditions, etc."></textarea>
                                </div>
                            </div>
                        </div>
                   
                        <div class="d-flex justify-content-between mt-4">
                             {{--Cancel--}}
                            <button type="button" class="btn btn-cancel">
                                <i class="fa-solid fa-arrow-left me-2"></i>Cancel
                            </button>
                             {{--Add Pet--}}
                            <button type="submit" class="btn btn-primary">
                               <i class="fa-regular fa-floppy-disk me-2"></i>Add Pet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
    </div>
  
       
</body>

</html>
