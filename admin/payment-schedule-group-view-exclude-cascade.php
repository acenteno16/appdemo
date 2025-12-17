<?php 

include("session-schedule.php"); 
require('functions.php');

$ids = isset($_GET['ids']) ? sanitizeInput($_GET['ids'], $con) : '';
$comments = isset($_GET['comments']) ? sanitizeInput($_GET['comments'], $con) : '';

$ids = substr($ids, 0, -1);
$idsArr = explode(',', $ids);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

for($i=0;$i<sizeof($idsArr);$i++){
	
	$id = intval($idsArr[$i]);

	$query = "SELECT * FROM payments WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	$queryfirst = "select * from schedulecontent where payment = '$row[id]'";
	$resultfirst = mysqli_query($con, $queryfirst);
	$rowfirst = mysqli_fetch_array($resultfirst);

	$schedule = $rowfirst['schedule'];

	$querydelete = "delete from schedulecontent where payment = '$row[id]'";
	$resultdelete = mysqli_query($con, $querydelete);

	$querymain = "select * from schedulecontent where schedule = '$schedule'";
	$resultmain = mysqli_query($con, $querymain);
	$nummain = mysqli_num_rows($resultmain);
	while($rowmain=mysqli_fetch_array($resultmain)){
	
		$querypayments = "select * from payments where id = '$rowmain[payment]'";
		$resultpayments = mysqli_query($con, $querypayments);
		$rowpayments = mysqli_fetch_array($resultpayments);
		$gpayment+= $rowpayments['payment']; 
	}

	$query3 = "update payments set status = '9', schedule='0000-00-00' where id = '$row[id]'";
	$result3 = mysqli_query($con, $query3); 
	
	#$query4 = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '13.02', 'Eliminado de la programacion.', '$comments')";
	#$result4 = mysqli_query($con, $query4);  
	
	$query4 = "INSERT INTO times (payment, today, now, now2, userid, stage, comment, reason) 
           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt4 = $con->prepare($query4);
	$stage = '13.02'; 
	$comment = 'Eliminado de la programacion.';
	$stmt4->bind_param(
    	"isssssss", 
    	$id,        // Entero para "payment"
    	$today,     // String para "today"
    	$now,       // String para "now"
    	$now2,      // String para "now2"
    	$_SESSION['userid'], // String para "userid"
    	$stage,     // String para "stage"
    	$comment,   // String para "comment"
    	$comments   // String para "reason"
	);
	$stmt4->execute();

	$queryschedule = "update schedule set ammount='$gpayment' where id = '$schedule'";
	$resultschedule = mysqli_query($con, $queryschedule); 
  
}

header('location: payment-schedule-group-view.php?id='.$schedule);  

?>