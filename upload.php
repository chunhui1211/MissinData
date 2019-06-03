<?php
    if($_FILES["file"]["name"]==null)
    {
        echo "<script>alert('請選取檔案進行上傳'); location.href = 'http://localhost/Missingdata/index.php';</script>";
        exit;
    }
    else
    {      
        session_start(); 
        session_destroy();
        $name=$_FILES["file"]["name"];
        $type=$_FILES['file']['type'];
        $size=$_FILES['file']['size'];   
        $tmp_name=$_FILES['file']['tmp_name'];
        $sizemb=round($size/10240000,2);
        $file=explode(".",$name);
        date_default_timezone_set("Asia/Taipei");
        $new_name=$file[0]."-".date("ymdhis").".".$file[1];
        
        if($type=="application/vnd.ms-excel" ||$type=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
        {
            move_uploaded_file($tmp_name,"upload/".$new_name);       
            session_start();       
            $_SESSION['name']=$name;
            $_SESSION['type']=$type;
            $_SESSION['size']= $size;   
            $_SESSION['new_name']=$new_name; 
            // $new_name=substr($new_name,0,-4);
            $new=explode(".",$new_name);
            mkdir("./imputation_photo/".$new[0]);
            mkdir("./missinginfo/".$new[0]);
            header("Location: http://localhost/Missingdata/data.php");
            exit;            
                  
        }
        else
        {
            echo "<script>alert('檔案格式錯誤，上傳失敗'); location.href = 'http://localhost/Missingdata/index.php';</script>";
            exit;
        }     

    }
    
?> 
