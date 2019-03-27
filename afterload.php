<!doctype html>
<html lang="en">

<head>
    <title>MissingData</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"
        integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <style type="text/css">
    td {
        border: 1px solid #ddd;
    }

    .msno {
        width: 450px;
        height: 300px;
    }

    .box {
        width: 400px;
        height: 500px;
    }

    .factor {
        width: 600px;
        height: 300px;
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
    if ($method=="del") {
        $method="列表刪除";
    } elseif ($method=="delrow") {
        $method="欄位刪除";
    } elseif ($method=="mean") {
        $method="平均值";
    } elseif ($method=="mode") {
        $method="眾值";
    } elseif ($method=="knn") {
        $method="最近鄰居法";
    } elseif ($method=="linear") {
        $method="線性迴歸法";
    } elseif ($method=="logistic") {
        $method="邏輯迴歸法";
    }
    echo "<p class='lead'>方法:".$method."</p>";
    $col=$_SESSION['col'];
    echo "<p class='lead'>欄位:".$col."</p>";
    ?>
        <div class="row">
            <div class="col-1">
                <button type="button" class="btn btn-secondary"
                    onclick="location.href='http://localhost/Missingdata/mechanisms.php'">返回修改</button>
            </div>
            <div class="col-1">
                <form action="check_imputation.php" method="post" enctype="multipart/form-data">
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#Modal">確定填補</button>
                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <div class="container-fluid mt-5">
        <nav>
            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">長條圖</a>
                <a class="nav-item nav-link " id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">盒狀圖</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">jointplot</a>
            </div>
        </nav>
        <div class="tab-content p-5" id="nav-tabContent">
            <?php
            function displayimg($type)
            {
                $handle = opendir('./imputation_photo/'); //當前目錄
                while (false !== ($file = readdir($handle))) 
                { 
                    list($filesname, $kzm)=explode(".", $file);
                    if ($kzm=="png" and strpos($filesname, $type)!==false) 
                    {  
                        if (!is_dir('./'.$file)) 
                        { 
                            $array[]=$file;
                        }
                    }
                }
                for ($j=0;$j<count($array);$j++)
                {
                echo "<img class=\"$type\" src=\"./imputation_photo/$array[$j]\">";
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
                echo '</table>';
                ?>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
            integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous">
        </script>
        <!-- jQuery v1.9.1 -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
        <!-- fancyBox v2.1.5 -->
        <link type="text/css" rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" />
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>