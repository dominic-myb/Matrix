<?php
session_start();
include("connection.php");
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
            width: 30%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .show-password-label a{
            float: right;
        }
        button:hover {
            background-color: #45a049;
        }
        #password-label input{
            float: left;
        }
    </style>
    <title>Registration Form</title>

</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form id="register-form">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group" id="password-label">
                <label>Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="checkbox" id="showPassword"><a class="show-password-label">Show Password</a>
            </div>
            
            <div class="form-group">
                <label>Department:</label>
                <select id="department" name="department" required>
                <option value="DCS">DCS</option>
                <option value="DTE">DTE</option>
                <option value="DEE">DEE</option>
                </select>
            </div>
            <br>

            <input id="text" type="submit" value="REGISTER" class="btn btn-dark" onclick="storeData()">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
