<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connection.php");
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = $_POST['hashedPassword'];
    $department = $_POST['department'];
    $sql = "UPDATE user_tbl SET username='$username', password='$password', encrypted_pass='$hashedPassword', department='$department' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert ('Update Successfully!')
            window.location = 'table.php'
        </script>";
    }
}
