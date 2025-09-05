<div class="modal fade" id="deleteReserveModal{{ $appointment->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <h5 class="modal-title text-danger">Cancel Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this appointment?</p>
        <p><strong>Service:</strong> {{ $appointment->serviceItem->servicename }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</p>
        <p><strong>Salon:</strong> {{ $appointment->salon->salonname }}</p>
        <p class="fw-light mt-3">This action cannot be undone. Cancellation fees may apply depending on the salon’s policy.</p>
      </div>
      <div class="modal-footer border-0">
        <form action="{{ route('mypage.reservation.destroy', $appointment) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Keep Appointment</button>
          <button type="submit" class="btn btn-danger btn-sm">Cancel Appointment</button>
        </form>
      </div>
    </div>
  </div>
</div>