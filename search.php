<?php
include("connection.php");

if(isset($_POST['input'])){
    $input = $_POST['input'];
    $query = "SELECT * FROM user_tbl WHERE username LIKE '{$input}%' OR password LIKE '{$input}%'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $password = $row['password'];
            $encrypted_pass = $row['encrypted_pass'];
            $department = $row['department'];
            ?>
            <tr>
                <td><?php echo $username; ?></td>
                <td><?php echo $password;?></td>
                <td><?php echo $encrypted_pass;?></td>
                <td><?php echo $department;?></td>
                <td>
                    <a href="update.php?updateid=<?php echo $row['id']?>" class="btn btn-primary">Update</a>
                    <a href="delete.php?deleteid=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="5">0 results</td></tr>';
    }
}
?>
