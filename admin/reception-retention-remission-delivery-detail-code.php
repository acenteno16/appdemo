<?php 

include("session-reception.php");

$irid = $_POST['irid'];
$hallsid = $_POST['hallsid'];
$receiver = $_POST['receiver'];
if($receiver == 0){ ?>
<script>
alert('Debe de seleccionar quien recibe.');
history.go(-1);
</script>
<? exit(); }

//Delivery IR retentions
for($i=0;$i<sizeof($irid);$i++){
	
	$queryir = "update irretention set delivery = '$receiver' where id = '$irid[$i]'";
	$resultir = mysqli_query($con, $queryir);
	
} 

for($h=0;$h<sizeof($hallsid);$h++){ 
	
	$queryhalls = "update irretention set delivery = '$receiver' where id = '$hallsid[$h]'";
	$resulthalls = mysqli_query($con, $queryhalls);
	
}

header('location: reception-retention-remission-delivery.php'); 


?>