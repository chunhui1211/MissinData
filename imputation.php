<?php
set_time_limit(0);
if ($_POST['submit'] == 'imputation') {
    session_start();
    $new_name = $_SESSION['new_name'];
    $count = $_SESSION['count'];
    $count = $count + 1;
    $_SESSION['count'] = $count;
    $ycol = "";

    if ($_POST['colname'] != null) {
        for ($i = 0; $i < count($_POST['colname']); $i++) {
            $colname = $_POST['colname'][$i];
            $_SESSION['col'] = $colname;
        }
    }
    if (isset($_POST['ycol'])) {
        if ($_POST['ycol'] != null) {
            $ycol = $_POST['ycol'];
        }
    }
    $method = "";
    $methods = array();
    foreach ($_POST['method'] as $key => $value) {
        $method = $method . $key . ',';
        array_push($methods, $key);
    }
    $method = substr($method, 0, -1);
    $_SESSION['method'] = $methods;
    $vp = "";
    foreach ($_POST['vp'] as $key => $value) {
        $vp = $vp . $key . ',';
    }
    $vp = substr($vp, 0, -1);

    trim($colname);

    $sum = "/xampp/htdocs/MissingData/imputation.py " . $new_name . ";" . $colname . ";" . $method . ";" . $count . ";". $vp . ";" . $ycol . ";";
    echo shell_exec($sum);
    header("Location: http://localhost/Missingdata/afterload.php");
    exit;
} else if ($_POST['submit'] == 'check') {
    session_start();
    $new_name=$_SESSION['new_name'];  
    $colname=$_SESSION['col'];
    if (isset($_POST['colname'])) {
        for ($i = 0; $i < count($_POST['colname']); $i++) {
            $colname = $_POST['colname'][$i];
        }
    }
    if(isset($_POST['method']))
    {
        $method=$_POST['method'];
    }   
    if(isset($_POST['option']))
    {
        $method=$_POST['option'];
    }    

    array_push($_SESSION['list'], array ($colname,$method));

    $var="/xampp/htdocs/MissingData/check_imputation.py ".$new_name.";".$colname.";".$method.";";
    shell_exec($var);
    foreach($_SESSION['col_cage'] as $key => $value)
    {
        if($colname==$value)
        {
            unset($_SESSION['col_cage'][$key]);
        }
    }
    $_SESSION['col_cage'] = array_values($_SESSION['col_cage']); 

    foreach($_SESSION['col_num'] as $key => $value)
    {
        if($colname==$value)
        {
            unset($_SESSION['col_num'][$key]);
        }
    }
    $_SESSION['col_num'] = array_values($_SESSION['col_num']);

    $_SESSION['method']="";
    // $_SESSION['col']="";
    $_SESSION['count']="";

    header("Location: http://localhost/Missingdata/mechanisms.php");   
    exit;
}
    // session_start();
    // $new_name=$_SESSION['new_name'];
    // $count=$_SESSION['count'];
    // $count=$count+1;
    // $_SESSION['count']=$count;
    // $ycol="";

    // if ($_POST['colname']!=null)
    // {
    //     for($i=0;$i<count($_POST['colname']);$i++)
    //     {
    //         $colname=$_POST['colname'][$i];        
    //         $_SESSION['col']=$colname;
    //     }        
    // } 
    // if (isset($_POST['ycol'])) 
    // {
    //     if ($_POST['ycol']!=null)
    //     {
    //         $ycol=$_POST['ycol']; 
    //     }

    // }
    // $method="";
    // $methods=array();
    // foreach ($_POST['method'] as $key => $value) 
    // {
    //     $method=$method.$key.',';
    //     array_push($methods,$key);        
    // }  
    // $method=substr($method,0,-1);
    // $_SESSION['method']=$methods;
    // $vp="";
    // foreach ($_POST['vp'] as $key => $value) 
    // {
    //     $vp=$vp.$key.',';
    // }  
    // $vp=substr($vp,0,-1);

    // trim($colname);

    // $sum="/xampp/htdocs/MissingData/imputation.py ".$new_name.";".$colname.";".$method.";".$count.";";    
    // shell_exec($sum);    
    
    // $sumplot="/xampp/htdocs/MissingData/plot.py ".$new_name.";".$colname.";".$method.";".$ycol.";".$vp.";".$count.";";   
    // echo shell_exec($sumplot);

    
    
    // header("Location: http://localhost/Missingdata/afterload.php");   
    // exit;
