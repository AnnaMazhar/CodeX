<?php

$MAX_TIME_ALLOWED_FOR_RUN = 5;

$code = $submitted_code;
$file_name = "code"."_".$contest_ID."_".$round_number."_".$participant_username."_".str_replace(" ", "_", str_replace(":", "_", $time)).".py";
$python_interpreter_name = "python3";

$OperatingSystem = php_uname('s');
echo nl2br("OS: $OperatingSystem\n");
if ($OperatingSystem == "Linux")
{
    // Nothing to do here
}
else if ($OperatingSystem == "Windows NT")
{
    include "windows_paths.php";
    $file_name = $desktop_path."\\".$file_name;
}
else
{
    die("Unsupported OS");
}


// MAKE A PYTHON FILE:
$python_file = fopen($file_name, "w");
if (!$python_file) {
    die("Unable to open file!");
} 
fwrite($python_file, $code);
fclose($python_file);

$stdout = "";
$stderr = "";
$timeout = false;

$descriptors = array(
    0 => array("pipe", "r"),  // STDIN
    1 => array("pipe", "w"),  // STDOUT
    2 => array("pipe", "w")   // STDERR
);

$time_pre = microtime(true);

$proc = proc_open($python_interpreter_name." " . $file_name, $descriptors, $pipes);
// $proc = proc_open("python3 code.py", $descriptors, $pipes);
fwrite($pipes[0], $test_input);
fclose($pipes[0]);

while (true)
{
    $status = proc_get_status($proc);
    if($status['running'] == true)
    {
        if ((microtime(true) - $time_pre) > $MAX_TIME_ALLOWED_FOR_RUN)
        {
            $timeout = true;
            //close all pipes that are still open
            fclose($pipes[1]); //stdout
            fclose($pipes[2]); //stderr
            //get the parent pid of the process we want to kill
            $ppid = $status['pid'];

            if($OperatingSystem == "Windows NT") {  
                $output = array_filter(explode(" ", shell_exec("wmic process get parentprocessid,processid | find \"$ppid\"")));  
                array_pop($output);  
                //Process Id is  
                $pid = end($output);
                exec("taskkill /pid $pid /F"); 
            }  
            else {  
                //use ps to get all the children of this process, and kill them
                $pids = preg_split('/\s+/', `ps -o pid --no-heading --ppid $ppid`);
                foreach($pids as $pid) {
                    if(is_numeric($pid)) {
                        $stderr = "Took longer than ". strval($MAX_TIME_ALLOWED_FOR_RUN) ." seconds! Killing $pid\n";
                        posix_kill($pid, 9); //9 is the SIGKILL signal
                    }
                }
            }

            proc_close($proc);

            break;
        }
    }
    else
    {
        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);

        fclose($pipes[1]);
        fclose($pipes[2]);

        proc_close($proc);

        break;
    }
} 
   
// Use unlink() function to delete a file  
if (!unlink($file_name)) {  
    // echo ("$file_name cannot be deleted due to an error");  
}  
else {  
    // echo ("$file_name has been deleted");  
} 

// echo nl2br("STDOUT:\n");
// echo nl2br($stdout);
// echo "<br><br>";
// echo nl2br("STDERR:\n");
// echo nl2br($stderr);

// lets generate a compiler's result
$interpreter_result = "F";
$interpretor_result_msg = "Incorrect";
$marks_awarded = 0;

if ($timeout)
{
    $interpreter_result = "E";
    $interpretor_result_msg = "Timeout";
}
elseif ($stderr != "") 
{
    $interpreter_result = "E";
    $interpretor_result_msg = "Runtime Error";
}
elseif (strcmp(trim($stdout), trim($expected_output)) == 0)
{
    $interpreter_result = "P";
    $interpretor_result_msg = "Correct";
    $marks_awarded = $total_marks;
}

// echo "<br>";
// echo $interpreter_result;
// echo "<br>";
// echo $interpretor_result_msg;
// echo "<br>";
// sleep(2);

?>