<?php
session_start();
include("connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $department = $_POST['department'];
    $sql = "SELECT * FROM user_tbl WHERE username='$username' AND department='$department'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>
            alert('Username Unavailable!')
            window.location = 'index.php'
        </script>";
    }else{
        $sql = "INSERT INTO user_tbl (username, password, encrypted_pass, department) VALUES ('$username', '$password','$hashedPassword', '$department')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Added Successfully!')
                window.location = 'table.php'
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
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
        <form id="register-form" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off" required>
            </div>
            <br>
            <div class="form-group" id="password-label">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" autocomplete="off" required>
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
            <input id="register-btn" type="submit" value="REGISTER" class="btn btn-dark">
            <br><br>
            <button id="table-btn" type="button">View Table</button>
        </form>
    </div>
    <?php include("app/includes/html/html.scripts.php");?>
    <script src="assets/js/scripts.js"></script>
    <script>
        $('#table-btn').on('click', function() {
            window.location.href = 'table.php';
        });
    </script>
</body>
</html>
