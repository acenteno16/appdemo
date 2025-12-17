<?

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION['imivoid'] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noAdminOrVoidRetention");
}
	 
$id = $_POST['id'];

$hall = $_POST['hall'];
if($hall == 0){
	?>
  <script>
  alert('Ingrese una sucursal.');
  history.go(-1);
  </script>  
   <?
   exit();
} 

$today = date("Y-m-d"); 
$now = date('H:i:s'); 

$query = "select * from hallsretention where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$queryretention = "update hallsretention set hall='$hall' where id = '$id'";
$resultretention = mysqli_query($con, $queryretention); 


$querypayment = "select * from payments where id = '$row[payment]'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

$querypayment = "update payments set hall='$hall' where id = '$row[payment]'";
$resultpayment = mysqli_query($con, $querypayment);

header('location: retentions-generator-imi-global.php');

?>