<?php
if(!empty($_GET['file'])){
    $fileName = basename($_GET['file']);
    $filePath = 'upload/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");       
        // Read the file
        readfile($filePath);
        exit;
    }else{
        echo "<script>alert('The file does not exist.'); 
        location.href = 'http://localhost/Missingdata/mechanisms.php';</script>";
    }
}

?>