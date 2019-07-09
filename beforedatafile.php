<?php
session_start();
$params =$_SESSION['new_name']; 
$command2 = escapeshellcmd('/xampp/htdocs/MissingData/before_visual.py ');
$missingrate=shell_exec($command2.$params);
$missingrate=explode(";",$missingrate);
$missing=explode(",",$missingrate[0]);
$rate=explode(",",$missingrate[1]);
$_SESSION['colname']=$missing;
$_SESSION['rate']=$rate;

header("Location: http://localhost/Missingdata/beforevisual.php");   
exit;
?>