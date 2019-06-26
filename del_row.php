<?php
session_start();
$new_name = $_SESSION['new_name'];
if(isset($_POST['del']))
{   
    if($_POST['del']=="number")
    {
        $var = "/xampp/htdocs/MissingData/del_row.py " . $new_name . ';' .  $_POST['delnumber'];
        echo shell_exec($var);
    }
}
header("Location: http://localhost/Missingdata/delcol.php");   
exit;
