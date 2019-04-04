<?php
session_start();
$new_name=$_SESSION['new_name']; 
$var="python missingcol.py ".$new_name;
$varpython = exec($var);

$col=explode(";",$varpython);

$cage=explode(",",$col[0]);
$num=explode(",",$col[1]);

$_SESSION['col_cage']=$cage;
$_SESSION['col_num']=$num;
$_SESSION['num']=$num;
$_SESSION['method']="";
$_SESSION['col']="";
$_SESSION['list']="";
$_SESSION['count']=0;

header("Location: http://localhost/Missingdata/filtercol.php");   
exit;
?>