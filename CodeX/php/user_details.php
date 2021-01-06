<?php

include "connect.php";

// Start session
session_start();


if (!($_SESSION["username"]))
{
    #echo $_SESSION["is_admin"];
    echo "<br>Bye Thanks";
}
else
{
    $uname = $_SESSION["username"];

    $sql = "SELECT username, password, first_name, last_name, email, date_of_birth, gender FROM participant WHERE username='".$uname."'";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row['first_name'];
    $lname = $row["last_name"];
    $participant_username = $row["username"];
    $get_email = $row["email"];
    $DOB = $row["date_of_birth"];
    $gender = $row["gender"];
    # Connect HTML
}


$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>User Details</title>
    <style type="text/css">
        body { 
        margin: 0;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
      }

      .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 40px 10px;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
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
        font-size: 35px;
        font-weight: 100;
        text-transform: uppercase;

      }
        fieldset
        {        
          position: absolute;
          top: 240px;
          right: 100px;
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
        

        legend{
            color:#333;
        margin-left: auto;
        margin-right: auto;
        }
        
        .form
        {
            /* background-color: #f1f1f1; */
            color: white;
        margin-top: 0px;
        }
        tr, td, th
        {
            border-style: groove;
            border-width: 0cm;
            color: rgba(0, 0, 0, 0.705);
            /* border-color: rgba(158, 94, 105, 0.4); */
            background-color: rgba(64, 65, 66, 0.1);
            padding: 10px 20px;
            text-align: center;
            transition: background-color 2s, border-radius 2s;
        }

        table
        {
            margin-top: 5em;
            margin-left: auto;
            margin-right: auto;
        }


        th
        {
            color: white;
            border-top-left-radius: 0.3cm;
            border-top-right-radius: 0.3cm;
            border-bottom-width: 0.1cm;
            text-transform: uppercase;
            border-color: #000000;
            background-color:#333;
        }

        .btn-group2 button {
        position: absolute;
        right: 38px;
        top: 40px;
        border: none;
        background: #404040;
        color: #ffffff !important;
        font-weight: 100;
        padding: 9px 38px;
        text-transform: uppercase;
        border-radius: 6px;
        display: inline-block;
        transition: all 0.3s ease 0s;
      }

      .btn-group2 button:hover {
        color: #404040 !important;
        font-weight: 700 !important;
        letter-spacing: 3px;
        background: none;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        transition: all 0.3s ease 0s;
      }
    </style>
</head>
<body>

    <div class="header">
  <a class="logo"> View and Edit Participant Profile </a>
  <div class="btn-group2">
    <button onclick="document.location='user_portal.php'" >Back</button>
  </div>
  </div>

    <table class="styled-table">
    <thead>
        <tr>
            <th>Userame</th>
            <th><?php echo $participant_username ?></th>
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
    
    </tbody>
</table>

<div class="form">
        <fieldset>
            <legend> EDIT DETAILS </legend>
            <form name="register" autocomplete="off" action="edit_user.php" method="post">
                <input name="first_name" type="text" placeholder="Enter new first name" ><br>
                <input name="last_name" type="text" placeholder="Enter new last name" ><br>
                <input name="date_of_birth" type="text" placeholder="Date of birth YYYY-MM-DD" ><br>
                <input name="password" autocomplete="false" type="password" placeholder="Enter new password"><br>
                <br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>  
</body>
</html>




