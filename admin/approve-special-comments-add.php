<?php 

include('sessions.php');
	
$id = intval($_POST['payment']); 
$comments = addslashes($_POST['comments']);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query = "insert into approvecomments (payment, today, now, now2, userid, comments) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$comments')";
$result = mysqli_query($con, $query); 
$commentid = mysqli_insert_id($con);


$querypayment ="select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment=mysqli_fetch_array($resultpayment);
$users[] = $rowpayment['userid'];
$users[] = '226237';
$prequest = $rowpayment['userid'];

$unique_users = array_unique($users);

for($i=0;$i<=sizeof($unique_users);$i++){

	if($unique_users[$i] != ""){
	if($unique_users[$i] != $_SESSION['userid']){ 
		
	$selector_comments = $_SESSION['firstname']." ".$_SESSION['lastname']." ha agregado un mensaje en el pago no. ".$id;
	if($_SESSION['userid'] == $prequest){
		$link = "approve-special-view.php?id=".$id."#comment".$commentid;
	}else{
		$link = "payment-order-view.php?id=".$id."#comment".$commentid; 
	} 
	
	$query2 = "insert into notifications (userid, userid2, today, now, now2, notification, link) values ('$unique_users[$i]', '$_SESSION[userid]', '$today', '$now', '$now2', '$selector_comments', '$link')";
	$result2 = mysqli_query($con, $query2);
	
	}
	}

}

header("location: ".$_SERVER['HTTP_REFERER'].'#comment'.$commentid);  

?>