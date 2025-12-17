<?php 

include("session-provision.php"); 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = $_POST['paymentadj'];
$payment = numberFormat($_POST['floatpayment']);
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
for($c = 0; $c < sizeof($ammount); $c++){ 
			
			$billdate[$c] = date("Y-m-d", strtotime($billdate[$c]));
			$billdate2[$c] = date("Y-m-d", strtotime($billdate2[$c]));
			
			$tc = 1;
			if($paymentcurrency == 2){
				$querytc = "select * from tc where today = '$billdate[$c]'";
				$resulttc = mysqli_query($con, $querytc);
				$rowtc = mysqli_fetch_array($resulttc); 
				$tc = $rowtc['tc'];
			} 
			
			//Bills
			
			$nfbillpayment = 0; 
			$nfammount = numberFormat($ammount[$c]); 
			$nfstotal = numberFormat($stotal[$c]);
			$nfstotal2 = numberFormat($stotal2[$c]);
			$nftax = numberFormat($tax[$c]);
			
			$nfintur = numberFormat($inturammount[$c]);
			$nfinturammount = numberFormat($inturammount2[$c]);
			$nfexempt = numberFormat($exempt[$c]);
			
			
			
			//Retentions
			$nfftotal1 = numberFormat($billret1a[$c]);
			$nfftotal2 = numberFormat($billret2a[$c]); 
			
			$nfbillpayment = numberFormat($ammount[$c])-numberFormat($billret1a[$c])-numberFormat($billret2a[$c]);
			
			//NIO
			$nfnioammount = $nfammount*$tc;
			$nfniostotal = $nfstotal*$tc;
			$nfniostotal2 = $nfstotal2*$tc;
			$nfniotax = $nftax*$tc;
			$nfniointurammount = $nfinturammount*$tc;
			$nfniobillpayment = $nfbillpayment*$tc;
	
		
//If Bill-id Exist 
$query1 = "update bills set billpayment='$nfbillpayment', ret1='$ret1', ret1a='$nfftotal1', ret2='$ret2', ret2a='$nfftotal2', niobillpayment='$nfniobillpayment' where id = '$billid[$c]'";  
$result1 = mysqli_query($con, $query1);  

}
	
//READ NOTES 
$totalnotes = 0;
$querynotes = "select * from notes where payment = '$id'";
$resultnotes = mysqli_query($con, $querynotes);
while($rownotes=mysqli_fetch_array($resultnotes)){
	$totalnotes += $rownotes['ammount'];
}

$finalpayment = $payment-$totalnotes;

//UPDATE PAYMENT INFORMATION
$querypayment = "update payments set payment='$finalpayment', ret1='$ret1', ret1a='$ret1a', ret2='$ret2', ret2a='$ret2a', acp='$acp', acp2='$acp2' where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);

//Inset Time
$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.06', 'Ajuste de Retenciones')";
$result2 = mysqli_query($con, $query2); 

header("location: ".$_SERVER['HTTP_REFERER']);

 


function numberFormat($unformatedNumber){ 
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}

 
?>