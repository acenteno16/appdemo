<?php
/*
include("sessions.php"); 

$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

$destino = '/var/www/html/admin/files/folder_'.$_SESSION['userid']; 
if (!file_exists($destino)){
	mkdir('/var/www/html/admin/files/folder_'.$_SESSION['userid']);
}

//Aqui vamos a meter el permiso 777

if(!$fileTmpLoc) { // if file not chosen
    echo "ERROR: El archivo no pudo ser cargado. Intente reducir el archivo y volver a subirlo.";
    exit();
}

///////////

$whitelist = array(".pdf");

foreach ($whitelist as $item) {

    if (preg_match("/$item\$/i", $_FILES['file1']['name'])){ 
		//OKAY
    }else {
		echo "El archivo a subir debe de ser .PDF"; 
		exit();  
    }
}


///////////


	//NEW
	
	$today = date('Y-m-d');
	$now = date('H:i:s'); 
	$title = str_replace('-',' ',$_FILES['file1']['name']);
	$title = str_replace('_',' ',$title);
	$title = str_replace('.pdf','',$title);
	$title = str_replace('.PDF','',$title); 
	
	$query1 = "INSERT INTO filebox (filename, title, user, today, now, fdelete, size, type) VALUES ('$fileName', '$title', '$_SESSION[userid]', '$today', '$now', '1', '$fileSize', '$fileType')";
	$result1 = mysqli_query($con, $query1);  
	$lastid = mysqli_insert_id($con);
	$myurl = base64_encode('file='.$lastid.'&userid='.$_SESSION['userid']); 
	$newname = $myurl.".pdf";   
	
	//END NEW 
$newdestino = $destino.'/'.$newname;
if(move_uploaded_file($_FILES["file1"]["tmp_name"], $newdestino)){
    $query2 = "update filebox set name='$newname', url='$myurl' where id = '$lastid'"; 
	$result2 = mysqli_query($con, $query2);  

	$destino2 = 'files/folder_'.$_SESSION['userid'].'/index.php'; 
	if (!file_exists($destino2)){
		$fcontents = join('', file ('files/index.html'));
		$fpl=fopen('files/folder_'.$_SESSION['userid'].'/index.php',"a"); 
		fwrite($fpl,$fcontents); fclose($fpl);
	}

	echo "$fileName cargado con éxito.";
	
	
} else {
	$querydelete = "delete from filebox where id = '$lastid'";
	$resultdelete = mysqli_query($con, $querydelete);
    
}
*/
?>