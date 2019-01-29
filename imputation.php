<?php
    session_start();
    $new_name=$_SESSION['new_name'];  
    $colname=$_SESSION['colname']; 
    $method=$_SESSION['method']; 
    // $sum=null;
    if ($_POST['colname']!=null)
    {
        for($i=0;$i<count($_POST['colname']);$i++)
        {
            $varphp=$_POST['colname'][$i]; 
            $sum=$varphp.";".$method.";";            
        }
    }
    $varpython="python imputation.py ";
    $var=$varpython.$new_name.";".$sum; 
    echo shell_exec($var);
    header("Location: http://localhost/Missingdata/afterload.php");   
    exit;
?>
