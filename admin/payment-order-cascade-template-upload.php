<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include("session-request.php"); 

$id = $_POST['id'];

$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

//$destino = '/var/www/html/admin/files/folder_'.$_SESSION['userid'];
//$destino = '/var/www/html/paymentstemplates/folder_'.$_SESSION['userid'];
//$destino = '../paymentstemplates/folder_'.$_SESSION['userid'];

$destino = '/home/paymentstemplates/';
if (!file_exists($destino)){
	mkdir('/home/paymentstemplates/');
}


$destino = '/home/paymentstemplates/'.$id;
if (!file_exists($destino)){
	mkdir('/home/paymentstemplates/'.$id);
}

//Aqui vamos a meter el permiso 777
if(!$fileTmpLoc) { // if file not chosen
    echo "ERROR: El archivo no pudo ser cargado. Intente reducir el archivo y volver a subirlo.";
    exit();
}

///////////
$whitelist = array(".xlsx");
foreach ($whitelist as $item) {
    if (preg_match("/$item\$/i", $_FILES['file1']['name'])){ 
		//OKAY
    }else {
		echo "El archivo a subir debe de ser .xlsx"; 
		exit();  
    }
} 

$today = date('Y-m-d');
$now = date('H:i:s'); 
$title = str_replace('-',' ',$_FILES['file1']['name']);
$title = str_replace('_',' ',$title);
$title = str_replace('.xls','',$title);
$title = str_replace('.XLS','',$title);
$title = str_replace('.xlsx','',$title);
$title = str_replace('.XLSX','',$title);

$newname = $id.'.xlsx';
	
$query1 = "INSERT INTO paymentstemplatesfiles (filename, title, user, today, now, fdelete, size, type) VALUES ('$fileName', '$title', '$_SESSION[userid]', '$today', '$now', '1', '$fileSize', '$fileType')";
$result1 = mysqli_query($con, $query1);  
$lastid = mysqli_insert_id($con);
	
//END NEW 
$newdestino = $destino.'/'.$newname;
if(move_uploaded_file($_FILES["file1"]["tmp_name"], $newdestino)){
	$query2 = "update paymentstemplatesfiles set filename='$newname' where id = '$lastid'"; 
	$result2 = mysqli_query($con, $query2);

	echo "$fileName cargado con éxito.";
	
} else {
	$querydelete = "delete from paymentstemplates where id = '$lastid'"; 
	$resultdelete = mysqli_query($con, $querydelete);  
	
	echo "Error al cargar el archivo.";
}

?>