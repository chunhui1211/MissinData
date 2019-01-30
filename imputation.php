<?php
    session_start();
    $new_name=$_SESSION['new_name'];  
    if ($_POST['method']!=null)
    {
        $method=$_POST['method']; 
    }
    if ($_POST['colname']!=null)
    {
        for($i=0;$i<count($_POST['colname']);$i++)
        {
            $colname=$_POST['colname'][$i];                 
        }
        $sum=$new_name.";".$colname.";".$method.";";    
    } 
  
    $varpython="python imputation.py ";
    $var=$varpython.$sum; 
    echo $sum;
    // echo "<br/>";
    // print_r($_SESSION);
    echo shell_exec($var);
    header("Location: http://localhost/Missingdata/afterload.php");   
    exit;
?>
