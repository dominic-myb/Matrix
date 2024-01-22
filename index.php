<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Password Matrix</title>
</head>
<body>
    <div class="container">

        <div class="filter-container">
            <h2>USER DATA</h2>
            <label for="dropdown">Filter by Department:</label>
            <select id="dropdown">
                <option value="All">All Departments</option>
                <option value="DCS">DCS</option>
                <option value="DTE">DTE</option>
                <option value="DEE">DEE</option>
            </select>
        </div>
        
        <div class="search-container">
            <label for="search">Search:</label>
            <input type="text" id="search" placeholder="Search . . .">
        </div>
        
        <div class="box1">
            <h3>USERS:</h3>
            <a href="create.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Add Users</a>
        </div>
        <div id="search-result"></div>
        <form method="POST">
        <table id="customers">
            <thead>
                <tr>
                    <th scope = "col">Username</th>
                    <th scope = "col">Original Password</th>
                    <th scope = "col">Encrypted Password</th>
                    <th scope = "col">Department</th>
                    <th scope = "col">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
            <?php
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
                    }else {
                        echo '<tr><td colspan="5">0 results</td></tr>';
                    }
            ?>
            </tbody>
        </table>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Initial load
            updateTable();

            // Event handlers
            $("#search").keyup(function(){
                updateTable();
            });

            $("#dropdown").on("change", function(){
                updateTable();
            });

            // Function to update table based on search and department filter
            function updateTable() {
                var input = $("#search").val();
                var department = $("#dropdown").val();

                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: { input: input, department: department },
                    success: function(data){
                        $("#table-body").html(data);

                        if (input !== "") {
                            $("#search-result").css("display", "block");
                        } else {
                            $("#search-result").css("display", "none");
                        }
                    }
                });
            }
        });
    </script>
    </body>
</html>

