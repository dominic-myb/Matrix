<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "password_db";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}