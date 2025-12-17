<?php 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["withholding"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}


$query = "select * from payments where ret1a > 0 and btype = 2 and status = '14'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$query1 = "select * from hallsretention where payment = '$row[id]'";
	$result1 = mysqli_query($con, $query1);
	$row1 = mysqli_fetch_array($result1);
	
	$queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$row[id]'"; 
$resultretdate = mysqli_query($con, $queryretdate);  
$rowretdate = mysqli_fetch_array($resultretdate); 

  $date = date('d-m-Y',strtotime($rowretdate['today'])); 
	
	$anulada = "";
	if($row['ret1void'] == 1){
		$anulada = "Anulada";
	}
	echo "<br> IDS: ".$row['id']." | IDR: ".$row1['serial']."-".$row1['number']." | Date: ".$date." ".$anulada; 
}

?>