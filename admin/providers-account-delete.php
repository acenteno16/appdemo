<?php include("sessions.php"); 

$id = sanitizeInput($_GET['id'], $con);
$id2 = sanitizeInput($_GET['id2'], $con);

$query = "DELETE FROM providersaccount WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id); // "i" indica que $id es un entero
$stmt->execute();

header("location: providers-edit.php?id=".$id2."&changes=3"); 

?>