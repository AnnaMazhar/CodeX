<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
  
  /* background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1)) */
  
}
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


.card {
  /*position: absolute;*/
  /*top: 250px;*/
  /*right: 650px;*/
  display: inline-block;
  margin-top: 5em;
  margin-left: 19em;
  margin-right: 3em;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  transition: 0.3s;
  width: 20%;
  color: white;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}
.card2 {
  /*position: absolute;*/
  /*top: 250px;*/
  /*right: 350px;*/
  display: inline-block;
  margin-top: 5em;
  margin-left: 3em;
  margin-right: 15em;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  transition: 0.3s;
  width: 20%;
  color: white;
}
.card2:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.container {
  text-align: center;
}
/* Add a background color on hover */

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
  font-weight: 100;
}

      /* Style the tab */
.tab {
  overflow: hidden;
  /* border: 1px solid rgba(7, 145, 85, 1); */
  border-top: 1px solid #333;
  border-bottom: 1px solid #333;
  background-color: #f1f1f1;
  -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
  -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
}

.tablinks {
  /* background-color: #555; */
  color: black;
  float: right;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

/* Style the buttons inside the tab */
.tab button {
  /* background-color: inherit; */
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ccc;
}

/* Create an active/current tablink class */
.tab button.active {
  /* background-color: #ccc; */
  background-color: rgba(7, 145, 85, 0.7);
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
  margin-left: 150px;
  margin-right: 150px;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

</style>
</head>
<body>
<div class="header">
  <a class="logo"> View All Contests </a>
  <div class="btn-group">
    <button onclick="document.location='user_portal.php'"  style="width:10%">Back</button>
  </div>
</div>

<div class="tab">
      <button class="tablinks" onclick="document.location='register_into_contest.php'">Enroll Into Contests</button>
      <button class="tablinks" onclick="document.location='past_contests_user.php'">View All Past Contests</button>
      <button class="tablinks" onclick="document.location='live_contests_user.php'">View All Live Contests</button>
      <button class="tablinks" onclick="document.location='user_display_contests.php'">My Contests</button>
    </div>

<div class="card">
  <img src="../img/past_live.jpg" alt="Avatar" style="width:100%">
  <div class="container">
    <a href="past_contests_user.php"> <h4>Past Contests</h4>  </a>
  </div>
</div>

<div class="card2">
  <img src="../img/past_live.jpg" alt="Avatar" style="width:100%">
  <div class="container">
   <a href="live_contests_user.php"> <h4>Live Contests</h4>  </a> 
  </div>
</div>

</body>
</html>