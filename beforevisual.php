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
    <div class="row ml-5 mt-3">
    <?php
        session_start();
        $new_name=$_SESSION['new_name'];
        echo "<span>檔名新名稱:".$new_name."</span>";
    ?> 
        <div class="col-1">
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
        <button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#Modal" onclick="location.href='http://localhost/Missingdata/filtercol.php'"><i class="fas fa-sliders-h mr-2"></i>設定填補</button>
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
        </div>
        <div class="col-10">               
        </div>     
    </div>
  <h1 class="text-center mt-5">資料遺漏狀況圖</h1>  
    <div class="row">    
        <div class="col text-center">
            <h2>Matrix</h2>
            <?php
            $new_name=explode(".",$new_name);
            if (file_exists("./missinginfo/".$new_name[0]."/matrix.png")) {
                echo  "<a href=\"missinginfo/".$new_name[0]."/matrix.png\" class=\"fancybox\">";
                echo "<img class=\"msno\" src=\"./missinginfo/".$new_name[0]."/matrix.png\"></a>";
            }
            ?>    
        </div>
        <div class="col text-center">
            <h2>Bar Chart</h2>
            <?php
            if (file_exists("./missinginfo/".$new_name[0]."/bar.png")) {
                echo  " <a href=\"missinginfo/".$new_name[0]."/bar.png\" class=\"fancybox\">";
                echo "<img class=\"msno\" src=\"./missinginfo/".$new_name[0]."/bar.png\"></a>";
            }
            ?>
        </div>
        <div class="col text-center">
            <h2>Heatmap</h2>
            <?php
            if (file_exists("./missinginfo/".$new_name[0]."/heatmap.png")) {
                echo  " <a href=\"missinginfo/".$new_name[0]."/heatmap.png\" class=\"fancybox\">";
                echo "<img class=\"msno\" src=\"./missinginfo/".$new_name[0]."/heatmap.png\"></a>";
            }
            ?>
        </div>            
    </div>
    <div class="row">
    <div class="col">  
    <?php
    // $path="./missinginfo/".$new_name[0]."/".$new_name[0].".html";
    // if (file_exists($path)) {
    //     include($path);
    // }
     
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