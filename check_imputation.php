<?php
    session_start();
    $new_name=$_SESSION['new_name'];  
    $method=$_SESSION['method'];
    $colname=$_SESSION['col'];

    $sum=$new_name.";".$colname.";".$method.";";  
    $varpython="python check_imputation.py ";
    $var=$varpython.$sum; 
    echo $var;
    echo shell_exec($var);

    foreach($_SESSION['colname'] as $key => $value){
        if($_SESSION['col']==$value)
        {
            unset($_SESSION['colname'][$key]);
        }
        echo '陣列順序'.$key.'：=>'.$value.'<br />';
      }
     
    $_SESSION['colname'] = array_values($_SESSION['colname']);
    header("Location: http://localhost/Missingdata/mechanisms.php");   
    exit;
?>