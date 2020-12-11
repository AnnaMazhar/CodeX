<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My Contests</title>
    <style type="text/css">
      body { 
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1))
        
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
        font-size: 25px;
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
        font-size: 25px;
      }
      table{
      margin-left:auto; 
      margin-right:auto;
      margin-top:auto;
      
      top: 20%;
      border: 1px solid black;
      
      width: 75%;
      background-color: #E6E1E0; 
    }

    th, td {
      height: 5px;
      padding: 10px;
    }
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
      }

      .button_red:hover {
        background-color: #e00b0b;
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

  
</style>
</head>

<body>
    <?php 
    include "connect.php";
    include "fetch_name.php";
    $contestid = $_SESSION['contest_ID'];
  $round_num = $_SESSION['round_num'];
  $name = $_POST["cid"];

    ?> 
    <div class="header">
    <a class="logo"> Submission</a>
    <div class="btn-group2">
    <button onclick="document.location='past_contests.php'"  style="width:10%">Back</button>
    </div>
    </div>

    <?php 
      include "connect.php";
    ?>
    <div>
          <?php 
          $sql = "SELECT max(marks_awarded) as marks_awarded FROM submission WHERE round_number = '".$round_num."'  and
          contest_ID = '".$contestid."' and participant_username = '".$name."' ";
          $result = $conn->query($sql);
          $row = $result->fetch_row();
          $max_marks = $row[0];

          $sql = "SELECT submitted_code FROM submission WHERE round_number = '".$round_num."'  and
          contest_ID = '".$contestid."' and participant_username = '".$name."' and marks_awarded = '".$max_marks."'  ";
          $result = $conn->query($sql);
          $row = $result->fetch_row();
          $code = $row[0];          
        
        echo "<br>";  
        echo "<table>";
        echo "<th>"."Code Submitted by $name (Round $round_num)"."</th>";
        echo "<tr>";
        echo "<td>";
        echo  "<pre>";
        echo ($code);
        echo "</pre>";
        echo "</td>";  
        echo "</tr>";
        echo "</table>";

        $sql1 = "SELECT total_marks FROM round WHERE round_number=$round_num AND contest_ID=$contestid";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $total_marks = $row1['total_marks'];
        ?>
        <table>
        <th>
        <?php echo "Marks Awarded: ";
        echo ($max_marks);
        echo " / ";
        echo $total_marks;
        ?>
        </th>
        </table>

         <?php
              $conn->close()
          ?>
    </table>
    </div>

    
</body>
</html>