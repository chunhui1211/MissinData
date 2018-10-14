<!doctype html>
<html lang="en">
  <head>
    <title>afterload</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <style type="text/css">
    td{
        border:1px solid #ddd;
    }
    </style>
  </head>
  <body>
<div class="container-fluid"> 
  <div class="row" style="box-shadow: 0 0 30px 0 rgba(0,123,255,0.20);height: 64px">
        <div class="col">
           <h1>Missing Data</h1>
        </div>
    </div>
    </div>
    </div>
  </div>
</div>
<div class="container">
    

<?php 
    $new_name=$_GET["new_name"];
    echo "<p class='lead'>檔名新名稱:".$new_name."</p>";
?>
    <div class="row mt-2">
        <div class="col">
<?php      
        require_once "C:/xampp/htdocs/0919/PHPExcel/Classes/PHPExcel.php";
        $excelObj = PHPExcel_IOFactory::load("download/".$new_name);  
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();
        $lastColumn = $worksheet->getHighestColumn(); 
               
        echo '<table>';      
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
        </div> 
    </div> 
 </div>   

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>