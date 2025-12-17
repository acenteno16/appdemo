<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include("session-request.php"); 
require 'functions.php';

$id = isset($_POST['id']) ? sanitizeInput(intval($_POST['id']), $con) : 0;
$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

$destino = '/home/paymentstemplates/'.$id.'/';
if(!file_exists($destino)){
	if (!mkdir($destino, 0755, true)) {
    	#print_r(error_get_last()); 
		echo "Error al crear la carpeta. <br>";
	} 
}

if(!$fileTmpLoc){ 
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

///////////
//NEW
	
$today = date('Y-m-d');
$now = date('H:i:s'); 
$title = str_replace('-',' ',$_FILES['file1']['name']);
$title = str_replace('_',' ',$title);
$title = str_replace('.xls','',$title);
$title = str_replace('.XLS','',$title);
$title = str_replace('.xlsx','',$title);
$title = str_replace('.XLSX','',$title);
	
$newname = $id.'.xlsx';

$query1 = "INSERT INTO paymentstemplatesfiles (filename, title, user, today, now, fdelete, size, type, payment) VALUES ('$newname', '$title', '$_SESSION[userid]', '$today', '$now', '1', '$fileSize', '$fileType', '$id')";
$result1 = mysqli_query($con, $query1);  
$lastid = mysqli_insert_id($con);
	
//END NEW 

$newdestino = $destino.'/'.$newname; 
if(move_uploaded_file($_FILES["file1"]["tmp_name"], $newdestino)){

	echo "$fileName cargado con éxito."; 
	
} else {
	$querydelete = "delete from paymentstemplates where id = '$lastid'"; 
	$resultdelete = mysqli_query($con, $querydelete);
	
	echo "Error al cargar el archivo.". $_FILES["file1"]["error"];;
}

?>