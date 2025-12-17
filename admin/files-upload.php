<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require("session-files.php"); 

$fileName = $_FILES["file1"]["name"]; // The file name
$fileName = cleanName($fileName); 
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$bd = $_POST['bd'];
$bdstage = $_POST['bdstage'];
$bdid = $_POST['bdid'];
$xlsx = $_POST['xlsx'];

$destino = '/home/files/folder_'.$_SESSION['userid'].'/'; 
if (!file_exists($destino)){
	mkdir($destino);
}



//Aqui vamos a meter el permiso 777
if(!$fileTmpLoc) { // if file not chosen
    echo "ERROR: El archivo no pudo ser cargado. Intente reducir el archivo y volver a subirlo.";
    exit();
}

///////////

#$extensionOkay = 0;
$whitelist = array(".pdf");
if($xlsx == 1){
	$whitelist = array();
	$whitelist[] = '.pdf';
	$whitelist[] = '.xls';
	$whitelist[] = '.xlsx'; 
}

foreach ($whitelist as $item) {
	if (preg_match("/$item\$/i", $_FILES['file1']['name'])){ 
		$extensionOkay = 1;
    }
}

if($extensionOkay == 0){
	$errStr = "El archivo a subir debe de ser PDF"; 
	if($xlsx == 1){
		$errStr = " o EXCEL"; 
	}
	echo $errStr;
	exit();    
}

///////////

//NEW
$today = date('Y-m-d');
$now = date('H:i:s'); 
$title = str_replace('-',' ',$_FILES['file1']['name']);
$title = str_replace('_',' ',$title);
$title = str_replace('.pdf','',$title);
$title = str_replace('.PDF','',$title); 
$title = str_replace('.xls','',$title); 
$title = str_replace('.XLS','',$title); 
$title = str_replace('.xlsx','',$title); 
$title = str_replace('.XLSX','',$title); 
	
$query1 = "INSERT INTO filebox (filename, title, user, today, now, fdelete, size, type, bdid, bdstage) VALUES ('$fileName', '$title', '$_SESSION[userid]', '$today', '$now', '1', '$fileSize', '$fileType', '$bdid', '$bdstage')";
$result1 = mysqli_query($con, $query1); 
$lastid = mysqli_insert_id($con);
$myurl = base64_encode('file='.$lastid.'&userid='.$_SESSION['userid']); 
$newname = $myurl.".pdf";  
	
	
$newdestino = $destino.'/'.$newname; 
if(move_uploaded_file($_FILES["file1"]["tmp_name"], $newdestino)){
    
    $query2 = "update filebox set name='$newname', url='$myurl' where id = '$lastid'"; 
	$result2 = mysqli_query($con, $query2);  

	echo "$fileName cargado con éxito.";
	
	
} 
else {
	$querydelete = "delete from filebox where id = '$lastid'"; 
	$resultdelete = mysqli_query($con, $querydelete);
    
}

function cleanName($name){
    
    $name = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $name
    );

    $name = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $name );

    $name = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $name );

    $name = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $name );

    $name = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $name );

    $name = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $name
    );
    
    $name = strtolower($name);
    $name = preg_replace('/\s+/', ' ', $name);
    $name = trim($name);
    $name = str_replace(' ','-',$name);
    $name = str_replace('&','',$name);
    $name = str_replace('/','-',$name);
	$name = str_replace("'",'',$name);
    $name = str_replace('---','-',$name);
    $name = str_replace('--','-',$name); 
    $name = htmlentities($name);
    
    return $name; 
}

?>