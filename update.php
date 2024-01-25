<?php
include("connection.php");

$id = filter_input(INPUT_GET, 'updateid', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<script>
        alert('Invalid ID!')
        window.location = 'update.php'
    </script>";
    exit;
}

$query = "SELECT * FROM user_tbl WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($password) || empty($department)) {
        echo "<script>
            alert('Please fill in all fields!')
            window.location = 'update.php?updateid=$id'
        </script>";
        exit;
    }

    $hashedPassword = hash('sha256', $password);

    $sql = "SELECT * FROM user_tbl WHERE username=? AND department=? AND id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $department, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        echo "<script>
            alert('Username Unavailable!')
            window.location = 'update.php?updateid=$id'
        </script>";
    } else {

        $sql = "UPDATE user_tbl SET username=?, password=?, encrypted_pass=?, department=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $password, $hashedPassword, $department, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>
                alert('Updated Successfully!')
                window.location = 'table.php'
            </script>";
        } else {
            echo "<script>
                alert('Nothing is Changed!')
                window.location = 'table.php';
            </script>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    $styleCSS = "assets/css/form.css";
    $pageTitle = "Password Matrix - Update";
    include("app/includes/html/html.head.php");
?>
<body>
    <div class="container">
        <br>
        <h2>Update Form</h2><br>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username'] ?>"
                    autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password'] ?>"
                    autocomplete="off">
                    <br><br>
                <div class="show-hide">
                    <label for="showPassword" class="form-check-label" style="display: inline-block; float:left;">Show Password: &nbsp;&nbsp;&nbsp;</label>
                    <input type="checkbox" id="showPassword" class="form-check-input">
                </div>
            </div>
            
            <div class="form-group">
                <label for="department" style="display: inline-block; float:left;">Department: &nbsp;&nbsp;</label>
                <select id="department" name="department" class="btn btn-secondary btn-sm dropdown-toggle">
                    <option value="DCS" <?php echo ($row['department'] == 'DCS') ? 'selected' : ''; ?>>DCS</option>
                    <option value="DTE" <?php echo ($row['department'] == 'DTE') ? 'selected' : ''; ?>>DTE</option>
                    <option value="DEE" <?php echo ($row['department'] == 'DEE') ? 'selected' : ''; ?>>DEE</option>
                </select>
            </div>
            <br>
            <input id="update" type="submit" value="UPDATE" class="btn btn-dark"><br><br>
        </form>
    </div>
    <?php include("app/includes/html/html.scripts.php");?>
</body>
</html>