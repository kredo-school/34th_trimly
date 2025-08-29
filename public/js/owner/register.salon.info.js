function toggleOwnerPassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
 }
 
 // Owner form validation
 document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();  // Stop submission only if passwords don't match
        alert('Passwords do not match!');
        return;
    }
    
    if (password.length < 8) {
        e.preventDefault();  // Stop submission only if password is too short
        alert('Password must be at least 8 characters long!');
        return;
    }
    
    // If validation passes, form will submit automatically
    // alert('Owner registration information submitted successfully! Proceeding to confirmation...');
 });
