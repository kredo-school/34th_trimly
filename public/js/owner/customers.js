// =====================================================
// Salon Owner - Customers Management
// =====================================================

document.addEventListener('DOMContentLoaded', function() {
    let customers = [];
    let deleteModal = null;
    let isSearching = false;

    // Initialize delete modal
    const deleteModalElement = document.getElementById('deleteConfirmModal');
    if (deleteModalElement) {
        deleteModal = new bootstrap.Modal(deleteModalElement);
    }

    // Fetch customers from API
    async function fetchCustomers(search = '') {
        try {
            // Set searching flag
            isSearching = search.trim() !== '';
            
            // Show loading state
            const loadingSpinner = document.getElementById('loadingSpinner');
            const grid = document.getElementById('customersGrid');
            const emptyState = document.getElementById('emptyState');
            
            if (loadingSpinner && grid) {
                // Show spinner only for initial load or search
                if (grid.children.length === 0 || isSearching) {
                    loadingSpinner.style.display = 'block';
                    grid.innerHTML = '';
                }
                if (emptyState) {
                    emptyState.style.display = 'none';
                }
            }
            
            const response = await fetch(`/api/salon-owner/customers?search=${encodeURIComponent(search)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });

            if (!response.ok) {
                throw new Error('Failed to fetch customers');
            }

            const data = await response.json();
            
            if (data.success) {
                customers = data.data;
                renderCustomers();
            }
        } catch (error) {
            console.error('Error fetching customers:', error);
            // Hide loading spinner on error
            const loadingSpinner = document.getElementById('loadingSpinner');
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
            showError('Failed to load customers. Please try again.');
        }
    }

    // Render customers grid
    function renderCustomers() {
        const grid = document.getElementById('customersGrid');
        const emptyState = document.getElementById('emptyState');
        const loadingSpinner = document.getElementById('loadingSpinner');
        
        // Hide loading spinner
        if (loadingSpinner) {
            loadingSpinner.style.display = 'none';
        }
        
        if (customers.length === 0) {
            grid.innerHTML = '';
            if (emptyState) {
                emptyState.style.display = 'block';
                // Update empty state message based on search status
                const h5 = emptyState.querySelector('h5');
                const p = emptyState.querySelector('p');
                
                if (isSearching) {
                    if (h5) h5.textContent = 'No customers found';
                    if (p) p.textContent = 'Try adjusting your search criteria.';
                } else {
                    if (h5) h5.textContent = 'No customers yet';
                    if (p) p.textContent = 'Customers will appear here when they register with your salon code.';
                }
            }
            return;
        }
        
        if (emptyState) {
            emptyState.style.display = 'none';
        }
        
        grid.innerHTML = customers.map(customer => createCustomerCard(customer)).join('');
    }

    // Create customer card HTML
    function createCustomerCard(customer) {
        const lastVisit = customer.stats.last_visit 
            ? formatLastVisit(customer.stats.last_visit)
            : 'No visits yet';

        const petsHtml = customer.pets.map(pet => `
            <div class="mb-2">
                <span class="owner-pet-name">${escapeHtml(pet.name)}</span><br>
                <span class="text-muted owner-pet-details">${escapeHtml(pet.breed)} • ${pet.age} • ${pet.size}</span>
                ${pet.notes ? `<div class="text-muted owner-pet-notes">${escapeHtml(pet.notes)}</div>` : ''}
            </div>
        `).join('');

        return `
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Customer Header -->
                        <div class="d-flex justify-content-between align-items-start mb-3 owner-customer-header">
                            <div>
                                <h5 class="mb-1">${escapeHtml(customer.full_name)}</h5>
                                <p class="text-muted owner-customer-member-since">Member since ${customer.stats.member_since}</p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-ghost btn-sm owner-action-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="confirmDeleteCustomer(event, ${customer.id}, '${escapeHtml(customer.full_name)}')">
                                            <i class="fa-solid fa-trash-can me-2"></i>Delete Customer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Customer Contact Info -->
                        <div class="owner-customer-contact-info">
                            <div class="owner-customer-contact-item">
                                <i class="fa-solid fa-envelope text-muted"></i>
                                <span>${escapeHtml(customer.email)}</span>
                            </div>
                            <div class="owner-customer-contact-item">
                                <i class="fa-solid fa-phone text-muted"></i>
                                <span>${escapeHtml(customer.phone)}</span>
                            </div>
                            ${customer.address ? `
                                <div class="owner-customer-contact-item">
                                    <i class="fa-solid fa-location-dot text-muted"></i>
                                    <span>${escapeHtml(customer.address)}, ${escapeHtml(customer.city)}</span>
                                </div>
                            ` : ''}
                        </div>

                        <!-- Pet Information -->
                        <div class="owner-pet-section">
                            <h6 class="mb-2">Pets</h6>
                            ${petsHtml || '<p class="text-muted">No pets registered</p>'}
                        </div>

                        <!-- Customer Stats -->
                        <div class="owner-customer-stats">
                            <div class="owner-stats-grid">
                                <div class="owner-stat-item">
                                    <div class="owner-stat-value">${customer.stats.total_visits}</div>
                                    <div class="text-muted owner-stat-label">Total Visits</div>
                                </div>
                                <div class="owner-stat-item">
                                    <div class="owner-stat-value">$${customer.stats.total_spent}</div>
                                    <div class="text-muted owner-stat-label">Total Spent</div>
                                </div>
                                <div class="owner-stat-item">
                                    <div class="owner-stat-value">${lastVisit}</div>
                                    <div class="text-muted owner-stat-label">Last Visit</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Format last visit date
    function formatLastVisit(dateString) {
        if (!dateString) return 'No visits yet';
        
        const date = new Date(dateString);
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        
        if (date.toDateString() === today.toDateString()) {
            return 'Today';
        } else if (date.toDateString() === yesterday.toDateString()) {
            return 'Yesterday';
        } else {
            const days = Math.floor((today - date) / (1000 * 60 * 60 * 24));
            if (days < 7) {
                return `${days} days ago`;
            } else if (days < 30) {
                const weeks = Math.floor(days / 7);
                return `${weeks} week${weeks > 1 ? 's' : ''} ago`;
            } else {
                return date.toLocaleDateString();
            }
        }
    }

    // Delete customer
    window.confirmDeleteCustomer = function(event, customerId, customerName) {
        event.preventDefault();
        
        document.getElementById('deleteCustomerId').value = customerId;
        
        // Update modal message
        const modalBody = deleteModalElement.querySelector('.modal-body p');
        if (modalBody) {
            modalBody.textContent = `Are you sure you want to remove ${customerName}? This action cannot be undone.`;
        }
        
        deleteModal.show();
    };

    // Handle delete confirmation
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', async function() {
            const customerId = document.getElementById('deleteCustomerId').value;
            
            try {
                const response = await fetch(`/api/salon-owner/customers/${customerId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    deleteModal.hide();
                    // Get current search value
                    const searchInput = document.getElementById('searchInput');
                    const currentSearch = searchInput ? searchInput.value : '';
                    // Refresh customer list with current search
                    await fetchCustomers(currentSearch);
                    showSuccess('Customer removed successfully');
                } else {
                    showError(data.message || 'Failed to remove customer');
                }
            } catch (error) {
                console.error('Error deleting customer:', error);
                showError('Failed to remove customer. Please try again.');
            }
        });
    }

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchValue = e.target.value;
            
            // Set loading state immediately for better UX
            const loadingSpinner = document.getElementById('loadingSpinner');
            const grid = document.getElementById('customersGrid');
            
            if (searchValue.trim() !== '') {
                if (loadingSpinner && grid) {
                    loadingSpinner.style.display = 'block';
                    grid.innerHTML = '';
                }
            }
            
            searchTimeout = setTimeout(() => {
                fetchCustomers(searchValue);
            }, 300); // Debounce for 300ms
        });
    }

    // Utility functions
    function getCsrfToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        return token ? token.getAttribute('content') : '';
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // function showSuccess(message) {
    //     // You can implement toast notifications here
    //     console.log('Success:', message);
    //     // Simple alert for now
    //     alert(message);
    // }

    // function showError(message) {
    //     // You can implement toast notifications here
    //     console.error('Error:', message);
    //     // Simple alert for now
    //     alert(message);
    // }

    // Initial load
    fetchCustomers();
});