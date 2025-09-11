  {{-- Edit Modal --}}
<div class="modal fade" id="editReserveModal{{ $appointment->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-light">

      <div class="modal-header border-light">
        <h5 class="modal-title">Edit Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('mypage.reservation.update', $appointment) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="modal-body">
          <p class="mb-3">Edit your appointment for <strong>{{ $appointment->serviceItem->servicename }}</strong>.</p>

          {{-- Date --}}
          <div class="mb-3">
            <label for="appointment_date{{ $appointment->id }}" class="form-label">Date</label>
            <input type="date" class="form-control"
                   id="appointment_date{{ $appointment->id }}"
                   name="appointment_date"
                   value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}" required>
          </div>

          {{-- Time --}}
          <div class="mb-3">
            <label for="appointment_time_start{{ $appointment->id }}" class="form-label">Time</label>
            <select name="appointment_time_start"
                    id="appointment_time_start{{ $appointment->id }}"
                    class="form-select" required>
              @forelse ($availableSlots[$appointment->id] ?? [] as $slot)
                <option value="{{ $slot }}"
                    {{ \Carbon\Carbon::parse($appointment->appointment_time_start)->format('H:i') == $slot ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
                </option>
              @empty
                <option disabled>(No available slots)</option>
              @endforelse
            </select>
          </div>

          {{-- Service Item --}}
          <div class="mb-3">
            <label for="service_item_id{{ $appointment->id }}" class="form-label">Service Menu</label>
            <select name="service_item_id"
                    id="service_item_id{{ $appointment->id }}"
                    class="form-select" required>
              @foreach ($appointment->salon->serviceItems as $service)
                <option value="{{ $service->id }}"
                    {{ $appointment->service_item_id == $service->id ? 'selected' : '' }}>
                    {{ $service->servicename }} ({{ $service->price }}円 / {{ $service->duration }}分)
                </option>
              @endforeach
            </select>
          </div>

        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-save me-2"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>