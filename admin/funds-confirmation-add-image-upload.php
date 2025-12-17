<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
 
include("sessions.php");

$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$fileid = $_POST['fileid'];

$destino = '../funds';

if (!file_exists($destino)){
    mkdir($destino);
}

if(!$fileTmpLoc) { // if file not chosen
    echo "ERROR: El archivo no pudo ser cargado. Intente reducir el archivo y volver a subirlo.";
    exit();
}


if(($_FILES['file1']['type'] == "image/jpg") or ($_FILES['file1']['type'] == 'image/jpeg')){
	
	$newdestino = $destino.'/'.$fileid.'.jpg';	
	
	if(move_uploaded_file($_FILES["file1"]["tmp_name"], $newdestino)){
			echo "$fileName cargado con éxito.<br>"; 
	
	}
	
}elseif($_FILES['file1']['type'] == "image/png"){
	$newdestino = $destino.'/'.$fileid.'.png';
	$newdestino2 = $destino.'/'.$fileid.'.jpg';
	if(move_uploaded_file($_FILES["file1"]["tmp_name"], $newdestino)){
		
		$image = imagecreatefrompng($newdestino);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		$quality = 100; // 0 = worst / smaller file, 100 = better / bigger file 
		imagejpeg($bg, $newdestino2, $quality);	
		imagedestroy($bg);
		
		echo "$fileName cargado con éxito.<br>"; 
	
	}
}else{
	echo "Error con ".$_FILES['file1']['type'].". El archivo debe de ser JPG o PNG.<br>";
}

$today = date('Y-m-d');
$now = date('H:i:s'); 


	
	//Resize the image 
	/*
	$image_location = $newdestino;
	$image_size = getimagesize($image_location);
	$image_width = $image_size[0];
	$image_height = $image_size[1];

	if($image_width > $image_height){
		$image_type = "landscape";
		$new_w = 1024;  
		$new_h = ($image_height*$new_w)/$image_width; 	
	}else{
		$image_type = "portrait";
		$new_w = 768;
		//despejar
		$new_h = ($image_height*$new_w)/$image_width;
	}
 
	$src_img = imagecreatefromjpeg($image_location);
	$dst_img = imagecreatetruecolor($new_w,$new_h); 
	imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
	imagejpeg($dst_img, $image_location);*/
	
	//End resize




?>