<?php 

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noAdmin,noIVA");	 
}

$now = date('Y-m-d'); 

include('functions.php');


$xlsRow = 2;
$today = date('Y-m-d');  
$totime = date('H:i:s');

$xlsRow = 2;
$query = "select payments.id, payments.description, payments.provider, payments.currency, bills.id as billId, bills.number, bills.stotal, bills.ammount, bills.tax, bills.billdate, times.userid from bills inner join payments on bills.payment = payments.id inner join times on payments.id = times.payment where payments.approved = '1' and bills.tax > 0 and payments.btype = '1' and (times.stage = '8.00' or times.stage = '8.04' or times.stage = '8.05' or times.stage = '8.06') and (payments.currency = '1' or payments.currency = '2') and times.today >= '2022-05-01' group by bills.id";
$result = mysqli_query($con, $query);       
while($row=mysqli_fetch_array($result)){
	
	$queryProvider = "select ruc, name from providers where id = '$row[provider]'";
	$resultProvider = mysqli_query($con, $queryProvider);
	$rowProvider = mysqli_fetch_array($resultProvider);
	
	$queryProvisioner = "select code, first, last from workers where code = '$row[userid]'";
	$resultProvisioner = mysqli_query($con, $queryProvisioner);
	$rowProvisioner = mysqli_fetch_array($resultProvisioner);
	$thisProvisioner = $rowProvisioner['code'].' | '.$rowProvisioner['first'].' '.$rowProvisioner['last'];
	
	$billDate = date('d-m-Y',strtotime($row['billdate']));
	
	$thisTax = $row['tax'];
	$thisAmount = $row['stotal'];
	$thisAmount2 = $row['ammount'];
	if($row['currency'] == 2){
		
		$queryTc = "select tc from tc where today = '$row[billdate]'";
		$resultTc = mysqli_query($con, $queryTc);
		$rowTc = mysqli_fetch_array($resultTc);
		
		$thisTax = $thisTax*$rowTc['tc'];
		$thisAmount = $thisAmount*$rowTc['tc'];
		$thisAmount2 = $thisAmount2*$rowTc['tc'];
		
	} 
	
	$queryInsert = "insert into taxCredit (today, totime, payment, bill, type, userid, status) values ('$today', '$totime', '$row[id]', '$row[billId]', '1', '$row[userid]', '1')";
	$resultInsert = mysqli_query($con, $queryInsert);
	
}


?>