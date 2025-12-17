<?php

include("sessions.php");

extract($_POST);


ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_execution_time', 300);


$tipo = $_FILES['myfile']['type'];
if($tipo != "application/pdf"){
	echo "<script>alert('El archivo no es PDF.'); history.go(-1);</script>";
	exit();
}
$destino = 'files/folder_'.$_SESSION['userid']; 
if (!file_exists($destino)){
	mkdir('files/folder_'.$_SESSION['userid']);
}

$today = date('Y-m-d');
$now = date('H:i:s'); 
$title = str_replace('-',' ',$_FILES['myfile']['name']);
$title = str_replace('_',' ',$_FILES['myfile']['name']);
$title = str_replace('.pdf','',$title);

$query1 = "INSERT INTO filebox (filename, title, user, today, now) VALUES ('$filename', '$title', '$_SESSION[userid]', '$today', '$now')";
$result1 = mysqli_query($con, $query1); 
$lastid = mysqli_insert_id($con);	


$myurl = base64_encode('file='.$lastid.'&userid='.$_SESSION['userid']); 
$newname = $myurl.".pdf"; 
move_uploaded_file ( $_FILES [ 'myfile' ][ 'tmp_name' ], $destino . '/' . $newname); 

if(file_exists($destino.'/'.$newname)){
			
			$query2 = "update filebox set name='$newname', url='$myurl' where id = '$lastid'"; 
			$result2 = mysqli_query($con, $query2); 
			$destino2 = 'files/folder_'.$_SESSION['userid'].'/index.php';  
			
			if (!file_exists($destino2)){
			$fcontents = join('', file ('files/index.html'));
			$fpl=fopen('files/folder_'.$_SESSION['userid'].'/index.php',"a"); 
			fwrite($fpl,$fcontents); fclose($fpl);
			}
			echo "<script>alert('Archivo cargado con exito.'); window.location = 'files.php';</script>";
			
}else{
	echo "<script>alert('Error al subir el archivo.'); history.go(-1);</script>";
}

?>