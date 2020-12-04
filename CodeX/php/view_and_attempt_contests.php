<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Attempt in Contests</title>
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

    // session_start();

    // $name = $_SESSION["username"];
    $ID = $_GET["c_id"];
?>

<div class="header">
    <a class="logo"> Rounds for Contest ID # <?php echo $ID; ?> </a>
    <b class="logo"> <?php echo $name; ?> </b>
    </div>

<table>
          <tr>
          <th>Round Number</th>
          <th>Contest ID</th>
          <th>Round Title</th>
          <th>Round Marks</th>
          <th></th>
          </tr>

<?php
include "connect.php";

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
      $loc = "code_editor.php?c_id=".$c_id."&r_no=".$r_no;
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
</body>
</html>