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
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" />
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
            <div class="row mt-3">
                <div class="col">
                    <p><i class="fas fa-trash-alt mr-2"></i></i>請選擇欲刪除的欄位</p>
                    <input type="checkbox" name="col[]" id="none" />
                    <label for="none">無</label><br />
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
                    <p><i class="fas fa-trash-alt mr-2"></i></i>請設定刪除資料列個數</p>
                    <input type="radio" name="del" id="nonee" value="none" />
                    <label for="nonee">無</label><br />

                    <!-- <input type="radio" name="del" id="percent" value="percent" />
                    <input type="textbox" name="delpercent" style="width:30px;"  />
                    <label for="percent">%</label><br /> -->

                    <input type="radio" name="del" id="number" value="number" />
                    <input type="textbox" name="delnumber" style="width:30px;" id="numtext" />
                    <label for="number">個</label><br /><br /><br /><br /><br /><br />
                    <button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#Modal"><i class="far fa-share-square mr-2"></i>下一步</button>
                </div>
                <div class="col">
                    <p><i class="fas fa-percent mr-2"></i>遺失率參考</p>
                    <?php
                    $new_name = explode(".", $new_name);
                    if (file_exists("./missinginfo/" . $new_name[0] . "/missingrate.png")) {
                        echo  "<a href=\"missinginfo/" . $new_name[0] . "/missingrate.png\" class=\"fancybox\">";
                        echo "<img class=\"msno\" src=\"./missinginfo/" . $new_name[0] . "/missingrate.png\"></a>";
                    }
                    ?>

                </div>
            </div>
          
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
    <!-- jQuery v1.9.1 -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <!-- fancyBox v2.1.5 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $('.fancybox').fancybox();
        $('button[type="submit"]').click(function() {
            var colname = $('input[name="col[]"]:checked').length;
            if (colname == 0) {
                alert("請選擇選項");
                return false;
            } else {
                document.form1.submit();
            }
        });
        $('#numtext').click(function(){
            $('#number').prop('checked', true);             
        })

        $('#nonee').click(function(){
            $('#numtext').val("")      
        })       
    </script>
</body>