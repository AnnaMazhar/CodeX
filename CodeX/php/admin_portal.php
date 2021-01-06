<?php

include "connect.php";

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

a:link {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: #333;
  background-color: transparent;
  text-decoration: underline;
}
body { 
  margin: 0;
  font-family: URW Gothic L;
  
  /* background-color: rgb(99,128,107); */
  /* background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1)) */
}
.btn-group button {
  position: absolute;
  right: 38px;
  top: 48px;
  border: none;
  background: #404040;
  color: #ffffff !important;
  font-weight: 100;
  padding: 9px 38px;
  text-transform: uppercase;
  border-radius: 6px;
  display: inline-block;
  transition: all 0.3s ease 0s;
  /* float: right; */
}

.btn-group button:hover {
  color: #404040 !important;
  font-weight: 700 !important;
  letter-spacing: 3px;
  background: none;
  -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
  -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
  transition: all 0.3s ease 0s;
}

.btn-group2 button {
  position: absolute;
  top: 88px;
  right: 38px;
  border: none;
  background: #404040;
  color: #ffffff !important;
  font-weight: 100;
  padding: 9px 12px;
  text-transform: uppercase;
  border-radius: 6px;
  display: inline-block;
  transition: all 0.3s ease 0s;
  /* float: right; */
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

.card {
  /*position: absolute;*/
  /*top: 200px;*/
  /*right: 800px;*/
  display: inline-block;
  margin-top: 5em;
  margin-left: 9em;
  margin-right: 3em;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.7);
  transition: 0.3s;
  width: 20%;
  color: black;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}
.card2 {
  /*position: absolute;*/
  /*top: 200px;*/
  /*right: 500px;*/
  display: inline-block;
  margin-top: 5em;
  margin-left: 3em;
  margin-right: 3em;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.7);
  transition: 0.3s;
  width: 20%;
  color: black;
}
.card2:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}
.card3 {
  /*position: absolute;*/
  /*top: 200px;*/
  /*right: 200px;*/
  display: inline-block;
  margin-top: 5em;
  margin-left: 3em;
  margin-right: 3em;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.7);
  transition: 0.3s;
  width: 20%;
  color: black;
}
.card3:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.container {
  text-align: center;
}
/* Add a background color on hover */

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
  -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
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
  font-weight: 100;
  text-transform: uppercase;
}
.header b {
  position: absolute;;
  top: 2px;
  right: 25px;
  color: black;
  /* text-align: center; */
  padding: 20px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header b.logo {
  font-size: 18px;
  font-weight: 100;
  /* text-transform: uppercase; */

}
  
</style>
</head>
<body>

<div class="header">
  <a class="logo"> Admin Dashboard</a>
  <b class="logo"> <?php echo "Welcome ".$name ?> </b>

  <div class="btn-group">
    <button onclick="document.location='admin_details.php'">My Profile</button>
  </div>
</div>

<div class="btn-group2">
        <button onclick="document.location='destroy_session.php'"><i class="fa fa-sign-out"></i></button>  
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
    <A href="past_live_contests.php"> <h4>View All Contests</h4> </A>
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