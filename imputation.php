<?php
    session_start();
    $new_name=$_SESSION['new_name'];  
    
    $sum=null;
    if ($_POST['head']!=null)
    {
        for($i=0;$i<count($_POST['head']);$i++)
        {
            $varphp=$_POST['head'][$i]; 
            $sum=$sum.$varphp.";";            
        }
    }
    $varpython="python imputation.py ";
    $var=$varpython.$new_name.";".$sum; 
    echo shell_exec($var);
    header("Location: http://localhost/Missingdata/afterload.php");   
    exit;
?>