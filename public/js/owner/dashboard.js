/**
 * Navigation Menu Functions
 */
function toggleMenu() {
    const dropdown = document.getElementById('menuDropdown');
    const menuBtn = document.getElementById('menuBtn');
    
    if (dropdown && menuBtn) {
        dropdown.classList.toggle('show');
        menuBtn.classList.toggle('active');
    }
}

// Click outside to close menu
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('menuDropdown');
    const menuBtn = document.getElementById('menuBtn');
    
    if (dropdown && menuBtn && !menuBtn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
        menuBtn.classList.remove('active');
    }
});

// Copy salon code function
function copySalonCode() {
    const codeElement = document.getElementById('salonCodeDisplay');
    if (!codeElement) return;
    
    const code = codeElement.textContent.trim();
    
    navigator.clipboard.writeText(code).then(() => {
        const btn = document.getElementById('copyCodeBtn');
        if (btn) {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
            }, 2000);
        }
    }).catch(err => {
        console.error('Failed to copy:', err);
        alert('Failed to copy code. Please try again.');
    });
}

// Logout function
function logout(event) {
    if (event) {
        event.preventDefault();
    }
    
    // Create form for POST request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/salon-owner/logout';
    
    // Add CSRF token
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = token.getAttribute('content');
        form.appendChild(csrfInput);
    }
    
    // Submit form
    document.body.appendChild(form);
    form.submit();
}

// Appointments page functionality
document.addEventListener('DOMContentLoaded', function() {
    // Only run on appointments page
    if (!document.getElementById('filterForm')) return;
    
    // Search input submit with debounce
    const searchInput = document.getElementById('searchInput');
    const statusInput = document.getElementById('statusInput');
    const filterForm = document.getElementById('filterForm');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 500);
        });
    }

    // Status filter dropdown
    const dropdownItems = document.querySelectorAll('.dropdown-menu .dropdown-item[data-status]');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const status = this.getAttribute('data-status');
            if (status !== null) {
                statusInput.value = status;
                filterForm.submit();
            }
        });
    });

    // Edit Appointment functionality - Event delegation approach
    document.addEventListener('click', function(e) {
        const editButton = e.target.closest('.edit-appointment');
        if (!editButton) return;
        
        // e.preventDefault();
        // e.stopPropagation();
        
        // Close any open dropdowns
        const dropdowns = document.querySelectorAll('.dropdown-menu.show');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });
        
        // Get appointment data using getAttribute (more reliable)
        const appointmentId = editButton.getAttribute('data-id');
        const customerName = editButton.getAttribute('data-customer');
        const serviceName = editButton.getAttribute('data-service');
        const date = editButton.getAttribute('data-date');
        const startTime = editButton.getAttribute('data-start-time');
        const endTime = editButton.getAttribute('data-end-time');
        const status = editButton.getAttribute('data-status');
        
        // Wait a moment for dropdown to close
        setTimeout(() => {
            // Populate modal fields
            document.getElementById('editAppointmentId').value = appointmentId || '';
            document.getElementById('editCustomerName').value = customerName || '';
            document.getElementById('editServiceName').value = serviceName || '';
            document.getElementById('editDate').value = date || '';
            document.getElementById('editStartTime').value = startTime || '';
            document.getElementById('editEndTime').value = endTime || '';
            document.getElementById('editStatus').value = status || '1';
            
            // Set form action
            const form = document.getElementById('editAppointmentForm');
            form.action = `/dashboard-salonowner/appointments/${appointmentId}`;
            
            // Show modal
            const modalElement = document.getElementById('editAppointmentModal');
            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
        }, 100);
    });

    // Cancel appointment - Event delegation approach
    document.addEventListener('click', function(e) {
        const cancelButton = e.target.closest('.cancel-appointment');
        if (!cancelButton) return;
        
        e.preventDefault();
        e.stopPropagation();
        
        const id = cancelButton.getAttribute('data-id');
        const customer = cancelButton.getAttribute('data-customer');
        const service = cancelButton.getAttribute('data-service');
        
        if (confirm(`Cancel appointment for ${customer} (${service})?`)) {
            fetch(`/dashboard-salonowner/appointments/${id}/cancel`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Edit form submit handler
    const editAppointmentForm = document.getElementById('editAppointmentForm');
    if (editAppointmentForm) {
        editAppointmentForm.addEventListener('submit', function(e) {
            // Allow normal form submission
            // The controller will handle the redirect
        });
    }
});