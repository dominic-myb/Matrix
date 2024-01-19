<?php
    include("connection.php");
// Retrieve the hashed password from the AJAX request
$hashedPassword = $_POST['hashedPassword'];

// Store the hashed password in the database
$sql = "INSERT INTO user_tbl (encrypted_pass) VALUES ('$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo '<script>
    alert ("Added Succesfully!")
    window.location="index.php"
    </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
