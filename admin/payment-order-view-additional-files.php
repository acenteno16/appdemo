<? 

include('session-admin.php');

$today = date('Y-m-d');
$totime = date('Y-m-d H:i:s');

$id = $_POST['paymentid'];
$fileUrl = $_POST['fileUrl'];
$fileComments = $_POST['fileComments'];

if($fileUrl == ''){
	exit('<script>alert("No se reconocio una url valida");</script>');
}

if(strlen($fileComments) < 10){
	exit('<script>alert("Los comentarios deben de superar un minimo de 10 caracteres.");</script>');
}

$query = "insert into filesAdditional (payment, today, totime, link, comments, userid) values ('$id', '$today', '$totime', '$fileUrl', '$fileComments', '$_SESSION[userid]')";
$result = mysqli_query($con, $query); 

header('location: payment-order-view.php?id='.$id);

?>