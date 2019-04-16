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

<body >
    <div class="container-fluid">
        <div class="row rowheader" >
            <div class="col">
                <h1><a href='http://localhost/Missingdata/index.php'>Missing Data</a></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <?php
        session_start();
        $new_name=$_SESSION['new_name'];
        echo "<p>檔案名稱:".$new_name."</p>";
        echo "<p>預覽次數:".$_SESSION['count']."</p>";
        echo "<p>填補欄位:".$_SESSION['col']."</p>";
        
        $method=$_SESSION['method'];
        echo "<p>填補方法:";
        foreach ($method as $key => $value) {
            echo enmethodtoch($value).';';
        }
        echo "</p>";

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
    <form action="check_imputation.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-4 mb-2">
            <p>填補方法設定:</p>
            <select class="custom-select" name="option">
            <?php
                foreach ($method as $key => $value) {
                    $s=enmethodtoch($value);
                    echo "<option value='{$value}'>{$s}</option>";
                }
            ?>
            </select>
        </div>
        <div class="col-1 mt-5">
            <button type="button" class="btn btn-secondary"
                onclick="location.href='http://localhost/Missingdata/mechanisms.php'"><i class="fas fa-undo mr-2"></i>返回修改</button>           
        </div>
        <div class="col-1 mt-5">          
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#Modal"><i class="far fa-check-circle mr-2"></i>確定填補</button>
            <div class="modal fade" id="Modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
    </div>
    </form>
   <div class="row">
    <div class="col">
       <h1>視覺化</h1>    
    <nav>
        <div class="nav nav-tabs " id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="factor" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">長條圖</a>
            <a class="nav-item nav-link " id="box" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">盒狀圖</a>
            <a class="nav-item nav-link" id="joint" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">散點圖</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
    <?php
        function displayimg($type)
        {
            $new_name=$_SESSION['new_name'];
            $new_name=substr($new_name, 0, -4);
            $handle = opendir('./imputation_photo/'.$new_name.'/');
            while (false !== ($file = readdir($handle))) {
                list($filesname, $kzm)=explode(".", $file);
                if ($kzm=="png" and strpos($filesname, $type)!==false) {
                    if (!is_dir('./'.$file) and
                    substr($file, 0, 1)==$_SESSION['count'] and
                    substr($file, 1, strlen($_SESSION['col']))==$_SESSION['col']) {
                        $array[]=$file;
                    }
                }
            }
            if (isset($array)) {
                for ($j=0;$j<count($array);$j++) {
                    echo "<img class=\"$type\" src=\"./imputation_photo/$new_name/$array[$j]\">";
                }
            }
        }
    ?>
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <?php
        displayimg("factor");
    ?>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <?php
        displayimg("box");
    ?>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <?php
        displayimg("joint");
    ?>         
    </div>
    </div> 
       </div>
   </div>       
    <div class="row mt-5">
        <div class="col">
        <h1>檔案</h1>
        <ul class="nav nav-tabs">            
        <?php
            for ($i = 0 ; $i < count($method) ; $i++) 
            {
                $opname=$_SESSION['count'].$_SESSION['col'].$method[$i].'_'.$new_name;
                $opname=explode(".", $opname);
                if ($i==0) 
                {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link active'  data-toggle='tab' href='#f{$opname[0]}'>";
                    echo enmethodtoch($method[$i]);
                    echo "</a>";
                    echo "</li>";
                } 
                else 
                {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link'  data-toggle='tab' href='#f{$opname[0]}'>";
                    echo enmethodtoch($method[$i]);
                    echo "</a>";
                    echo "</li>";
                }
            }
        ?>
        </ul>
        <div class="tab-content p-2">
        <?php
            for ($i = 0 ; $i < count($method) ; $i++) {
                $opname=$_SESSION['count'].$_SESSION['col'].$method[$i].'_'.$new_name;
                $opname=explode(".", $opname);
                if ($i==0) {
                    echo "<div class='tab-pane fade show active' id='f{$opname[0]}'>";
                    displayfile($opname);
                    echo "</div>";
                } else {
                    echo "<div class='tab-pane fade' id='f{$opname[0]}'>";
                    displayfile($opname);
                    echo "</div>";
                }
            }
            function displayfile($opname)
            {
                require_once "C:/xampp/htdocs/0919/PHPExcel/Classes/PHPExcel.php";
                $excelObj = PHPExcel_IOFactory::load("download/".$opname[0].'.'.$opname[1]);
                $worksheet = $excelObj->getSheet(0);
                $lastRow = $worksheet->getHighestRow();
                $lastColumn = $worksheet->getHighestColumn();
                echo "<div id='{$opname[0]}'>";
                echo '<table>';
                for ($row=1;$row<=$worksheet->getHighestRow();$row++) {
                    $toCol = $worksheet->getHighestColumn();
                    $toCol++;
                    echo "<tr>";
                    for ($col = "A"; $col != $toCol; $col++) {
                        echo "<td>";
                        echo $worksheet->getCell($col.$row)->getValue();
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo '</table></div>';
            }
        ?>
        </div>
        </div>  
        </div>         
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script>
        $(function () {
            if($("img[class='factor']").length>0)
            {
                $("#factor").append($("<span>").addClass("badge badge-danger").text($("img[class='factor']").length));
            }
            if($("img[class='box']").length>0)
            {
                $("#box").append($("<span>").addClass("badge badge-danger").text($("img[class='box']").length));
            }
            if($("img[class='joint']").length>0)
            {
                $("#joint").append($("<span>").addClass("badge badge-danger").text($("img[class='joint']").length));
            }  
        });
    </script>
</body>

</html>