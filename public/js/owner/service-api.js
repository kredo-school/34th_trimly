/**
 * Service API Integration
 * Handles all API communications for service management
 */

// API Configuration
const ServiceAPI = {
    baseUrl: '/api/salon-owner/dashboard-salonowner/services',
    
    // Headers configuration
    getHeaders() {
        return {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': this.getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest'
        };
    },

    // Get CSRF token
    getCsrfToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        return token ? token.getAttribute('content') : '';
    },

    // Get all services
    async getAll() {
        const response = await fetch(this.baseUrl, {
            method: 'GET',
            headers: this.getHeaders()
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    },

    // Get single service
    async get(id) {
        const response = await fetch(`${this.baseUrl}/${id}`, {
            method: 'GET',
            headers: this.getHeaders()
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    },

    // Create service
    async create(data) {
        const response = await fetch(this.baseUrl, {
            method: 'POST',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'Failed to create service');
        }
        
        return result;
    },

    // Update service
    async update(id, data) {
        const response = await fetch(`${this.baseUrl}/${id}`, {
            method: 'PUT',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'Failed to update service');
        }
        
        return result;
    },

    // Delete service
    async delete(id) {
        const response = await fetch(`${this.baseUrl}/${id}`, {
            method: 'DELETE',
            headers: this.getHeaders()
        });
        
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'Failed to delete service');
        }
        
        return result;
    },

    // Get available features
    async getFeatures() {
        const response = await fetch(`${this.baseUrl}/features`, {
            method: 'GET',
            headers: this.getHeaders()
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    }
};

// Service Manager Class
class ServiceManager {
    constructor() {
        this.currentEditId = null;
        this.services = [];
        this.features = [];
        this.featureMap = new Map();
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadFeatures().then(() => {
            this.loadServices();
        });
    }

    async loadFeatures() {
        try {
            const response = await ServiceAPI.getFeatures();
            
            if (response.success && response.data) {
                this.features = response.data;
                // Create a map for quick lookup
                this.features.forEach(feature => {
                    this.featureMap.set(feature.id.toString(), feature.name);
                });
                this.updateFeatureCheckboxes();
            }
        } catch (error) {
            console.error('Error loading features:', error);
            // Fall back to using existing HTML checkboxes
        }
    }

    updateFeatureCheckboxes() {
        // Update existing checkboxes with database IDs
        const featureMapping = {
            'bathShampoo': 1,
            'professionalCut': 2,
            'nailTrim': 5,
            'earCleaning': 6,
            'teethCleaning': 7,
            'blowDry': 9,
            'desheddingTreatment': 11,
            'fleaTickTreatment': null, // Not in database
            'nailPolish': null, // Not in database
            'bowBandana': null, // Not in database
            'aromatherapy': null, // Not in database
            'gentleHandling': null // Not in database
        };

        // Update add form checkboxes
        Object.entries(featureMapping).forEach(([elementId, dbId]) => {
            const checkbox = document.getElementById(elementId);
            if (checkbox && dbId) {
                checkbox.value = dbId;
            }
        });

        // Update edit form checkboxes
        Object.entries(featureMapping).forEach(([elementId, dbId]) => {
            const checkbox = document.getElementById('edit' + elementId.charAt(0).toUpperCase() + elementId.slice(1));
            if (checkbox && dbId) {
                checkbox.value = dbId;
            }
        });
    }

    setupEventListeners() {
        // Override save button for add service
        const saveBtn = document.getElementById('saveServiceBtn');
        if (saveBtn) {
            saveBtn.removeEventListener('click', this.handleSaveService);
            saveBtn.addEventListener('click', () => this.handleSaveService());
        }

        // Override save button for edit service
        const saveEditBtn = document.getElementById('saveEditServiceBtn');
        if (saveEditBtn) {
            saveEditBtn.removeEventListener('click', this.handleUpdateService);
            saveEditBtn.addEventListener('click', () => this.handleUpdateService());
        }

        // Override edit buttons
        document.addEventListener('click', (e) => {
            const editBtn = e.target.closest('.btn-salon-code[data-service]');
            if (editBtn) {
                e.preventDefault();
                e.stopPropagation();
                const serviceId = editBtn.getAttribute('data-service');
                this.handleEditService(serviceId);
            }

            // Override delete buttons
            const deleteBtn = e.target.closest('.service-card .delete-btn');
            if (deleteBtn) {
                e.preventDefault();
                e.stopPropagation();
                const card = deleteBtn.closest('.service-card');
                const serviceId = card.getAttribute('data-service-id');
                if (serviceId) {
                    this.handleDeleteService(serviceId);
                }
            }
        });
    }

    async loadServices() {
        try {
            this.showLoading();
            const response = await ServiceAPI.getAll();
            
            if (response.success && response.data) {
                this.services = response.data.data || [];
                this.renderServices();
            }
        } catch (error) {
            console.error('Error loading services:', error);
            this.showNotification('Failed to load services', 'danger');
        } finally {
            this.hideLoading();
        }
    }

    renderServices() {
        const servicesGrid = document.getElementById('servicesGrid');
        const emptyState = document.getElementById('emptyState');
        
        if (!this.services.length) {
            servicesGrid.innerHTML = '';
            emptyState.classList.remove('owner-empty-state-hidden');
            return;
        }

        emptyState.classList.add('owner-empty-state-hidden');
        servicesGrid.innerHTML = this.services.map(service => this.createServiceCard(service)).join('');
    }

    createServiceCard(service) {
        const features = service.features || [];
        const featuresHTML = features.map(feature => 
            `<span class="badge feature-badge">${this.escapeHtml(feature)}</span>`
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
                        <span class="me-4">${service.formatted_price || service.price}</span>
                        <i class="fa-solid fa-scissors me-2"></i>
                        <span>${service.features_count || features.length} features</span>
                    </div>
                    
                    <p class="text-muted mb-3 owner-service-description">${this.escapeHtml(service.description)}</p>
                    
                    <div class="mb-0">
                        <h6 class="text-dark mb-2 fw-bold owner-features-header">INCLUDED FEATURES:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            ${featuresHTML}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

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

    async handleDeleteService(serviceId) {
        const card = document.querySelector(`[data-service-id="${serviceId}"]`);
        const serviceName = card.querySelector('h5').textContent;
        
        if (!confirm(`Are you sure you want to delete "${serviceName}"?`)) {
            return;
        }

        try {
            this.showLoading();
            const response = await ServiceAPI.delete(serviceId);
            
            if (response.success) {
                this.showNotification('Service deleted successfully!', 'success');
                await this.loadServices();
            }
        } catch (error) {
            this.showNotification(error.message, 'danger');
        } finally {
            this.hideLoading();
        }
    }

    collectFormData(formType) {
        const prefix = formType === 'edit' ? 'edit' : '';
        const selectedFeatures = [];
        
        // Collect checked features with their IDs
        document.querySelectorAll(`#${formType}ServiceForm input[type="checkbox"]:checked`).forEach(checkbox => {
            if (checkbox.value) {
                selectedFeatures.push(checkbox.value);
            }
        });

        return {
            servicename: document.getElementById(`${prefix}ServiceName`).value.trim(),
            category: document.getElementById(`${prefix}ServiceCategory`).value.trim() || 'General',
            duration: parseInt(document.getElementById(`${prefix}ServiceDuration`).value),
            price: parseFloat(document.getElementById(`${prefix}ServicePrice`).value),
            description: document.getElementById(`${prefix}ServiceDescription`).value.trim(),
            servicefeatures: selectedFeatures.join(',') // Store as comma-separated IDs
        };
    }

    populateEditForm(service) {
        document.getElementById('editServiceName').value = service.servicename;
        document.getElementById('editServiceCategory').value = service.category;
        document.getElementById('editServiceDuration').value = service.duration;
        document.getElementById('editServicePrice').value = service.price;
        document.getElementById('editServiceDescription').value = service.description;

        // Clear all checkboxes
        document.querySelectorAll('#editServiceForm input[type="checkbox"]').forEach(cb => cb.checked = false);

        // Check features based on stored IDs
        if (service.servicefeatures) {
            const featureIds = service.servicefeatures.toString().split(',');
            featureIds.forEach(id => {
                // Find checkbox by value
                const checkbox = document.querySelector(`#editServiceForm input[type="checkbox"][value="${id.trim()}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        }
    }

    // UI Helper Methods
    showModal(modalId) {
        cleanupModals();
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }

    closeModal(modalId) {
        const modalElement = document.getElementById(modalId);
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
        cleanupModals();
    }

    showLoading() {
        if (!document.getElementById('apiLoader')) {
            const loader = document.createElement('div');
            loader.id = 'apiLoader';
            loader.className = 'position-fixed top-50 start-50 translate-middle';
            loader.style.zIndex = '9999';
            loader.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
            document.body.appendChild(loader);
        }
    }

    hideLoading() {
        const loader = document.getElementById('apiLoader');
        if (loader) loader.remove();
    }

    showNotification(message, type = 'info') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
        alert.style.zIndex = '9999';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alert);
        setTimeout(() => alert.remove(), 5000);
    }

    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        if (window.location.pathname.includes('services')) {
            window.serviceManager = new ServiceManager();
        }
    });
} else {
    if (window.location.pathname.includes('services')) {
        window.serviceManager = new ServiceManager();
    }
}