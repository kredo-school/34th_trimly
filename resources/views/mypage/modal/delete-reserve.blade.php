<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mypage Cancel Appointment</title>
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
<body>

    {{--ダミーデータ１で--}}

 <div class="modal fade" id="deleteReserveModal1">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-danger">
                   Cancel Appointment
                </div>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to cansel this appointment for <span class="fw-bold">#</span>?</p>
                <p><span class="fw-bold">Service:</span>#</p>
                <p><span class="fw-bold">Date:</span>#</p>
                <p><span class="fw-bold">Salon:</span>#</p>
                <br>
                <br>
                <p class="fw-light">This action cannot be undone. You may be subject to cansellation fees depending on your salon's policy. </p>                
            </div>

            <div class="modal-footer border-0">
                <form action="#" method="post">
                    @csrf
                    @method('DELETE')

                    <div>
                        <button type="button" class="btn btn-outline-danger btn-sm"data-bs-dismiss="modal">Keep Appointment</button>
                        <button type="submit" class="btn btn-danger btn-sm">Cancel Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>