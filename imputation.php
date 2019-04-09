<?php
    session_start();
    $new_name=$_SESSION['new_name'];
    $count=$_SESSION['count'];
    $count=$count+1;
    $_SESSION['count']=$count;
    $ycol="";

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
    $method="";
    $methods=array();
    foreach ($_POST['method'] as $key => $value) 
    {
        $method=$method.$key.',';
        array_push($methods,$key);        
    }  
    $method=substr($method,0,-1);
    $_SESSION['method']=$methods;
    $vp="";
    foreach ($_POST['vp'] as $key => $value) 
    {
        $vp=$vp.$key.',';
    }  
    $vp=substr($vp,0,-1);

    trim($colname);

    $sum="python imputation.py ".$new_name.";".$colname.";".$method.";".$count.";";    
    echo shell_exec($sum);    
    
    $sumplot="python plot.py ".$new_name.";".$colname.";".$method.";".$ycol.";".$vp.";".$count.";";   
    echo shell_exec($sumplot);
    
    header("Location: http://localhost/Missingdata/afterload.php");   
    exit;
?>
