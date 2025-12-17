<? 

session_start();

if(!$_SESSION["admin"] == "active"){
	session_destroy();
	header("location: ../?err=noAdmin");	 
}	

#include('online.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$address = "/home/retentions/$id/$id.jpg"; 


if (file_exists($address)) {
    header('Content-type: image/jpeg');
	readfile($address);
} else {
    echo "El archivo no existe.";
    exit;
}

?>