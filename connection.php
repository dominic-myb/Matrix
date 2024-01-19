<?php
$conn = mysqli_connect("localhost", "root", "", "password_db");

if (!$conn) {
    die("Connection failed: " . mysqli_error());
}
?>