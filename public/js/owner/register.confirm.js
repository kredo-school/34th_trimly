// Owner form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const termsChecked = document.getElementById('termsCheckbox').checked;
    const authorityChecked = document.getElementById('authorityCheckbox').checked;
    
    if (!termsChecked || !authorityChecked) {
        e.preventDefault(); // Only prevent submission if checkboxes are not checked
        alert('Please accept all terms and conditions to continue.');
        return;
    }
    
    // Remove the alert - let the form submit naturally
    // alert('Salon account created successfully! Proceeding to next step...');
});

/**
 * Navigate back to previous page
 */
function goBack() {
    window.history.back(); // または
    // window.location.href = '/register-salonowner'; // スラッシュなし
}