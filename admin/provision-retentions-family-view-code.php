<?php 

include('session-provision.php');

$id = $_POST['id'];
$userid = $_SESSION['userid']; 

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$payment = $row['payment'];
$billretid = $_POST['billretid'];
$billrettype = $_POST['billrettype'];

##########new info

$id = $_POST['paymentadj'];
$fpayment = numberFormat($_POST['floatpayment']);
$currency = $_POST['floatcurrency']; 
$ret1 = $_POST['retention1'];
$ret1a = numberFormat($_POST['retention1ammount']);
$ret2 = $_POST['retention2'];
$ret2a = numberFormat($_POST['retention2ammount']);
$acp = $_POST['retainer2'];
$acp2 = $_POST['retainer3'];

//Bill
$bill = $_POST['bill'];
$billid = $_POST['billid'];
$letters = $_POST['letters'];
$stotal = $_POST['stotal'];
$stotal2 = $_POST['stotal2'];
$tax = $_POST['tax'];
$exempt = $_POST['exempt'];
$billdate = $_POST['billdate'];
$billdate2 = $_POST['billdate2'];
$ammount = $_POST['ammount'];
$billret1a = $_POST['ret1a'];
$billret2a = $_POST['ret2a']; 

//GET PAYMENT INFORMATION
$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$paymentcurrency = $rowpayment['currency'];

//Start Billing write or Update
$ammount = $_POST['ammount'];
$stotal2 = $_POST['stotal2'];

$edits = 0;

for($i=0;$i<sizeof($billretid);$i++){
	
	$querybill = "select ret2 from bills where id = '$billretid[$i]'";
	$resultbill = mysqli_query($con, $querybill);
	$rowbill = mysqli_fetch_array($resultbill);
	
	$billtypevalues = explode(",", $billrettype[$i]);  
	//echo "---".$billtypevalues[1].'+'.$rowbill['ret2']."---";
	if(($billtypevalues[1] != $rowbill['ret2'])){
		$edits++;
		//comprobamos si el pago ya esta pagado
		if(($row['status'] == 13) or ($row['status'] == 14)){
			echo "<script>alert('No se puede cambiar la alicuota de una solicitud que ya ha sido pagada');history.go(-1);</script>";
			exit();
		}else{
			
			################################start
			
			$billdate[$i] = date("Y-m-d", strtotime($billdate[$i]));
			$billdate2[$i] = date("Y-m-d", strtotime($billdate2[$i]));
			$tc = 1;
			if($paymentcurrency == 2){
				$querytc = "select * from tc where today = '$billdate[$i]'";
				$resulttc = mysqli_query($con, $querytc);
				$rowtc = mysqli_fetch_array($resulttc); 
				$tc = $rowtc['tc'];
			} 
			
			//Bills
			
			$nfbillpayment = 0; 
			$nfammount = numberFormat($ammount[$i]); 
			$nfstotal = numberFormat($stotal[$i]);
			$nfstotal2 = numberFormat($stotal2[$i]);
			$nftax = numberFormat($tax[$i]);
			
			$nfintur = numberFormat($inturammount[$i]);
			$nfinturammount = numberFormat($inturammount2[$i]);
			$nfexempt = numberFormat($exempt[$i]);
			
			//Retentions
			$nfftotal1 = numberFormat($billret1a[$i]);
			$nfftotal2 = numberFormat($billret2a[$i]); 
			
			$nfbillpayment = numberFormat($ammount[$i])-numberFormat($billret1a[$i])-numberFormat($billret2a[$i]);
			
			//NIO
			$nfnioammount = $nfammount*$tc;
			$nfniostotal = $nfstotal*$tc;
			$nfniostotal2 = $nfstotal2*$tc;
			$nfniotax = $nftax*$tc;
			$nfniointurammount = $nfinturammount*$tc;
			$nfniobillpayment = $nfbillpayment*$tc;
	
			//If Bill-id Exist 
			$querybillarray[] = "update bills set billpayment='$nfbillpayment', ret1='$ret1', ret1a='$nfftotal1', ret2='$billtypevalues[1]', ret2a='$nfftotal2', niobillpayment='$nfniobillpayment' where id = '$billretid[$i]'";
	  
			################################end
		}
	}else{
		$querybillarray[] = "update bills set retfamily='$billtypevalues[0]' where id = '$billretid[$i]'";
		$updates++;
	}
	
}

//echo 'Edirts count: '.$edits;

if($edits > 0){ 

	//Cuando se altera la alicuota
	for($q=0;$q<sizeof($querybillarray);$q++){
		$querybillarray[$q];
		$resultbillarray = mysqli_query($con, $querybillarray[$q]);
		
		//READ NOTES 
		$totalnotes = 0;
		$querynotes = "select * from notes where payment = '$id'";
		$resultnotes = mysqli_query($con, $querynotes);
		while($rownotes=mysqli_fetch_array($resultnotes)){
			$totalnotes += $rownotes['ammount'];
		}

		$finalpayment = $fpayment-$totalnotes;
		
		$nret2 = getRet2($id);
		$nret2a = getRet2a($id);

		$querypayment = "update payments set payment='$finalpayment', ret1='$ret1', ret1a='$ret1a', ret2='$nret2', ret2a='$nret2a', acp='$acp', acp2='$acp2', retfamily='1' where id = '$id'";
		$resultupdate = mysqli_query($con, $queryupdate);
	}

}else{

	//Cuando no se altera el monto a pagar
	for($q=0;$q<sizeof($querybillarray);$q++){
		
		$querybillarray[$q];
		$resultbillarray = mysqli_query($con, $querybillarray[$q]);
		
		$querypayment = "update payments set retfamily='1' where id = '$id'";
		$resultpayment = mysqli_query($con, $querypayment);
		
	}
}



$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$gcomments = "Se ha reparado la Familia de Retenciones."; 

$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.05', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);

header("location: provision-retentions-family.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}   

function getRet2($id){
	$inc = 0;
	$queryg = "select ret2 from bills where payment = '$id'";
	$resultg = mysqli_query($con, $queryg);
	while($rowg = mysqli_fetch_array($resultg)){
		if($inc == 0){
			$percentage = $rowg['ret2'];
		}
		if($rowg['ret2'] != $percentage){
			$percentage = "999999999";
		}
		
		$inc++; 
	}
	
	return $percentage;
}
function getRet2a($id){
	$queryg1 = "select sum(ret2a) from bills where payment = '$id'";
	$resultg1 = mysqli_query($con, $queryg1);
	$rowg1 = mysqli_fetch_array($resultg1);
	
	return $rowg1[0];
}

?>