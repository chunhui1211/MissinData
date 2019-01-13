<!doctype html>
<html lang="en">
  <head>
    <title>INDEX</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  </head>
  <body style="background-color: rgb(243, 243, 243);">
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
            // $new_name=$_GET["new_name"];
            // $_SESSION['new_name']=$new_name;
            session_start();
            $new_name=$_SESSION['new_name'];  
            echo "<p class='lead'>檔案名稱:".$new_name."</p>";
        ?> 
        <hr>
        
        <h4>欄位</h4>
        <form action="imputation.php" method="post" enctype="multipart/form-data">
        <?php
        for($i = 0 ; $i < count($_SESSION['col']) ; $i++) 
        {            
            echo "<input type='radio' name='colname[]' value='{$_SESSION['colname'][$i]}'>";
            echo $_SESSION['colname'][$i];           
        } 
        ?>
        <hr>
        <h4>遺漏機制</h4>       
        <input type="radio" name="mrbook[]" value="MCAR" />MCAR
        <input type="radio" name="mrbook[]" value="MAR" />MAR
        <input type="radio" name="mrbook[]" value="MNAR" />MNAR
        <hr>
        <h4>填補方法</h4>
        <input type="radio" name="imputation" value="列表刪除法" />列表刪除法
        <input type="radio" name="imputation" value="平均值" />平均值
        <input type="radio" name="imputation" value="眾值" />眾值
        <input type="radio" name="imputation" value="最近鄰居法" />最近鄰居法
        <input type="radio" name="imputation" value="線性迴歸法" />線性迴歸法
        <input type="radio" name="imputation" value="邏輯回歸法" />邏輯回歸法
        <hr>
        <button type="submit" class="btn" name="submit">送出</button>
        </form>
        <?php
        // if(issrt($_POST['mrbook'][0])=="MCAR")
        // {
        //     echo "您選擇的遺漏機制是：";
        //     echo "MCAR";
        // }
        // if(issrt($_POST['mrbook'][0])=="MAR")
        // {
        //     echo "您選擇的遺漏機制是：";
        //     echo "MAR";
        // }
        // if(issrt($_POST['mrbook'][0])=="MNAR")
        // {
        //     echo "您選擇的遺漏機制是：";
        //     echo "MNAR";
        // }     
           
        //  if(isset($_POST['mrbook'])!=null)
        //  {
        //     echo "您選擇的遺漏機制是：";
        //     for($i=0;$i<count($_POST['mrbook']);$i++)
        //     {
        //         echo $_POST['mrbook'][$i]."&nbsp;&nbsp;";
        //     }
        //      echo "您選擇的欄位是：";
        //      for($i=0;$i<count($_POST['colname']);$i++)
        //      {
        //          echo $_POST['colname'][$i]."&nbsp;&nbsp;";
        //      }
        //  }
        ?>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>