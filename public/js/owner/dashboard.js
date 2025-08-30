// =====================================================
// Salon Owner Dashboard - Main JavaScript File
// =====================================================

// Navigation Functions
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    mobileNav.classList.toggle('show');
 }
 
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
    
    if (btn && dropdown && !btn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
        if (btn.querySelector('i')) {
            btn.querySelector('i').style.transform = 'rotate(0deg)';
        }
    }
 });

 // Handle logout
document.addEventListener('DOMContentLoaded', function() {
    const logoutForm = document.getElementById('logoutForm');
    if (logoutForm) {
        logoutForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const response = await fetch('/salon-owner/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    window.location.href = '/login-salonowner';
                }
            } catch (error) {
                console.error('Logout error:', error);
            }
        });
    }
});

// Get CSRF token function
function getCsrfToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.getAttribute('content') : '';
}
 
 // =====================================================
 // Salon Code Functions
 // =====================================================
 
 function generateSalonCode() {
    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numbers = '0123456789';
    let code = 'TRIMLY';
    
    // Add current year
    code += new Date().getFullYear();
    
    return code;
 }
 
 function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Change button text temporarily
        const copyBtn = document.getElementById('copyCodeBtn');
        if (copyBtn) {
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            copyBtn.classList.add('copied');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.classList.remove('copied');
            }, 2000);
        }
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
        if (copyBtn) {
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i>Copied!';
            copyBtn.classList.add('copied');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.classList.remove('copied');
            }, 2000);
        }
    });
 }
 
 // =====================================================
 // Services Page Functions
 // =====================================================
 
 function initializeServicesPage() {
    const addServiceBtn = document.getElementById('addServiceBtn');
    const addServiceModal = document.getElementById('addServiceModal');
    const editServiceModal = document.getElementById('editServiceModal');
    
    // Add Service Button
    if (addServiceBtn) {
        addServiceBtn.addEventListener('click', function() {
            cleanupModals();
            const modal = new bootstrap.Modal(addServiceModal);
            modal.show();
        });
    }
    
    // Edit Service Buttons - using event delegation
    document.addEventListener('click', function(e) {
        const editBtn = e.target.closest('.btn-salon-code[data-service]');
        if (editBtn) {
            e.preventDefault();
            cleanupModals();
            
            const serviceId = editBtn.getAttribute('data-service');
            populateEditForm(serviceId);
            
            const modal = new bootstrap.Modal(editServiceModal);
            modal.show();
            
            console.log(`Edit service: ${serviceId}`);
        }
    });
    
    // Save Service Button
    const saveServiceBtn = document.getElementById('saveServiceBtn');
    if (saveServiceBtn) {
        saveServiceBtn.addEventListener('click', function() {
            const form = document.getElementById('addServiceForm');
            if (form.checkValidity()) {
                alert('Service added successfully!');
                
                const modalElement = document.getElementById('addServiceModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                } else {
                    cleanupModals();
                }
                
                form.reset();
            } else {
                form.reportValidity();
            }
        });
    }
    
    // Save Edit Service Button
    const saveEditServiceBtn = document.getElementById('saveEditServiceBtn');
    if (saveEditServiceBtn) {
        saveEditServiceBtn.addEventListener('click', function() {
            const form = document.getElementById('editServiceForm');
            if (form.checkValidity()) {
                alert('Service updated successfully!');
                
                const modalElement = document.getElementById('editServiceModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                } else {
                    cleanupModals();
                }
            } else {
                form.reportValidity();
            }
        });
    }
    
    // Delete Service Actions
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            e.preventDefault();
            
            const serviceCard = e.target.closest('.service-card');
            const serviceName = serviceCard.querySelector('h5').textContent;
            
            if (confirm(`Are you sure you want to delete "${serviceName}"?`)) {
                serviceCard.remove();
                console.log(`Deleted service: ${serviceName}`);
            }
        }
    });
    
    // Modal cleanup event listeners
    const addModal = document.getElementById('addServiceModal');
    const editModal = document.getElementById('editServiceModal');
    
    if (addModal) {
        addModal.addEventListener('hidden.bs.modal', function() {
            cleanupModals();
        });
    }
    
    if (editModal) {
        editModal.addEventListener('hidden.bs.modal', function() {
            cleanupModals();
        });
    }
    
    // Cancel buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('[data-bs-dismiss="modal"]')) {
            cleanupModals();
        }
    });
    
    // ESC key handler
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cleanupModals();
        }
    });
 }
 
 // Modal cleanup function
 function cleanupModals() {
    // Exclude Salon Code Modal
    const salonCodeModal = document.getElementById('salonCodeModal');
    
    // Remove all modal backdrops except for salon code modal
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        // Check if this is Salon Code Modal's backdrop
        if (salonCodeModal && salonCodeModal.classList.contains('show')) {
            // Don't remove backdrop if Salon Code Modal is showing
            return;
        }
        backdrop.remove();
    });
    
    // Remove modal-open class from body only if no modals are open
    const openModals = document.querySelectorAll('.modal.show');
    if (openModals.length === 0) {
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }
    
    // Hide all modals except salon code modal
    document.querySelectorAll('.modal').forEach(modal => {
        if (modal.id === 'salonCodeModal') {
            return; // Skip salon code modal
        }
        modal.classList.remove('show');
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        modal.removeAttribute('aria-modal');
    });
 }
 
 // Cleanup function specifically for Salon Code Modal
 function cleanupSalonCodeModal() {
    const salonCodeModal = document.getElementById('salonCodeModal');
    if (salonCodeModal) {
        // Get Bootstrap modal instance
        const modalInstance = bootstrap.Modal.getInstance(salonCodeModal);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
 }
 
 // Populate edit form function
 function populateEditForm(serviceId) {
    const serviceData = getServiceData(serviceId);
    
    if (serviceData) {
        const editServiceName = document.getElementById('editServiceName');
        const editServiceCategory = document.getElementById('editServiceCategory');
        const editServiceDuration = document.getElementById('editServiceDuration');
        const editServicePrice = document.getElementById('editServicePrice');
        const editServiceDescription = document.getElementById('editServiceDescription');
        
        if (editServiceName) editServiceName.value = serviceData.name;
        if (editServiceCategory) editServiceCategory.value = serviceData.category;
        if (editServiceDuration) editServiceDuration.value = serviceData.duration;
        if (editServicePrice) editServicePrice.value = serviceData.price;
        if (editServiceDescription) editServiceDescription.value = serviceData.description;
    }
 }
 
 // Get service data function (mock data)
 function getServiceData(serviceId) {
    const services = {
        'full-grooming': {
            name: 'Full Grooming Package',
            category: 'Complete Service',
            duration: '90',
            price: '65.00',
            description: 'Complete grooming service including bath, haircut, nail trim, and ear cleaning for a full spa experience.'
        },
        'basic-bath': {
            name: 'Basic Bath & Brush',
            category: 'Basic Grooming',
            duration: '45',
            price: '35.00',
            description: 'Essential bath and brushing service to keep your pet clean and fresh.'
        },
        'nail-trim': {
            name: 'Nail Trim Only',
            category: 'Add-on Service',
            duration: '15',
            price: '15.00',
            description: 'Quick and safe nail trimming service for your pet\'s comfort and health.'
        }
    };
    
    return services[serviceId] || null;
 }
 
 // =====================================================
// Appointments Page Functions
// =====================================================

function initializeAppointmentsPage() {
   const searchInput = document.getElementById('searchInput');
   const appointmentItems = document.querySelectorAll('.owner-appointment-item');
   const emptyState = document.getElementById('emptyState');
   const statusDropdownItems = document.querySelectorAll('.dropdown-item[data-status]');
   const statusDropdownBtn = document.querySelector('.owner-status-dropdown');

   let currentStatusFilter = '';

   if (searchInput) {
       searchInput.addEventListener('input', function() {
           filterAppointments();
       });
   }

   // Status filter
   statusDropdownItems.forEach(item => {
       item.addEventListener('click', function(e) {
           e.preventDefault();
           currentStatusFilter = this.dataset.status;
           if (statusDropdownBtn) {
               statusDropdownBtn.innerHTML = `<i class="fa-solid fa-filter me-2"></i>${this.textContent} <i class="fa-solid fa-chevron-down ms-2"></i>`;
           }
           filterAppointments();
       });
   });

   // Filter function
   function filterAppointments() {
       if (!searchInput || !appointmentItems.length) return;
       
       const searchTerm = searchInput.value.toLowerCase();
       let visibleCount = 0;

       appointmentItems.forEach(item => {
           const customerNameEl = item.querySelector('.owner-customer-name');
           const serviceInfoEl = item.querySelector('.owner-service-info');
           
           if (!customerNameEl || !serviceInfoEl) return;
           
           const customerName = customerNameEl.textContent.toLowerCase();
           const serviceInfo = serviceInfoEl.textContent.toLowerCase();
           const status = item.dataset.status;

           const matchesSearch = customerName.includes(searchTerm) || serviceInfo.includes(searchTerm);
           const matchesStatus = !currentStatusFilter || status === currentStatusFilter;

           const cardElement = item.closest('.card');
           if (cardElement) {
               if (matchesSearch && matchesStatus) {
                   cardElement.style.display = 'block';
                   visibleCount++;
               } else {
                   cardElement.style.display = 'none';
               }
           }
       });

       // Show/hide empty state
       if (emptyState) {
           if (visibleCount === 0) {
               emptyState.style.display = 'block';
           } else {
               emptyState.style.display = 'none';
           }
       }
   }

   // Initialize badge colors
   function initializeBadgeColors() {
       appointmentItems.forEach(item => {
           const status = item.dataset.status;
           if (status) {
               updateBadgeStatus(item, status);
           }
       });
   }

   function updateBadgeStatus(appointmentItem, newStatus) {
       const avatar = appointmentItem.querySelector('.owner-customer-avatar');
       const badge = appointmentItem.querySelector('.badge');
       
       if (avatar) {
           avatar.classList.remove('owner-avatar-confirmed', 'owner-avatar-completed', 'owner-avatar-cancelled');
           avatar.classList.add('owner-avatar-neutral');
       }
       
       if (badge) {
           badge.classList.remove('owner-badge-confirmed', 'owner-badge-completed', 'owner-badge-cancelled');
           
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
       }
       
       appointmentItem.dataset.status = newStatus;
   }

   // Initialize on page load
   initializeBadgeColors();

   // =====================================================
   // DROPDOWN POSITIONING FIX FOR NESTED CARDS
   // =====================================================
   
   // Fix dropdown position when shown
   document.addEventListener('shown.bs.dropdown', function(event) {
       const button = event.target;
       const menu = button.nextElementSibling;
       
       if (menu && menu.classList.contains('dropdown-menu')) {
           // Get button position
           const rect = button.getBoundingClientRect();
           
           // Set menu position using fixed positioning
           menu.style.position = 'fixed';
           menu.style.top = `${rect.bottom + 5}px`;
           menu.style.left = 'auto';
           menu.style.right = `${window.innerWidth - rect.right}px`;
           menu.style.zIndex = '999999';
           
           // Ensure menu doesn't go off screen
           const menuRect = menu.getBoundingClientRect();
           if (menuRect.bottom > window.innerHeight) {
               // If menu goes below viewport, position it above the button
               menu.style.top = 'auto';
               menu.style.bottom = `${window.innerHeight - rect.top + 5}px`;
           }
       }
   });

   // Hide dropdown on scroll
   window.addEventListener('scroll', function() {
       // Close all open dropdowns
       const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
       openDropdowns.forEach(menu => {
           const dropdownButton = menu.previousElementSibling;
           if (dropdownButton) {
               const dropdown = bootstrap.Dropdown.getInstance(dropdownButton);
               if (dropdown) {
                   dropdown.hide();
               }
           }
       });
   }, { passive: true });

   // Reset dropdown position when hidden
   document.addEventListener('hidden.bs.dropdown', function(event) {
       const button = event.target;
       const menu = button.nextElementSibling;
       
       if (menu && menu.classList.contains('dropdown-menu')) {
           // Reset to default positioning
           menu.style.position = '';
           menu.style.top = '';
           menu.style.left = '';
           menu.style.right = '';
           menu.style.bottom = '';
           menu.style.zIndex = '';
       }
   });

   // =====================================================
   // END DROPDOWN POSITIONING FIX
   // =====================================================

   // Dropdown handlers for actions
   document.addEventListener('click', function(e) {
       const dropdownItem = e.target.closest('.dropdown-item');
       if (dropdownItem && !dropdownItem.hasAttribute('data-status')) {
           e.preventDefault();
           
           const appointmentItem = dropdownItem.closest('.owner-appointment-item');
           if (!appointmentItem) return;
           
           const customerNameEl = appointmentItem.querySelector('.owner-customer-name');
           const customerName = customerNameEl ? customerNameEl.textContent : 'Unknown';
           const action = dropdownItem.textContent.trim();
           
           if (action.includes('Edit')) {
               console.log('Editing appointment for:', customerName);
           } else if (action.includes('Cancel')) {
               if (confirm(`Are you sure you want to cancel the appointment for ${customerName}?`)) {
                   console.log('Cancelling appointment for:', customerName);
                   updateBadgeStatus(appointmentItem, 'cancelled');
               }
           }
       }
   });
}
 // =====================================================
 // Customers Page Functions
 // =====================================================
 
 function initializeCustomersPage() {
    const searchInput = document.getElementById('searchInput');
    const customerCards = document.querySelectorAll('.card');
    const emptyState = document.getElementById('emptyState');
 
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterCustomers();
        });
    }
 
    function filterCustomers() {
        if (!searchInput || !customerCards.length) return;
        
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;
 
        customerCards.forEach(card => {
            // Skip the search card and empty state
            if (card.closest('#emptyState') || card.closest('.owner-search-section')) {
                return;
            }
 
            const customerNameEl = card.querySelector('h5');
            const customerEmailEl = card.querySelector('span');
            const petNameEl = card.querySelector('.pet-section .fw-bold');
            
            if (!customerNameEl) return;
            
            const customerName = customerNameEl.textContent.toLowerCase();
            const customerEmail = customerEmailEl ? customerEmailEl.textContent.toLowerCase() : '';
            const petName = petNameEl ? petNameEl.textContent.toLowerCase() : '';
 
            const matchesSearch = customerName.includes(searchTerm) || 
                                customerEmail.includes(searchTerm) || 
                                petName.includes(searchTerm);
 
            const cardContainer = card.closest('.col-md-6');
            if (cardContainer) {
                if (matchesSearch) {
                    cardContainer.style.display = 'block';
                    visibleCount++;
                } else {
                    cardContainer.style.display = 'none';
                }
            }
        });
 
        // Show/hide empty state
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        }
    }
 
    // Dropdown handlers
    document.addEventListener('click', function(e) {
        const dropdownItem = e.target.closest('.dropdown-item');
        if (dropdownItem) {
            e.preventDefault();
            
            const customerCard = dropdownItem.closest('.card');
            if (!customerCard) return;
            
            const customerNameEl = customerCard.querySelector('h5');
            const customerName = customerNameEl ? customerNameEl.textContent : 'Unknown';
            const action = dropdownItem.textContent.trim();
            
            if (action.includes('Delete')) {
                if (confirm(`Are you sure you want to delete customer ${customerName}?`)) {
                    console.log('Deleting customer:', customerName);
                }
            }
        }
    });
 }
 
 // =====================================================
 // Settings Page Functions
 // =====================================================
 
 function toggleOwnerPassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    if (!passwordField) return;
    
    const toggleButton = passwordField.nextElementSibling;
    if (!toggleButton) return;
    
    const icon = toggleButton.querySelector('i');
    if (!icon) return;
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
 }
 
 function initializeSettingsPage() {
    const form = document.getElementById('settingsForm');
    const newPassword = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const cancelBtn = document.getElementById('cancelBtn');
 
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Password validation
            if ((newPassword && newPassword.value) || (confirmPassword && confirmPassword.value)) {
                if (newPassword.value !== confirmPassword.value) {
                    alert('Passwords do not match!');
                    return;
                }
                
                if (newPassword.value.length < 6) {
                    alert('Password must be at least 6 characters long.');
                    return;
                }
            }
            
            // Required fields validation
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                alert('Please fill in all required fields.');
                return;
            }
            
            alert('Settings saved successfully!');
            console.log('Settings updated successfully');
        });
    }
 
    // Real-time password confirmation validation
    if (confirmPassword && newPassword) {
        confirmPassword.addEventListener('input', function() {
            if (newPassword.value && confirmPassword.value) {
                if (newPassword.value === confirmPassword.value) {
                    confirmPassword.classList.remove('is-invalid');
                    confirmPassword.classList.add('is-valid');
                } else {
                    confirmPassword.classList.remove('is-valid');
                    confirmPassword.classList.add('is-invalid');
                }
            } else {
                confirmPassword.classList.remove('is-valid', 'is-invalid');
            }
        });
    }
 
    // Cancel button
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
                window.location.reload();
            }
        });
    }
 }
 
 // =====================================================
 // Main Initialization
 // =====================================================
 
 document.addEventListener('DOMContentLoaded', function() {
    console.log('Salon Owner Dashboard loaded');
    
    // Initialize Salon Code Modal
    const salonCodeModal = document.getElementById('salonCodeModal');
    if (salonCodeModal) {
        // Before modal shows
        salonCodeModal.addEventListener('show.bs.modal', function(event) {
            // Clean up other modals first
            cleanupModals();
            
            // Generate code
            const code = generateSalonCode();
            const codeDisplay = document.getElementById('salonCodeDisplay');
            if (codeDisplay) {
                codeDisplay.textContent = code;
            }
            
            // Ensure proper z-index
            this.style.zIndex = '1060';
        });
        
        // After modal is shown
        salonCodeModal.addEventListener('shown.bs.modal', function(event) {
            // Verify backdrop z-index
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = '1050';
            }
        });
 
        // Copy button handler
        const copyBtn = document.getElementById('copyCodeBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function() {
                const codeDisplay = document.getElementById('salonCodeDisplay');
                if (codeDisplay) {
                    const code = codeDisplay.textContent;
                    copyToClipboard(code);
                }
            });
        }
    }
    
    // Initialize page-specific functions based on current page
    const currentPage = window.location.pathname;
    
    if (currentPage.includes('services') || document.getElementById('addServiceBtn')) {
        initializeServicesPage();
        console.log('Services page initialized');
    }
    
    if (currentPage.includes('appointments') || document.querySelector('.owner-appointment-item')) {
        initializeAppointmentsPage();
        console.log('Appointments page initialized');
    }
    
    if (currentPage.includes('customers') || document.querySelector('.pet-section')) {
        initializeCustomersPage();
        console.log('Customers page initialized');
    }
    
    if (currentPage.includes('settings') || document.getElementById('settingsForm')) {
        initializeSettingsPage();
        console.log('Settings page initialized');
    }
 });
 salonCodeModal.addEventListener('shown.bs.modal', function(event) {
    // Check if backdrop exists
    let backdrop = document.querySelector('.modal-backdrop');
    if (!backdrop) {
        // Create backdrop manually
        backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.style.zIndex = '1040';
        document.body.appendChild(backdrop);
    }
});
// Replace the existing salon code modal initialization with this:
document.addEventListener('DOMContentLoaded', function() {
    console.log('Salon Owner Dashboard loaded');
    
    // Initialize Salon Code Modal
    const salonCodeModal = document.getElementById('salonCodeModal');
    if (salonCodeModal) {
        // Clean initialization
        const bsModal = new bootstrap.Modal(salonCodeModal, {
            backdrop: true,
            keyboard: true,
            focus: true
        });
        
        // Store modal instance for later use
        salonCodeModal.bsModal = bsModal;
        
        // Before modal shows
        salonCodeModal.addEventListener('show.bs.modal', function(event) {
            console.log('Modal showing');
            // Generate code
            const code = generateSalonCode();
            const codeDisplay = document.getElementById('salonCodeDisplay');
            if (codeDisplay) {
                codeDisplay.textContent = code;
            }
        });
        
        // After modal is shown
        salonCodeModal.addEventListener('shown.bs.modal', function(event) {
            console.log('Modal shown');
            // Ensure backdrop exists
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = '1040';
            }
        });

        // Copy button handler
        const copyBtn = document.getElementById('copyCodeBtn');
        if (copyBtn) {
            copyBtn.removeEventListener('click', copyToClipboard); // Remove any existing listeners
            copyBtn.addEventListener('click', function() {
                const codeDisplay = document.getElementById('salonCodeDisplay');
                if (codeDisplay) {
                    const code = codeDisplay.textContent;
                    copyToClipboard(code);
                }
            });
        }
    }
    
    // ... rest of initialization code
});