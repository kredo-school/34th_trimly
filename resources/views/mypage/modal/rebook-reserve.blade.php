{{-- Rebook Modal --}}
<div class="modal fade" id="rebookReserveModal1" tabindex="-1" aria-labelledby="rebookReserveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary bg-light">
                <h5 class="modal-title text-primary" id="rebookReserveModalLabel1">
                    Rebook Appointment
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="mb-3">Choose a new date and time for your appointment.</p>

                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="appointment_time_start" class="form-label">Time</label>
                        <input type="time" class="form-control" id="appointment_time_start" name="appointment_time_start" required>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-calendar-plus me-2"></i> Rebook
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>