<?php
if(isset($_POST['submit'])){
	$filename = $_POST['filename'];
	$myfile = fopen("files/$filename", "w") or die("Unable to open file!");
	$txt = $_POST['text'];
	fwrite($myfile, $txt);
	fclose($myfile);
	$filenameintext = $filename;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>File Storage</title>
	<link rel="stylesheet" type="text/css" href="layout.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script type="text/javascript">
		function reset() {
			document.getElementById("text").value="";
			document.getElementById("textbox").value="";
		}
		window.onload=function(){
		    document.getElementById('textbox').addEventListener('keydown', function(e) {
			  	if (e.key == 'Tab') {
			    e.preventDefault();
			    var start = this.selectionStart;
			    var end = this.selectionEnd;

			    // set textarea value to: text before caret + tab + text after caret
			    this.value = this.value.substring(0, start) +
			      "\t" + this.value.substring(end);

			    // put caret at right position again
			    this.selectionStart =
			      this.selectionEnd = start + 1;
			  }
			});
		}
		function showAside() {
			const a = document.getElementById("sideNav").style.display;
			if(a.localeCompare("block") == 0){
				document.getElementById("sideNav").style.display="none";
			}
			else{
				document.getElementById("sideNav").style.display="block";
			}
		}	
	</script>
</head>

<body class="gridlayout">

<header class="Header">
	<div class="HeaderLeft">
    	<h2>Gola</h2>
	</div>
	<div class="Headerright">
		<a href="">Admin</a>
		<button id="showBut" onclick="showAside()">All Files</button>
	</div>
</header>

<div class="Main">
    <aside id="sideNav" class="side-navigation" id="side-navigation">
    	<?php 
    		function dirToArray($dir) {
			   $result = array();
			   $cdir = scandir($dir);
			   foreach ($cdir as $key => $value)
			   {
			      if (!in_array($value,array(".","..")))
			      {
			         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
			         {
			            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
			         }
			         else
			         {
			            $result[] = $value;
			         }
			      }
			   }
			  
			   return $result;
		}
		$arr = dirToArray("files");

		foreach ($arr as $a) {
			echo "<a href='?files=" .$a. "'>" .$a. "</a><br>";
		}
    	?>
        
    </aside>
	<main>  
		<form action="index.php" method="POST">
			<?php if(isset($_GET['files'])){ $filenameintext =$_GET['files']; } ?>
			<input type="text" id="text" name="filename" placeholder="Enter filename" required="required" 
			value=<?php if(isset($filenameintext)){ echo "\"$filenameintext\"";} ?>>
			<input type="submit" name="submit" value="Save">
			<button onclick="reset()">New</button>
			<?php
				if(isset($filenameintext)){
					$myfile = fopen("files/$filenameintext", "r"); 
					if($myfile == false){
						echo ("<br><h1 style='color:red'>Unable to open file!</h1>");
					}
					else{
						$txt = fread($myfile, filesize("files/$filenameintext"));
					}
				}
			?>
			<textarea id="textbox" name="text" placeholder="Type your text here" ><?php if(isset($txt)){ echo $txt;} ?></textarea>
		</form>
	</main>
</div>

<footer class="footer">
    <p>Developed by -- Shahrukh</p>
</footer>

</body>
</html>