<?php
    session_start();
    $new_name=$_SESSION['new_name'];
    $count=$_SESSION['count'];
    $count=$count+1;
    $_SESSION['count']=$count;
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
    if (isset($_POST['ycol'])) 
    {
        if ($_POST['ycol']!=null)
        {
            $ycol=$_POST['ycol']; 
        }
    }

    foreach ($_POST['vp'] as $key => $value) 
    {
        $vp=$vp.$key.',';
    }  

    trim($colname);
    $sum=$new_name.";".$colname.";".$method.";".$ycol.";"; 
    $sumplot=$new_name.";".$colname.";".$method.";".$ycol.";".$vp.";".$count.";"; 
    $varpython="python imputation.py ";
    $var=$varpython.$sum; 
    echo shell_exec($var);    
    $varpython_plot="python plot.py ";
    $plot=$varpython_plot.$sumplot;  
    echo shell_exec($plot);
    
    header("Location: http://localhost/Missingdata/afterload.php");   
    exit;
?>
