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
    <form id="form1" action="del_col.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <p><i class="far fa-check-square mr-2"></i>請選擇欲刪除的欄位</p>
                    <?php
                    session_start();
                    $new_name = $_SESSION['new_name'];
                    for ($i = 0; $i < count($_SESSION['colname']); $i++) {
                        echo "<input type='checkbox' name='col[]' id='{$_SESSION['colname'][$i]}' value='{$_SESSION['colname'][$i]}'>";
                        echo "<label for='{$_SESSION['colname'][$i]}'>{$_SESSION['colname'][$i]}</label>";
                        echo "<br/>";
                    }
                    ?>
                </div>
                <div class="col">
                    <br />
                    <p><i class="fas fa-percent mr-2"></i>遺失率參考</p>
                    <?php
                    for ($i = 0; $i < count($_SESSION['colname']); $i++) {
                        echo $_SESSION['colname'][$i] . ':' . $_SESSION['rate'][$i] . '%';
                        echo "<br/>";
                    }
                    ?>
                </div>
                <div class="col">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#Modal"><i class="far fa-share-square mr-2"></i>送出</button>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>