<?php
session_start();
$params =$_SESSION['new_name']; 
$pathdata="python missingfile.py "; //需要注意的是：末尾要加一個空格
$pathphoto="python beforemissingno.py ";
passthru($pathdata.$params);//等同於命令python python.py，並接收列印出來的資訊 
passthru($pathphoto.$params);
header("Location: http://localhost/Missingdata/beforevisual.php");   
exit;
?>