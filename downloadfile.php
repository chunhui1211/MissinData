<?php
require_once 'C:/xampp/htdocs/Missingdata/PHPExcel/Classes/PHPExcel.php';
require_once 'C:/xampp/htdocs/Missingdata/PHPExcel/Classes/PHPExcel/IOFactory.php';
session_start();
$name = explode('.', $_SESSION['new_name']);

$file = 'upload/'.$_SESSION['new_name'];
$objPHPExcel = new PHPExcel();
$inputFileType = PHPExcel_IOFactory::identify($file);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($file);

$type=$_POST['type'];
if ($type == 'csv') {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    $objWriter->save($name[0].'.csv');
} else if ($type == 'xls') {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($name[0].'.xls');
} else if ($type == 'xlsx') {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($name[0].'.xlsx');
}

$filePath = $name[0].'.'.$type;
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filePath");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");
readfile($filePath);



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