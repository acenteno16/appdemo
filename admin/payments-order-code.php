<?php include("sessions.php"); 

/*$user = $_SESSION['userid'];
$provider = $_POST['provider'];
$type = $_POST['type'];
$concept = $_POST['concept'];
$concept2 = $_POST['concept2'];
$description = $_POST['description'];
$bill = $_POST['bill'];
$ammount = $_POST['ammount'];
$letters = $_POST['letters'];
$currency = $_POST['currency'];
$retention1 = $_POST['retention1'];
$retention1ammount = $_POST['retention1ammount'];
$retention2 = $_POST['retention2'];
$retention2ammount = $_POST['retention2ammount'];
$payment = $_POST['payment']; */

//$query = "insert into payments (provider, type, concept, concept2, description, bill, ammount, letters, currency, retention1, retention1ammount, retention2, retention2ammount, payment) values ('$provider', '$type', '$concept', '$concept2', '$description', '$bill', '$ammount', '$letters', '$currency', '$retention1', '$retention1ammount', '$retention2', $retention2ammount', '$payment')";
//$result = mysqli_query($con, $query);  
//$id = mysqli_insert_id($con);  

//$today = date("Y-m-d");
//$now = date('H:i:s');

/*
STAGES
1 ingreso
2 aprobado 1
3 aprobado 2
4 pagado
5 En proceso etapa 1
6 En Proceso en etapa 2
7 En proceso de pago
8 rechazado en etapa 1
9 rechazado en etapa 2
*/

//$query2 = "insert into times (payment, today, now, user, stage, comment) values ('$id', '$today', '$now', '$_SESSION[userid]', '1', '')";
//$result2 = mysqli_query($con, $query2);      
 
header("location: paymets-order-view.php");   

?>