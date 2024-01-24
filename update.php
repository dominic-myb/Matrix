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