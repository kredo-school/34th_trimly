/**
 * Service API Integration
 * Handles all API communications for service management
 */

// API Configuration
const ServiceAPI = (function() {
    const baseUrl = '/api/salon-owner/services';
    
    /**
     * Get CSRF token from meta tag
     * @returns {string} CSRF token value
     */
    function getCsrfToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        return token ? token.getAttribute('content') : '';
    }
    
    /**
     * Get request headers with CSRF token
     * @returns {Object} Headers object for fetch requests
     */
    function getHeaders() {
        return {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest'
        };
    }
    
    return {
        /**
         * Get all services
         * @returns {Promise<Object>} API response with services list
         */
        async getAll() {
            const response = await fetch(baseUrl, {
                method: 'GET',
                headers: getHeaders()
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return await response.json();
        },

        /**
         * Get single service by ID
         * @param {number} id - Service ID
         * @returns {Promise<Object>} API response with service details
         */
        async get(id) {
            const response = await fetch(`${baseUrl}/${id}`, {
                method: 'GET',
                headers: getHeaders()
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return await response.json();
        },

        /**
         * Create new service
         * @param {Object} data - Service data
         * @returns {Promise<Object>} API response with created service
         */
        async create(data) {
            const response = await fetch(baseUrl, {
                method: 'POST',
                headers: getHeaders(),
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Failed to create service');
            }
            
            return result;
        },

        /**
         * Update existing service
         * @param {number} id - Service ID
         * @param {Object} data - Updated service data
         * @returns {Promise<Object>} API response with updated service
         */
        async update(id, data) {
            const response = await fetch(`${baseUrl}/${id}`, {
                method: 'PUT',
                headers: getHeaders(),
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Failed to update service');
            }
            
            return result;
        },

        /**
         * Delete service
         * @param {number} id - Service ID
         * @returns {Promise<Object>} API response confirming deletion
         */
        async delete(id) {
            const response = await fetch(`${baseUrl}/${id}`, {
                method: 'DELETE',
                headers: getHeaders()
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Failed to delete service');
            }
            
            return result;
        },

        /**
         * Get available service features
         * @returns {Promise<Object>} API response with features list
         */
        async getFeatures() {
            const response = await fetch('/api/salon-owner/services/features', {
                method: 'GET',
                headers: getHeaders()
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return await response.json();
        }
    };
})();

/**
 * Service Manager Class
 * Handles UI interactions and state management for services
 */
class ServiceManager {
    constructor() {
        this.currentEditId = null;
        this.services = [];
        this.features = [];
        this.featureMap = new Map();
        this.init();
    }

    /**
     * Initialize the service manager
     */
    init() {
        this.setupEventListeners();
        this.loadServices();
    }

    /**
     * Setup event listeners for UI interactions
     */
    setupEventListeners() {
        // Save button for add service modal
        const saveBtn = document.getElementById('saveServiceBtn');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => this.handleSaveService());
        }

        // Save button for edit service modal
        const saveEditBtn = document.getElementById('saveEditServiceBtn');
        if (saveEditBtn) {
            saveEditBtn.addEventListener('click', () => this.handleUpdateService());
        }

        // Confirm delete button
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', () => this.confirmDelete());
        }

        // Global click handler for edit and delete buttons
        document.addEventListener('click', (e) => {
            // Handle edit button clicks
            if (e.target.closest('.btn-salon-code[data-service]')) {
                e.preventDefault();
                const btn = e.target.closest('.btn-salon-code[data-service]');
                const serviceId = btn.getAttribute('data-service');
                this.handleEditService(serviceId);
            }

            // Handle delete button clicks
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                const card = e.target.closest('.service-card');
                const serviceId = card.getAttribute('data-service-id');
                if (serviceId) {
                    this.handleDeleteService(serviceId);
                }
            }
        });
    }

    /**
     * Load services from API and render
     */
    async loadServices() {
        try {
            this.showLoading();
            const response = await ServiceAPI.getAll();
            
            if (response.success && response.data) {
                this.services = response.data;
                this.renderServices();
            }
        } catch (error) {
            console.error('Error loading services:', error);
            this.showNotification('Failed to load services', 'danger');
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Render services to the DOM
     */
    renderServices() {
        const servicesGrid = document.getElementById('servicesGrid');
        const emptyState = document.getElementById('emptyState');
        
        if (!servicesGrid) return;
        
        if (!this.services || this.services.length === 0) {
            servicesGrid.innerHTML = '';
            if (emptyState) {
                emptyState.style.display = 'block';
            }
            return;
        }

        if (emptyState) {
            emptyState.style.display = 'none';
        }
        
        servicesGrid.innerHTML = this.services.map(service => this.createServiceCard(service)).join('');
    }

    /**
     * Create HTML for service card
     * @param {Object} service - Service data
     * @returns {string} HTML string for service card
     */
    createServiceCard(service) {
        const features = service.features || [];
        const featuresHTML = features.map(feature => 
            `<span class="badge feature-badge">${this.escapeHtml(feature.name || feature)}</span>`
        ).join('');

        return `
            <div class="card service-card mb-3" data-service-id="${service.id}">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1 fw-bold">${this.escapeHtml(service.servicename)}</h5>
                            <span class="badge bg-secondary text-white px-2 py-1 small">${this.escapeHtml(service.category)}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back" data-service="${service.id}">
                                <i class="fa-solid fa-edit me-1"></i>Edit
                            </button>
                            <button class="btn btn-salon-code d-none d-sm-flex btn-owner-back px-3 delete-btn">
                                <i class="fa-solid fa-trash me-1"></i>Delete
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-muted mb-3 owner-service-info">
                        <i class="fa-regular fa-clock me-2"></i>
                        <span class="me-4">${service.formatted_duration || service.duration + ' minutes'}</span>
                        <i class="fa-solid fa-dollar-sign me-2"></i>
                        <span class="me-4">$${service.formatted_price || service.price}</span>
                        <i class="fa-solid fa-scissors me-2"></i>
                        <span>${service.features_count || features.length} features</span>
                    </div>
                    
                    <p class="text-muted mb-3 owner-service-description">${this.escapeHtml(service.description)}</p>
                    
                    ${features.length > 0 ? `
                    <div class="mb-0">
                        <h6 class="text-dark mb-2 fw-bold owner-features-header">INCLUDED FEATURES:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            ${featuresHTML}
                        </div>
                    </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    /**
     * Handle save new service
     */
    async handleSaveService() {
        const form = document.getElementById('addServiceForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const data = this.collectFormData('add');
        
        try {
            this.showLoading();
            const response = await ServiceAPI.create(data);
            
            if (response.success) {
                this.showNotification('Service added successfully!', 'success');
                this.closeModal('addServiceModal');
                form.reset();
                await this.loadServices();
            }
        } catch (error) {
            this.showNotification(error.message, 'danger');
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Handle edit service click
     * @param {number} serviceId - ID of service to edit
     */
    async handleEditService(serviceId) {
        try {
            this.showLoading();
            const response = await ServiceAPI.get(serviceId);
            
            if (response.success && response.data) {
                this.currentEditId = serviceId;
                this.populateEditForm(response.data);
                this.showModal('editServiceModal');
            }
        } catch (error) {
            this.showNotification('Failed to load service details', 'danger');
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Handle update existing service
     */
    async handleUpdateService() {
        const form = document.getElementById('editServiceForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const data = this.collectFormData('edit');
        
        try {
            this.showLoading();
            const response = await ServiceAPI.update(this.currentEditId, data);
            
            if (response.success) {
                this.showNotification('Service updated successfully!', 'success');
                this.closeModal('editServiceModal');
                await this.loadServices();
            }
        } catch (error) {
            this.showNotification(error.message, 'danger');
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Handle delete service
     * @param {number} serviceId - ID of service to delete
     */
    handleDeleteService(serviceId) {
        // Store the service ID for deletion
        document.getElementById('deleteServiceId').value = serviceId;
        
        // Show confirmation modal
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    }

    /**
     * Confirm and execute deletion
     */
    async confirmDelete() {
        const serviceId = document.getElementById('deleteServiceId').value;
        
        try {
            this.showLoading();
            const response = await ServiceAPI.delete(serviceId);
            
            if (response.success) {
                this.showNotification('Service deleted successfully!', 'success');
                this.closeModal('deleteConfirmModal');
                await this.loadServices();
            }
        } catch (error) {
            this.showNotification(error.message, 'danger');
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Collect form data for submission
     * @param {string} formType - 'add' or 'edit'
     * @returns {Object} Form data object
     */
    collectFormData(formType) {
        const prefix = formType === 'edit' ? 'edit' : '';
        const capitalizedPrefix = formType === 'edit' ? 'Edit' : '';
        const selectedFeatures = [];
        
        // Collect checked features
        document.querySelectorAll(`#${formType}ServiceForm input[name="${formType === 'edit' ? 'edit_' : ''}features[]"]:checked`).forEach(checkbox => {
            selectedFeatures.push(checkbox.value);
        });

        return {
            servicename: document.getElementById(`${prefix}ServiceName`).value.trim(),
            category: document.getElementById(`${prefix}ServiceCategory`).value.trim(),
            duration: parseInt(document.getElementById(`${prefix}ServiceDuration`).value),
            price: parseFloat(document.getElementById(`${prefix}ServicePrice`).value),
            description: document.getElementById(`${prefix}ServiceDescription`).value.trim(),
            features: selectedFeatures // Send as array, controller will process
        };
    }

    /**
     * Populate edit form with service data
     * @param {Object} service - Service data
     */
    populateEditForm(service) {
        document.getElementById('editServiceName').value = service.servicename;
        document.getElementById('editServiceCategory').value = service.category;
        document.getElementById('editServiceDuration').value = service.duration;
        document.getElementById('editServicePrice').value = service.price;
        document.getElementById('editServiceDescription').value = service.description;

        // Clear all checkboxes
        document.querySelectorAll('#editServiceForm input[type="checkbox"]').forEach(cb => cb.checked = false);

        // For now, we can't restore features since they're stored as count only
        // This would need to be improved with proper feature storage
    }

    /**
     * Show modal dialog
     * @param {string} modalId - Modal element ID
     */
    showModal(modalId) {
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }

    /**
     * Close modal dialog
     * @param {string} modalId - Modal element ID
     */
    closeModal(modalId) {
        const modalElement = document.getElementById(modalId);
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
    }

    /**
     * Show loading spinner
     */
    showLoading() {
        const existingLoader = document.getElementById('serviceLoadingSpinner');
        if (!existingLoader) {
            const loader = document.createElement('div');
            loader.id = 'serviceLoadingSpinner';
            loader.className = 'position-fixed top-50 start-50 translate-middle';
            loader.style.zIndex = '9999';
            loader.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
            document.body.appendChild(loader);
        }
    }

    /**
     * Hide loading spinner
     */
    hideLoading() {
        const loader = document.getElementById('serviceLoadingSpinner');
        if (loader) {
            loader.remove();
        }
    }

    /**
     * Show notification message
     * @param {string} message - Message to display
     * @param {string} type - Alert type (info, success, danger, etc.)
     */
    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingAlerts = document.querySelectorAll('.alert.service-notification');
        existingAlerts.forEach(alert => alert.remove());
        
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 service-notification`;
        alert.style.zIndex = '9999';
        alert.style.minWidth = '300px';
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
     * Escape HTML special characters
     * @param {string} text - Text to escape
     * @returns {string} Escaped text
     */
    escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.toString().replace(/[&<>"']/g, m => map[m]);
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize on services page
    if (window.location.pathname.includes('/dashboard-salonowner/services') || 
        window.location.pathname.includes('/salon-owner/services')) {
        window.serviceManager = new ServiceManager();
    }
});

