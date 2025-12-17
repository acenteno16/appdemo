<?php 

include("session-admin.php"); 

$id = $_POST['id'];
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$unitid = $_POST['unitid']; 
$active = $_POST['active'];
$nid = $_POST['nid'];
$code = $_POST['code'];

$query = "select code from workers where id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$queryUpdate = "update workers set first='$first', last='$last', email='$email', unitid='$unitid', active='$active', nid='$nid' where id='$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

if(($code != $row['code']) and ($code != '') and ($code != ' ') and ($code != null)){
	
	$updateThis = 0;
	
	$queryCheck = "select id from workers where code='$code'";
	$resultCheck = mysqli_query($con, $queryCheck);
	$numCheck = mysqli_num_rows($resultCheck);
	
	if($numCheck > 0){
		#err
		echo '<script>alert("Ya existe un colaborador con el codigo '.$code.'");history.go(-1);</script>'; 
		exit();
	}else{
		$updateThis = 1;
	}
	
	$queryCheck2 = "select id from payments where userid='$row[code]'";
	$resultCheck2 = mysqli_query($con, $queryCheck2);
	$numCheck2 = mysqli_num_rows($resultCheck2);
	
	if($numCheck2 > 0){
		#err
		echo '<script>alert("Existen pagos relacionados al codigo '.$code.'"); history.go(-1);</script>'; 
		exit();
	}else{
		$updateThis = 1;
	}
	
	if($updateThis == 1){
		$queryUpdate = "update workers set code='$code' where id='$id'";
		$resultUpdate = mysqli_query($con, $queryUpdate);
		
		$COLUMNS = array(
			array('TABLE_NAME' => 'approvecomments'),
			array('TABLE_NAME' => 'audit_log'),
			array('TABLE_NAME' => 'authorizedtimes'),
			array('TABLE_NAME' => 'bankingDebt'),
			array('TABLE_NAME' => 'bankingDebtBalance'),
			array('TABLE_NAME' => 'bankingDebtContractBalance'),
			array('TABLE_NAME' => 'bankingDebtContractExtensions'),
			array('TABLE_NAME' => 'bankingDebtContractParentBalance'),
			array('TABLE_NAME' => 'bankingDebtContracts'),
			array('TABLE_NAME' => 'bankingDebtTimes'),
			array('TABLE_NAME' => 'bankingDebtTransactions'),
			array('TABLE_NAME' => 'banksalias'),
			array('TABLE_NAME' => 'beneficiaries'),
			array('TABLE_NAME' => 'blines'),
			array('TABLE_NAME' => 'clients'),
			array('TABLE_NAME' => 'clientstimes'),
			array('TABLE_NAME' => 'cnotificationTimes'),
			array('TABLE_NAME' => 'development'),
			array('TABLE_NAME' => 'filescomments'),
			array('TABLE_NAME' => 'filestimes'),
			array('TABLE_NAME' => 'followupComments'),
			array('TABLE_NAME' => 'followupLog'),
			array('TABLE_NAME' => 'funds'),
			array('TABLE_NAME' => 'fundstimes'),
			array('TABLE_NAME' => 'halls'),
			array('TABLE_NAME' => 'hallsbook'),
			array('TABLE_NAME' => 'hallsbooknotifications'),
			array('TABLE_NAME' => 'hallsremission'),
			array('TABLE_NAME' => 'hallsremissiontimes'),
			array('TABLE_NAME' => 'hallsretention'),
			array('TABLE_NAME' => 'hallsretentionVer'),
			array('TABLE_NAME' => 'hallsretention_2oct2017'),
			array('TABLE_NAME' => 'hcTemplates'),
			array('TABLE_NAME' => 'hcfiles'),
			array('TABLE_NAME' => 'internstimes'),
			array('TABLE_NAME' => 'ir'),
			array('TABLE_NAME' => 'irremission'),
			array('TABLE_NAME' => 'irremissiontimes'),
			array('TABLE_NAME' => 'irtimes'),
			array('TABLE_NAME' => 'letters'),
			array('TABLE_NAME' => 'letterstimes'),
			array('TABLE_NAME' => 'mayor'),
			array('TABLE_NAME' => 'mayorremission'),
			array('TABLE_NAME' => 'mayortimes'),
			array('TABLE_NAME' => 'news'),
			array('TABLE_NAME' => 'newsread'),
			array('TABLE_NAME' => 'notes'),
			array('TABLE_NAME' => 'notifications'),
			array('TABLE_NAME' => 'nternstimes'),
			array('TABLE_NAME' => 'packages'),
			array('TABLE_NAME' => 'packagestimes'),
			array('TABLE_NAME' => 'payments'),
			array('TABLE_NAME' => 'paymentsRecords'),
			array('TABLE_NAME' => 'providers_excel'),
			array('TABLE_NAME' => 'providerstimes'),
			array('TABLE_NAME' => 'provisionfilestimes'),
			array('TABLE_NAME' => 'refundCommissions'),
			array('TABLE_NAME' => 'retentionenveloperemission'),
			array('TABLE_NAME' => 'retentionenvelopetimes'),
			array('TABLE_NAME' => 'retentionremission'),
			array('TABLE_NAME' => 'retfamily'),
			array('TABLE_NAME' => 'retfamilycontent'),
			array('TABLE_NAME' => 'schedule'),
			array('TABLE_NAME' => 'scheduletimes'),
			array('TABLE_NAME' => 'senttimes'),
			array('TABLE_NAME' => 'standby'),
			array('TABLE_NAME' => 'taxCredit'),
			array('TABLE_NAME' => 'templates'),
			array('TABLE_NAME' => 'templatesexpenses'),
			array('TABLE_NAME' => 'templatesexpensescontent'),
			array('TABLE_NAME' => 'times'),
			array('TABLE_NAME' => 'times_millions'),
			array('TABLE_NAME' => 'timesrepair'),
			array('TABLE_NAME' => 'timesrepair2'),
			array('TABLE_NAME' => 'unitstimes'),
			array('TABLE_NAME' => 'approvecomments'),
			array('TABLE_NAME' => 'authorizedtimes'),
			array('TABLE_NAME' => 'bankingDebt'),
			array('TABLE_NAME' => 'bankingDebtBalance'),
			array('TABLE_NAME' => 'bankingDebtContractBalance'),
			array('TABLE_NAME' => 'bankingDebtContractExtensions'),
			array('TABLE_NAME' => 'bankingDebtContractParentBalance'),
			array('TABLE_NAME' => 'bankingDebtContracts'),
			array('TABLE_NAME' => 'bankingDebtTimes'),
			array('TABLE_NAME' => 'bankingDebtTransactions'),
			array('TABLE_NAME' => 'banksalias'),
			array('TABLE_NAME' => 'beneficiaries'),
			array('TABLE_NAME' => 'blines'),
			array('TABLE_NAME' => 'clients'),
			array('TABLE_NAME' => 'clientstimes'),
			array('TABLE_NAME' => 'cnotificationTimes'),
			array('TABLE_NAME' => 'development'),
			array('TABLE_NAME' => 'filesAdditional'),
			array('TABLE_NAME' => 'filescomments'),
			array('TABLE_NAME' => 'filestimes'),
			array('TABLE_NAME' => 'followupComments'),
			array('TABLE_NAME' => 'followupLog'),
			array('TABLE_NAME' => 'funds'),
			array('TABLE_NAME' => 'fundstimes'),
			array('TABLE_NAME' => 'halls'),
			array('TABLE_NAME' => 'hallsbook'),
			array('TABLE_NAME' => 'hallsbooknotifications'),
			array('TABLE_NAME' => 'hallsremission'),
			array('TABLE_NAME' => 'hallsremissiontimes'),
			array('TABLE_NAME' => 'hallsretention'),
			array('TABLE_NAME' => 'hallsretentionVer'),
			array('TABLE_NAME' => 'hallsretention_2oct2017'),
			array('TABLE_NAME' => 'hcTemplates'),
			array('TABLE_NAME' => 'hcfiles'),
			array('TABLE_NAME' => 'internstimes'),
			array('TABLE_NAME' => 'ir'),
			array('TABLE_NAME' => 'irremission'),
			array('TABLE_NAME' => 'irremissiontimes'),
			array('TABLE_NAME' => 'irtimes'),
			array('TABLE_NAME' => 'letters'),
			array('TABLE_NAME' => 'letterstimes'),
			array('TABLE_NAME' => 'mayor'),
			array('TABLE_NAME' => 'mayorremission'),
			array('TABLE_NAME' => 'mayortimes'),
			array('TABLE_NAME' => 'news'),
			array('TABLE_NAME' => 'newsread'),
			array('TABLE_NAME' => 'notes'),
			array('TABLE_NAME' => 'notifications'),
			array('TABLE_NAME' => 'nternstimes'),
			array('TABLE_NAME' => 'packages'),
			array('TABLE_NAME' => 'packagestimes'),
			array('TABLE_NAME' => 'payments'),
			array('TABLE_NAME' => 'paymentsRecords'),
			array('TABLE_NAME' => 'providers_excel'),
			array('TABLE_NAME' => 'providerstimes'),
			array('TABLE_NAME' => 'provisionfilestimes'),
			array('TABLE_NAME' => 'refundCommissions'),
			array('TABLE_NAME' => 'retentionenveloperemission'),
			array('TABLE_NAME' => 'retentionenvelopetimes'),
			array('TABLE_NAME' => 'retentionremission'),
			array('TABLE_NAME' => 'retfamily'),
			array('TABLE_NAME' => 'retfamilycontent'),
			array('TABLE_NAME' => 'schedule'),
			array('TABLE_NAME' => 'scheduletimes'),
			array('TABLE_NAME' => 'senttimes'),
			array('TABLE_NAME' => 'standby'),
			array('TABLE_NAME' => 'taxCredit'),
			array('TABLE_NAME' => 'templates'),
			array('TABLE_NAME' => 'templatesexpenses'),
			array('TABLE_NAME' => 'templatesexpensescontent'),
			array('TABLE_NAME' => 'times'),
			array('TABLE_NAME' => 'times_millions'),
			array('TABLE_NAME' => 'timesrepair'),
			array('TABLE_NAME' => 'timesrepair2'),
			array('TABLE_NAME' => 'unitstimes'),
			array('TABLE_NAME' => 'workersTimes')
		);

		foreach ($COLUMNS as $trows) {
			
			$table = $trows['TABLE_NAME'];
			$queryUpdate = "UPDATE `$table` SET userid = '$code' WHERE userid = '$row[code]'";
			$resultUpdate = mysqli_query($con, $queryUpdate); 
 
		}
		
		$queryTimes = "insert workersTimes (today, totime, userid, changes) values ('$today', '$totime', '$_SESSION[userid]', 'Codigo: $row[code] | $code')";
		$resultTimes = mysqli_query($con, $queryTimes);
		
	}

}
 
header("location: ".$_SERVER['HTTP_REFERER']);

?>