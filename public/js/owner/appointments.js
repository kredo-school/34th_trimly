/**
 * appointments.js
 * Appointments page specific functionality
 */

(function() {
    'use strict';

    // Execute after page is fully loaded
    window.addEventListener('load', function() {
        console.log('Appointments JS loaded');
        
        // Edit Appointment Button Handler
        initEditAppointmentHandlers();
        
        // Cancel Appointment Button Handler
        initCancelAppointmentHandlers();
        
        // Form Submit Handler
        initFormHandlers();
    });

    /**
     * Edit Appointment Handlers
     */
    function initEditAppointmentHandlers() {
        // Use event delegation
        document.addEventListener('click', function(e) {
            const editBtn = e.target.closest('.edit-appointment-btn');
            if (!editBtn) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Edit button clicked');
            
            // Close dropdown
            const dropdown = editBtn.closest('.dropdown');
            if (dropdown) {
                const dropdownToggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
                if (dropdownToggle) {
                    const bsDropdown = bootstrap.Dropdown.getInstance(dropdownToggle);
                    if (bsDropdown) bsDropdown.hide();
                }
            }
            
            // Get data
            const appointmentData = {
                id: editBtn.getAttribute('data-appointment-id'),
                customerName: editBtn.getAttribute('data-customer-name'),
                petId: editBtn.getAttribute('data-pet-id'),
                petOwnerId: editBtn.getAttribute('data-pet-owner-id'),
                serviceId: editBtn.getAttribute('data-service-id'),
                date: editBtn.getAttribute('data-date'),
                startTime: editBtn.getAttribute('data-start-time'),
                status: editBtn.getAttribute('data-status')
            };
            
            // Populate form with data
            populateEditForm(appointmentData);
            
            // Show modal with delay
            setTimeout(function() {
                showEditModal();
            }, 100);
        });
    }
    
    /**
     * Cancel Appointment Handlers
     */
    function initCancelAppointmentHandlers() {
        document.addEventListener('click', function(e) {
            const cancelBtn = e.target.closest('.cancel-appointment-btn');
            if (!cancelBtn) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            const appointmentId = cancelBtn.getAttribute('data-appointment-id');
            const customerName = cancelBtn.getAttribute('data-customer-name');
            const serviceName = cancelBtn.getAttribute('data-service-name');
            
            if (confirm(`Cancel appointment for ${customerName} (${serviceName})?`)) {
                cancelAppointment(appointmentId, cancelBtn);
            }
        });
    }
    
    /**
     * Form Submit Handler
     */
    function initFormHandlers() {
        const editForm = document.getElementById('editAppointmentForm');
        if (!editForm) return;
        
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitEditForm(this);
        });
        
        // Service/Time change handlers
        const serviceSelect = document.getElementById('editServiceId');
        const startTimeSelect = document.getElementById('editStartTime');
        const dateInput = document.getElementById('editDate');
        
        if (serviceSelect) {
            serviceSelect.addEventListener('change', function() {
                updateEndTimeDisplay();
                if (dateInput.value) {
                    updateAvailableTimeSlots(dateInput.value, startTimeSelect.value);
                }
            });
        }
        if (startTimeSelect) {
            startTimeSelect.addEventListener('change', updateEndTimeDisplay);
        }
        if (dateInput) {
            dateInput.addEventListener('change', function() {
                updateAvailableTimeSlots(this.value, startTimeSelect.value);
            });
        }
    }
    
    /**
     * Populate Edit Form
     */
    function populateEditForm(data) {
        document.getElementById('editAppointmentId').value = data.id;
        document.getElementById('editCustomerName').value = data.customerName;
        document.getElementById('editServiceId').value = data.serviceId;
        document.getElementById('editDate').value = data.date;
        document.getElementById('editStatus').value = data.status;
        
        // Set form action
        document.getElementById('editAppointmentForm').action = `/dashboard-salonowner/appointments/${data.id}`;
        
        // Populate pets
        const petSelect = document.getElementById('editPetId');
        petSelect.innerHTML = '<option value="">Select pet</option>';
        
        if (window.customerPetsData && window.customerPetsData[data.petOwnerId]) {
            window.customerPetsData[data.petOwnerId].forEach(pet => {
                const option = document.createElement('option');
                option.value = pet.id;
                option.textContent = pet.name;
                if (pet.id == data.petId) {
                    option.selected = true;
                }
                petSelect.appendChild(option);
            });
        }
        
        // Update time slots with availability check
        updateAvailableTimeSlots(data.date, data.startTime, data.id);
        
        // Update end time
        setTimeout(updateEndTimeDisplay, 50);
    }
    
    /**
     * Show Edit Modal
     */
    function showEditModal() {
        const modalElement = document.getElementById('editAppointmentModal');
        
        // Remove existing modal instance
        const existingModal = bootstrap.Modal.getInstance(modalElement);
        if (existingModal) {
            existingModal.dispose();
        }
        
        // Create and show new modal
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        });
        
        modal.show();
        console.log('Modal shown');
    }
    
    /**
     * Cancel Appointment
     */
    function cancelAppointment(appointmentId, button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Cancelling...';
        button.style.pointerEvents = 'none';
        
        fetch(`/dashboard-salonowner/appointments/${appointmentId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Appointment cancelled successfully');
                window.location.reload();
            } else {
                throw new Error(data.message || 'Failed to cancel appointment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to cancel appointment. Please try again.');
            button.innerHTML = originalText;
            button.style.pointerEvents = 'auto';
        });
    }
    
    /**
     * Submit Edit Form
     */
    function submitEditForm(form) {
        const appointmentId = document.getElementById('editAppointmentId').value;
        const formData = new FormData(form);
        
        const data = {
            appointment_date: formData.get('appointment_date'),
            appointment_time_start: formData.get('appointment_time_start'),
            status: formData.get('status'),
            pet_id: formData.get('pet_id'),
            service_item_id: formData.get('service_item_id'),
            _method: 'PUT'
        };
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
        
        fetch(`/dashboard-salonowner/appointments/${appointmentId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) return response.json().then(err => Promise.reject(err));
            return response.json();
        })
        .then(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editAppointmentModal'));
            if (modal) modal.hide();
            alert('Appointment updated successfully!');
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Failed to update appointment. Please try again.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    }
    
    /**
     * Update End Time Display
     */
    function updateEndTimeDisplay() {
        const serviceSelect = document.getElementById('editServiceId');
        const startTimeSelect = document.getElementById('editStartTime');
        const endTimeDisplay = document.getElementById('editEndTimeDisplay');
        
        if (!serviceSelect || !startTimeSelect || !endTimeDisplay) return;
        
        const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
        const startTime = startTimeSelect.value;
        
        if (!selectedService || !startTime || !selectedService.value) {
            endTimeDisplay.value = '';
            return;
        }
        
        const duration = parseInt(selectedService.getAttribute('data-duration') || '30');
        const [hours, minutes] = startTime.split(':').map(Number);
        
        let endHours = hours;
        let endMinutes = minutes + duration;
        
        while (endMinutes >= 60) {
            endHours++;
            endMinutes -= 60;
        }
        
        const endTime24 = `${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
        const endTime12 = new Date(`2000-01-01T${endTime24}`).toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
        
        endTimeDisplay.value = endTime12;
    }
    
    /**
     * Update Available Time Slots
     */
    function updateAvailableTimeSlots(selectedDate, currentTime, currentAppointmentId = null) {
        const startTimeSelect = document.getElementById('editStartTime');
        const serviceSelect = document.getElementById('editServiceId');
        if (!startTimeSelect || !serviceSelect) return;
        
        // Get selected service duration
        const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
        const duration = selectedService ? parseInt(selectedService.getAttribute('data-duration') || '30') : 30;
        
        // Clear and rebuild time slots
        const previousValue = startTimeSelect.value;
        startTimeSelect.innerHTML = '<option value="">Select start time</option>';
        
        // Business hours configuration
        const startHour = 9;  // 9 AM
        const endHour = 18;   // 6 PM
        
        // Generate time slots
        for (let hour = startHour; hour < endHour; hour++) {
            for (let minute of [0, 30]) {
                const time24 = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                const slotStart = hour * 60 + minute;
                const slotEnd = slotStart + duration;
                
                // Check if slot is available
                let isAvailable = true;
                
                // Check against booked slots
                if (window.bookedSlots) {
                    for (let booked of window.bookedSlots) {
                        // Skip if it's the current appointment being edited
                        if (currentAppointmentId && booked.id == currentAppointmentId) continue;
                        
                        // Convert booked times to minutes
                        const bookedStart = timeToMinutes(booked.start);
                        const bookedEnd = timeToMinutes(booked.end);
                        
                        // Check for overlap
                        if (!(slotEnd <= bookedStart || slotStart >= bookedEnd)) {
                            isAvailable = false;
                            break;
                        }
                    }
                }
                
                // Check if end time exceeds business hours
                if (slotEnd > endHour * 60) {
                    isAvailable = false;
                }
                
                // Create option
                const option = document.createElement('option');
                option.value = time24;
                
                // Format display time
                const displayTime = new Date(`2000-01-01T${time24}`).toLocaleTimeString('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
                
                if (!isAvailable) {
                    option.disabled = true;
                    option.textContent = `${displayTime} (Unavailable)`;
                } else {
                    option.textContent = displayTime;
                }
                
                startTimeSelect.appendChild(option);
            }
        }
        
        // Restore previous value if available
        if (previousValue || currentTime) {
            startTimeSelect.value = previousValue || currentTime;
        }
        
        // Update end time
        updateEndTimeDisplay();
    }
    
    /**
     * Convert time string to minutes
     */
    function timeToMinutes(timeStr) {
        const [hours, minutes] = timeStr.split(':').map(Number);
        return hours * 60 + minutes;
    }

})();