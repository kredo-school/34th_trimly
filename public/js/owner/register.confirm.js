
// Owner form validation
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const termsChecked = document.getElementById('termsCheckbox').checked;
    const authorityChecked = document.getElementById('authorityCheckbox').checked;
    
    if (!termsChecked || !authorityChecked) {
        alert('Please accept all terms and conditions to continue.');
        return;
    }
    
    alert('Salon account created successfully! Proceeding to next step...');
});

/**
 * Navigate back to previous page
 */
function goBack() {
    window.location.href = '/register-salonowner/salon-info';
}
