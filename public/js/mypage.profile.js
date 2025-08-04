
document.addEventListener('DOMContentLoaded', function() {
            // 現在のパスワードフィールドの目玉アイコンのみを対象にする
            const togglePasswordIcon = document.querySelector('.toggle-password[data-target="currentPassword"]');

            if (togglePasswordIcon) { // 目玉アイコンが存在する場合のみイベントリスナーを設定
                togglePasswordIcon.addEventListener('click', function() {
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
            }
        });