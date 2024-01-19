const showPasswordCheckbox = document.getElementById("showPassword");
        const passwordInput = document.getElementById("password");

        showPasswordCheckbox.addEventListener("change", function () {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
        const passwdInput = document.getElementById("password");

        function hashPasswordAndStore() {
            
            const sha256script = document.createElement('script');
            sha256script.src = 'https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js';
            document.head.appendChild(sha256script);

            sha256script.onload = function () {
                
                const hashedPassword = sha256(passwordInput.value);

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "hash.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Stored Successful!');
                    }
                };
                xhr.send("hashedPassword=" + encodeURIComponent(hashedPassword));
            };
        }