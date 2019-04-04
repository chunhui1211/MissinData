<!doctype html>
<html lang="en">
  <head>
    <title>MissingData</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" />
    <style>
    .msno{
        width:450px;
        height:300px;
    }
    </style>
  
  </head>
  <body style="font-family:Microsoft JhengHei;">
  <div class="container-fluid"> 
  <div class="row" style="box-shadow: 0 0 30px 0 rgba(0,123,255,0.20);height: 64px">
        <div class="col">
           <h1 style="margin:0;font-size:40px;">Missing Data</h1>
        </div>
    </div>
    </div>
  <div class="container-fluid">
    <div class="row ml-5 mt-3">
    <?php
        session_start();
        $new_name=$_SESSION['new_name'];
        echo "<p class='lead '>檔名新名稱:".$new_name."</p>";
    ?> 
        <div class="col-1">
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
                            <?php echo "<p class='lead'>$new_name</p>";?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" onclick="location.href='http://localhost/Missingdata/index.php'">確認</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-1">
        <form action="missingcol.php" method="post" enctype="multipart/form-data">
        <button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#Modal">設定填補</button>
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
        <div class="col-10">         
        </div>
    </div>
    <div class="row mt-5">     
        <div class="col">
            <?php
            $filename="./photo/".$new_name."1.png";
            if (file_exists($filename)) {
                echo  "<a href=\"photo/".$new_name."1.png\" class=\"fancybox\">";
                echo "<img class=\"msno\" src=\"./photo/".$new_name."1.png\"></a>";
            }
            ?>    
        </div>
        <div class="col">
            <?php
            $filename="./photo/".$new_name."2.png";
            if (file_exists($filename)) {
                echo  " <a href=\"photo/".$new_name."2.png\" class=\"fancybox\">";
                echo "<img class=\"msno\" src=\"./photo/".$new_name."2.png\"></a>";
            }
            ?>
        </div>
        <div class="col">
            <?php
            $filename="./photo/".$new_name."3.png";
            if (file_exists($filename)) {
                echo  " <a href=\"photo/".$new_name."3.png\" class=\"fancybox\">";
                echo "<img class=\"msno\" src=\"./photo/".$new_name."3.png\"></a>";
            }
            ?>
        </div>            
    </div>
    <div class="row">
    <div class="col">  
    <?php
    $path="./missinginfo/".$new_name.".html";
    if (file_exists($path)) {
        include($path);
    }
      
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  </body>
  <script>
        $('.fancybox').fancybox();
</script>
</html>