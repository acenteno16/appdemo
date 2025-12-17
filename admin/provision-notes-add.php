<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

include("session-provision.php");
include("functions.php");

/*
Explicacion:

Se esta realizando un cambio en la manera en que trabajan las notas de debito.

La idea es que vamos a guardar la nota de debito en la moneda en que vienen. Luego vamos a ocupar 

amount va a guardae el monto de la nota en la moneda de la nota.

ammount va a guardar el monto de la nota en la moneda de pago.

Asi que cuado eliminemos una nota de debito, le vamos a sumar ammount... (Esto no va a requerir cambio.)

Ni va a requerir normalizacion. Todo lo que este realizado con el codigo anterior va a quedar legible (Sin el monto/moneda real de la nota.)


*/

$id = $_POST['paymentadj2']; 
$number = $_POST['notenumber'];
$ammount = $_POST['noteammount'];
$reason = $_POST['notereason']; 
$today = date('Y-m-d');
$tammount2 = 0;
$tammount3 = 0;
$currency = $_POST['notecurrency'];
$notetoday = $_POST['notetoday'];


//Luego necesitamos la moneda de pago
$query_p = "select currency from payments where id = '$id'";
$result_p = mysqli_query($con, $query_p);
$row_p = mysqli_fetch_array($result_p);

$payment_currency = $row_p['currency'];  

for($c = 0; $c < sizeof($ammount); $c++){ 
	
	if(($currency[$c] == 1) or ($currency[$c] == 2)){
		$thistoday = date('Y-m-d', strtotime($notetoday[$c])); 
	
		if(($payment_currency == 1) and ($currency[$c] == 2)){
			//Si moneda de pago = Cordobas y Moneda de la Nota es en Dolares
			$camount = convertAmount($ammount[$c], 2, 1, $thistoday);
		}elseif(($payment_currency == 2) and ($currency[$c] == 1)){
			//Si moneda de pago = Dolares y Moneda de la Nota es en Cordobas
			$camount = convertAmount($ammount[$c], 1, 2, $thistoday);
		}else{
			//Si la moneda de pago es igual a la moneda de la nota 
			$camount = $ammount[$c];  
		} 

    	$thisamount = str_replace(',','',$ammount[$c]); 
		$query = "insert into notes (payment, number, ammount, reason, today, userid, amount, currency) values ('$id','$number[$c]','$camount','$reason[$c]', '$today', '$_SESSION[userid]', '$thisamount', '$currency[$c]')"; 
		$result = mysqli_query($con, $query);
		$tammount2+=$camount;  
	}

	
}

$querynotes = "select * from notes where payment = '$id'";
$resultnotes = mysqli_query($con, $querynotes);
while($rownotes = mysqli_fetch_array($resultnotes)){
	//Total del debito
	$tammount3+=$rownotes['ammount']; 
}

$query2 = "select * from payments where id = '$id'"; 
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($result2); 

$newpayment = $row2['payment']-$tammount2;

$query3 = "update payments set payment='$newpayment', debit='$tammount3' where id = '$id'"; 
$result3 = mysqli_query($con, $query3); 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query4 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.01', 'Ingreso de nota de debito.')";  
$result4 = mysqli_query($con, $query4);  

header("location: ".$_SERVER['HTTP_REFERER']);     
 
	

/*

<?php include("session-provision.php");

$id = $_POST['paymentadj2']; 
$number = $_POST['notenumber'];
$ammount = $_POST['noteammount'];
$reason = $_POST['notereason']; 
$today = date('Y-m-d');

for($c = 0; $c < sizeof($ammount); $c++){
	$query = "insert into notes (payment, number, ammount, reason, today, userid) values ('$id','$number[$c]','$ammount[$c]','$reason[$c]', '$today', '$_SESSION[userid]')"; 
	$result = mysqli_query($con, $query); 
	
	$tammount = $tammount+$ammount[$c];
	
}

$query2 = "select * from payments where id = '$id'";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($result2);

$newpayment = $row2['payment']-$tammount; 

$querynotes = "select * from notes where payment = '$id'";
$resultnotes = mysqli_query($con, $querynotes);
while($rownotes = mysqli_fetch_array($resultnotes)){
	$tammount2+=$rownotes['ammount']; 
}


$query3 = "update payments set payment='$newpayment', debit='$tammount2' where id = '$id'"; 
$result3 = mysqli_query($con, $query3); 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query4 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.01', 'Ingreso de nota de debito.')";  
$result4 = mysqli_query($con, $query4);  

header("location: ".$_SERVER['HTTP_REFERER']);    

?>

*/

?>