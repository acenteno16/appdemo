<?php 

exit();
/*
include("session-review.php");

$id = $_POST['id'];
$payment = $_POST['payment'];

//$commentscc = $_POST['commentscc'];
//$queryccc = "update payments set commentscc='$commentscc' where id = '$payment'";
//$resultccc = mysqli_query($con, $queryccc); 

$reason = $_POST['reason'];
$reason2 = $_POST['reason2'];


if($id != ""){
    for($c = 0; $c < sizeof($id); $c++){ 
	 $query1 = "update files set status = '4' where id = '$id[$c]'";
	 $result1 = mysqli_query($con, $query1);
	 
   }
}

//Esta sentencia me marca los archivos no encontrados basandose en marcar como no encontrados los archivos
//que no están marcados como encontrados.
$query2 = "update files set status = '3' where payment = '$payment' and status != '4'";
$result2 = mysqli_query($con, $query2);

$query3 = "select * from files where payment = '$payment' and status = '3'";
$result3 = mysqli_query($con, $query3);
$num3 = mysqli_num_rows($result3);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
		
if($num3>0){
	//Aqui definimos al paquete como incompleto
	$query4 = mysqli_query($con, "update payments set sent = '3' where id = '$payment'");
	//Creamos los datos para la consulta time
	$gcomments = "El paquete ha sido revisado y encontrado como incompleto ya que no fueron encontrado uno o mas archivos ";
	//insertamos la consulta time para paquetes incompletos
	$querytime = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$payment', '$today', '$now', '$now2', '$_SESSION[userid]', '3', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime);  
		
	//Recordarorio: No hay sent = '4' ya que este es cuando se aprueba un pago incompleto
	//y esto lo hacemos en otra página
	
}else{
	//Aqui definimos el paquete como completo
	$query4 = "update payments set sent = '5' where id = '$payment'";
	$result4 = mysqli_query($con, $query4);
	//Creamos los datos para la consulta time para paquetes completos
	$gcomments = "Enhorabuena, el paquete fue revisado y encontrado completo.";
	//insertamos la consulta time
	$querytime = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$payment', '$today', '$now', '$now2', '$_SESSION[userid]', '5', '$gcomments')"; 
		$resulttime = mysqli_query($con, $querytime);  
		
}


//Si el pago es reprobado

echo $approve = $_POST['approve'];

if($approve == 2){
	
	$reason = $_POST['reason'];
	$reason2 = $_POST['reason2'];
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s'); 
	$now2 = date('H:i:s');

	$query100 = "update payments set status = '7.07', reason='$reason2', approved='$approve' where id = '$payment'";
    $result100 = mysqli_query($con, $query100);
		
	$comments = "Rechazado en control de calidad";	 
	
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$payment', '$today', '$now', '$now2', '$_SESSION[userid]', '7.07, '$comments', '$reason')"; 
	$resulttime = mysqli_query($con, $querytime); 
	
}


header('location: file-review-detail.php');

*/

?>