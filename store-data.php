<?php
include("connection.php");

$username = $_POST["username"];
$password = $_POST["password"];
$hashedPassword = $_POST['hashedPassword'];
$department = $_POST["department"];

$sql = "INSERT INTO user_tbl (username, password, encrypted_pass, department) VALUES ('$username', '$password','$hashedPassword','$department')";

if ($conn->query($sql) === TRUE) {
    echo '<script>
    alert ("Added Succesfully!");
    window.location="table.php";
    </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>