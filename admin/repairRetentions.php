<? 

include('sessions.php');

$ids = '234216,234514,232909,232919,233505,233500,233507,233509,233369,233479,233483,233933,234760,233738,234433,235016,234669,235143,234258,234258,234258,234161,234126,235046,234787,232368,234763,233357,234785,234152,235013,234169,234088,234050,233585,233840,233604,233608,233713,234394,234961,234371,234318,234308,235193,235474,235539,235321,235231,234962,233556,235285,235538,236077,235144,235272,235028,236286,236283,236089';
$ids = explode(',',$ids);
echo '<br>RT: '.sizeof($ids);


/*
$ds = '234216,234514,232909,232919,233505,233500,233507,233509,233369,233479,233483,233933,234760,233738,234433,235016,234669,235143,234258,234258,234258,234161,234126,235046,234787,232368,234763,233357,234785,234152,235013,234169,234088,234050,233585,233840,233604,233608,233713,234394,234961,234371,234318,234308,235193,235474,235539,235321,235231,234962,233556,235285,235538,236077,235144,235272,235028,236286,236283,236089';

$query = "select hallsretention.* from hallsretention where hallsretention.status > '0' and hallsretention.hall = '4' and created >= '2023-01-01'";
$result = mysqli_query($con,$query);
echo 'VM: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	echo '<br>-'.$queryUpdate = "update hallsretention set payment='0', status='0', created='0000-00-00', billsno='*', billsid='*', amount='0.00' where id = '$row[id]'";
	$resultUpdate = mysqli_query($con, $queryUpdate);
	
	echo '<br>-'.$queryUpdate2 = "update payments set ret1id = '0', mayorstage = '0' where id = '$row[payment]'";
	$resultUpdate2 = mysqli_query($con, $queryUpdate2);
	
	$rets.="$row[id],";
	$payments.="$row[payment],";
	
}
echo '<br>Rets:'.$rets;
echo '<br>Payments:'.$payments;
*/
/*
$ids = "228693,228636,228648,226451,228645,228137,227793,226448,226272,227277,225489,224983,226370,224991,224965,224024";
$ids = explode(',',$ids);
echo '<br>RT: '.sizeof($ids);

for($i=0;$i<sizeof($ids);$i++){
	echo '<br>'.$ids[$i];
	createIMIRetention($ids[$i], 1, 0);
}


*/
?>