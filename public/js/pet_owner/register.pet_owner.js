document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordIcons = document.querySelectorAll('.toggle-password');

            togglePasswordIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const passwordInput = document.getElementById(targetId);
                    const eyeIcon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text'; 
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            });
        });