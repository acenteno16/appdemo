<?

#repairRetetions22.php

include('sessions.php');
include('imiGenerator.php');

#leonn $rets = '24679,225665,225667,226173,227382,228464,228194,227967,228769,229915,229667,229939,229015,229964';
$rets = '';
#$rets = '223880,223875,223871,223877,223904,223779,224561,224560,224556,225627,225634,225626,225255,224554,224559,225382,227080,227087,227267,227543,227371,227373,227068,227070,227037,227368,227607,227065,227545,228220,228343,228283,228377,228567,228473,228444,228445,228580,229143,229177,228997,229017,229054,229354,229287,229355,229683,229672,227035,229212';
$retsArr = explode(',',$rets);

for($i=0;$i<sizeof($retsArr);$i++){
	
	$querypayment = "select id, ret1a, ret2a, hall, route, company from payments where id = '$retsArr[$i]'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$queryTimes = "select * from times where payment = '$retsArr[$i]' and stage = '13' order by id desc limit 1";
	$resultTimes = mysqli_query($con, $queryTimes);
	$rowTimes = mysqli_fetch_array($resultTimes);
	
	if(($rowpayment['ret1a'] > 0) and ($rowTimes['today'] > '2022-10-01')){
		
		echo '<br>-'.$rowpayment['id'].' - '.$rowpayment['ret1a'].' @'.$rowTimes['today'];
		#createIMIRetention($rowpayment['id'], 1, 0); 
		
	}
	
}

?>