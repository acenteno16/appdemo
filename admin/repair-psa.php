<? 

/*
include('sessions.php'); 

$queryschedule = "select * from scheduletimes where stage = '3' and today >= '2017-09-28' group by schedule";
$resultschedule = mysqli_query($con, $queryschedule);
while($rowschedule=mysqli_fetch_array($resultschedule)){ 
//for($i=0;$i<sizeof($ids);$i++){
	
	$today = $rowschedule['today'];
	$now = $rowschedule['now'];
	$now2 = $rowschedule['now2'];
	$userid = $rowschedule['userid'];
	
	$querysta = "select * from schedule where id = '$rowschedule[schedule]'";
	$resultsta = mysqli_query($con, $querysta);
	$rowsta = mysqli_fetch_array($resultsta);
	
	if($rowsta['status'] == 3){
	
	$querystatus = "select * from schedulestages where id = '$rowsta[status]'";
	$resultstatus = mysqli_query($con, $querystatus);
	$rowstatus = mysqli_fetch_array($resultstatus);
	
	$query = "select * from schedulecontent where schedule = '$rowschedule[schedule]'";
	$result = mysqli_query($con, $query);
	echo '<strong>Grupo de pago:</strong> '.$rowschedule[schedule]." (".$rowstatus['name'].") <br>";
	while($row=mysqli_fetch_array($result)){
		
		$querypayment = "select * from payments where id = '$row[payment]'";
		$resultpayment = mysqli_query($con, $querypayment);
		$rowpayment = mysqli_fetch_array($resultpayment);
		
		
		$querystage = "select * from stages where id = '$rowpayment[status]'"; 
		$resultstage = mysqli_query($con, $querystage);
		$rowstage = mysqli_fetch_array($resultstage);
		$status = $rowstage['name'];
		
		if($rowstage['id'] == '12.00'){   
			echo '<br>-Solicitud ID #'.$row['payment'].': | Estado: '.$status.' | Fecha y Hora:'.$today.' @'.$now2."<br>"; 
		
		//Update del pago
		
		//echo '<br>'.$query1 = "update payments set status = '13' where id = '$row[payment]'";
		//$result1 = mysqli_query($con, $query1);
	
		//Insertamos el registro de la programacion aprobada (Registro del pago)
		//echo '<br>'.$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$row[payment]', '$today', '$now', '$now2', '$userid', '13', 'Enhorabuena, la programación del pago ha sido aprobada.')"; 
		//$result2 = mysqli_query($con, $query2);
		
		//Fin del Update del pago
		}
		
	}
	echo "<br><br><br>";
}

}






/*include('sessions.php');

$queryschedule = "select * from scheduletimes where stage = '3' and today > '2017-09-28' group by schedule";
$resultschedule = mysqli_query($con, $queryschedule);
while($rowschedule=mysqli_fetch_array($resultschedule)){
//for($i=0;$i<sizeof($ids);$i++){
	
	$today = $rowschedule['today'];
	$now = $rowschedule['now'];
	$now2 = $rowschedule['now2'];
	$userid = $rowschedule['userid'];
	
	$querysta = "select * from schedule where id = '$rowschedule[schedule]'";
	$resultsta = mysqli_query($con, $querysta);
	$rowsta = mysqli_fetch_array($resultsta);
	
	if($rowsta['status'] == 3){
	
	$querystatus = "select * from schedulestages where id = '$rowsta[status]'";
	$resultstatus = mysqli_query($con, $querystatus);
	$rowstatus = mysqli_fetch_array($resultstatus);
	
	$query = "select * from schedulecontent where schedule = '$rowschedule[schedule]'";
	$result = mysqli_query($con, $query);
	echo '<strong>Grupo de pago:</strong> '.$rowschedule[schedule]." (".$rowstatus['name']." ".$rowsta[status].")<br>";
	while($row=mysqli_fetch_array($result)){
		
		$querypayment = "select * from payments where id = '$row[payment]'";
		$resultpayment = mysqli_query($con, $querypayment);
		$rowpayment = mysqli_fetch_array($resultpayment);
		
		
		$querystage = "select * from stages where id = '$rowpayment[status]'";
		$resultstage = mysqli_query($con, $querystage);
		$rowstage = mysqli_fetch_array($resultstage);
		$status = $rowstage['name'];
		echo '<br>-Solicitud ID #'.$row['payment'].': ('.$status.')';
		
		//Update del pago
		
		echo '<br>'.$query1 = "update payments set status = '13' where id = '$row[payment]'";
		//$result1 = mysqli_query($con, $query1);
	
		//Insertamos el registro de la programacion aprobada (Registro del pago)
		echo '<br>'.$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$row[payment]', '$today', '$now', '$now2', '$userid', '13', 'Enhorabuena, la programación del pago ha sido aprobada.')"; 
		//$result2 = mysqli_query($con, $query2);
		
		//Fin del Update del pago
		
	}
	echo "<br><br><br><br>";
}

}*/

?>