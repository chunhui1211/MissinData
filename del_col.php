<?php
session_start();
$new_name = $_SESSION['new_name'];

if (isset($_POST['col'])) {
    $col = "";
    foreach ($_POST['col'] as $value) {
        $col = $col . $value . ',';
        
    }
    $var = "/xampp/htdocs/MissingData/del_col.py " . $new_name . ';' . $col;
    $varpython = shell_exec($var);
    $varpython=trim($varpython); 
    $cols=explode(",",$varpython);  
    for($j=0;$j<sizeof($cols);$j++)
    {
       echo $cols[$j];
        for($i=0;$i<sizeof($_SESSION['colname']);$i++)
        {
            //  echo $_SESSION['colname'][$i];
            if($_SESSION['colname'][$i]==$cols[$j])
            {  
                // echo "o".$i.$cols[$j].$colname[$i]."<br/>";
                unset($_SESSION['colname'][$i]);
            }  
        }           
    }
    $_SESSION['colname'] = array_values($_SESSION['colname']); 
}
header("Location: http://localhost/Missingdata/filtercol.php");   
exit;
