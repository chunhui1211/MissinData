<?php
    if($_FILES["file"]["name"]==null)
    {
        echo "<script>alert('請選取檔案進行上傳'); location.href = 'http://localhost/Missingdata/index.php';</script>";
        exit();
    }
    else
    {
        $name=$_FILES["file"]["name"];
        $type=$_FILES['file']['type'];
        $size=$_FILES['file']['size'];   
        $tmp_name=$_FILES['file']['tmp_name'];
        $sizemb=round($size/10240000,2);
        $file=explode(".",$name);
        date_default_timezone_set("Asia/Taipei");
        $new_name=$file[0]."-".date("ymdhis").".".$file[1];

        if($type=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ||$type=="application/vnd.ms-excel")
        {
            
            $baseUrl='http://localhost/Missingdata/data.php?';
            $queries=array(
                'name'=>$name,
                'new_name'=>$new_name,
                'type'=>$type,
                'size'=>$size                
            );
            $url=http_build_query($queries);

            move_uploaded_file($tmp_name,"upload/".$new_name);  
            $params = $new_name; //傳遞給python指令碼的入口引數  
            $pathdata="python missingfile.py "; //需要注意的是：末尾要加一個空格
            $pathphoto="python beforemissingno.py ";
            passthru($pathdata.$params);//等同於命令python python.py，並接收列印出來的資訊 
            passthru($pathphoto.$params);
            header("Location: http://localhost/Missingdata/data.php?$url");
            exit;            
                   
        }
        else
        {
            echo "<script>alert('檔案格式錯誤，上傳失敗'); location.href = 'http://localhost/Missingdata/index.php';</script>";
            exit();
        }     

    }
    
?> 