<?php
    include "connection.php";
    $id = $_GET['updateid'];
    $query = "SELECT * FROM user_tbl WHERE id='$id'";
    $result = $conn->query($query);
    $row = mysqli_fetch_array($result);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $department =$_POST['department'];
        $sql = "UPDATE user_tbl SET username='$username', password='$password', department='$department' WHERE id='$id'";
        if($conn->query($sql) === TRUE){
            echo "<script>
            alert ('Update Successfully!')
            window.location = 'index.php'
            </script>";
        }
        //add here the func for ecryption && the dep
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

    </style>

    <title>Update Form Form</title>

</head>
<body>
    <div class="container">

        <h2>Update Form</h2>
        
        <form method="POST">

            <div class="form-group">
                <label>Username:</label>
                <input type="text" id="text" name="username" value="<?php echo $row['username']?>" autocomplete="off">
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="text" name="password" value="<?php echo $row['password']?>" autocomplete="off">
            </div>
            
            <div class="form-group">
                <label>Department:</label>
                <select id="choices" name="department">
                <option value="DCS" <?php echo ($row['department'] == 'DCS') ? 'selected' : ''; ?>>DCS</option>
                <option value="DTE" <?php echo ($row['department'] == 'DTE') ? 'selected' : ''; ?>>DTE</option>
                <option value="DEE" <?php echo ($row['department'] == 'DEE') ? 'selected' : ''; ?>>DEE</option>
                </select>
            </div>

            <br>

            <input id="text" type="submit" value="UPDATE" class="btn btn-dark">
        </form>
    </div>
</body>
</html>