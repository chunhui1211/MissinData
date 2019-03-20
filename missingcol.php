<?php
session_start();
$new_name=$_SESSION['new_name']; 

$var="python missingcol.py ".$new_name;
$varpython = exec($var);
echo $varpython;
echo "<br/>";
$col=explode(";",$varpython);

$cage=explode(",",$col[0]);
$num=explode(",",$col[1]);
print_r($cage);
print_r($num);

$_SESSION['col_cage']=$cage;
$_SESSION['col_num']=$num;
$_SESSION['method']="";
$_SESSION['col']="";
$_SESSION['list']="";
header("Location: http://localhost/Missingdata/mechanisms.php");   
exit;
?>