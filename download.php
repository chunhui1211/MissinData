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
        <?php
            session_start();
        ?> 
        <div class="col">
        <button type="button" class="btn btn-warning"  onclick="location.href='downloadfile.php?file=<?=$_SESSION['new_name']?>'"><i class="fas fa-download"></i>檔案匯出</button>
        <button type="button" class="btn btn-primary ml-5"  onclick="location.href='http://localhost/Missingdata/index.php'"><i class="fas fa-home"></i>首頁</button>
        <?php    
        echo "<p class='lead'>檔案名稱:".$_SESSION['new_name']."</p>";
        if ($_SESSION['list']!=null) {
            for($i=0;$i<count($_SESSION['list']);$i++)
            {
              $value=enmethodtoch($_SESSION['list'][$i][1]);
              echo '步驟'.($i+1).'=>欄位:'.$_SESSION['list'][$i][0].',方法:'.$value."<br/>";
            }
          }
          function enmethodtoch($method)
          {
              if ($method=="del") {
                  return "列表刪除";
              } elseif ($method=="delrow") {
                  return "欄位刪除";
              } elseif ($method=="mean") {
                  return "平均值";
              } elseif ($method=="mode") {
                  return "眾值";
              } elseif ($method=="knn") {
                  return "最近鄰居法";
              } elseif ($method=="linear") {
                  return "線性迴歸法";
              } elseif ($method=="logistic") {
                  return "邏輯迴歸法";
              }
          }
        ?>       
        </div>
        </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

  </body>
</html>
         