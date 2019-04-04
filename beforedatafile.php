<?php
session_start();
$params =$_SESSION['new_name']; 
$tmp="python before_visual.py ";
passthru($tmp.$params);
header("Location: http://localhost/Missingdata/beforevisual.php");   
exit;
?>