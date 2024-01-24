<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);

    // Validate input
    if (empty($username) || empty($password) || empty($department)) {
        echo "<script>
            alert('Please fill in all fields!')
            window.location = 'index.php'
        </script>";
        exit;
    }

    $hashedPassword = hash('sha256', $password);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user_tbl WHERE username=? AND department=?");
    $stmt->bind_param("ss", $username, $department);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        echo "<script>
            alert('Username Unavailable!')
            window.location = 'index.php'
        </script>";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO user_tbl (username, password, encrypted_pass, department) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $hashedPassword, $department);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>
                alert('Added Successfully!')
                window.location = 'table.php'
            </script>";
        } else {
            echo "<script>
                alert('Error adding user!')
                window.location = 'index.php'
            </script>";
        }

        $stmt->close();
    }

    $conn->close();
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
                <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
            </div>
            <br>
            <div class="form-group" id="password-label">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                <br><br><br>
                <div class="show-hide">
                    <label for="showPassword" class="form-check-label" style="display: inline-block; float:left; ">Show Password: &nbsp;&nbsp;&nbsp;</label>
                    <input type="checkbox" id="showPassword" class="form-check-input">
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="department" style="display:inline-block; float:left;">Department: &nbsp;&nbsp;</label>
                <select id="department" name="department" class="btn btn-secondary btn-sm dropdown-toggle"required>
                <option value="DCS">DCS</option>
                <option value="DTE">DTE</option>
                <option value="DEE">DEE</option>
                </select>
            </div><br>
            <input id="register-btn" type="submit" value="Register" class="btn btn-dark" ><br><br>
            <input id="table-btn" class="btn btn-success" type="button" value="View Table">
            <br><br>
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
