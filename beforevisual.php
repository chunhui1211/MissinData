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
      $new_name = $_SESSION['new_name'];
      echo "<span>檔名新名稱:" . $new_name . "</span>";
      ?>
      <div class="col-1">
        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-upload mr-2"></i>重新上傳</button>
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
                <?php echo "<p class='lead'>$new_name</p>"; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="location.href='http://localhost/Missingdata/index.php'">確認</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <form action="del_img.php" method="post" enctype="multipart/form-data">
        <div class="col-1">
          <button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#Modal"><i class="fas fa-sliders-h mr-2"></i>調整資料集</button>
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
      </form>
      <div class="col-10">
      </div>
    </div>
    <h1 class="text-center mt-4 mb-4">資料遺漏狀況圖</h1>
    <div class="row">
      <div class="col text-center">
        <h2>數據矩陣 Matrix</h2>
        <div style="height:100px;">
          <p>快速直觀地查看數據完整及遺漏程度</p>
        </div>
        <?php
        $new_name = explode(".", $new_name);
        if (file_exists("./missinginfo/" . $new_name[0] . "/matrix.png")) {
          echo  "<a href=\"missinginfo/" . $new_name[0] . "/matrix.png\" class=\"fancybox\">";
          echo "<img class=\"msno\" src=\"./missinginfo/" . $new_name[0] . "/matrix.png\"></a>";
        }
        ?><br /><br />
        <small>黑色代表為完整資料,白色為遺漏資料</small>
      </div>
      <div class="col text-center">
        <h2>長條圖 Bar Chart</h2>
        <div style="height:100px;">
          <p>將欄位以長條的方式簡單視覺化</p>
        </div>
        <?php
        if (file_exists("./missinginfo/" . $new_name[0] . "/bar.png")) {
          echo  " <a href=\"missinginfo/" . $new_name[0] . "/bar.png\" class=\"fancybox\">";
          echo "<img class=\"msno\" src=\"./missinginfo/" . $new_name[0] . "/bar.png\"></a>";
        }
        ?><br /><br />
        <small>遺失率低於5%較為無關緊要，超過10%可能導致統計分析偏差</small>
      </div>
      <div class="col text-center" id="heatmap">
        <h2>熱圖 Heatmap</h2>
        <div style="height:100px;">
          <p>一個變量的存在或不存在如何強烈影響另一個變量</p>
        </div>
        <?php
        if (file_exists("./missinginfo/" . $new_name[0] . "/heatmap.png")) {
          echo  " <a href=\"missinginfo/" . $new_name[0] . "/heatmap.png\" class=\"fancybox\">";
          echo "<img id='heatimg' class=\"msno\" src=\"./missinginfo/" . $new_name[0] . "/heatmap.png\"></a>";
        }
        ?><br /><br />
        <small>無效相關範圍從-1(如果一個變量出現另一個肯定沒有)
          到0(出現或不出現的變量對彼此沒有影響)
          到1(如果一個變量出現另一個肯定也出現)</small>
      </div>
    </div>
    <h1 class="text-center mt-4 mb-4">資料統計資訊</h1>
    <div class="row">
      <div class="col text-center">
        <?php
        require_once "C:/xampp/htdocs/Missingdata/PHPExcel/Classes/PHPExcel.php";
        $excelObj = PHPExcel_IOFactory::load("missinginfo/" . $new_name[0] . "/describe.csv");
        $worksheet = $excelObj->getSheet(0);
        $toCol = $worksheet->getHighestColumn();
        $toCol++;
        echo '<table>';
        for ($row = 1; $row <= $worksheet->getHighestRow(); $row++) {
          $toCol = $worksheet->getHighestColumn();
          $toCol++;
          echo "<tr>";
          for ($col = "A"; $col != $toCol; $col++) {
            echo "<td>";
            echo $worksheet->getCell($col . $row)->getValue();
            echo "</td>";
          }
          echo "</tr>";
        }
        echo '</table>';
        ?>
      </div>
      <div class="col ">
        <?php
        for ($i = 0; $i < count($_SESSION['colname']); $i++) {
          echo $_SESSION['colname'][$i] . ':' . $_SESSION['rate'][$i] . '%';
          echo "<br/>";
        }
        ?>
      </div>
      <div class="col text-center">
      </div>
    </div>
    <br /><br /><br />
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
  var len = $('#heatmap').find("img")
  if (len.length == 0) {
    $('#heatmap').css("display", "none")
  }
</script>

</html>