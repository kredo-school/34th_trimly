// navigaation//
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    mobileNav.classList.toggle('show');
}
// Salon Code Modal Scripts//

// Generate salon code
function generateSalonCode() {
    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numbers = '0123456789';
    let code = 'TRIMLY';
    
    // Add current year
    code += new Date().getFullYear();
    
    return code;
}

// Salon Code Modal Scripts //

    // Generate salon code
    function generateSalonCode() {
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const numbers = '0123456789';
        let code = 'TRIMLY';
        
        // Add current year
        code += new Date().getFullYear();
        
        return code;
    }

    // Copy code to clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Change button text temporarily
            const copyBtn = document.getElementById('copyCodeBtn');
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            copyBtn.classList.add('copied');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.classList.remove('copied');
            }, 2000);
        }, function(err) {
            console.error('Could not copy text: ', err);
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            
            const copyBtn = document.getElementById('copyCodeBtn');
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            copyBtn.classList.add('copied');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.classList.remove('copied');
            }, 2000);
        });
    }

    // Modal event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Generate salon code when modal is opened
        const salonCodeModal = document.getElementById('salonCodeModal');
        if (salonCodeModal) {
            salonCodeModal.addEventListener('show.bs.modal', function() {
                const code = generateSalonCode();
                document.getElementById('salonCodeDisplay').textContent = code;
            });

            // Copy button click handler
            const copyBtn = document.getElementById('copyCodeBtn');
            if (copyBtn) {
                copyBtn.addEventListener('click', function() {
                    const code = document.getElementById('salonCodeDisplay').textContent;
                    copyToClipboard(code);
                });
            }
        }
    });

    // Menu toggle function (existing)
    function toggleMenu() {
        const dropdown = document.getElementById('menuDropdown');
        dropdown.classList.toggle('show');
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const menuDropdown = document.getElementById('menuDropdown');
        const menuBtn = document.getElementById('menuBtn');
        
        if (!menuBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
            menuDropdown.classList.remove('show');
        }
    });

// Modal event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Generate salon code when modal is opened
    const salonCodeModal = document.getElementById('salonCodeModal');
    if (salonCodeModal) {
        salonCodeModal.addEventListener('show.bs.modal', function() {
            const code = generateSalonCode();
            document.getElementById('salonCodeDisplay').textContent = code;
        });

        // Copy button click handler
        const copyBtn = document.getElementById('copyCodeBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function() {
                const code = document.getElementById('salonCodeDisplay').textContent;
                copyToClipboard(code);
            });
        }
    }
});

// Menu toggle function (existing)
function toggleMenu() {
    const dropdown = document.getElementById('menuDropdown');
    dropdown.classList.toggle('show');
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const menuDropdown = document.getElementById('menuDropdown');
    const menuBtn = document.getElementById('menuBtn');
    
    if (!menuBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
        menuDropdown.classList.remove('show');
    }
});

  // Menu dropdown toggle
  function toggleMenu() {
    const dropdown = document.getElementById('menuDropdown');
    const btn = document.getElementById('menuBtn');
    const icon = btn.querySelector('i');
    
    dropdown.classList.toggle('show');
    
    if (dropdown.classList.contains('show')) {
        icon.style.transform = 'rotate(180deg)';
    } else {
        icon.style.transform = 'rotate(0deg)';
    }
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('menuDropdown');
    const btn = document.getElementById('menuBtn');
    
    if (!btn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
        btn.querySelector('i').style.transform = 'rotate(0deg)';
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Salon Owner navigation loaded');
});

