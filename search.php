<?php
include("connection.php");

$input = $_POST['input'];
$department = $_POST['department'];

$sql = "SELECT * FROM user_tbl";

if ($department != "All") {
    $sql .= " WHERE department = '" . mysqli_real_escape_string($conn, $department) . "'";
}

if ($input != "") {
    if ($department == "All") {
        $sql .= " WHERE";
    } else {
        $sql .= " AND";
    }

    $sql .= " (username LIKE '" . mysqli_real_escape_string($conn, $input) . "%' OR password LIKE '" . mysqli_real_escape_string($conn, $input) . "%')";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            
            $username = $row["username"];
            $password = $row["password"];
            $encrypted_pass = $row["encrypted_pass"];
            $department = $row["department"];

            ?>
            <tr>
                <td><?php echo $username; ?></td>
                <td><?php echo $password; ?></td>
                <td><?php echo $encrypted_pass; ?></td>
                <td><?php echo $department; ?></td>
                <td>
                    <a href='update.php?updateid=<?php echo $row["id"]?>' class='btn btn-primary'>Update</a>
                    <a href='delete.php?deleteid=<?php echo $row["id"]?>' class='btn btn-danger'>Delete</a>
                </td>
            </tr>
            <?php
        }

        mysqli_free_result($result);

    } else {
        echo '<tr><td colspan="5">0 results</td></tr>';
    }
} else {
    echo '<tr><td colspan="5">0 results</td></tr>';
}
mysqli_close($conn);
?>
