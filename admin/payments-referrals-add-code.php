<?php include("session-provision.php");

$id = $_POST['pid'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id_size = sizeof($id);

if($id_size > 30){
	echo "<script>alert('Se permiten hasta 30 solicitudes por remision.'); history.go(-1); </script>";
	exit();
}

if($id != ""){
//Creamo la remisión	
$query = "insert into packages (today, now, userid) values ('$today','$now','$_SESSION[userid]')";
$result = mysqli_query($con, $query);
//Obtenemos el ID de la remision
$packageid = mysqli_insert_id($con);

	//Cramos el comentario de remision
	$gcomments = "Enhorabuena, la remision ha sido generada.";
	
	//Creamos el registro de que la remision fue creada
	$querytime = "insert into packagestimes (package, today, now, now2, userid, stage, comment) values ('$packageid', '$today', '$now', '$now2', '$_SESSION[userid]', '1', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime); 

    //Bucle para ingresar las solicitudes de pago a la remision
	for($c = 0; $c < sizeof($id); $c++) {
     
	 $query1 = "insert into packagescontent (package, payment) values ('$packageid', '$id[$c]')";
	 $result1 = mysqli_query($con, $query1);
	 
	 //Ponemos el estado de archivos de solicitud remisionado.
	 $query2 = "update payments set sent = '2' where id = '$id[$c]'";
	 $result2 = mysqli_query($con, $query2); 
	 
	 $gcomments2 = "Enhorabuena, el paquete ha sido remisionado.";
	//insertamos la consulta time
	$querytime2 = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$id[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments2')";
	$resulttime2 = mysqli_query($con, $querytime2);  
	 
   }
   header('location: payments-packages-view.php?id='.$packageid);

}else{
	?>
    <script>
	alert('Debe de seleccionar al menos 1 pago.');
	history.go(-1);
	</script>
	<?php }


?>