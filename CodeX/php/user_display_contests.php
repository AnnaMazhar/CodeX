<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My Contests</title>
    <style type="text/css">
    	body { 
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-color: rgb(99,128,107);  
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
      table{
        margin-top: 5em;
        margin-left: auto;
    	  margin-right: auto;
        background-color: white;
        /* border-radius: 15px */

      }
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        /* border-radius: 15px */

      }
      th, td {
        padding: 15px;
        text-align: left;
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

  
</style>
</head>

<body>
    <?php 
      include "connect.php";
      include "fetch_name.php";
    ?> 
    <div class="header">
    <a class="logo"> My Contests!</a>
    <b class="logo"> <?php echo "Hey ".$name ?> </b>
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
          <th></th>
          </tr>
          <?php 
          $query = "SELECT * FROM contest WHERE EXISTS (SELECT * FROM participations WHERE username = '$participant_username' AND participations.contest_ID = contest.contest_ID) ORDER BY contest_ID";
          $result = $conn->query($query);
            while($row = $result->fetch_assoc()){
    
                $id = $row['contest_ID'];
                $contest_name = $row['name'];
                $admin = $row['admin_username'];
                $s_time = $row['start_time'];
                $duration = $row['duration'];
            ?>
                <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $contest_name; ?></td>
                <td><?php echo $admin; ?></td>
                <td><?php echo $s_time; ?></td>
                <td><?php echo $duration; ?></td>
                <?php
                  $loc = "view_and_attempt_contests.php?c_id=".$id;
                  $click = "document.location = '".$loc."'";
                  echo '<td><button onclick = "'.$click.'" class="button button1" >Attempt</button></td>';
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