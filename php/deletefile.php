<?php
session_start();
$baseref = "http://gola.unaux.com";
	if(!empty($_GET['file']))
	{
		$filepath = '../Data/users/' .$_SESSION['uname'].$_GET['file'];
		// PHP program to delete a file named gfg.txt
		// using unlike() function

		// Use unlink() function to delete a file
		if (!unlink($filepath)) {
			//echo ("$filepath cannot be deleted due to an error");
		}
		$t = explode("/",$_GET['file']);
		array_pop($t);
		$temp = implode("/", $t);
		$str = $baseref."/gola.php?dir=".$temp;
		//echo $str;
		header("location:".$str);

	}
?>