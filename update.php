<?php
include("connection.php");
$id = $_GET['updateid'];
$query = "SELECT * FROM user_tbl WHERE id='$id'";
$result = $conn->query($query);
$row = mysqli_fetch_array($result);
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
        <form id="update-form">
            <div class="form-group">
                <input type="hidden" id="id" name="updateid" value="<?php echo $row['id'] ?>">
            </div>

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
            <input id="update" type="submit" value="UPDATE" class="btn btn-dark" onclick="updateData()">
        </form>
    </div>
    <?php include("app/includes/html/html.scripts.php");?>
</body>

</html>