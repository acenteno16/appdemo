<?php include("sessions.php");  

$destino = 'files/folder_'.$_SESSION['userid']; 

if ($_FILES['myfile']['name'] != ""){

$whitelist = array(".pdf");

foreach ($whitelist as $item) {

    if (preg_match("/$item\$/i", $_FILES['myfile']['name'])) {

    }
    else {
		echo "<script>alert('Solo se permiten archivos PDF.')</script>"; 
    }
}

//end whitelist

if (!file_exists($destino)){
	mkdir('files/folder_'.$_SESSION['userid']);
}

$filename = $_FILES['myfile']['name'];
$title = $_POST['title'];

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

//move_uploaded_file ( $_FILES [ 'myfile' ][ 'tmp_name' ], $fdestino . '/' . $_FILES [ 'myfile' ][ 'name' ]); 
//move_uploaded_file ( $_FILES [ 'myfile' ][ 'tmp_name' ], $destino . '/' . $newname);

$query2 = "update filebox set name='$newname', url='$myurl' where id = '$lastid'"; 
$result2 = mysqli_query($con, $query2); 

$destino2 = 'files/folder_'.$_SESSION['userid'].'/index.php'; 
if (!file_exists($destino2)){
	$fcontents = join('', file ('files/index.html'));
$fpl=fopen('files/folder_'.$_SESSION['userid'].'/index.php',"a"); 
fwrite($fpl,$fcontents); fclose($fpl);


}

header("location: ".$_SERVER['HTTP_REFERER']); 

}else{
	
	echo '<script>alert(El formulario no contenia archivo.);</script>';
	
}


?>