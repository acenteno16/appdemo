<?php 

include("session-retentions.php"); 

$id = $_GET['id'];

$query = "select * from irremission where id = '$id' and status = '1'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if($num == 1){

	$query_a = "update irremission set status = '5' where id = '$id'";
	$result_a = mysqli_query($con, $query_a); 
	
	$query_q = "select * from irremissioncontent where irremission = '$id'";
	$result_q = mysqli_query($con, $query_q);
	while($row_q=mysqli_fetch_array($result_q)){
		
		$query_u = "update irretention set remissionstatus='0', delivery='0' where id = '$row_q[irretention]'";
		$result_u = mysqli_query($con, $quer_u);
		
	}
	
	$query_d = "delete from irremissioncontent where irremission = '$id'";
	$result_d = mysqli_query($con, $query_d);
	
	header('location: '.$_SERVER['HTTP_REFERER']);
	

}else{
	echo "<script>alert('La remision se encuentra en otra etapa.'); history.go(-1);</script>";
}

?>