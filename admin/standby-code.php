<? 

include('session-admin.php');

$id = $_POST['id'];
$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query1 = "select * from payments where id = '$id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

if($row1['status'] == '0.02'){
	echo "<script>alert('Este pago ya se encuentra en Standby.');history.go(-1);</script>";
	exit();
}

$query2 = "insert into standby (payment, userid, today, totime, status) values ('$id', '$_SESSION[userid]', '$today', '$now2', '$row1[status]')";
$result2 = mysqli_query($con, $query2);

$query3 = "update payments set status = '0.02' where id = '$id'";
$result3 = mysqli_query($con, $query3);

$query4 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.02', 'Standby')";
$result4 = mysqli_query($con, $query4); 

header('location: standby.php');  

?>