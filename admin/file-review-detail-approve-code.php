<?php include("session-review.php");

$id = $_POST['id'];
$payment = $_POST['payment'];

 if($id != ""){
    for($c = 0; $c < sizeof($id); $c++){ 
	 $query1 = "update files set status = '5' where id = '$id[$c]'";
	 $result1 = mysqli_query($con, $query1); 
	 
   }
}
$query4 = mysqli_query($con, "update payments set sent = '4' where id = '$payment'");

//Creamos los datos para la consulta time para paquetes completos
	
$gcomments = "Enhorabuena, el paquete fue revisado y encontrado completo.";
		
//insertamos la consulta time
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 
	
$querytime = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$payment', '$today', '$now', '$now2', '$_SESSION[userid]', '4', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);   
		

header('location: file-review-detail.php');


?>