// Owner - appointment  
document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const searchInput = document.getElementById('searchInput');
    const appointmentItems = document.querySelectorAll('.owner-appointment-item');
    const emptyState = document.getElementById('emptyState');
    const statusDropdownItems = document.querySelectorAll('.dropdown-item[data-status]');
    const statusDropdownBtn = document.querySelector('.owner-status-dropdown');

    let currentStatusFilter = '';

    // Search functionality
    searchInput.addEventListener('input', function() {
        filterAppointments();
    });

    // Status filter
    statusDropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            currentStatusFilter = this.dataset.status;
            statusDropdownBtn.innerHTML = `<i class="fa-solid fa-filter me-2"></i>${this.textContent} <i class="fa-solid fa-chevron-down ms-2"></i>`;
            filterAppointments();
        });
    });

    // Filter function
    function filterAppointments() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        appointmentItems.forEach(item => {
            const customerName = item.querySelector('.owner-customer-name').textContent.toLowerCase();
            const serviceInfo = item.querySelector('.owner-service-info').textContent.toLowerCase();
            const status = item.dataset.status;

            const matchesSearch = customerName.includes(searchTerm) || serviceInfo.includes(searchTerm);
            const matchesStatus = !currentStatusFilter || status === currentStatusFilter;

            const cardElement = item.closest('.card');
            if (matchesSearch && matchesStatus) {
                cardElement.style.display = 'block';
                visibleCount++;
            } else {
                cardElement.style.display = 'none';
            }
        });

        // Show/hide empty state
        const appointmentsList = document.getElementById('appointmentsList');
        if (visibleCount === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }

    // Function to update badge class based on status (Avatar stays neutral)
    function updateBadgeStatus(appointmentItem, newStatus) {
        const avatar = appointmentItem.querySelector('.owner-customer-avatar');
        const badge = appointmentItem.querySelector('.badge');
        
        // Keep avatar always neutral (remove any status classes)
        avatar.classList.remove('owner-avatar-confirmed', 'owner-avatar-completed', 'owner-avatar-cancelled');
        avatar.classList.add('owner-avatar-neutral');
        
        // Remove all badge status classes
        badge.classList.remove('owner-badge-confirmed', 'owner-badge-completed', 'owner-badge-cancelled');
        
        // Add new badge status class only
        switch(newStatus) {
            case 'confirmed':
                badge.classList.add('owner-badge-confirmed');
                badge.textContent = 'Confirmed';
                break;
            case 'completed':
                badge.classList.add('owner-badge-completed');
                badge.textContent = 'Completed';
                break;
            case 'cancelled':
                badge.classList.add('owner-badge-cancelled');
                badge.textContent = 'Cancelled';
                break;
        }
        
        // Update data attribute
        appointmentItem.dataset.status = newStatus;
    }

    // Initialize badge colors based on data-status on page load (Avatar stays neutral)
    function initializeBadgeColors() {
        appointmentItems.forEach(item => {
            const status = item.dataset.status;
            updateBadgeStatus(item, status);
        });
    }

    // Call initialization function when page loads
    initializeBadgeColors();

    // Dropdown item handlers
    document.querySelectorAll('.dropdown-item').forEach(item => {
        if (!item.hasAttribute('data-status')) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                const appointmentItem = this.closest('.owner-appointment-item');
                const customerName = appointmentItem.querySelector('.owner-customer-name').textContent;
                const action = this.textContent.trim();
                
                switch(true) {
                    case action.includes('Edit'):
                        console.log('Editing appointment for:', customerName);
                        break;
                    case action.includes('Cancel'):
                        if (confirm(`Are you sure you want to cancel the appointment for ${customerName}?`)) {
                            console.log('Cancelling appointment for:', customerName);
                            // Update badge status to cancelled (avatar stays neutral)
                            updateBadgeStatus(appointmentItem, 'cancelled');
                        }
                        break;
                }
            });
        }
    });

    // Generate random salon code
    function generateSalonCode() {
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const numbers = '0123456789';
        let code = 'TRIMLY';
        
        // Add current year
        code += new Date().getFullYear();
        
        return code;
    }

    // Copy code functionality
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Change button text temporarily
            const copyBtn = document.getElementById('copyCodeBtn');
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            copyBtn.style.backgroundColor = '#28a745';
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.style.backgroundColor = '#ab8b73';
            }, 2000);
        }, function(err) {
            console.error('Could not copy text: ', err);
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            
            const copyBtn = document.getElementById('copyCodeBtn');
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            copyBtn.style.backgroundColor = '#28a745';
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.style.backgroundColor = '#ab8b73';
            }, 2000);
        });
    }

    // Modal event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Generate salon code when modal is opened
        const salonCodeModal = document.getElementById('salonCodeModal');
        salonCodeModal.addEventListener('show.bs.modal', function() {
            const code = generateSalonCode();
            document.getElementById('salonCodeDisplay').textContent = code;
        });

        // Copy button click handler
        document.getElementById('copyCodeBtn').addEventListener('click', function() {
            const code = document.getElementById('salonCodeDisplay').textContent;
            copyToClipboard(code);
        });
    });

    // Initialize avatar colors based on data-status on page load
    function initializeAvatarColors() {
        appointmentItems.forEach(item => {
            const status = item.dataset.status;
            updateAvatarStatus(item, status);
        });
    }

    // Call initialization function when page loads
    initializeAvatarColors();

    console.log('Appointments page loaded successfully');
});

