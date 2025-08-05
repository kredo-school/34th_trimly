 document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword'); // IDで要素を取得

            if (passwordField && togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);

                    // 目のアイコンの表示を切り替える
                    if (type === 'password') {
                        this.innerHTML = '<i class="fa-solid fa-eye"></i>'; // 閉じている目
                    } else {
                        this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'; // 開いている目
                    }
                });
            }
        });