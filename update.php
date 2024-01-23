<?php
include("connection.php");
$id = $_GET['updateid'];
$query = "SELECT * FROM user_tbl WHERE id='$id'";
$result = $conn->query($query);
$row = mysqli_fetch_array($result);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_GET['updateid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $department = $_POST['department'];

    $sql = "SELECT * FROM user_tbl WHERE username='$username' AND department='$department' AND id != '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>
            alert('Username Unavailable!')
            window.location = 'update.php?updateid=$id'
        </script>";
    }else{
        $sql = "UPDATE user_tbl SET username='$username', password='$password', encrypted_pass='$hashedPassword', department='$department' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert ('Update Successfully!')
                window.location = 'table.php'
            </script>";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
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
        <h2>Update Form</h2>
        <form method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $row['username'] ?>"
                    autocomplete="off">
            </div>
            <br>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $row['password'] ?>"
                    autocomplete="off">
                <input type="checkbox" id="showPassword"><a class="show-password-label">Show Password</a>
            </div>
            <br>
            <div class="form-group">
                <label>Department:</label>
                <select id="department" name="department">
                    <option value="DCS" <?php echo ($row['department'] == 'DCS') ? 'selected' : ''; ?>>DCS</option>
                    <option value="DTE" <?php echo ($row['department'] == 'DTE') ? 'selected' : ''; ?>>DTE</option>
                    <option value="DEE" <?php echo ($row['department'] == 'DEE') ? 'selected' : ''; ?>>DEE</option>
                </select>
            </div>
            <br>
            <input id="update" type="submit" value="UPDATE" class="btn btn-dark">
        </form>
    </div>
    <?php include("app/includes/html/html.scripts.php");?>
</body>
</html>