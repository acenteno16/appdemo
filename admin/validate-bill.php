<?php

include("sessions.php");
require('functions.php');

$bill = isset($_POST['variable']) ? sanitizeInput($_POST['variable'], $con) : 0;
$provider = isset($_POST['variable2']) ? sanitizeInput(intval($_POST['variable2']), $con) : 0;
$payment = isset($_POST['payment']) ? sanitizeInput(intval($_POST['payment']), $con) : 0;

$query = "select payments.id, bills.payment from payments inner join bills on payments.id = bills.payment inner join providers on payments.provider = providers.id where bills.number = ? and providers.id = ? and payments.approved != '2' and payments.id != ?";
$stmt = $con->prepare($query);
$stmt->bind_param("sii", $bill,$provider,$payment);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;
if($num > 0){
	while ($row = $result->fetch_assoc()){
		$pIds.= $row['id'].', ';
	}
	$pIds = substr($pIds,0,-2);
	echo "La factura no.".$bill." aparece en el sistema vinculada a la solicitud(es): ".$pIds;
}else{
	echo '0';
}

?>