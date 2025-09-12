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
    // Search input submit with debounce
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });
    }

    // Status filter - Fixed to only target status filter dropdown
    document.querySelectorAll('.owner-status-dropdown + .dropdown-menu [data-status]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const statusInput = document.getElementById('statusInput');
            if (statusInput) {
                statusInput.value = this.dataset.status;
                document.getElementById('filterForm').submit();
            }
        });
    });

    // Cancel appointment
    document.querySelectorAll('.cancel-appointment').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent dropdown from closing
            
            const id = this.dataset.id;
            const customer = this.dataset.customer;
            const service = this.dataset.service;
            
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
    });
});