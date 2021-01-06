<?php

    include "connect.php";
    
    session_start();
    
    $uname_su_inp = ""; if (isset($_SESSION["uname_su_inp"])) { $uname_su_inp = $_SESSION["uname_su_inp"]; }
    $fname_su_inp = ""; if (isset($_SESSION["fname_su_inp"])) { $fname_su_inp = $_SESSION["fname_su_inp"]; }
    $lname_su_inp = ""; if (isset($_SESSION["lname_su_inp"])) { $lname_su_inp = $_SESSION["lname_su_inp"]; }
    $pw_su_inp = ""; if (isset($_SESSION["pw_su_inp"])) { $pw_su_inp = $_SESSION["pw_su_inp"]; }
    $email_su_inp = ""; if (isset($_SESSION["email_su_inp"])) { $email_su_inp = $_SESSION["email_su_inp"]; }
    $dob_su_inp = ""; if (isset($_SESSION["dob_su_inp"])) { $dob_su_inp = $_SESSION["dob_su_inp"]; }
    $gender_su_inp = ""; if (isset($_SESSION["gender_su_inp"])) { $gender_su_inp = $_SESSION["gender_su_inp"]; }
    $type_su = ""; if (isset($_SESSION["type_su"])) { $type_su = $_SESSION["type_su"]; }
    $org_su_inp = ""; if (isset($_SESSION["org_su_inp"])) { $org_su_inp = $_SESSION["org_su_inp"]; }

    // echo $uname_su_inp . "<br>";
    // echo $fname_su_inp . "<br>";
    // echo $lname_su_inp . "<br>";
    // echo $pw_su_inp . "<br>";
    // echo $email_su_inp . "<br>";
    // echo $dob_su_inp . "<br>";
    // echo $gender_su_inp . "<br>";
    // echo $type_su . "<br>";
    // echo $org_su_inp . "<br>";

    $uname_logininput = ""; if (isset($_SESSION["uname_logininput"])) { $uname_logininput = $_SESSION["uname_logininput"]; }
    $pw_logininput = ""; if (isset($_SESSION["pw_logininput"])) { $pw_logininput = $_SESSION["pw_logininput"]; }
    $type_login = ""; if (isset($_SESSION["type_login"])) { $type_login = $_SESSION["type_login"]; }
    
    // echo $uname_logininput . "<br>";
    // echo $pw_logininput . "<br>";
    // echo $type_login . "<br>";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Register / Login</title>
    <style type="text/css">
    	body{
    	background-color: #333;
    	}
        fieldset
        {
            color: white;
        margin-left: auto;
    	margin-right: auto;
    	width: 10em;
    	}
    	legend{
    	margin-left: auto;
    	margin-right: auto;
    	}
    	.form
    	{
    	margin-bottom:2em;
    	}
        .inputfield {
            width: 15em;
            /* display:block; */
            /* position:relative; */
        }
        .submitButton {
            width: 15em;
        }
        .checkboxgroup {
            display: inline-block;
            text-align: center;
        }
        .checkboxgroup label {
            display: block;
        }
        .divider{
            padding: 4px;
        }
    </style>
