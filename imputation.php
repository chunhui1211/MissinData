<?php
    $new_name=$_POST["new_name"];
    echo $new_name;
    $params = $new_name; //傳遞給python指令碼的入口引數
    $pathimputation="python imputation.py ";
    passthru($pathimputation.$params);
    header("Location: http://localhost/Missingdata/afterload.php?new_name=$new_name");
    exit;
?>