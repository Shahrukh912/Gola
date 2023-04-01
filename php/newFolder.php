<?php
session_start();
$baseref = "http://gola.unaux.com";
	if(isset($_GET['folderName']))
	{
		$path = '../Data/users/' .$_SESSION['uname'].$_GET['dir']."/".$_GET['folderName'];
		

		echo $path;
		if (!file_exists($path)) {
    		mkdir($path);
		}

		
		header("location:".$baseref."/gola.php?dir=".$_GET['dir']);

	}
?>