<? 

include('sessions.php');

$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 

$query = "select id, status, reason from payments where (type = '2' or type = '3' or type = '5') and approved = '2' order by id desc"; 
$result = mysqli_query($con, $query);
#echo $num = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	

	//Multiple Rejection
	$query_multiple = "select id, approved, status from payments where child = '$row[id]'";  
	$result_multiple = mysqli_query($con, $query_multiple);
	#$string1 = '<br>'.$row['id'].': ';
	#$string2 = "";
	while($row_multiple = mysqli_fetch_array($result_multiple)){  
		
	
		if($row_multiple['approved'] != 2){
		#if(($row_multiple['approved'] != 2) or ($row_multiple['status'] == '7.12')){  	
			#$string2.= $row_multiple['id'].', ';
			#Aqui rechazamos todos los hijos.
	
			echo '<br><br>'.$query_reject = "update payments set approved='2', status='7.12' where id = '$row_multiple[id]'"; 
			#$result_reject = mysqli_query($con, $query_reject);

			//time stage 
			echo '<br>'.$querytime_reject = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$row_multiple[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '7.12', 'La solicitud ha sido rechazada por Administrador.', 'Err detectado. No se aplico el rechazo del pago madre.')";  
			#$resulttime_reject = mysqli_query($con, $querytime_reject); 
		}
		
		
	
	}
	#if($string2 != ''){
		#echo $string1.$string2;
	#}
	
}




?>