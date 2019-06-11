<?php
session_start();
$name = explode('.', $_SESSION['new_name']);
$fileName=$name[0];
$fileType=$_POST['type'];
$filePath = 'upload/'.$fileName.".".$fileType;
if(!empty($fileName)){
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filePath");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");       
    readfile($filePath);
    exit;
}else{
    echo "<script>alert('The file does not exist.'); 
    location.href = 'http://localhost/Missingdata/mechanisms.php';</script>";
}


// if(!empty($_GET['file'])){
//     $fileName = basename($_GET['file']);
//     $fileType = basename($_GET['type']);
//     $filePath = 'upload/'.$fileName.".".$fileType;

//     if(!empty($fileName) && file_exists($filePath)){
//         // Define headers
//         header("Cache-Control: public");
//         header("Content-Description: File Transfer");
//         header("Content-Disposition: attachment; filename=$filePath");
//         header("Content-Type: application/zip");
//         header("Content-Transfer-Encoding: binary");       
//         // Read the file
//         readfile($filePath);
//         exit;
//     }else{
//         echo "<script>alert('The file does not exist.'); 
//         location.href = 'http://localhost/Missingdata/mechanisms.php';</script>";
//     }
// }

?>