<?php
session_start();
$command = escapeshellcmd('/xampp/htdocs/MissingData/del_img.py ');
shell_exec($command.$_SESSION['new_name']);
header("Location: http://localhost/Missingdata/delrow.php");   
exit;
?>