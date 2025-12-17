<?php 

include("session-treasury.php"); 

$err = 0;
$errMsg = array();
$data = array();
$id = $_GET['id'];
$bank = $_GET['bank']; 

$thisBank = array();
$queryThisBank = "select * from banks";
$resultThisBank = mysqli_query($con, $queryThisBank);
while($rowThisBank = mysqli_fetch_array($resultThisBank)){
	
	$thisBank[$rowThisBank['id']] = $rowThisBank['name'];
	
}
$thisCurrency = array();
$queryThisCurrency = "select id, pre from currency";
$resultThisCurrency = mysqli_query($con, $queryThisCurrency);
while($rowThisCurrency = mysqli_fetch_array($resultThisCurrency)){	
	$thisCurrency[$rowThisCurrency['id']] = $rowThisCurrency['pre'];
}

$querySchedule = "select * from schedule where id= '$id'";
$resultSchedule = mysqli_query($con, $querySchedule);
$rowSchedule = mysqli_fetch_array($resultSchedule);

$querymain = "select payment from schedulecontent where schedule = '$id'"; 
$resultmain = mysqli_query($con, $querymain);
$nummain = mysqli_num_rows($resultmain);

if($bank == 1){
	
	#BAC
	
	$incrm = 0;
	$today = date('Ymd');
	$thisAmount = str_replace('.','',$rowSchedule['ammount']);
	
	
	while($rowmain=mysqli_fetch_array($resultmain)){
		
		$query = "select btype, provider, payment, company from payments where id = '$rowmain[payment]'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		
		if($incrm == 0){
			$queryPlan = "select name, inc from bankspaymentplans where bank = '1' and currency = '$rowSchedule[currency]' and company = '$row[company]'";
			$resultPlan = mysqli_query($con, $queryPlan);
			$numPlan = mysqli_num_rows($resultPlan);
			$rowPlan = mysqli_fetch_array($resultPlan);
			
			$inc = str_pad($rowPlan['inc']+1, 5, "0", STR_PAD_LEFT);
			$thePayment = str_pad($thisAmount, 13, "0", STR_PAD_LEFT);
			$lines = str_pad($nummain, 5, "0", STR_PAD_LEFT);
			
			
			$data[] = "B$rowPlan[name]$inc                        $today$thePayment$lines";
			
			
		}
		$thisPayment = str_replace('.','',$row['payment']);
		$thisPayment = str_pad($thisPayment, 13, "0", STR_PAD_LEFT);
		$incrm++;
		$queryProvider = "select name from providers where id = '$row[provider]'";
		$resultProvider = mysqli_query($con, $queryProvider);
		$rowProvider = mysqli_fetch_array($resultProvider);
		$providerName = str_replace(',','',$rowProvider[name]);
		
		
		$data[] = "T$rowPlan[name]$inc$providerCode             $incrm$today$thisPayment     Pago Velosa                    $providerName                               0155                 10002815"; 
		
	}
	
	if($err == 0){
		ob_clean();
  		flush();
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename="sample.txt"');

		$fh = fopen('php://output', 'w');
 
		foreach ($data as $row) {
			fwrite($fh,$row.PHP_EOL);
		}
		
 
		fclose($fh);
		
		#$queryScheduleUpdate = "update schedule set bankfile='1', thebank2='$bank' where id= '$id'";
		#$resultScheduleUpdate = mysqli_query($con, $queryScheduleUpdate); 

	}
	else{
		
		foreach ($errMsg as $errUnit) {
			$errStr.="- $errUnit \\n";
		}
		echo "<script>alert('$errStr');history.go(-1);</script>";
	}
	
	
	
}
elseif($bank == 6){
	
	#AVANZ
	
	$data[] = "BANCO BENEFICIARIO,MONEDA,TIPO DE PAGO,BENEFICIARIO,CUENTA,MONTO,CONCEPTO,CORREO ELECTRÓNICO,CELULAR";
	
	while($rowmain=mysqli_fetch_array($resultmain)){
	
		$query = "select btype, provider, payment, description from payments where id = '$rowmain[payment]'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		
		$billsStr = '';
		$queryBills = "select number from bills where payment = '$rowmain[payment]'";
		$resultBills = mysqli_query($con, $queryBills);
		while($rowBills = mysqli_fetch_array($resultBills)){
			$billsStr.=str_replace(',',' ',$rowBills['number'])." - ";
		}
		$billsStr = substr($billsStr,0,-3);
	 
		$queryProvider = "select name from providers where id = '$row[provider]'";
		$resultProvider = mysqli_query($con, $queryProvider);
		$rowProvider = mysqli_fetch_array($resultProvider);
	
		$queryProviderPlans = "select bank, account from providers_plans where provider = '$row[provider]'";
		$resultProviderPlans = mysqli_query($con, $queryProviderPlans);
		$rowProviderPlans = mysqli_fetch_array($resultProviderPlans);
	
		$queryAlias = "select name from banksalias where bybank = '$bank' and bank = '$rowSchedule[bank]'";
		$resultAlias = mysqli_query($con, $queryAlias);
		$rowAlias = mysqli_fetch_array($resultAlias);
	
		$providerName = str_replace(',','',$rowProvider[name]);
	
		$mcurrency = $thisCurrency[$rowSchedule[currency]];
		$data[] = "$rowAlias[name],$mcurrency,1 - Transferencia Cuenta Corriente,$providerName,$rowProviderPlans[account],$row[payment],$billsStr,,";
	
		if($row['btype'] > 1){ 
			 $err++; $errMsg[] = 'No se identific\u00F3 un proveedor en el IDS#'.$rowmain['payment']; 
		}else{
			if($row['provider'] == 0){ $err++; $errMsg[] = 'No se encotr\u00F3 proveedor para el ID'.$rowmain['payment']; }
			if($row['ammount'] == 0){ $err++; $errMsg[] = 'Monto cero en IDS#'.$rowmain['payment']; }
			if($providerName == ''){ $err++; $errMsg[] = 'No se encontr\u00F3 nombre de proveedor en IDS#'.$rowmain['payment']; }
			if($rowAlias['name'] == ''){ $err++; $errMsg[] = 'No se encontr\u00F3 al\u00EDas de banco en IDS#'.$rowmain['payment']; }
			if($rowProviderPlans['account']== ''){ $err++; $errMsg[] = 'No se encontr\u00F3 cuenta del proveedor en IDS#'.$rowmain['payment']; }
			if($rowSchedule['currency'] == '0'){ $err++; $errMsg[] = 'No se encontr\u00F3 moneda en el grupo#'.$id; }
		}
	}

	if($err == 0){
		ob_clean();
  		flush();
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="sample.csv"');

		$fh = fopen('php://output', 'w');
 
		foreach ($data as $row) {
			fwrite($fh,$row.PHP_EOL);
		}
		
 
		fclose($fh);
		
		$queryScheduleUpdate = "update schedule set bankfile='1', thebank2='$bank' where id= '$id'";
		$resultScheduleUpdate = mysqli_query($con, $queryScheduleUpdate); 

	}
	else{
		
		foreach ($errMsg as $errUnit) {
			$errStr.="- $errUnit \\n";
		}
		echo "<script>alert('$errStr');history.go(-1);</script>";
	}
}
else{
	$bankName = $thisBank[$bank];
	echo "<script>alert('No se encontro plantilla desarrollada para $bankName');history.go(-1);</script>";
	
}

?>