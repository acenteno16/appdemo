<?php 

include("session-treasury.php"); 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query1 = "SELECT * FROM schedulecontent WHERE schedule = ?";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param("s", $id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$num1 = $result1->num_rows;

if($num1 == 0){
	
	$queryDelete = "delete from schedule where id = ?";
	$stmtDelete = $con->prepare($queryDelete);
	$stmtDelete->bind_param("i", $id);
	$stmtDelete->execute();

} 

header('location: '.$_SERVER['HTTP_REFERER']);

?>