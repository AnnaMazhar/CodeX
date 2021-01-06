<?php 
      include "connect.php";
      include "fetch_name.php";
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Register in Contests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    	
      body { 
        margin: 0;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;

        /* background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1)) */
        /* background-color: "red"; */
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
        font-weight: 100;
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

      .checked {
        color: orange;
      }

      .btn-group2 button {
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

      .btn-group2 button:hover {
        color: #404040 !important;
        font-weight: 700 !important;
        letter-spacing: 3px;
        background: none;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        transition: all 0.3s ease 0s;
      }

      .tab {
        overflow: hidden;
        border-top: 1px solid #333;
        border-bottom: 1px solid #333;
        background-color: #f1f1f1;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
      }

      .tablinks1 {
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
        background-color: #333;
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
    <a class="logo"> Enroll into Contests!</a>
    <div class="btn-group2">
    <button onclick="document.location='user_portal.php'"  style="width:10%">Back</button>
    </div>
    </div>

    <div class="tab">
      <button class="tablinks" onclick="document.location='register_into_contest.php'">Enroll Into Contests</button>
      <button class="tablinks" onclick="document.location='past_contests_user.php'">View All Past Contests</button>
      <button class="tablinks" onclick="document.location='live_contests_user.php'">View All Live Contests</button>
      <button class="tablinks" onclick="document.location='user_display_contests.php'">My Contests</button>
    </div>

    <?php 
      include "connect.php";
    ?>
    <div>
          <table>
          <tr>
          <th>ID</th>
          <th>Contest name</th>
          <th>Admin Name</th>
          <!-- <th>Rating</th> -->
          <th>Start time</th>
          <th>Duration</th>
          <th>Rating</th>
          <th></th>
          </tr>
          <?php 

          date_default_timezone_set("Asia/Karachi");
          $currentdt = new DateTime();
          $query = "SELECT * FROM contest WHERE NOT EXISTS (SELECT * FROM participations WHERE username = '$participant_username' AND participations.contest_ID = contest.contest_ID) ORDER BY start_time";
          $result = $conn->query($query);
            while($row = $result->fetch_assoc()){   
                $id = $row['contest_ID'];
                $contest_name = $row['name'];
                $admin = $row['admin_username'];
                $s_time = $row['start_time'];
                $duration = $row['duration'];
                if($currentdt->format('Y-m-d H:i:s') < $s_time ){ 
            ?>
                <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $contest_name; ?></td>
                <td><?php echo $admin; ?></td>
                <td><?php echo $s_time; ?></td>
                <td><?php echo $duration; ?></td>
                <td>
                  <?php
                    include "calculate_rating.php";
                  ?>
                </td>

                <?php
                  $loc = "update_user_contests.php?c_id=".$id;
                  $click = "document.location = '".$loc."'";
                  echo '<td><button onclick = "'.$click.'" class="button button1" >Register</button></td>';

                }

                ?>
                </tr>

            <?php
            }


          ?>
          <?php
              $conn->close()
          ?>
          </table>
    </div>

    
</body>
</html>