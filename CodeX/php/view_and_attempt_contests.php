<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Attempt in Contests</title>
    <style type="text/css">
    	body { 
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1));
        
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

      .btn-group2 button {
        position: absolute;
        top: 55px;
        right: 15px;
        background-color: #0E5225; 
        border: 1px solid green; /* Green border */
        color: white; /* White text */
        padding: 10px 24px; /* Some padding */
        cursor: pointer; /* Pointer/hand icon */
        float: left; /* Float the buttons side by side */
      }

      .btn-group2 button:hover {
        background-color: #11346b;
      }

      .rate {
        float: left;
        height: 46px;
        padding: 10px 20px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
#x {
  
  font-variant-caps: petite-caps;
  font-weight: bold;
  font-size: 20px;
}
/* input {
    border:none;
    background-image:none;
    background-color:transparent;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
} */
  
</style>
</head>

<body>

<?php
    include "connect.php";
    include "fetch_name.php";

    function timeAddition( $time, $plusMinutes ) {
    $time = DateTime::createFromFormat( 'Y-m-d H:i:s', $time );
    $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
    $newTime = $time->format( 'Y-m-d H:i:s' );
    return $newTime;
}

    // session_start();

    // $name = $_SESSION["username"];
    $ID = $_GET["c_id"];
    $loc = "update_rating.php?c_id=".$ID

?>

<div class="header">
    <a class="logo"> Rounds </a>
    <div class="btn-group2">
    <button onclick="document.location='user_display_contests.php'"  style="width:10%">Back</button>
    </div>
    </div>

  <?php
  // include "check_contest_completion.php";
  // echo "ss";

  include "connect.php";

    //session_start();
    $name = $_SESSION["username"];
    $ID = $_GET["c_id"];
    $sql = "SELECT COUNT(distinct round_number) as x FROM submission WHERE contest_ID='".$ID."' and participant_username='".$name."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $rounds_completed = $row["x"];

    $sql = "SELECT COUNT(round_number) as y FROM round WHERE contest_ID='".$ID."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_rounds = $row["y"];
    if($total_rounds == $rounds_completed && $total_rounds != 0){
        $flag = True;
    }
    else{
        $flag = False;
    }

    $conn->close();


  if($flag){?>
    <form name="rating" autocomplete="off" action=<?php echo $loc; ?> method="post">

      <span class="rate">
      
        <p id='x'>Rate the Admin!</p>
        <input type="radio" id="star5" name="rate" value="5" />
        <label for="star5" title="text">5 stars</label>
        <input type="radio" id="star4" name="rate" value="4" />
        <label for="star4" title="text">4 stars</label>
        <input type="radio" id="star3" name="rate" value="3" />
        <label for="star3" title="text">3 stars</label>
        <input type="radio" id="star2" name="rate" value="2" />
        <label for="star2" title="text">2 stars</label>
        <input type="radio" id="star1" name="rate" value="1" />
        <label for="star1" title="text">1 star</label>
        <br><br><br>
        <div style="text-align: center">
            <input class="submitButton" name="submit" value="rate" type="submit">
        </div>
      
      </span>
  </form> 
<?php
  }  
  ?>
  
<span>
<table>
          <tr>
          <th>Round Number</th>
          <th>Contest ID</th>
          <th>Round Title</th>
          <th>Round Marks</th>
          <th>Submissions</th>
          <th></th>
          </tr>

<?php
include "connect.php";

date_default_timezone_set("Asia/Karachi");
$currentdt = new DateTime();

$check = "SELECT * FROM contest WHERE contest_ID = '$ID'";
$check2 = $conn->query($check);
$check_row = $check2->fetch_row();

if($currentdt->format('Y-m-d H:i:s') > timeAddition($check_row[4], $check_row[5]) ){
  echo '<script type="text/javascript">'; 
  echo 'alert("Contest has already ended. Please attempt a live contest");'; 
  echo 'window.location.href = "user_display_contests.php";';
  echo '</script>';
}
else if($currentdt->format('Y-m-d H:i:s') < $check_row[4]){
  echo '<script type="text/javascript">'; 
  echo 'alert("Contest has not begun yet");'; 
  echo 'window.location.href = "user_display_contests.php";';
  echo '</script>';
}
else{



$sql = "SELECT title, round_number,total_marks FROM round WHERE contest_ID = '$ID'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    
    $r_no = $row['round_number'];
    $c_id = $ID;
    $r_name = $row['title'];
    $marks = $row['total_marks'];
?>
    <tr>
    <td><?php echo $r_no; ?></td>
    <td><?php echo $c_id; ?></td>
    <td><?php echo $r_name; ?></td>
    <td><?php echo $marks; ?></td>
    <?php
      $loc = "subs_rounds.php?c_id=".$c_id."&r_no=".$r_no;
      $click = "document.location = '".$loc."'";
      echo '<td><button onclick = "'.$click.'" class="button button1" >View</button></td>';

      $loc = "code_editor.php?c_id=".$c_id."&r_no=".$r_no;
      $click = "document.location = '".$loc."'";
      echo '<td><button onclick = "'.$click.'" class="button button1" >Attempt</button></td>';

    ?>
    </tr>
    

<?php
}
?>
</table>
</span>



<?php
    }
    $conn->close()

?>
</body>
</html>