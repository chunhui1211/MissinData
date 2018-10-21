<?php
$sum=null;
if ($_POST['head']!=null)
{
    for($i=0;$i<count($_POST['head']);$i++)
       {
           $varphp=$_POST['head'][$i]; 
           $sum=$sum.$varphp.";";            
       }
}
$varpython="python test.py ";
$var=$varpython.$sum; 
// echo shell_exec($var);
?>