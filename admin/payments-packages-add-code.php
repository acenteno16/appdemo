<?php 

include("session-remission.php");

$id = $_POST['pid'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$id_size = sizeof($id);

if($id_size > 30){
	echo "<script>alert('Se permiten hasta 30 solicitudes por remision.'); history.go(-1);</script>";
	exit();
}

if($id != ""){
	
$reqToken = $_POST['req_token']; 
		
if ($reqToken === '') {
   exit("<script>alert('No se encontro el token de verificacion.'); history.go(-1);</script>");
}
	
$queryCheck = "select id from packages where req_token='$reqToken'";
$resultCheck = mysqli_query($con, $queryCheck);	
$numCheck = mysqli_num_rows($resultCheck);
	
if ($numCheck > 0) {
   exit("<script>alert('Token duplicado detectado. Intar de nuevo.'); window.location = 'payments-packages-add.php';</script>"); 
}	
	
//Creamo la remisión	
$query = "insert into packages (today, now, userid, req_token) values ('$today','$now','$_SESSION[userid]','$reqToken')";
$result = mysqli_query($con, $query);
//Obtenemos el ID de la remision
$packageid = mysqli_insert_id($con);

	//Cramos el comentario de remision
	$gcomments = "Enhorabuena, la remision ha sido generada.";
	
	//Creamos el registro de que la remision fue creada
	$querytime = "insert into packagestimes (package, today, now, now2, userid, stage, comment) values ('$packageid', '$today', '$now', '$now2', '$_SESSION[userid]', '1', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime); 

    //Bucle para ingresar las solicitudes de pago a la remision
	for($c=0;$c<sizeof($id);$c++){
     
	 $queryPackage = "insert into packagescontent (package, payment) values ('$packageid', '$id[$c]')";
	 $resultPackage = mysqli_query($con, $queryPackage);
	 
	 //Ponemos el estado de archivos de solicitud remisionado.
	 $queryPaymentUpdate = "update payments set sent = '2' where id = '$id[$c]'";
	 $resultPaymentUpdate = mysqli_query($con, $queryPaymentUpdate); 
	 
	 $gcomments2 = "Enhorabuena, el paquete ha sido remisionado.";
	 //insertamos la consulta time
	 $querySentTime = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$id[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments2')";
	 $resultSentTime = mysqli_query($con, $querySentTime);  
		

		 $queryThisPaymentChild = "select id from payments where child = '$id[$c]'";
	 	 $resultThisPaymentChild = mysqli_query($con, $queryThisPaymentChild);
	 	 while($rowThisPaymentChild = mysqli_fetch_array($resultThisPaymentChild)){
		 
			//Ponemos el estado de archivos de solicitud remisionado.
	 	 	$queryPaymentUpdateChild = "update payments set sent = '2' where id = '$rowThisPaymentChild[id]'";
	 	 	$resultPaymentUpdateChild = mysqli_query($con, $queryPaymentUpdateChild); 
			
		 	$querySentTimeChild = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$rowThisPaymentChild[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments2')";
	 	 	$resultSentTimeChild = mysqli_query($con, $querySentTimeChild);
			 
		 }
	
   }
	
   header('location: payments-packages-view.php?id='.$packageid);

}else{ ?>
<script>
	alert('Debe de seleccionar al menos 1 pago.');
	history.go(-1);
</script>
<?php } ?>