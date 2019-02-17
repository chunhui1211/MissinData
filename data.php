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
    </style>
  </head>
  <body style="font-family:Microsoft JhengHei;">
  <div class="container-fluid"> 
    <div class="row" style="box-shadow: 0 0 30px 0 rgba(0,123,255,0.20);height: 64px">
        <div class="col">
           <h1>Missing Data</h1>
        </div>
    </div>
  </div>
  <div class="container">
  <div class="row">
      <div class="col-9">
    <?php
    // $name=$_GET["name"];
    // $type=$_GET["type"];
    // $size=$_GET["size"];
    // $new_name=$_GET["new_name"];
    session_start(); 
    echo "<p class='lead'>檔名名稱:".$_SESSION['name']."</p>";
    echo "<p class='lead'>檔名型態:".$_SESSION['type']."</p>";
    echo "<p class='lead'>檔名大小:".$_SESSION['size']."</p>";
    echo "<p class='lead'>檔名新名稱:".$_SESSION['new_name']."</p>";
    $new_name=$_SESSION['new_name'];
    ?>
    </div>
    <div class="col align-self-center">
    <button type="button" class="btn"  data-toggle="modal" data-target="#exampleModal">重新上傳</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">重新上傳檔案</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>目前檔案:</p>
      <?php echo "<p class='lead'>".$new_name."</p>";?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="location.href='http://localhost/Missingdata/index.php'">確認</button>
      </div>
    </div>
  </div>
</div>
        <form action="beforedatafile.php" method="post" enctype="multipart/form-data">
          <button type="submit" class="btn mt-3" name="submit">資料視覺化</button>
        </form>
    </div>
  </div>
    <div class="row mt-2">
        <div class="col">
<?php      
        require_once "C:/xampp/htdocs/0919/PHPExcel/Classes/PHPExcel.php";
        $excelObj = PHPExcel_IOFactory::load("upload/".$_SESSION['new_name']);  
        $worksheet = $excelObj->getSheet(0);
        $toCol = $worksheet->getHighestColumn();$toCol++;

        // $array=array();
        
        // for($col = "A"; $col != $toCol; $col++) 
        // { 
        //   if ($row=1) 
        //   {   
        //     $head=$worksheet->getCell($col.$row)->getValue();
        //     array_push($array,$head);                
        //   }            
        //   else 
        //     break;
        // } 
        // $_SESSION['head']=$array;

        $arrayhead=array();
        for($col = "A"; $col != $toCol; $col++) 
        { 
          for($row=1;$row<=$worksheet->getHighestRow();$row++)
          {
            if($worksheet->getCell($col.$row)->getValue()===null)
            {
              $roww=1;           
              $head=$worksheet->getCell($col.$roww)->getValue();
              array_push($arrayhead,$head);
              break;
            }
          }                                
        } 
        $_SESSION['colname']=$arrayhead;
        

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
        // echo "<script type='text/javascript'>console.log($a);</script>";


?>
    </div>
</div> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>   
       
  </body>
</html>