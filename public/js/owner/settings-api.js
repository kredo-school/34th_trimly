/**
 * QQ Settings saved successfully!
Settings saved successfully!
Settings updated successfully! why 3 times ?
 *  Settings API Integration
 * Handles settings form submission and updates
 * 
 */

document.addEventListener('DOMContentLoaded', function() {
    const settingsForm = document.getElementById('settingsForm');
    const cancelBtn = document.getElementById('cancelBtn');
    
    if (settingsForm) {
        settingsForm.addEventListener('submit', handleSettingsSubmit);
    }
    
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            window.location.href = '/dashboard-salonowner/appointments';
        });
    }
});

/**
 * Handle settings form submission
 */
async function handleSettingsSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Saving...';
    
    try {
        // Collect form data
        const formData = collectFormData(form);
        
        // Send update request
        const response = await fetch('/api/salon-owner/settings', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        
        const result = await response.json();
        
        if (response.ok && result.success) {
            // Show success message
            showNotification('Settings updated successfully!', 'success');
            
            // Update navbar salon name if changed
            updateNavbarSalonName(formData.salonname);
            
            // Clear password fields
            form.querySelector('#password').value = '';
            form.querySelector('#confirmPassword').value = '';
        } else {
            // Show error message
            const errorMsg = result.message || 'Failed to update settings';
            showNotification(errorMsg, 'danger');
            
            // Show validation errors if any
            if (result.errors) {
                showValidationErrors(result.errors);
            }
        }
    } catch (error) {
        console.error('Error updating settings:', error);
        showNotification('Network error. Please try again.', 'danger');
    } finally {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fa-solid fa-save me-2"></i>Save Changes';
    }
}

/**
 * Collect form data
 */
function collectFormData(form) {
    const formData = new FormData(form);
    const data = {};
    
    // Regular fields
    const fields = [
        'salonname', 'email_address', 'firstname', 'lastname', 
        'phone', 'business_address', 'city', 'state',
        'website', 'licencenum', 'description', 
        'open_time', 'close_time', 'password', 'password_confirmation'
    ];
    
    fields.forEach(field => {
        const value = formData.get(field);
        if (value !== null && value !== '') {
            data[field] = value;
        }
    });
    
    // Operating days (checkboxes)
    data.operating_days = [];
    const checkboxes = form.querySelectorAll('input[name="operating_days[]"]:checked');
    checkboxes.forEach(cb => {
        data.operating_days.push(cb.value);
    });
    
    return data;
}

/**
 * Update navbar salon name
 */
function updateNavbarSalonName(newName) {
    const navbarElements = document.querySelectorAll('.subtitle, .main-title + p');
    navbarElements.forEach(element => {
        if (element.classList.contains('subtitle') || element.textContent.includes('TEST')) {
            element.textContent = newName;
        }
    });
}

/**
 * Show notification message
 */
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingAlerts = document.querySelectorAll('.settings-notification');
    existingAlerts.forEach(alert => alert.remove());
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show position-fixed settings-notification`;
    alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alert);
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}

/**
 * Show validation errors
 */
function showValidationErrors(errors) {
    // Clear previous errors
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.style.display = 'none';
    });
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    
    // Show new errors
    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add('is-invalid');
            const feedback = input.parentElement.querySelector('.invalid-feedback') || 
                           input.parentElement.parentElement.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = errors[field][0];
                feedback.style.display = 'block';
            }
        }
    });
}

/**
 * Toggle password visibility
 */
window.toggleOwnerPassword = function(fieldId) {
    const input = document.getElementById(fieldId);
    const icon = input.parentElement.querySelector('.owner-password-toggle i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
};

