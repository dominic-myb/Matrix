<?php
    include("connection.php");
    $query = "SELECT * FROM user_tbl";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
?>
            <tr>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['password']?></td>
                <td><?php echo $row['encrypted_pass']?></td>
                <td><?php echo $row['department']?></td>
                <td>
                    <a href="update.php?updateid=<?php echo $row['id']?>" class="btn btn-primary">Update</a>
                    <a href="delete.php?deleteid=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
<?php
        }
    } 
    else {
        echo '<tr><td colspan="5">0 results</td></tr>';
    }
?>