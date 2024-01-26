<?php
include("connection.php");

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    echo '<script>
        let message = "Are you sure you want to delete this account?";
        if (confirm(message)) {
            window.location.href = "delete.php?id=' . $id . '";
        } else {
            alert("Deletion Cancelled!");
            window.location.href = "table.php";
        }
    </script>';
}

?>

<?php
include("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM user_tbl WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>
                alert("Deleted Successfully!");
                window.location.href = "table.php";
            </script>';
    } else {
        echo '<script>
                alert("Deletion Unsuccessful!");
                window.location.href = "table.php";
            </script>';
    }
}
?>
