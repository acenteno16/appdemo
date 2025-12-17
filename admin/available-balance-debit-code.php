<?php include("sessions.php"); 

$description = $_POST['description'];
$ammount = $_POST['ammount'];
$ammount = str_replace(',','',$ammount);
$ammount = str_replace('_','',$ammount);
$ammount = str_replace('€','',$ammount); 
$currency = $_POST['currency'];

$today = date("Y-m-d");
$now = date('H:i:s');
$type = "nd";

$query1 = "select * from balance where currency = '$currency' order by id desc limit 1";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

$newbalance = $row1['balance']-$ammount;

if($newbalance >= 0){
$query = "insert into balance (today, now, type, description, ammount, balance, currency) values ('$today', '$now', '$type', '$description', '$ammount', '$newbalance', '$currency')";
$result =  mysqli_query($con, $query); 

header('location: available-balance.php'); 
}else{
	?>
    <script>
	alert('El balance actual no permite un debito de <?php echo $ammount; ?>');	
	history.go(-1);
	</script>
    <?php }



?>