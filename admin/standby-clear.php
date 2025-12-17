<? 

include('session-admin.php');

$id = $_GET['id'];
$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query1 = "select * from standby where payment = '$id'";
$result1 = mysqli_query($con, $query1);
$num1 = mysqli_num_rows($result1);
$row1 = mysqli_fetch_array($result1);

if($num1 == 0){
	echo "<script>alert('No se encontró el ID de solicitud en Standby'); history.go(-1);</script>";
	exit();
}

$query3 = "update payments set status = '$row1[status]' where id = '$row1[payment]'";
$result3 = mysqli_query($con, $query3);

$query4 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.03', 'Standby off')";
$result4 = mysqli_query($con, $query4); 

$query2 = "delete from standby where payment = '$id'";
$result2 = mysqli_query($con, $query2); 

header('location: standby.php');  

?>