<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>read</title>
    <style type="text/css">
    table{
        width:200px;
        height:200px;
       
    }
    td{
        border:1px solid #ddd;
    }
    </style>

</head>
<body>
<?php
require_once "C:/xampp/htdocs/0919/PHPExcel/Classes/PHPExcel.php";

    $url="http://spreadsheetpage.com/downloads/xl/worksheet%20functions.xlsx";
    $filecontent = file_get_contents($url);
    $tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
    file_put_contents($tmpfname,$filecontent);
    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $excelObj = $excelReader->load($tmpfname);   
    $worksheet = $excelObj->getSheet(0);
    $lastRow = $worksheet->getHighestRow();
    $lastColumn = $worksheet->getHighestColumn();
    
    echo "<table>";
    for($row=1;$row<=$worksheet->getHighestRow();$row++)
    {
        $toCol = $worksheet->getHighestColumn(); $toCol++;
        echo "<tr>";
        for($col = "A"; $col != $toCol; $col++) 
        {   
            echo "<td>";       
            echo $worksheet->getCell($col.$row)->getValue();          
            echo "</td>"; 
        }
        echo "</tr>";
    }
    echo '</table>';


?>

</body>
</html>