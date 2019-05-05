<?php
session_start();
$params =$_SESSION['new_name']; 
$command2 = escapeshellcmd('/xampp/htdocs/MissingData/before_visual.py ');
echo shell_exec($command2.$params);
header("Location: http://localhost/Missingdata/beforevisual.php");   
exit;
?>