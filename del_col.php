<?php
session_start();
$new_name = $_SESSION['new_name'];
$col = "";
if (isset($_POST['col']))
{   
    foreach ($_POST['col'] as $value) 
    {
        $col = $col . $value . ',';    
    }
    $var = "/xampp/htdocs/MissingData/del_col.py " . $new_name . ';' . $col;
    $varpython = shell_exec($var);

    foreach ($_POST['col'] as $value) 
    {        
        
        for($i=0;$i<sizeof($_SESSION['colname']);$i++)
        {
            
            if($_SESSION['colname'][$i]==$value)
            {  
                unset($_SESSION['colname'][$i]);
                $_SESSION['colname'] = array_values($_SESSION['colname']); 
            }  
        }   
    }
}

if(isset($_POST['del']))
{   
    if($_POST['del']=="none")
    {
        echo $_POST['del'];
    }
    elseif($_POST['del']=="number")
    {
        $var = "/xampp/htdocs/MissingData/del_row.py " . $new_name . ';' .  $_POST['delnumber'];
        echo shell_exec($var);
    }
}
header("Location: http://localhost/Missingdata/filtercol.php");   
exit;
