<?php
session_start();
$baseref = "http://localhost/Gola";
	
	$total = count($_FILES['files']['name']);
	$dir = "";
	if(isset($_POST['dir'])){
		$dir = $_POST['dir'];
	}

	$path = "../Data/users/".$_SESSION['uname'].$dir."/";
	if(isset($_POST["html"])){
		$path = "../Data/pdf/";
	}
	//echo $path;
	// Loop through each file
	for( $i=0 ; $i < $total ; $i++ ) {

	  //Get the temp file path
	  $tmpFilePath = $_FILES['files']['tmp_name'][$i];

	  //Make sure we have a file path
	  if ($tmpFilePath != ""){

	    $newFilePath = $path. $_FILES['files']['name'][$i];
	    //echo "<br>".$newFilePath;
	    //Upload the file into the temp dir
	    if(!move_uploaded_file($tmpFilePath, $newFilePath)) {
	      echo "<h2 style='color:red'>Error While Uploading:<h2><br>";
	      die("<a href='../login.php'>Go to Login </a>");
	    }
	  }
	}
	if(isset($_POST["html"])){
		header("location:".$baseref."/pdfadmin.php");
	}
	header("location:../gola.php?dir=".$_POST['dir']);

?>