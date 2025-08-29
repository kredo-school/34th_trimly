

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
