<?php
    session_start();
    $new_name=$_SESSION['new_name'];  
    $colname=$_SESSION['col'];

    if(isset($_POST['option']))
    {
        $method=$_POST['option'];
    }

    $_SESSION['list']=$_SESSION['list'].$colname.",".$method.";";

    $var="python check_imputation.py ".$new_name.";".$colname.";".$method.";";
    echo shell_exec($var);
   

    foreach($_SESSION['col_num'] as $key => $value)
    {
        if($_SESSION['col']==$value)
        {
            unset($_SESSION['col_num'][$key]);
        }
    }
    $_SESSION['col_num'] = array_values($_SESSION['col_num']);
    foreach($_SESSION['col_cage'] as $key => $value)
    {
        if($_SESSION['col']==$value)
        {
            unset($_SESSION['col_cage'][$key]);
        }
    }
    $_SESSION['col_cage'] = array_values($_SESSION['col_cage']); 
    $_SESSION['method']="";
    $_SESSION['col']="";
    $_SESSION['count']="";
    header("Location: http://localhost/Missingdata/mechanisms.php");   
    exit;
?>