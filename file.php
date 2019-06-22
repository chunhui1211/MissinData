<?php
require_once "C:/xampp/htdocs/Missingdata/PHPExcel/Classes/PHPExcel.php";
$excelObj = PHPExcel_IOFactory::load("upload/titanic-190622033414.csv" );
$worksheet = $excelObj->getSheet(0);
$toCol = $worksheet->getHighestColumn();
$toCol++;          
$var='Survived';
echo '<table>';

for ($col = "A"; $col != $toCol; $col++) 
{   
    if($var==$worksheet->getCell($col. 1)->getValue())
    { 
        echo '<tr>';
        for ($row = 1; $row <= $worksheet->getHighestRow(); $row++) 
        {
            echo "<td>";
            echo $worksheet->getCell($col. $row)->getValue();
            echo "</td>";
        }     
        echo '</tr>';  
    }
}
echo '</table>';
?>