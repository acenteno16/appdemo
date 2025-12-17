<? 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["withholding"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}

$id = $_POST['id'];
$company = $_POST['company'];
if($company == 0){
	?>
  <script>
  alert('Ingrese una compañia.');
  history.go(-1);
  </script>  
   <?
   exit();
} 

$today = date("Y-m-d"); 
$now = date('H:i:s'); 

$query = "select * from irretention where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$querypayment = "select * from payments where id = '$row[payment]'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);


			//leer el ultimo id2
			$querycompany2 = "select * from irretention where company = '$company' order by id desc limit 1";
			$resultcompany2 = mysqli_query($con, $querycompany2);
			$rowcompany2 = mysqli_fetch_array($resultcompany2);
			$number = $rowcompany2['number'];  
			
			//Sumarle uno
			$number = $number+1;
			
			$queryret = "insert into irretention (today, now, payment, company, number) values ('$today', '$now', '$row[payment]', '$company', '$number')"; 
			$resultret = mysqli_query($con, $queryret); 
			$idret = mysqli_insert_id($con);



//////

$querycompany1 = "select * from companies where id = '$row[company]'";
$resultcompany1 = mysqli_query($con, $querycompany1);
$rowcompany1 = mysqli_fetch_array($resultcompany1);
$company1 = $rowcompany1['name'];
 
$querycompany2 = "select * from companies where id = '$company'";
$resultcompany2 = mysqli_query($con, $querycompany2);
$rowcompany2 = mysqli_fetch_array($resultcompany2);
$company2 = $rowcompany2['name']; 

$comments = "La retencion ".$row['number']." para el id de solicitud No. ".$row['payment']." fue anulada por el ususario: ".$_SESSION["userid"]." | ".$_SESSION["firstname"]." ".$_SESSION["lastname"]." redireccionado de la compañia ".$company1." a la compañia ".$company2." el ".date('d-m-Y')." a las ".date('h:i a');


$querypayment = "update payments set ret2id='$idret' where id = '$row[payment]'";
$resultpayment = mysqli_query($con, $querypayment);

$query1 = "update irretention set payment='0', void='1', voidcomments='$comments' where id = '$id'";
$result1 = mysqli_query($con, $query1);

header('location: show-retentions-ir.php');


?>