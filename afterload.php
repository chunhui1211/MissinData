<!doctype html>
<html lang="en">
  <head>
    <title>MissingData</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <style type="text/css">
    td{
        border:1px solid #ddd;
    }
    .msno{
        width:450px;
        height:300px;
    }
    </style>
  </head>
  <body style="background-color: rgb(243, 243, 243);font-family:Microsoft JhengHei;">
<div class="container-fluid"> 
  <div class="row" style="box-shadow: 0 0 30px 0 rgba(0,123,255,0.20);height: 64px;">
        <div class="col">
           <h1>Missing Data</h1>
        </div>
    </div>
    </div>
    </div>
  </div>
</div>
<div class="container-fluid">
<?php 
    session_start();
    $new_name=$_SESSION['new_name']; 
    echo "<p class='lead'>檔案名稱:".$new_name."</p>";
    $method=$_SESSION['method']; 
    if($method=="del")
        $method="列表刪除";
    else if($method=="delrow")
        $method="欄位刪除";
    else if($method=="mean")
        $method="平均值"; 
    else if($method=="mode")
        $method="眾值";  
    else if($method=="knn")
        $method="最近鄰居法";   
    else if($method=="linear")
        $method="線性迴歸法";   
    else if($method=="logistic")
        $method="邏輯迴歸法";    
    echo "<p class='lead'>方法:".$method."</p>";
    $col=$_SESSION['col']; 
    echo "<p class='lead'>欄位:".$col."</p>";
?>
    <button type="button" class="btn btn-light" onclick="location.href='http://localhost/Missingdata/mechanisms.php'">返回修改方法</button>
  
    <form action="check_imputation.php" method="post" enctype="multipart/form-data">
    <button type="submit" class="btn btn-light" >確定此方法</button>
    </form>
    <div class="container-fluid">       
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
       <!-- jQuery v1.9.1 -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	<!-- fancyBox v2.1.5 -->
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
    // $(document).ready(function() {
    //     $(".fancybox").fancybox();
    // });
    function divFunction(){
        alert("123")
    }
    </script>
  </body>
</html>