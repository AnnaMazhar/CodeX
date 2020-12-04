
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
  top: 50px;
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


.card {
  position: absolute;
  top: 200px;
  right: 600px;
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
  right: 300px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  color: white;
}
.card2:hover {
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
  <a class="logo"> View All Contests </a>
  <div class="btn-group">
    <button onclick="document.location='admin_portal.php'"  style="width:10%">Back</button>
  </div>
</div>

<div class="card">
  <img src="../img/past_live.jpg" alt="Avatar" style="width:100%">
  <div class="container">
    <a href="past_contests.php"> <h4>Past Contests</h4>  </a>
  </div>
</div>

<div class="card2">
  <img src="../img/past_live.jpg" alt="Avatar" style="width:100%">
  <div class="container">
   <a href="live_contests.php"> <h4>Live Contests</h4>  </a> 
  </div>
</div>

</body>
</html>