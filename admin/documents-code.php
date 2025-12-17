<? 

include("session-admin.php"); 

$id = $_POST['id'];
$type = $_POST['dtype'];

$paymentid = $_POST['paymentid'];
$retainer2 = $_POST['retainer2'];
if($retainer2 != 1){
	$retainer2 = 0;
}
$retainer3 = $_POST['retainer3'];
if($retainer3 != 1){
	$retainer3 = 0;
} 

for($i=0;$i<sizeof($id);$i++){
	$query = "update bills set dtype='$type[$i]' where id = '$id[$i]'"; 
	$result = mysqli_query($con, $query); 
}

$query_payment = "update payments set acp='$retainer2', acp2='$retainer3' where id = '$paymentid'";
$result_payment = mysqli_query($con, $query_payment);

//echo '<script>document.location="'.$_SERVER['HTTP_REFERER'].'";</script>';
echo '<script>document.location="payment-management.php";</script>';

?>