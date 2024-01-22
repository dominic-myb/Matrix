<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php
$styleCSS = "assets/css/form.css";
$pageTitle = "Password Matrix";
include("app/includes/html/html.head.php");
?>
<body>
    <div class="container">
        <br>
        <h2>Password Matrix</h2>
        <br>
        <form id="register-form">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <br>
            <div class="form-group" id="password-label">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="checkbox" id="showPassword"><a class="show-password-label">Show Password</a>
            </div>
            <br>
            <div class="form-group">
                <label for="department">Department:</label>
                <select id="department" name="department" required>
                <option value="DCS">DCS</option>
                <option value="DTE">DTE</option>
                <option value="DEE">DEE</option>
                </select>
            </div>
            <br>
            <input id="register-btn" type="submit" value="REGISTER" class="btn btn-dark" onclick="storeData()">
            <br><br>
            <button id="table-btn" type="button">View Table</button>
        </form>
    </div>
    <?php include("app/includes/html/html.scripts.php");?>
    <script src="assets/js/scripts.js"></script>
    <script>
        $('#table-btn').on('click', function() {
            // Redirect to the desired PHP file
            window.location.href = 'table.php';
        });
    </script>
</body>
</html>
