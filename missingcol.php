<?php
session_start();
$new_name=$_SESSION['new_name'];
$col="";
foreach ($_POST['col'] as $value) 
{
    $col=$col.$value.',';       
}   

$col=substr($col,0,-1);
$var="/xampp/htdocs/MissingData/missingcol.py ".$new_name.';'.$col;
$varpython = shell_exec($var);

$col=explode(";",$varpython);
$cage=explode(",",$col[0]);
$num=explode(",",$col[1]);
$ynum=explode(",",$col[2]);

if($col[0]=="")
{
    $_SESSION['col_cage']=null;    
}
else
{
    $_SESSION['col_cage']=$cage;
}

if($col[1]=="")
{
    $_SESSION['col_num']=null;
}
else
{
    $_SESSION['col_num']=$num;
}
if($col[2]=="")
{
    $_SESSION['num']=null;
}
else
{
    $_SESSION['num']=$ynum;
}

$_SESSION['method']="";
$_SESSION['col']="";
$_SESSION['list']="";
$_SESSION['count']=0;
$_SESSION['list']=array();

header("Location: http://localhost/Missingdata/mechanisms.php");   
exit;
