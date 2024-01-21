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

function storeData() {
    const sha256script = document.createElement('script');
    sha256script.src = 'https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js';
    document.head.appendChild(sha256script);

    sha256script.onload = function () {
        // Wait for the script to be loaded before executing the code inside

        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        const hashedPassword = sha256(password);
        var department = document.getElementById("department").value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "store-data.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    alert('Stored Successfully!');
                    window.location = "index.php";
                } else {
                    console.error('Error storing data. Status:', xhr.status);
                    // Handle the error appropriately
                }
            }
        };

        // Construct the data to be sent in the request
        const data = "username=" + encodeURIComponent(username) +
                     "&password=" + encodeURIComponent(password) +
                     "&hashedPassword=" + encodeURIComponent(hashedPassword) +
                     "&department=" + encodeURIComponent(department);

        xhr.send(data);
    };
}