</head>
<body>

    <div style="height: 100%; margin-top: 60px;">
        <div class="form" >
            <fieldset>
                <legend> REGISTER </legend>

                <form name="register" autocomplete="off" action="../php/sign_up.php" method="post">
                    <label for="username" style="font-size:15px">Username</label>
                    <input value="<?php echo $uname_su_inp ?>" class="inputfield"  name="username" id = "u_name" autocomplete="false" type="text" placeholder="Username" pattern="\S{1,20}" required="" onkeyup = "to_lower()"><br>

                    <label for="first_name" style="font-size:15px">First Name</label>
                    <input value="<?php echo $fname_su_inp ?>" class="inputfield" name="first_name" type="text" placeholder="First Name" pattern="[A-Za-z]{1,20}" required=""><br>
                    
                    <label for="last_name" style="font-size:15px">Last Name</label>
                    <input value="<?php echo $lname_su_inp ?>" class="inputfield" name="last_name" type="text" placeholder="Last Name" pattern="[A-Za-z]{1,20}" required=""><br>
                    
                    <label for="password" style="font-size:15px">Password</label>
                    <input value="<?php echo $pw_su_inp ?>" class="inputfield" name="password" autocomplete="false" type="password" placeholder="Password" pattern="\S{1,20}" required=""><br>
                    
                    <label for="email" style="font-size:15px">Email Address</label>
                    <input value="<?php echo $email_su_inp ?>" class="inputfield" name="email" type="email" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required=""><br>
                    
                    <label for="date_of_birth" style="font-size:15px">Date of Birth</label>
                    <input value="<?php echo $dob_su_inp ?>" class="inputfield" name="date_of_birth" type="date" pattern="\d{4}-[0-1]\d-[0-3]\d" required=""><br>
                    
                    <div class="divider"></div>
                    
                    <label for="organization" id ="org_label" style="font-size:15px; display: none">Organization</label>
                    <input value="garbage" class="inputfield" name="organization" type="text" style="display: none" id ="org_input" pattern=".{1,30}" placeholder="Organization Name" required="">
                    <div class="divider" style="display: none" id ="org_divider"></div>

                    <div id="checkboxes" style="text-align: center">
                        <div class="checkboxgroup" >
                            <input id="radio_F" type="radio" checked="checked" value="F" name="gender">
                            <label for="F" style="font-size:15px">Female</label>
                        </div>
                        <div class="checkboxgroup">
                            <input id="radio_M" type="radio" value="M" name="gender">
                            <label for="M" style="font-size:15px">Male</label>
                        </div>
                        <div class="checkboxgroup">
                            <input id="radio_N" type="radio" value="N" name="gender">
                            <label for="N" style="font-size:15px">Other</label>
                        </div>
                    </div>

                    <div class="divider"></div>
                    
                    <input type="radio" id="p_type_su" onclick="myFunction()" checked="checked" value="participant" name="type">
                    <label for="participant" style="font-size:17px">Participant</label><br>
                    <input type="radio" id="a_type_su" onclick="myFunction2()" value="admin" name="type">
                    <label for="admin" style="font-size:17px">Admin</label><br>
                    
                    <div class="divider"></div>
                    
                    <div style="text-align: center">
                        <input class="submitButton" name="submit" value="Sign Up" type="submit">
                    </div>
                    
                </form>
            </fieldset>
        </div>
        <div class="">
            <fieldset>
                <legend> LOGIN </legend>
                <form name="login" action="../php/log_in.php" method="post">
                    
                    <label for="username" style="font-size:15px">Username</label>
                    <input value="<?php echo $uname_logininput ?>" class="inputfield" id = "u_name1" name="username" type="text" placeholder="Username" required="" onkeyup = "to_lower1()"><br>
                    
                    <label for="username" style="font-size:15px">Password</label>
                    <input value="<?php echo $pw_logininput ?>" class="inputfield" name="password" type="password" placeholder="Password" required=""><br>
                    
                    <div class="divider"></div>
                    
                    <input type="radio" id="p_type_login" checked="checked" value="participant" name="type">
                    <label for="participant" style="font-size:17px">Participant</label><br>
                    <input type="radio" id="a_type_login" value="admin" name="type">
                    <label for="admin" style="font-size:17px">Admin</label><br>
                    
                    <div class="divider"></div>
                    <div style="text-align: center">
                        <input class="submitButton" name="submit" value="Log In" type="submit">
                    </div>
                </form>
            </fieldset>
        </div>
    </div>

    <?php

    $status = $_GET['status'];
    if( $status =='inc_pw'){ echo "<script> alert('Incorrect Password!') </script>"; }
    else if($status =='u_exists'){ echo "<script> alert('Username exists! Choose a different username.') </script>"; }
    else if($status =='u_d_exists'){ echo "<script> alert('Username does not exist! Sign up') </script>"; }
    else if($status =='reg_success'){ echo "<script> alert('Thanks for registering. You are now our valued member!') </script>"; }
    else if($status =='dob_wrong'){ echo "<script> alert('Unacceptable date of birth entered! [Dates from the future are not allowed, and you must be 6+ to participate and 18+ to administrate]') </script>"; }
    else if($status =='email_long'){ echo "<script> alert('Email is too long!') </script>"; }
    
    ?>

    <script>
    window.onload = function() {
        setGender("<?php echo $gender_su_inp ?>");
        setTypeSU("<?php echo $type_su ?>");
        setTypeLogin("<?php echo $type_login ?>");
        if ("<?php echo $type_su ?>" == "admin")
        {
            // document.write("we came here");
            myFunction2();
        }
    };
    function setGender(gender) {
        if (gender == "F") { document.getElementById("radio_F").checked = true; }
        else if (gender == "M") { document.getElementById("radio_M").checked = true; }
        else if (gender == "N") { document.getElementById("radio_N").checked = true; }
        else { document.getElementById("radio_F").checked = true; }
    }
    function setTypeSU(val) {
        if (val == "participant") { document.getElementById("p_type_su").checked = true; }
        else if (val == "admin") { document.getElementById("a_type_su").checked = true; }
        else { document.getElementById("p_type_su").checked = true; }
    }
    function setTypeLogin(val) {
        if (val == "participant") { document.getElementById("p_type_login").checked = true; }
        else if (val == "admin") { document.getElementById("a_type_login").checked = true; }
        else { document.getElementById("p_type_login").checked = true; }
    }
    function myFunction() {
        var x = document.getElementById("org_input");
        var y = document.getElementById("org_label");
        var z = document.getElementById("org_divider");
        x.style.display = "none";
        y.style.display = "none";
        z.style.display = "none";
        x.value = "garbage";
    } 
	function myFunction2() {
        var x = document.getElementById("org_input");
        var y = document.getElementById("org_label");
        var z = document.getElementById("org_divider");
        x.style.display = "block";
        y.style.display = "block";
        z.style.display = "block";
        x.value = "<?php echo $org_su_inp ?>";
    } 
        function to_lower() {
        var x = document.getElementById("u_name");
        x.value = x.value.toLowerCase();
    }
        function to_lower1() {
        var x = document.getElementById("u_name1");
        x.value = x.value.toLowerCase();
    }
    

    </script>
</body>
</html>

<?php $conn->close(); ?>

