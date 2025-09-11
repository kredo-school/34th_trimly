{{-- Rebook Modal --}}
<div class="modal fade" id="rebookReserveModal{{ $appointment->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-primary">

            {{-- Header --}}
            <div class="modal-header border-primary bg-light">
                <h5 class="modal-title text-primary">Rebook Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- Form --}}
            <form action="{{ route('mypage.reservation.rebook', $appointment->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="mb-3">Choose a new date and time for your appointment.</p>

                    {{-- Date --}}
                    <div class="mb-3">
                        <label for="appointment_date{{ $appointment->id }}" class="form-label">Date</label>
                        <input type="date" class="form-control" id="appointment_date{{ $appointment->id }}"
                            name="appointment_date"
                            value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
                            required>
                    </div>

                    {{-- Time --}}
                    <div class="mb-3">
                        <label for="appointment_time_start{{ $appointment->id }}" class="form-label">Time</label>
                        <select name="appointment_time_start" id="appointment_time_start{{ $appointment->id }}"
                            class="form-select" required>
                            @forelse ($slots as $slot)
                                <option value="{{ $slot }}">
                                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
                                </option>
                            @empty
                                <option disabled>(No available slots)</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-primary btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-calendar-plus me-2"></i> Rebook
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
