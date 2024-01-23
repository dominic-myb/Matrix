<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php
    $styleCSS = "assets/css/style.css";
    $pageTitle = "Password Matrix";
    include("app/includes/html/html.head.php");
?>
<body class="bg-light">
    <div class="container">
    <div class="row justify-content-center">
        <h2>Password Matrix</h2><br><br><br>
            <div class="col-auto">
                <label for="dropdown" class="form-label">Filter by Department:</label>
            </div>
            <div class="col-auto">
                <select id="dropdown" class="form-select">
                    <option value="All">All Departments</option>
                    <option value="DCS">DCS</option>
                    <option value="DTE">DTE</option>
                    <option value="DEE">DEE</option>
                </select>
            </div>
            <div class="col-auto">
                <label for="search" class="form-label">Search:</label>
            </div>
            <div class="col-auto">
                <input type="text" id="search" class="form-control" placeholder="Search . . .">
            </div>
            <div class="col-auto">
                <button id="home-btn" type="button" class="btn btn-success">Home</button>
            </div>
        </div>
    
        <br><br>
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

            updateTable();

            $("#search").keyup(function(){
                updateTable();
            });

            $("#dropdown").on("change", function(){
                updateTable();
            });

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
        $('#home-btn').on('click', function() {
            window.location.href = 'index.php';
        });
    </script>
    </body>
</html>

