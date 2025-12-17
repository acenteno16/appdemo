<?php 

session_start();

if(($_SESSION['admin'] == "active") or ($_SESSION["stuck"] == "active") or ($_SESSION["retentionmanager"] == 'active')){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}
	 
$theid = $_POST['theid'];
$hallid = $_POST['hallid'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');


//Start for
for($c=0;$c<sizeof($theid);$c++){
	
	$querypayment = "update payments set hall='$hallid[$c]' where id = '$theid[$c]'";
	$resultpayment = mysqli_query($con, $querypayment); 

}


?>
<script> 
alert('<? echo $c; ?> solcitudes de pago procesadas con exito.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>"; 
</script>