<?php 

include("session-admin.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM hallsretention WHERE book = ? AND status > 0 AND payment > 0";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

if($num == 0){ 
	
	$queryDelete = "delete from hallsbook where id = ?";
	$stmtDelete = $con->prepare($queryDelete);
	$stmtDelete->bind_param("i", $id);
	$stmtDelete->execute();
	
	$queryDelete2 = "delete from hallsretention where book = ?";
	$stmtDelete2 = $con->prepare($queryDelete2);
	$stmtDelete2->bind_param("i", $id);
	$stmtDelete2->execute();
	
	echo "<script>alert('Talonario eliminado con exito!'); window.location = 'halls-retention.php'; </script>";
	
}else{
	while($row=mysqli_fetch_array($result)){
		$chain.= $row['serial']."-".$row['number'].", "; 
	}
	echo "<script>alert('No se puede eliminar un talonario cuando esta en uso. Rets: ".$chan."'); history.go(-1);</script>";
}

	 
?>