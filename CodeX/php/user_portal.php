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
    $participant_username = $_SESSION["username"];
    $sql = "SELECT first_name FROM participant WHERE username='".$participant_username."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['first_name'];
}


$conn->close();

?> 

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}
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
body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(99,128,107);
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
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
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
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
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
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
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
  position: absolute;;
  top: 10px;
  right: 25px;
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
  <a class="logo"> Participant Dashboard</a>
  <b class="logo"> <?php echo "Welcome ".$name ?></b>
  
  <div class="btn-group">
    <button onclick="document.location='user_details.php'" style="width:25%">View and Edit Profile  </button>  
  </div>
</div>

<div class="btn-group2">
    <button onclick="document.location='../html/index.html'" style="width:25%">Sign Out </button>  
</div>

<div class="card">
  <img src="../img/user.png" alt="Avatar" style="width:100%">
  <div class="container">
      <A href="register_into_contest.php"> <h4>Enroll into Contests</h4>  </A>
  </div>
</div>

<div class="card2">
  <img src="../img/user.png" alt="Avatar" style="width:100%">
  <div class="container">
  <A href="past_live_contests_user.php"> <h4>View All Contests</h4> </A>
  </div>
</div>
<div class="card3">
  <img src="../img/user.png" alt="Avatar" style="width:100%">
  <div class="container">
    <A href="user_display_contests.php"> <h4>My Contests</h4>  </A>
  </div>
</div>


</body>
</html>