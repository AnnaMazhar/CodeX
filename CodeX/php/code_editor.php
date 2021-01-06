<?php
  include "connect.php";
  session_start();
  ?>
<!-- The comments in this file are very important for the future when we would be expanding the functionalities -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Editor</title>
  <style type="text/css">
    #editor {
      margin: 0;
      width: 100%;
      height: 32em;
      /* padding-top: 5em; */
      /* margin-top: 5px; */
      font-size: 14px;
    }
    body { 
  margin: 0;
  font-family: URW Gothic L;
  
  /* background-color: rgb(99,128,107); */
  /* background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1)) */
}

    .btn{
        margin: 4px;
        box-shadow: 1px 1px 5px #888888;
    }

    .col-md-12.col-sm-12.codeSide {
        background: #272822;
        height: 33em;
        padding-left: 21px;
        padding-right: 21px;
        border-radius: 10px;
        padding-top: 7px;
    }

    .container{
      /* padding-top: 7em; */
    }

    .ace_gutter {
      -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        min-width: 50px;
    }

    .ace_scroller {
      margin-left: 5px;
    }

    #compile {
        /* margin-top: 5px; */
        float: right;
    }

    #mode {
        width: 12%;
        margin: 4px 2px 6px 4px;
        box-shadow: 1px 1px 5px #888888;

    }

    .btn-group2 button {
        position: absolute;
        right: 38px;
        top: 40px;
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
      
  </style>
</head>
<body>

<?php
  $contest_ID = $_GET["c_id"];
  $round_number = $_GET["r_no"];
  ?>

<div class="btn-group2">
    <button onclick="document.location='view_and_attempt_contests.php?c_id='+'<?php echo $contest_ID;?>' "  style="width:10%">Back</button>
    </div>

<?php

  $sql = "SELECT title, problem_statement, total_marks FROM round WHERE contest_ID = $contest_ID AND round_number = $round_number";

  $result = $conn->query($sql);
  if ($conn->query($sql) == TRUE)
  {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $problem_statement = $row['problem_statement'];
    $total_marks = $row['total_marks'];
  }
  else
  {
    echo "Error: " . $sql . "<br>";
  }

  echo '<h3> '.$title.' </h3>';
  echo '<p> Problem Statement: '.$problem_statement.' <p>';
  echo '<p> Marks: '.$total_marks.' </p>';

  $default_code = "#WRITE YOUR CODE HERE\n#WARNING: This is python. Be careful with the Indentation!\n\n\ndef main():\n\t#This is your main function\nmain()";
  $submission_msg = "";
  $interpretor_result_msg = "";

  

  if (isset($_SESSION["submitted_code"]) && isset($_SESSION["interpretor_result_msg"]))
  {
    $default_code = $_SESSION["submitted_code"];
    $submission_msg = "Submitted!";
    $interpretor_result_msg = "Result: ".$_SESSION["interpretor_result_msg"];
    // echo "$submission_msg<br>$interpretor_result_msg";
  }

?>

<div class="heading">
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12 codeSide">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="compile-code">
            <!-- Language Selection -->
            <select class="selectpicker" data-live-search="true" class="form-control" name="Language" id="mode" onchange="changeMode()">
              <!-- <option value="c" id="c" selected>C</option>
              <option value="c++" id="c++">C++</option>
              <option value="python2" id="python2">Python2</option> -->
              <option value="python3" id="python3" selected="selected" >Python3</option>
              <option value="-" id="-">Coming Soon</option>
              <!-- <option value="java" id="java">Java</option> -->
            </select>
            <!-- Editor -->
            <!-- <pre name="code" id="editor" style="border: none;"></pre> -->
            <form action="../php/submit_code.php" method="post">
                <!-- <label for="editor">Editor</label> -->
                <div id="editor"></div>
                <textarea id= "textbox" name="editor" style="display: none;" value=>#WRITE YOUR CODE HERE\n#WARNING: This is python. Be careful with the Indentation!\n#Print your final result!\n\n\ndef main():\n\t#This is your main function\nmain()</textarea>
                <input type="text" style="display:none" name="round_number" value="<?php echo $round_number; ?>">
                <input type="text" style="display:none" name="contest_ID" value="<?php echo $contest_ID; ?>">
                <input type="submit" id="compile" class="btn btn-sky text-uppercase btn-sm" value="Submit">
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="container">
  <div class="row">
    
  </div>
</div>

  <script src="js/ace.js" type="text/javascript" charset="utf-8"></script>
  <script>
      var editor = ace.edit("editor");
      editor.setTheme("ace/theme/xcode");
      editor.session.setMode("ace/mode/python");
      editor.setValue("#WRITE YOUR CODE HERE\n#WARNING: This is python. Be careful with the Indentation!\n#Print your final result!\n\n\ndef main():\n\t#This is your main function\nmain()");
      editor.clearSelection();
      var textarea = document.getElementById("textbox") 
      editor.getSession().on("change", function () {
          textarea.innerHTML = editor.getSession().getValue();
      });
  </script>

<?php $conn->close(); ?>

</body>
</html>