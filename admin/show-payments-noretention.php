<? 

#error_reporting(E_ALL);

include('sessions.php');
//Envio de retenciones IR
//include('function-email-irretention.php');
//Creacion de PDF retencion ir para envío
//include('pdf-ir-single.php'); 

$today = date("Y-m-d");
$now = date("H:i:s");
$forwarding = 1; 

$query = "select * from irretention where today = '2017-11-14' and now = '16:21:41'";
$result = mysqli_query($con, $query);
echo 'Total Casos: '.$num = mysqli_num_rows($result); 
while($row=mysqli_fetch_array($result)){

	if($row['company'] == 3){
		$query_ir = "select * from irretention where payment = '$row[payment]'";
		$result_ir = mysqli_query($con, $query_ir);  
		$num_ir = mysqli_num_rows($result_ir);
 		if($num_ir > 1){
			echo '<br>IDS: '.$row['payment'].' (RETS: ';
 			while($row_ir = mysqli_fetch_array($result_ir)){
				echo $row_ir['number'].',';
			}
			echo ')';
			$num3++;  
 		}
	}	
}
echo '<br>Total Consulta: '.$num2;
echo '<br>
<br>
<br>
';
echo 'Total duplicados: '.$num3;
echo '<br>Velosa: '.$velosa;


?>