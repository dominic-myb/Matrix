const showPasswordCheckbox = document.getElementById("showPassword");
const passwordInput = document.getElementById("password");

showPasswordCheckbox.addEventListener("change", function () {
    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
});

function storeData() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var department = document.getElementById("department").value;
    if(username == "" | password=="" | department == ""){
        window.alert("Invalid Input!");
        window.location = "create.php";
    }else{
        const sha256script = document.createElement('script');
        sha256script.src = 'https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js';
        document.head.appendChild(sha256script);

        sha256script.onload = function () {
            // Wait for the script to be loaded before executing the code inside

            const hashedPassword = sha256(password);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "store-data.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status !== 200) {
                        console.error('Error storing data. Status:', xhr.status);
                    } 
                }
            };

            // Construct the data to be sent in the request
            const data = "username=" + encodeURIComponent(username) +
                        "&password=" + encodeURIComponent(password) +
                        "&hashedPassword=" + encodeURIComponent(hashedPassword) +
                        "&department=" + encodeURIComponent(department);

            xhr.send(data);
            alert('Added Successfully!');
            window.location = "table.php";
        };
    }
}
function updateData() {
    var id = document.getElementById("id").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var department = document.getElementById("department").value;
    if(username == "" || password=="" || department == ""){
        window.alert("Invalid Input!");
        window.location = "update.php";
    }else{
        const sha256script = document.createElement('script');
        sha256script.src = 'https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js';
        document.head.appendChild(sha256script);

        sha256script.onload = function () {
            // Wait for the script to be loaded before executing the code inside

            const hashedPassword = sha256(password);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update-data.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status !== 200) {
                        console.error('Error storing data. Status:', xhr.status);
                    } 
                }
            };

            // Construct the data to be sent in the request
            const data = "id=" + encodeURIComponent(id) +
                        "&username=" + encodeURIComponent(username) +
                        "&password=" + encodeURIComponent(password) +
                        "&hashedPassword=" + encodeURIComponent(hashedPassword) +
                        "&department=" + encodeURIComponent(department);

            xhr.send(data);
            alert('Updated Successfully!');
            window.location = "table.php";
        };
    }
}