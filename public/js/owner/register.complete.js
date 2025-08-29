/**
 * Navigate to dashboard
 */
function goToDashboard() {
    window.location.href = '/dashboard-salonowner/appointments';
}

// DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', function() {
    // Get the dashboard button
    const dashboardBtn = document.querySelector('.btn-owner-continue');
    if (dashboardBtn) {
        dashboardBtn.addEventListener('click', goToDashboard);
    }
});