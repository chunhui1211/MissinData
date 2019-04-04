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
        <?php
            session_start();
            $new_name=$_SESSION['new_name'];
    
          ?> 
        <div class="col-3">

        <button type="button" class="btn btn-warning"  onclick="location.href='download.php?file=<?=$new_name?>'">檔案匯出</button>
        <br/><br/>
        <?php
            if ($_SESSION['list']!=null) {
                $listcol=$_SESSION['list'];
                $cutchar = explode(";", $listcol);

                foreach ($cutchar as $key => $value) {
                    $key=$key+1;
                    echo '步驟'.$key.'：=>'.$value.'<br />';
                }
            }
        ?>       
        </div>
        <div class="col">    
        <h4><strong>檔案名稱</strong></h4>
        <p><?=$new_name?></p>       
        <hr>
        <form id="form1" action="imputation.php" method="post" enctype="multipart/form-data">
        <h4><strong>遺漏欄位</strong></h4>
        <small>S:文字 N:數字</small>
        <div id="cage">
        <?php    
        if(isset($_POST['cage']))
        {
          $_SESSION['col_cage']="";
          $cage=array();
          $col_cage = $_POST['cage'];
          for ($i = 0 ; $i < count($_POST['cage']) ; $i++)
          {
            echo "<input type='radio' name='colname[]' id='{$col_cage[$i]}' value='{$col_cage[$i]}'>";
            echo "<label for='{$col_cage[$i]}'>{$col_cage[$i]} (S)</label><br/>";
            array_push($cage,$col_cage[$i]);
          }
          $_SESSION['col_cage']=$cage;
        }
        else
        {
          for ($i = 0 ; $i < count($_SESSION['col_cage']) ; $i++)
          {
            echo "<input type='radio' name='colname[]' id='{$_SESSION['col_cage'][$i]}' value='{$_SESSION['col_cage'][$i]}'>";
            echo "<label for='{$_SESSION['col_cage'][$i]}'>{$_SESSION['col_cage'][$i]} (S)</label><br/>";
          }
        }
          
             
        ?>
        </div>
        <div id="num">
        <?php
        if(isset($_POST['cage']))
        {
          $_SESSION['col_num']="";
          $num=array();
          $col_num = $_POST['num'];
          for ($i = 0 ; $i < count($col_num) ; $i++) 
          {
              echo "<input type='radio' name='colname[]' id='{$col_num[$i]}' value='{$col_num[$i]}'>";
              echo "<label for='{$col_num[$i]}'>{$col_num[$i]} (N)</label><br/>";
              array_push($num,$col_num[$i]);
          }    
          $_SESSION['col_num']=$num; 
        }
        else
        {
          for ($i = 0 ; $i < count($_SESSION['col_num']) ; $i++)
          {
            echo "<input type='radio' name='colname[]' id='{$_SESSION['col_num'][$i]}' value='{$_SESSION['col_num'][$i]}'>";
            echo "<label for='{$_SESSION['col_num'][$i]}'>{$_SESSION['col_num'][$i]} (S)</label><br/>";
          }
        }
         
        ?>
        </div>
        <hr>
        <!-- <h4><strong>遺漏機制</strong></h4>       
        <input type="radio" name="mrbook" value="MCAR" id='MCAR' />
        <label for='MCAR'>MCAR</label><br/>
        <input type="radio" name="mrbook" value="MAR" id="MAR" />
        <label for='MAR'>MAR</label><br/>
        <input type="radio" name="mrbook" value="MNAR" id="MNAR" />
        <label for='MNAR'>MNAR</label><br/>
        <hr> -->
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
        <input type="radio" name="method" value="logistic" id="logistic" />
        <label for="logistic" >邏輯迴歸法</label>
        <hr>
        <h4><strong>視覺化圖表</strong></h4>
        <input type="checkbox" name="vp[bar]" class="vp" id="bar" disabled>
        <label  for="bar">長條圖</label>
        <input type="checkbox"  name="vp[box]" class="vp" id="box" disabled>
        <label  for="box">盒狀圖</label>
        <input type="checkbox"  name="vp[join]" class="vp" id="join" disabled>
        <label  for="join">Join</label>
        <select id="select" name='ycol' class="custom-select" multiple></select>
        <hr>
        <button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#Modal" >送出</button>
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
<br/><br/><br/>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script >
      $(document).ready(function() {
      var method = '<?php echo $_SESSION['method']; ?>';
      var col = '<?php echo $_SESSION['col']; ?>';  
      if(method!="")
      {
        $('#'+method).attr("checked",true);
      }
      if(col!="")
      {
        $('#'+col).attr("checked",true);
      }
      $('button[type="submit"]').click(function(){
        var colname=$('input[name="colname[]"]:checked').length;
        var method=$('input[name="method"]:checked').length;
        var vp=$('input[class="vp"]:checked').length;
        if(colname==0)
        {
          alert("請選擇欄位");
          return false;
        }
        else if(method==0)
        {
          alert("請選擇方法");
          return false; 
        }
        else if(vp==0)
        {
          alert("請選擇圖表樣式");
          return false; 
        }
        else
        {
          document.form1.submit();
          
        }
      });
      if ($('#cage input').is(':checked')) {      
          cage();
      }
      if ($('#num input').is(':checked')) {
          num();
      }
      $('#cage input').click(function(){
        cage();
      })
      $('#num input').click(function(){
        num();
      })
      if($('input[name="colname[]"]').prop('checked', true))
      {
        $('#select').hide();
        $("#select option").remove();
        $('#join').prop('checked', false);
        option();
        $('#bar').attr("disabled", false);
        $('#box').attr("disabled", false);
        $('#join').attr("disabled", false);
      }

      $('#select').hide();
    
      $("#join").change(function() {
        if(this.checked) 
        {
          $('#select').show();
              $('#select option').each(function(i) {     
                if($('input:radio:checked[name="colname[]"]').val()==this.value)
                  $(this).attr('disabled','disabled');
                });     
        }     
      });

    });

    var cage=function(){
      $('label[for=mean],input#mean').hide();
      $('label[for=knn],input#knn').hide();
      $('label[for=linear],input#linear').hide();
      $('label[for=mode],input#mode').show();
      $('label[for=logistic],input#logistic').show();
    };
    var num=function(){
      $('label[for=logistic],input#logistic').hide();
        $('label[for=mean],input#mean').show();
        $('label[for=mode],input#mode').show();
        $('label[for=knn],input#knn').show();
        $('label[for=linear],input#linear').show();
    };
    var option=function(){
      var col_num = ["<?php echo join("\", \"", $_SESSION['num']); ?>"];
      $("#select").append($("<option></option>").text("請選擇Y軸").attr('disabled','disabled'));
      for(var i=0;i<col_num.length;i++)
      {          
        $("#select").append($("<option></option>").attr("value", col_num[i]).text(col_num[i]));
      } 
    };
    </script>
  </body>
</html>
         