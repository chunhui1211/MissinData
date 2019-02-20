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
  </head>
  
  <body style="background-color: rgb(243, 243, 243);font-family:Microsoft JhengHei;">
<div class="container-fluid">
    <div class="row" style="box-shadow: 0 0 30px 0 rgba(0,123,255,0.20);height: 64px">
        <div class="col">
           <h1>Missing Data</h1>
        </div>
    </div>
    </div>
    <div class="container">  
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-10">
        <?php
            session_start();      
            $new_name=$_SESSION['new_name'];  
            echo "<h4><strong>檔案名稱</strong></h4>";
            echo "<p>$new_name</p>"
        ?> 
        <hr>
        <h4><strong>遺漏欄位</strong></h4>
        <form action="imputation.php" method="post" enctype="multipart/form-data">
        <?php

        for($i = 0 ; $i < count($_SESSION['colname']) ; $i++) 
        {         
          echo "<input type='radio' name='colname[]' id='{$_SESSION['colname'][$i]}' value='{$_SESSION['colname'][$i]}'>";
          echo "<label for='{$_SESSION['colname'][$i]}'>{$_SESSION['colname'][$i]}</label>";
          echo "<br/>";             
        } 

        ?>
        <hr>
        <h4><strong>遺漏機制</strong></h4>       
        <input type="radio" name="mrbook[]" value="MCAR" id='MCAR' />
        <label for='MCAR'>MCAR</label><br/>
        <input type="radio" name="mrbook[]" value="MAR" id="MAR" />
        <label for='MAR'>MAR</label><br/>
        <input type="radio" name="mrbook[]" value="MNAR" id="MNAR" />
        <label for='MNAR'>MNAR</label><br/>
        <hr>
        <h4><strong>填補方法</strong></h4>
        <strong>刪除法</strong>
        <input type="radio" name="method" value="del" id="del" />
        <label for="del">列表刪除</label>
        <input type="radio" name="method" value="delrow" id="delrow" />
        <label for="delrow">欄位刪除</label>
        <br/><br/>
        <strong>補值法</strong>    
        <input type="radio" name="method" value="mean" id="mean" />
        <label for="mean">平均值</label>
        <input type="radio" name="method" value="mode" id="mode" />
        <label for="mode">眾值</label>
        <input type="radio" name="method" value="knn" id="knn" />
        <label for="knn">最近鄰居法</label>
        <input type="radio" name="method" value="linear" id="linear" />
        <label for="linear">線性迴歸法</label>
        <input type="radio" name="method" value="logistic" id="logistic"/>
        <label for="logistic">邏輯迴歸法</label>
        <hr>
        <button type="submit" class="btn" name="submit" data-toggle="modal" data-target="#Modal">送出</button>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script>
        var method = '<?php echo $_SESSION['method']; ?>';
        var col = '<?php echo $_SESSION['col']; ?>';
        document.getElementById(method).checked = true;
        document.getElementById(col).checked = true;
        </script>
  </body>
</html>
         