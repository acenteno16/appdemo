<?php   

include("sessions.php"); 

$id = $_POST['id'];

$query = "select * from workers where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 

$code = $row['code'];

$destino = 'profiles/'.$code; 

if ($_FILES['myfile']['name'] != ""){

$whitelist = array(".jpg");

foreach ($whitelist as $item) {

    if (preg_match("/$item\$/i", $_FILES['myfile']['name'])) {

    }
    else {
		echo "<script>alert('Solo se permiten archivos jpg.')</script>"; 
    }
}

//end whitelist

if (!file_exists($destino)){
	mkdir('profiles/'.$code); 
}

$filename = $_FILES['myfile']['name'];
$newname = $code.".jpg";  

move_uploaded_file ( $_FILES [ 'myfile' ][ 'tmp_name' ], $destino . '/' . $newname); 
header("location: ".$_SERVER['HTTP_REFERER']); 

}else{
	

	?>
    <script>
	alert('El formulario no contenia archivo.'); 
	history.go(-1);
	</script>
	<?php } 


?>