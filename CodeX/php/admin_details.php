<?php

$servername = "localhost";
$username = "debian-sys-maint";
$password = "NVxKE4bCYGO8nV9Y";
$dbname = "Code-X";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

// If session doesnt have relevant variables
if (!(isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
{
    echo "Nopes";
}
else
{
    if (!($_SESSION["is_admin"]))
    {
        echo $_SESSION["is_admin"];
        echo "<br> Not an admin";
    }
    else
    {
        $uname = $_SESSION["username"];
        $sql = "SELECT * FROM admin WHERE username='".$uname."'";
    
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $name = $row['first_name'];
        $lname = $row["last_name"];
        $admin_username = $row["username"];
        $get_email = $row["email"];
        $DOB = $row["date_of_birth"];
        $gender = $row["gender"];
        $org = $row["organization"];  
    }
}

$conn->close();
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Admin Details</title>
    <style type="text/css">
        body{
        background-color: rgb(99,128,107)
        }
        fieldset
        {        
          position: absolute;
          top: 140px;
          right: 500px;
          width: 10em
        }
        input[type=text] {
          border: 2px solid #555;
          outline: none;
        }

        input[type=text]:focus{
          background-color: lightblue;
        }
        input[type=password] {
          border: 2px solid #555;
          outline: none;
        }

        input[type=password]:focus{
          background-color: lightblue;
        }
        input[type=submit] {
            color: white;
          background-color: #11346b;
        }
        input[type=submit]:hover {
          background-color: #3e8e41;
        }

        legend{
        margin-left: auto;
        margin-right: auto;
        }
        .header {
          overflow: hidden;
          background-color: #f1f1f1;
          padding: 30px 10px;
        }

        .header a {
          float: left;
          color: black;
          text-align: center;
          padding: 12px;
          text-decoration: none;
          font-size: 18px; 
          line-height: 25px;
          border-radius: 4px;
        }

        .header a.logo {
          font-size: 25px;
          font-weight: bold;
        }
        .form
        {
            background-color: #f1f1f1;
            color: white;
        margin-top: 0px;
        }
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        }

        .styled-table th,
        .styled-table td {
        padding: 12px 15px;
        }
            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
            }

        .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
        }
    </style>
</head>
<body>

    <div class="header">
  <a class="logo"> View and Edit Admin Profile </a>
  </div>

    <table class="styled-table">
    <thead>
        <tr>
            <th>Userame</th>
            <th><?php echo $admin_username ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>First Name</td>
            <td><?php echo $name ?></td>
        </tr>
        <tr class="active-row">
            <td>Last Name</td>
            <td><?php echo $lname ?></td>
        </tr>
        <tr >
            <td >Email</td>
            <td><?php echo $get_email ?></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Date Of Birth</td>
            <td><?php echo $DOB ?></td>
        </tr>
        <tr >
            <td>Gender</td>
            <td><?php echo $gender ?></td>
        </tr>
        <tr >
            <td>Organization</td>
            <td><?php echo $org ?></td>

        </tr>
    </tbody>
</table>

<div class="form">
        <fieldset>
            <legend> EDIT DETAILS </legend>
            <form name="register" autocomplete="off" action="edit_admin.php" method="post">
                <input name="first_name" type="text" placeholder="Enter new first name" ><br>
                <input name="last_name" type="text" placeholder="Enter new last name" ><br>
                <input name="date_of_birth" type="text" placeholder="Date of birth YYYY-MM-DD" ><br>
                <input name="organization" type="text" placeholder="Enter new organization" ><br>
                <input name="password" autocomplete="false" type="password" placeholder="Enter new password"><br>
                <br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>  
    
</body>
</html>
