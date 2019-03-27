<?php
    session_start();
    $new_name=$_SESSION['new_name'];
    if ($_POST['method']!=null)
    {
        $method=$_POST['method']; 
        $_SESSION['method']=$method;
    }

    if ($_POST['colname']!=null)
    {
        for($i=0;$i<count($_POST['colname']);$i++)
        {
            $colname=$_POST['colname'][$i];        
            $_SESSION['col']=$colname;
        }        
    } 
    if ($_POST['ycol']!=null)
    {
        $ycol=$_POST['ycol']; 
    }
    trim($colname);
    $sum=$new_name.";".$colname.";".$method.";".$ycol.";"; 

    $varpython="python imputation.py ";
    $var=$varpython.$sum; 
    $varpython_plot="python plot.py ";
    $plot=$varpython_plot.$sum;
    echo shell_exec($var);
    echo shell_exec($plot);

    header("Location: http://localhost/Missingdata/afterload.php");   
    exit;
?>
