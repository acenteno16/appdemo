<? 

include('sessions.php');
#repair-schedulecontenttimes.php

$query = "select id, status from schedule where status = '6'and repaired = '0' order by id desc limit 100";
$result = mysqli_query($con, $query); 
echo 'Procesados: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$queryTimesMain = "select id from scheduletimes where schedule = '$row[id]' and stage = '6'";
	$resultTimes = mysqli_query($con, $queryTimesMain);
	$numTimesMain = mysqli_num_rows($resultTimesMain);
	
	if($numTimesMain == 0){
		echo '<br><br>'.$queryContent = "select payment from schedulecontent where schedule = '$row[id]'";
		$resultContent = mysqli_query($con, $queryContent);
		$rowContent = mysqli_fetch_array($resultContent);
		
		echo '<br>'.$queryTimes = "select * from times where payment = '$rowContent[payment]' and stage = '14' order by id desc limit 1";
		$resultTimes = mysqli_query($con, $queryTimes);
		$rowTimes = mysqli_fetch_array($resultTimes);
		
		echo '<br>'.$queryInsert = "insert into scheduletimes (schedule, comment, today, now, now2, stage, userid, reason) values ('$row[id]', 'Enhorabuena, el grupo de pagos ha sido cancelado.', '$rowTimes[today]', '$rowTimes[now]', '$rowTimes[now2]', '6', '$rowTimes[userid]', 'getPayRepairRobot')"; 
		$resultInsert = mysqli_query($con, $queryInsert);
		
	}
	
	echo '<br>'.$queryUpdate = "update schedule set repaired = '1' where id = '$row[id]'";
	$resultUpdate = mysqli_query($con, $queryUpdate); 
	
}

/*
?>

<script type="text/javascript">
  function actualizar(){location.reload(true);}
//Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",1500);
</script>*/ ?>