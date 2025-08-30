

    {{-- ダミーデータ１で --}}

    <div class="modal fade" id="editReserveModal1">
        <div class="modal-dialog">
            <div class="modal-content border-light">
                <div class="modal-header border-light">
                    <div class="h5 modal-title">
                        Edit Appointment
                    </div>
                </div>
                <form action="#" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="modal-body">
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
                        <button type="submit" class="btn btn-primary btn-sm"><i
                                class="fa-solid fa-save me-2"></i>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

