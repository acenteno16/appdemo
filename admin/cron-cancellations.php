<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

#echo "Ruta del script: " . __FILE__ . PHP_EOL;
#exit();

//Conection
require('/var/www/html/connection.php');  
//email assets
require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php';
//Envio de cancelación de retenciones 
include('/var/www/html/admin/function-email-cancellation.php');
//Envio de retenciones IR
include('/var/www/html/admin/function-email-irretention.php');
//Creacion de PDF retencion ir para envío
include('/var/www/html/admin/pdf-ir-single.php'); 

$forwarding = 0; 
$a = '';
$b = '';
$retainer = array();
$queryRetainer = "select id, iractive from companies";
$resultRetainer = mysqli_query($con, $queryRetainer);
while($rowRetainer=mysqli_fetch_array($resultRetainer)){
	$retainer[$rowRetainer['id']] = $rowRetainer['iractive']; 
}

$query_main = "select id, cnotification, rnotification, ret2a, company from payments where approved = '1' and cnotification = '1'";
$result_main = mysqli_query($con, $query_main);
$num_main = mysqli_num_rows($result_main);
echo 'NUM: '.number_format($num_main,0);

$query_main = "select id, cnotification, rnotification, ret2a, company from payments where approved = '1' and cnotification = '1' limit 6"; 
$result_main = mysqli_query($con, $query_main);
while($row_main=mysqli_fetch_array($result_main)){ 
	
	echo 'Payment: '.$row_main['id'].' - Cnot: '.$row_main['cnotification'].' - Rnot: '.$row_main['rnotification'].' Ret2a: '.$row_main['ret2a'];
	
	if($row_main['cnotification'] == 1){
		$a = notifyCancellation($row_main['id'],$forwarding,1,'',$con);
	}
	
	if(($row_main['rnotification'] == 1) and ($row_main['ret2a'] > 0) and ($retainer[$row_main['company']] == 1)){
		$fileUrl = '/home/tosend/'.$row_main['id'].'.pdf';
		if(file_exists($fileUrl)){
			unlink($fileUrl);
		}
		makeRetention($row_main['id'],1,$con);
		$b = sendEmailRetention($row_main['id'],$forwarding,1,'',$con); 
	}
	else{
		$b = 'No aplica envio de retencion.';
		if($retainer[$row_main['company']] == 0){
			$queryUpt = "update payments set rnotification = '3' where id = '$row_main[id]'";
			$resultUpt = mysqli_query($con, $queryUpt);
			$now = date('Y-m-d H:i:s a');
			$emailSent = 0;
			$emailStatusMessage = "La compania no esta configurada para grabar IR";
			$pagename = 'cron-cancellations.php';
			$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$row_main[id]', '2', '4, '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
			$resultErr = mysqli_query($con, $queryErr);
			$b = 'IR inactivo.';
			
		}
	} 
	
	echo '<br>Consulta de cancelacion: '.$a;
	echo '<br>Consulta de retencion: '.$b;
	
}

/*
echo '
<script> 
setInterval(function() {
  location.reload();
}, 1500); // 1000 milliseconds = 1 seconds 
</script>
';*/

?>