<!doctype html>
<html lang="en">
  <head>
    <title>MissingData</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
  <div class="container-fluid"> 
    <div class="row rowheader">
        <div class="col">
           <h1><a href='http://localhost/Missingdata/index.php'>Missing Data</a></h1>
        </div>
    </div>
  </div>
  <div class="container-fluid">
  <div class="row">
      <div class="col-4">
    <?php   
    session_start(); 
    echo "<p>檔名名稱:".$_SESSION['name']."</p>";
    echo "<p>檔名型態:".$_SESSION['type']."</p>";
    echo "<p>檔名大小:".$_SESSION['size']."</p>";
    echo "<p>檔名新名稱:".$_SESSION['new_name']."</p>";
    $new_name=$_SESSION['new_name'];
    ?>
    </div>
    <div class="col align-self-center">
    <button type="button" class="btn"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-upload mr-2"></i>重新上傳</button>
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
          <button type="submit" class="btn btn-primary mt-3" name="submit" data-toggle="modal" data-target="#Modal"><i class="fas fa-chart-bar mr-2"></i>資料視覺化</button>
          <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Loading...</h5>
                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                </div>
              </div>
            </div>
          </div>

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
?>
    </div>
</div>   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> 
  </body>
</html>