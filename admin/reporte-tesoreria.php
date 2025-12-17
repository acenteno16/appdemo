<? 

include('session-admin.php');

//Tiempos area de Tesorería


//Leemos el Rango de Fechas
$from1 = $_POST['from'];
$from = date("Y-m-d", strtotime($from1));
$from = "2017-01-01";
$to1 = $_POST['to'];
$to = date("Y-m-d", strtotime($to1)); 
$to = "2017-01-31"; 

//IDs de los pagos que han sido provisionados en el rango de fecha
$i=0;
echo $query = "select payments.id, times.today from payments inner join times on payments.id = times.payment where times.stage = '14.00' and times.today >= '$from' and times.today <= '$to' group by payments.id";  
$result = mysqli_query($con, $query);
echo '<br>Num: '.$num = mysqli_num_rows($result); 
while($row = mysqli_fetch_array($result)){
	
	//Fecha 1 (Cuando entra a tesorería)
	//Tiene que estar Control de Calidad y la liberacion
	
	//Fecha 1a (Liberacion)
	$query1a = "select * from times where stage = '9.00' and payment = '$row[0]' order by id desc limit 1";
	$result1a = mysqli_query($con, $query1a);
	$row1a = mysqli_fetch_array($result1a);
	$fecha1a = $row1a['today'];
	
	//Fecha 1b (Contros de calidad)
	$query1b = "select * from times where stage = '8.03' and payment = '$row[0]' order by id desc limit 1";
	$result1b = mysqli_query($con, $query1b);
	$row1b = mysqli_fetch_array($result1b);
	$fecha1b = $row1b['today'];
	
	//Fecha mas alta
	if($fecha1a > $fecha1b){
		$fecha1 = $fecha1a;
	}else{
		$fecha1 = $fecha1b;
	}
	
	$fecha2 = $row[1]; 
	
	//Numero de días
	
	$dias = (strtotime($fecha2)-strtotime($fecha1))/86400;
	//echo "<br>-IDS: ".$row[0]." Días: ".$dias;
	$sumdias+= $dias;
	$i++;
	
}

echo "<br><br>Prom: ".$sumdias/$i;




?>