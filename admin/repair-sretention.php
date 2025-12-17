<? 

/*
include("sessions.php");

$from = "2018-07-01";
$to = "2018-07-30";

$arr_retentions = array();

$query = "select payments.id, payments.provider, times.today from payments inner join times on payments.id = times.payment where times.stage = '13' and times.today >= '$from' and times.today <= '$to' and payments.ret2a > '0'"; 
$result = mysqli_query($con, $query); 
echo "<br>Num: ".$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$query_users = "select * from providerscontacts where provider = '$row[1]' and cret = '1'"; 
	$result_users = mysqli_query($con, $query_users);
	$num_users = mysqli_num_rows($result_users); 
	
	if($num_users > 0){
		
		$query_pre = "select * from irretention where payment = '$row[0]' and dsent = '0'";
		$result_pre = mysqli_query($con, $query_pre);
		$num_pre = mysqli_num_rows($result_pre);
	
		if($num_pre > 0){
		echo "<br>".$queryret_update = "update irretention set dsent='1', dsenttoday='$row[2]', dsenttotime='17:00:00' where payment = '$row[0]'";
		//$resultret_update = mysqli_query($con, $queryret_update);
		}
	
	
	}
	
}

 */

?>