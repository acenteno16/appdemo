<?php 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION['imivoid'] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noAdminOrVoidRetention");
}

$id = $_POST['id'];

$query = "select * from hallsretention where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$comments = $_POST['comments'];
if($comments == ""){
	?>
    <script>
	alert('Usted debe de ingresar la razon de anulación de la retencion.');
	history.go(-1);
	</script> 
    <?
}

$querypayments = "update payments set ret1void = '1' where id = '$row[payment]'";
$resultpayments = mysqli_query($con, $querypayments);

$today= date('Y-m-d');

$queryretention = "update hallsretention set void = '1', voidcomments='$comments', voidtoday='$today', voiduserid='$_SESSION[userid]' where id = '$id'"; 
$resultretention = mysqli_query($con, $queryretention);


header('location: retentions-generator-imi-global.php'); 

	 
?>