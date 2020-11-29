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
        $admin_username = $_SESSION["username"];   
        $sql = "SELECT first_name FROM admin WHERE username='".$admin_username."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['first_name'];
    }
}

$conn->close();
?> 

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(99,128,107);
}
a:link {
  color: white;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: white;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: #11346b;
  background-color: transparent;
  text-decoration: underline;
}

.btn-group button {
  position: absolute;
  top: 60px;
  right: 15px;
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group button:hover {
  background-color: #11346b;
}

.btn-group2 button {
  position: absolute;
  top: 100px;
  right: 15px;
  background-color: #11346b; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 5px 5px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button:hover {
  background-color: #0E5225;
}

.card {
  position: absolute;
  top: 200px;
  right: 800px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  color: white;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.card2 {
  position: absolute;
  top: 200px;
  right: 500px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  color: white;
}
.card2:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.card3 {
  position: absolute;
  top: 200px;
  right: 200px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  color: white;
}
.card3:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  text-align: center;
}
/* Add a background color on hover */

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 40px 10px;
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
  font-weight: bold;
}
.header b {
  position: absolute;
  top: 10px;
  right: 20px;
  color: black;
  text-align: center;
  padding: 20px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header b.logo {
  font-size: 18px;
  font-weight: bold;
}
  
}
</style>
</head>
<body>

<div class="header">
  <a class="logo"> Admin Dashboard</a>
  <b class="logo"> <?php echo "Welcome ".$name ?> </b>

  <div class="btn-group">
    <button onclick="document.location='admin_details.php'"  style="width:25%">View and Edit Profile</button>
  </div>
</div>

<div class="btn-group2">
    <button onclick="document.location='../html/index.html'" style="width:25%">Sign Out </button>  
</div>

<div class="card">
  <img src="../img/images.png" alt="Avatar" style="width:100%">
  <div class="container">
    <A href="../html/add-contest.html"> <h4>Create New Contests</h4>  </A>
  </div>
</div>

<div class="card2">
  <img src="../img/images.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h4>View All Contests</h4> 
  </div>
</div>
<div class="card3">
  <img src="../img/images.png" alt="Avatar" style="width:100%">
  <div class="container">
  <A href="contest_details.php"><h4>My Contests</h4> </A>
  </div>
</div>


</body>
</html>