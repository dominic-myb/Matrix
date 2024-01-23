<?php
include("connection.php");
$id = $_GET['deleteid'];
$sql = "DELETE FROM user_tbl WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<script>
            alert ("Deleted Succesfully!")
            window.location="table.php";
        </script>';
} else {
    echo '<script>
            alert ("Deletion Unsuccesful!")
            window.location="table.php";
        </script>';
}