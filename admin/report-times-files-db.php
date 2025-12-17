<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

if(!isset($_SESSION)){ session_start(); }

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active"))){
	$gp_server2 = "localhost";
	$gp_username2 = "cp_getpay";
	$gp_password2 = "9gwfxCpxFL8T60m";
	$gp_database2 = "cp_getpay_damage"; 

	$con = mysqli_connect($gp_server2, $gp_username2, $gp_password2, $gp_database2); 
	mysqli_set_charset($con, "utf8mb4"); 
}
else{
	if(isset($_SESSION)){ session_destroy(); }
	header("location: ../?err=nosession_sessions");	  
} 

include('function-beneficiary.php');

$now = date('Y-m-d'); 

$sql = " and times.stage = '14' and times.today >= '2022-1-1' and payments.rtimes = '0'"; 
$join = " inner join times on payments.id = times.payment";

echo $query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.userid, payments.company, payments.routeid, payments.payment from payments".$join." where payments.status >= '14' and payments.rtimes = '0'".$sql.' group by payments.id order by payments.id asc limit 10';   
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);

$thisCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}

while($row=mysqli_fetch_array($result)){
	
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select name from currency where id = '$row[currency]'"));
	$rowuser= mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[userid]'"));
	$rowcompany= mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row[company]'"));
							
	
	//TIMES
								
	$query2 = "select stage, today, now2 from times where payment = $row[id] order by stage asc";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	
    $queryunit = "select * from units where id = '$row[routeid]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
    if($row['ncatalog'] == 1){
	   $unit = "$rowunit[newCode] | $rowunit[companyName] $rowunit[lineName] $rowunit[locationName]";
    }
    else{
	   $unit = $rowunit['code'].' | '.$rowunit['name']; 
    }
			
	$requestdate = 0;
	$approve1date = 0;
	$approve2date = 0;
	$approve3date = 0;
	$provisiondate = 0;
	$releasingdate = 0;
	$bankdate = 0;
	$cancellationdate = 0;
			
	while($row2=mysqli_fetch_array($result2)){
		
		$vobodate = 0;
		
		
		switch($row2['stage']){
			case "1":
			$requestdate = $row2['today'];
			$requestdateTime = $row2['now2'];
			break;
			case "1.01":
			$vobodate = $row2['today'];
			$vobodateTime = $row2['now2'];
			break;
			case "2":
			$approve1date = $row2['today'];
			$approve1dateTime = $row2['now2'];
			break;
			case "3":
			$approve2date = $row2['today'];
				$approve2dateTime = $row2['now2'];
			break;
			case "4":
			$approve3date = $row2['today'];
				$approve3dateTime = $row2['now2'];
			break; 
			case "8":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
			case "8.01":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
			case "8.04":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
            case "8.05":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
			case "9":
			$releasingdate = $row2['today'];
				$releasingdateTime = $row2['now2'];
			break;
			case "12":
			$scheduledate = $row2['today'];
				$scheduledateTime = $row2['now2'];
			break;	
			case "13":
			$bankdate = $row2['today'];
				$bankdateTime = $row2['now2'];
			break; 
			case "14":
			$cancellationdate = $row2['today'];
				$cancellationdateTime = $row2['now2'];
			break;  
				}
	} 
			
			
			//Global time
			if($cancellationdate != 0){
				$datea = $requestdate; //Request date
				$dateb = $cancellationdate; //Approve1 date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tglobal = $dias;
			}
            else{
				$tglobal = "NA";
			}
	
			//Vobo Times
			$haveVobo = 0;
			if($vobodate  != 0){
				$datea = $requestdate; //Request date
				$dateb = $vobodate ; //Vobo date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tvobo = $dias;
				$haveVobo = 1;
			}
            else{
				$tvobo = "NA"; 
			}
	
			//Approve1 Times
			if($approve1date != 0){
				if($haveVobo == 0){
					$datea = $requestdate; //Request date
				}else{
					$datea = $vobodate; //vobo date
				}
				
				$dateb = $approve1date; //Approve1 date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove1 = $dias;
			}
            else{
				$tapprove1 = "NA";
			}
			
			//Approve2
			
			if($approve2date != 0){
				$datea = $approve1date; //Approve1 date
				$dateb = $approve2date; //Approve2 date
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove2 = $dias;
				$approve2 = 1; 
			}
            else{
				$tapprove2 = 'NA';
			}
			//Approve3
			//If approve3 isset
			if($approve3date != 0){
				$datea = $approve2date; //Aprobado2
				$dateb = $approve3date; //Aprpbado3
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove3 = $dias; 
				
			}
            else{
				$tapprove3 = "NA";
			}
			
			//Provision
			$scheduleuser = "NA";
			if($provisiondate != 0){
				
				$queryschedule1 = "select userid from times where payment = '$row[id]' and stage = '12.00'";
				$resultschedule1 = mysqli_query($con, $queryschedule1);
				$numschedule1 = mysqli_num_rows($resultschedule1);
				$rowschedule1 = mysqli_fetch_array($resultschedule1);
				 
				$scheduleuserid = $rowschedule1['userid'];
				
				$queryschedule = "select first, last from workers where code = '$scheduleuserid'";
				$resultschedule = mysqli_query($con, $queryschedule);
				$rowschedule = mysqli_fetch_array($resultschedule);
				
				$scheduleuser = $rowschedule['first'].' '.$rowschedule['last'];
				if($numschedule1 == 0){
					$scheduleuser = "NA";
				}
				
				if($approve1date != 0){
					$datea = $approve1date;
				}
				if($approve2date != 0){
					$datea = $approve2date;
				}
				if($approve3date != 0){
					$datea = $approve3date; 
				}
				$dateb = $provisiondate; //Provision
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tprovission = $dias; 
				
			}
			else{
				$tprovission = "NA"; 
			}

			//Releasing
			if($releasingdate != 0){
				$datea = $provisiondate; //Provision date
				$dateb = $releasingdate; //releasing date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$treleasing = $dias;
				
			}
            else{
				echo "NA";
			}
			//Schedule
			if($scheduledate != 0){
				$datea = $releasingdate; //Releasing
				$dateb = $scheduledate; //Schedule 
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedule = $dias;
				
			}

			//Bank
			if($bankdate != 0){
				$datea = $scheduledate; //Schedule 
				$dateb = $bankdate; //Bank
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tbank = $dias;
				
			}
			
			//Cancellation 
			if($cancellationdate != 0){
				$datea = $bankdate; //Schedule Approve
				$dateb = $cancellationdate; //Cancellation
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tcancellation = $dias;
				
			}
	
	$solicitud = "";
	$solicitudTime = "";
	if($requestdate != ""){
		$solicitud = date('Y-m-d',strtotime($requestdate)).' '.$requestdateTime;
	}
	$vobo = "-";
	if($vobodate != ""){
		if($vobo > '2005-01-01'){
			$vobo = date('Y-m-d',strtotime($vobodate)).' '.$vobodateTime;
		}
	}
	$aprobado1 = "-";
	if($approve1date != ""){
		$aprobado1 = date('Y-m-d',strtotime($approve1date)).' '.$approve1dateTime;
	}
	$aprobado2 = "-";
	if($approve2date != ""){
		if($approve2date > '2005-01-01'){
			$aprobado2 = date('Y-m-d',strtotime($approve2date)).' '.$approve2dateTime;
		}
	}
	$aprobado3 = "-";
	if($approve3date != ""){  
		if($approve3date > '2005-01-01'){
			$aprobado3 = date('Y-m-d',strtotime($approve3date)).' '.$approve3dateTime; 
		}
	}
	$provision = "-";
	if($provisiondate != ""){
		$provision = date('Y-m-d',strtotime($provisiondate)).' '.$provisiondateTime;
	}
	$releasing = "-";
	if($releasingdate != ""){
		$releasing = date('Y-m-d',strtotime($releasingdate)).' '.$releasingdateTime;
	}
	$schedule = "-";
	if($scheduledate){
		$schedule = date('Y-m-d',strtotime($scheduledate)).' '.$scheduledateTime;
	}
	$bank = "-";
	if($scheduledate){
		$bank = date('Y-m-d',strtotime($bankdate)).' '.$bankdateTime;
	}
	$cancellation = "-";
	if($cancellationdate != ""){
		$cancellation = date('Y-m-d',strtotime($cancellationdate)).' '.$cancellationdateTime; 
	}
	
	$querystatus = "select today, now2 from provisionfilestimes where payment = '$row[payment]'";   
	$resultstatus = mysqli_query($con, $querystatus);
	$rowstatus = mysqli_fetch_array($resultstatus);
	
	$rprov = "-";
	if($rowstatus['today'] != ""){
		$rprov = date('Y-m-d',strtotime($rowstatus['today']));
	}
	

	$dRem = '-';
	$dRec = '-';
	$dEnt = '-';
	
	$querypackage = "select package from packagescontent where payment = '$row[id]' limit 1";
	$resultpackage = mysqli_query($con, $querypackage);
	$numpackage = mysqli_num_rows($resultpackage);
	if($numpackage > 0){
		$rowpackage = mysqli_fetch_array($resultpackage);
		$querystatus = "select stage, now from packagestimes where package = '$rowpackage[package]' order by id asc";  
		$resultstatus = mysqli_query($con, $querystatus);
		while($rowstatus=mysqli_fetch_array($resultstatus)){
			switch($rowstatus['stage']){
				case 1:
					$dRem = $rowstatus['now'];
					break;
				case 2:
					$dRec = $rowstatus['now'];
					break;
				case 3:
					$dEnt = $rowstatus['now'];
					break;
			}	
		}
		
	}
	
	$dAlm = '-'; 
		
	$queryscheduletid = "select schedule from schedulecontent where payment = '$row[id]'";
	$resultscheduletid = mysqli_query($con, $queryscheduletid);
	$numscheduletid = mysqli_num_rows($resultscheduletid);
	
	if($numscheduletid > 0){
		$rowscheduletid=mysqli_fetch_array($resultscheduletid);
		$queryscheduleid = "select now from scheduletimes where schedule = '$rowscheduletid[schedule]' and stage = '7'";
		$resultscheduleid = mysqli_query($con, $queryscheduleid);
		$rowscheduleid=mysqli_fetch_array($resultscheduleid);
		$dAlm = $rowscheduleid['now']; 
	}
	
	$requester = $rowuser['first']." ".$rowuser['last'];
	$company = $rowcompany[0];
	$beneficiary = getBeneficiary($row['id'],'min');
	$amount = $row['payment'];
	$currency = $thisCurrency[$row['currency']];
	
	echo '<br>'.$queryInsert = "insert into reportTimes (
	payment, requester, 
	company, un, 
	beneficiary, 
	amount, currency, 
	requestDate, 
	voboDate, voboTime, 
	approve1Date, approve1Time, approve2Date, approve2Time, approve3Date, approve3Time, 
	provisionDate, provisionTime, releasingDate, releasingTime, scheduleDate, scheduleTime, 
	bankDate, bankTime, cancellationDate, cancellationTime, 
	totalTime, 
	fprovisionDate, fremisionDate, freceptionDate, ftreasuryDate, fstorageDate) 
	values (
	'$row[id]', '$requester', 
	'$company', '$unit', 
	'$beneficiary', 
	'$amount', '$currency', 
	'$solicitud', 
	'$vobo', '$tvobo', 
	'$aprobado1', '$tapprove1', '$aprobado2', '$tapprove2', '$aprobado3', '$tapprove3', 
	'$provision', '$tprovission', '$releasing', '$treleasing', '$schedule', '$tschedule', 
	'$bank', '$tbank', '$cancellation', '$tcancellation', 
	'$tglobal', 
	'$rprov', '$dRem', '$dRec', '$dEnt', '$dAlm')";
	$resultInsert = mysqli_query($con, $queryInsert);
	
	echo '<br>'.$queryUpt = "update payments set rtimes='1' where id = '$row[id]'";
	$resultUpt = mysqli_query($con, $queryUpt); 
	echo '<br>';
}

?>
<script>
    setTimeout(() => {
        location.reload(true);
    }, 5000);
</script>