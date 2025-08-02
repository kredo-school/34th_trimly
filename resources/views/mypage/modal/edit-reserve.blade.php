<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mypage Edit Appointment</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
</head>
<style>
    /* Save Changes ボタンのスタイル */
    .btn-save-changes {
        background-color: #a68c76 !important;
        color: #fff !important;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-size: 1rem;
        font-weight: 600;
        box-shadow: none;
        gap: 8px;
    }

    .btn-save-changes:hover {
        background-color: #8c7664;
        color: #fff;
    }
</style>

<body>

    {{-- ダミーデータ１で --}}

    <div class="modal fade" id="editReserveModal1">
        <div class="modal-dialog">
            <div class="modal-content border-light">
                <div class="modal-header border-light">
                    <div class="h5 modal-title text-muted">
                        Edit Appointment
                    </div>
                </div>
                <form action="#" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="modal-body text-muted">
                        <p> Make changes to your appointment details. Your groomer will be notified of any changes.</p>

                        <div class="mb-3">
                            <label for="service" class="form-label">Service</label>
                            <select name="service" id="service" class="form-select form-control-inline-select">
                                <option value="basic_trim">Basic Trim</option>
                                <option value="full_grooming_package" selected>Full Grooming Package</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control form-control-inline"
                                value="2024-07-09">
                        </div>

                        <div class="mb-4">
                            <label for="time" class="form-label">Time</label>
                            <select name="time" id="time" class="form-select form-control-inline-select">
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="14:00" selected>2:00 PM</option>
                            </select>
                        </div>
                    </div>


                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-save-changes btn-sm"><i
                                class="fa-solid fa-save me-2"></i>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


</body>

</html>
