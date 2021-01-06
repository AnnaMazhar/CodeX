<?php

include "connect.php";
include "fetch_name.php";

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My Contests</title>
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

/* td:hover
{
    color:rgb(0, 0, 0);
    background-color:rgba(81, 141, 162, 0.5);
    border-radius: 0.3cm;
} */

th:hover
{
    background-color: #999;
}

      .button {
        border: none;
        border-radius: 5px;
        color: white;
        padding: 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        width: 150px;
      }

      .button1 {
        background-color: #4CAF50; 
        color: white; 
        border: 2px solid #4CAF50;
      }

      .button1:hover {
        background-color: rgb(99,128,107);
        color: black;
      }

      .button_red {
        border: none;
        border-radius: 5px;
        color: white;
        padding: 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        background-color: #bd0808; 
        color: white; 
        border: 2px solid #bd0808;
        width: 150px;
      }

      .button_red:hover {
        background-color: #e00b0b;
        color: black;
      }

      .button_yellow {
        border: none;
        border-radius: 5px;
        color: white;
        padding: 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        background-color: #f5b642;
        color: white; 
        border: 2px solid #f5d442;
        width: 150px;
      }

      .button_yellow:hover {
        background-color: #f5b642;
        color: black;
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

      /* Style the tab */
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
        width: 200px;
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
    <?php 
    function timeAddition( $time, $plusMinutes ) {
    $time = DateTime::createFromFormat( 'Y-m-d H:i:s', $time );
    $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
    $newTime = $time->format( 'Y-m-d H:i:s' ); 
    return $newTime; }

    ?> 
    <div class="header">
    <a class="logo"> My Contests!</a>
    <div class="btn-group2">
    <button onclick="document.location='user_portal.php'"  style="width:10%">Back</button>
    </div>
    </div>

    <?php 
      include "connect.php";

      date_default_timezone_set("Asia/Karachi");
      $time_curr = date("Y-m-d H:i:s");

      $contests = array();

      $query = "SELECT * FROM contest WHERE EXISTS (SELECT * FROM participations WHERE username = '$participant_username' AND participations.contest_ID = contest.contest_ID) ORDER BY start_time desc";
      $result = $conn->query($query);
      if ($result)
      {
        $i = 0;
        while($row = $result->fetch_assoc()){

          $id = $row['contest_ID'];
          $contest_name = $row['name'];
          $admin = $row['admin_username'];
          $s_time = $row['start_time'];
          $duration = $row['duration'];

          $status = "Upcoming";

          if((strtotime($time_curr) < strtotime(timeAddition($s_time, $duration)) && (strtotime($time_curr) > strtotime($s_time))))
          {
            $status = "Live";
          }
          else if(strtotime($time_curr) >  strtotime(timeAddition($s_time, $duration)))
          {
            $status = "Past";
          }

          array_push($contests, array());

          $contests[$i]['status'] = $status;
          $contests[$i]['contest_ID'] = $id;
          $contests[$i]['name'] = $contest_name;
          $contests[$i]['admin_username'] = $admin;
          $contests[$i]['start_time'] = $s_time;
          $contests[$i]['duration'] = $duration;

          $i=$i+1;
        }
      }
        
    ?>

    <div class="tab">
      <button class="tablinks1" onclick="document.location='register_into_contest.php'">Enroll Into Contests</button>
      <button class="tablinks1" onclick="document.location='past_contests_user.php'">View All Past Contests</button>
      <button class="tablinks1" onclick="document.location='live_contests_user.php'">View All Live Contests</button>
      <button class="tablinks1" onclick="document.location='user_display_contests.php'">My Contests</button>
    </div>

    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'All', this, '#ccc')" id="defaultOpen">All</button>
      <button class="tablinks" onclick="openCity(event, 'Past', this, '#ccc')">Past</button>
      <button class="tablinks" onclick="openCity(event, 'Live', this, '#ccc')">Live</button>
      <button class="tablinks" onclick="openCity(event, 'Upcoming', this, '#ccc')">Upcoming</button>
    </div>

    <div id="Past" class="tabcontent">
      <div>
          <table>
          <tr>
          <th>ID</th>
          <th>Contest Name</th>
          <th>Admin Name</th>
          <th>Start time</th>
          <th>Duration</th>
          <th>Status</th>
          <th></th>
          </tr>

          <?php

            for($i = 0; $i < count($contests); $i++)
            {

              $status = $contests[$i]['status'];
              
              if ($status == "Past")
              {
                
              
              $id = $contests[$i]['contest_ID'];
              $contest_name = $contests[$i]['name'];
              $admin = $contests[$i]['admin_username'];
              $s_time = $contests[$i]['start_time'];
              $duration = $contests[$i]['duration'];

          ?>

          <tr>
          <td><?php echo $id; ?></td>
          <?php echo "<td><a href=\"past_stats_user_frommycontests.php?c_id=$id\">$contest_name</a></td>"; ?>
          <td><?php echo $admin; ?></td>
          <td><?php echo $s_time; ?></td>
          <td><?php echo $duration; ?></td>
          <?php
            echo '<td>Expired</td>';
            echo "<td><button onclick = \"document.location = 'my_stats.php?c_id=$id&prev=user_display_contests'\" class=\"button_red\" >My Performance</button></td>";
          ?>
          </tr>

          <?php
          }
          }
          ?>

          </table>
      </div>
    </div>

    <div id="Live" class="tabcontent">
      <div>
          <table>
          <tr>
          <th>ID</th>
          <th>Contest Name</th>
          <th>Admin Name</th>
          <th>Start time</th>
          <th>Duration</th>
          <th>Status</th>
          <th></th>
          </tr>

          <?php

            for($i = 0; $i < count($contests); $i++)
            {

              $status = $contests[$i]['status'];
              
              if ($status == "Live")
              {
                              
              $id = $contests[$i]['contest_ID'];
              $contest_name = $contests[$i]['name'];
              $admin = $contests[$i]['admin_username'];
              $s_time = $contests[$i]['start_time'];
              $duration = $contests[$i]['duration'];

          ?>

          <tr>
          <td><?php echo $id; ?></td>
          <?php echo "<td><a href=\"live_rounds_user_frommycontests.php?c_id=$id\">$contest_name</a></td>"; ?>
          <td><?php echo $admin; ?></td>
          <td><?php echo $s_time; ?></td>
          <td><?php echo $duration; ?></td>
          <?php
            $loc = "view_and_attempt_contests.php?c_id=".$id;
            $click = "document.location = '".$loc."'";
            echo '<td>Live</td>';
            echo '<td><button onclick = "'.$click.'" class="button button1" >Attempt</button></td>';
          ?>
          </tr>

          <?php
          }
          }
          ?>

          </table>
      </div>
    </div>

    <div id="Upcoming" class="tabcontent">
      <div>
          <table>
          <tr>
          <th>ID</th>
          <th>Contest Name</th>
          <th>Admin Name</th>
          <th>Start time</th>
          <th>Duration</th>
          <th>Status</th>
          <th></th>
          </tr>

          <?php

            for($i = 0; $i < count($contests); $i++)
            {

              $status = $contests[$i]['status'];
              
              if ($status == "Upcoming")
              {
                              
              $id = $contests[$i]['contest_ID'];
              $contest_name = $contests[$i]['name'];
              $admin = $contests[$i]['admin_username'];
              $s_time = $contests[$i]['start_time'];
              $duration = $contests[$i]['duration'];

          ?>

          <tr>
          <td><?php echo $id; ?></td>
          <?php echo "<td><a href=\"live_rounds_user_frommycontests.php?c_id=$id\">$contest_name</a></td>"; ?>
          <td><?php echo $admin; ?></td>
          <td><?php echo $s_time; ?></td>
          <td><?php echo $duration; ?></td>
          <?php
            $loc = "view_and_attempt_contests.php?c_id=".$id;
            $click = "document.location = '".$loc."'";
            echo '<td>Upcoming</td>';
            echo '<td><button onclick = "'.$click.'" class="button_yellow" >Not Begun</button></td>';
          ?>
          </tr>

          <?php
          }
          }
          ?>

          </table>
      </div>
    </div>

    <div id="All" class="tabcontent">
      <div>
          <table>
          <tr>
          <th>ID</th>
          <th>Contest Name</th>
          <th>Admin Name</th>
          <th>Start time</th>
          <th>Duration</th>
          <th>Status</th>
          <th> </th>
          </tr>

          <?php

            for($i = 0; $i < count($contests); $i++)
            {

              $status = $contests[$i]['status'];
                
              $id = $contests[$i]['contest_ID'];
              $contest_name = $contests[$i]['name'];
              $admin = $contests[$i]['admin_username'];
              $s_time = $contests[$i]['start_time'];
              $duration = $contests[$i]['duration'];

          ?>

          <tr>
          <td><?php echo $id; ?></td>
          <?php 
          if ($status == "Past")
          {
            echo "<td><a href=\"past_stats_user_frommycontests.php?c_id=$id\">$contest_name</a></td>";
          }
          else{
            echo "<td><a href=\"live_rounds_user_frommycontests.php?c_id=$id\">$contest_name</a></td>";
          }
          ?>
          <td><?php echo $admin; ?></td>
          <td><?php echo $s_time; ?></td>
          <td><?php echo $duration; ?></td>
          <?php
            $loc = "view_and_attempt_contests.php?c_id=".$id;
            $click = "document.location = '".$loc."'";
            if($status == "Live")
            {
              echo '<td>Live</td>';
              echo '<td><button onclick = "'.$click.'" class="button button1" >Attempt</button></td>';
            }
            else if($status == "Past")
            {
              echo '<td>Expired</td>';
              echo "<td><button onclick = \"document.location = 'my_stats.php?c_id=$id&prev=user_display_contests'\" class=\"button_red\" >My Performance</button></td>";
            }
            else{
              echo '<td>Not Begun</td>';
              echo '<td><button onclick = "'.$click.'" class="button_yellow" >Not Begun</td>';
            }
          ?>
          </tr>

          <?php
          }
          ?>

          </table>
      </div>
    </div>

    <script>
    function openCity(evt, cityName, element, color) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        tablinks[i].style.backgroundColor = "#f1f1f1";
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
      element.style.backgroundColor = color;
      // document.body.style.backgroundColor = color;
    }
    document.getElementById("defaultOpen").click();
    </script>
    
</body>
</html>