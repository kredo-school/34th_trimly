<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">

    <style>
        /* 独自スタイルとしてBlade内に残すCSS */
        /* Step（JuriバージョンがCSSに入ってきたら撤去 */
        .step-item-active .step-circle {
            background-color: #ab8b73;
            /* アクティブなステップの色 */
            border-color: #ab8b73;
            color: #fff;
            /* 数字の色 */
            position: relative;
            /* z-indexを効かせるため */
            z-index: 2;
            /* 線より手前に来るように */
        }

        .step-item-active .step-text {
            color: #ab8b73;
            /* アクティブなステップのテキスト色 */
            font-weight: bold;
            position: relative;
            /* z-indexを効かせるため */
            z-index: 2;
            /* 線より手前に来るように */
            background-color: #FEFCF1;
            /*bodyと同じ背景色を設定して線が文字を透けないように */
        }

        .step-item-inactive .step-circle {
            background-color: #e0e0e0;
            /* 未完了ステップの背景色 */
            border-color: #e0e0e0;
            color: #fff;
            /* 数字の色 */
            position: relative;
            /* z-indexを効かせるため */
            z-index: 2;
            /* ★追加: 線より手前に来るように */
        }

        .step-item-inactive .step-text {
            color: #e0e0e0;
            /* 未完了ステップのテキスト色 */
            position: relative;
            z-index: 2;
            background-color: #FEFCF1;
        }

        /* ステップ円の固定サイズ*/
        .w-40px {
            width: 40px;
        }

        .h-40px {
            height: 40px;
        }

        /* ステップ間の線 */
        .step-line {
            flex-grow: 1;
            /* 親のFlexboxコンテナ内で利用可能なスペースを埋める */
            height: 3px;
            /* 線の太さ */
            background-color: #e0e0e0;
            /* 線の色 */
            margin: 0 20px;
            /* 線と丸の間のスペース */
            align-self: flex-start;
            /* 親のFlexアイテムの上端に寄せる */
            margin-top: 19px;
            /* step-circle (40px) の中心に線が来るように調整 (40px/2 - 2px/2 = 19px) */
            z-index: -1;
            /*線を円やテキストの裏に隠す */
        }

        /* ★step-indicatorにz-indexの基準を設定 */
        .step-indicator {
            position: relative;
            /* 子要素のz-indexの基準とする */
            z-index: 1;
            /* 他の要素と重なったときの順序 */
        }


        /* Inputフォームのデザイン */
        .input-group-custom {
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .input-group-text-custom {
            background-color: var(--color-background);
            border: none;
            color: var(--color-text-secondary);
            padding-right: var(--spacing-sm);
        }

        .input-group .form-control {
            background-color: var(--color-background);
            border: none;
            border-radius: 0;
            padding-left: 0;
        }

        /* バックボタンのデザイン */
        .btn-back {
            background-color: #FEFCF1;
            border: 1px solid #ccc;
            color: #6c757d;
            font-weight: bold;
            border-radius: 8px;
            padding: 12px 25px;
        }

        /* Add petボタンのデザイン */
        .btn-add-pet {
            background-color: #FEFCF1;
            color: #666;
            font-weight: bold;
            border: 2px solid #e0e0e0;
        }

        .btn-add-pet:hover {
            background-color: #f5f5f5;
        }

        /* Petカードの背景 */
        .pet-card {
            background-color: #f9f5f2;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        /* placeholderのパディングを調整 */
        .input-group-custom .form-control {
            padding-left: 10px;
        }

    </style>
</head>

<body>
    @include('pet_owner.register.header')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-container" style="max-width: 800px; width: 90%; margin: auto;">

                    {{-- Step --}}
                    <nav class="d-flex justify-content-between align-items-center mt-2 mb-5 step-indicator">
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="step-text mt-2 fs-6">Salon Code</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="step-text mt-2 fs-6">Pet Owner</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-active step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                3</div>
                            <div class="step-text mt-2 fs-6">Pets</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                4</div>
                            <div class="step-text mt-2 fs-6">Confirm</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="d-flex flex-column align-items-center step-item-inactive step-item">
                            <div
                                class="step-circle d-flex justify-content-center align-items-center w-40px h-40px rounded-circle fs-5 fw-bold">
                                5</div>
                            <div class="step-text mt-2 fs-6">Complete</div>
                        </div>
                    </nav>

                    {{-- Card --}}
                    <div class="card p-4 mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="card-title text-start  mb-3 fw-bold"><i
                                            class="fa-regular fa-heart text-danger me-2"></i>Pet Information</h4>
                                    <p class="card-subtitle text-muted text-start mb-4">Tell us about your beloved pets
                                    </p>
                                </div>
                                <button type="button" class="btn btn-add-pet"><i class="fa-solid fa-plus me-2"></i>Add
                                    Pet</button>
                            </div>


                            <form action="#" method="post">
                                @csrf

                                <div class="pet-card" id="petCard1">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold text-muted mb-3">Pet 1</h5>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-pet-button"
                                            data-target-card="petCard1">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
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
                                                    <option selected disabled value="">Select weight range
                                                    </option>
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
                                        <label for="specialNotes1" class="form-label">Special Needs or
                                            Notes</label>
                                        <div class="input-group input-group-custom">
                                            <textarea class="form-control" id="specialNotes1" rows="3"
                                                placeholder="Any special care instructions, behavioral notes, medical conditions, etc."></textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- 新しいペットカードがJavaScriptでここに追加される想定のコンテナ --}}
                                <div id="petCardsContainer"></div>


                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-back">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Continue <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/register.add_pet.js') }}" defer></script>
</body>

</html>
