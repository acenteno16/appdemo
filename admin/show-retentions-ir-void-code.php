<? 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["withholding"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}


$id = $_GET['id'];

$query = "select * from irretention where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$querypayment = "select * from payments where id = '$row[payment]'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

echo $querypayment2 = "update payments set ret2void = '1' where id = '$row[payment]'";
//$resultpayment2 = mysqli_query($con, $querypayment2);

$comments = "La retencion ".$row['number']." para el id de solicitud No. ".$row['payment']." fue anulada por el ususario: ".$_SESSION["userid"]." | ".$_SESSION["firstname"]." ".$_SESSION["lastname"]." el ".date('d-m-Y')." a las ".date('h:i a'); 

$query1 = "update irretention set void='1', voidcomments='$comments' where id = '$id'";
$result1 = mysqli_query($con, $query1);

header('location: show-retentions-ir.php');

?>