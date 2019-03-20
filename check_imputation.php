<?php
    session_start();
    $new_name=$_SESSION['new_name'];  
    $method=$_SESSION['method'];
    $colname=$_SESSION['col'];

    $_SESSION['list']=$_SESSION['list'].$colname.",".$method.";";

    $sum=$new_name.";".$colname.";".$method.";";  
    $varpython="python check_imputation.py ";
    $var=$varpython.$sum; 
    echo shell_exec($var);

    foreach($_SESSION['col_num'] as $key => $value)
    {
        if($_SESSION['col']==$value)
        {

            unset($_SESSION['col_num'][$key]);
        }
        // echo '陣列順序'.$key.'：=>'.$value.'<br />';
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
    // unset($_SESSION['method']);
    // unset($_SESSION['col']); 
    header("Location: http://localhost/Missingdata/mechanisms.php");   
    exit;
?>