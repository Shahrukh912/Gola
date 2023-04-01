<?php
session_start();
	if(!empty($_GET['file']))
	{
        $extension = end(explode(".",$_GET['file']));
		$filename = end(explode("/",$_GET['file']));
		$filepath = 'Data/users/' .$_SESSION['uname'].$_GET['file'];
		
		if(!empty($filename) && file_exists($filepath)){

	//Define Headers
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Transfer-Encoding: binary");
          
            if($extension=="jpg" || $extension=="png" || $extension=="jpeg" || $extension=="gif" || $extension=="bmp" || $extension=="apng" || $extension=="jfif" || $extension=="webp"){
            	header("Content-Type: image/".$extension);
            	header("Expires: 0");
				header("Pragma: no-cache");
            }
            else{
				header("Content-Type: application/".$extension);
            }
          header("Content-Disposition: attachment; filename=$filename");

            flush(); 
			readfile($filepath);
			//exit;

		}
		else{
			echo "This File Does not exist.";
		}
	}
?>