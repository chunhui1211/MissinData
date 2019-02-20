<?php
session_start();
$params =$_SESSION['new_name']; 
$tmp="python before_visual.py ";//需要注意的是：末尾要加一個空格
passthru($tmp.$params);//等同於命令python python.py，並接收列印出來的資訊
header("Location: http://localhost/Missingdata/beforevisual.php");   
exit;
?>