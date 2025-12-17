<? 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../connection.php';
require 'fn-expirated.php';
require 'functions.php';
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

//Notificaciones a aprobados.
$query = "select * from routes where ((type = '2') or (type = '3') or (type = '4')) group by worker";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$queryworker = "select * from workers where code = '$row[worker]'";
	$resultworker = mysqli_query($con, $queryworker);
	$rowworker = mysqli_fetch_array($resultworker);
	$workername = $rowworker['first']." ".$rowworker['last'];	
	$workeremail = $rowworker['email'];  
	
	$queryu = "select * from routes where worker = '$row[worker]' and (type = '2' or type = '3' or type = '4')";
	$resultu = mysqli_query($con, $queryu);
	$numu = mysqli_num_rows($resultu); 
	
	if($numu > 0 ){
		$firstu = 1; 
		while($rowu=mysqli_fetch_array($resultu)){
										$rowutype = intval($rowu['type']);
										 $rowutype = $rowutype-1;
										
										if($firstu == 1){ //First
											$sqlu = " and (((payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
											$firstu++;
										}
									} 
									
		$today = date('Y-m-d');							
		$querybefore1 = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.expiration, payments.route, payments.headship, payments.status, payments.sent_approve, payments.immediate, payments.today, payments.approved from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.approved != '2' and payments.status >= '1' and payments.status < '14' and payments.approved != '2' and payments.status != '13' and payments.expiration <= '$today'".$sqlu." group by payments.id order by payments.status asc, payments.expiration asc";
		
		$resultbefore1 = mysqli_query($con, $querybefore1); 
		$numbefore1 = mysqli_num_rows($resultbefore1); 
		$ids= "";
		$string = "";
		$numbefore2 = 0;
		if($numbefore1 > 0){
			while($rowbefore1=mysqli_fetch_array($resultbefore1)){
				$payment_expiration = date('d-m-Y', strtotime($rowbefore1['expiration']));
				
				//DESDE AQUI LO NUEVO
				
				if($rowbefore1['expiration'] != '0000-00-00'){
							
					$date1 = date("Y-m-d");
					$date2 = date('d-m-Y',strtotime($rowbefore1['expiration']));
					$dias	= (strtotime($date1)-strtotime($date2))/86400; 
					$dias2	= (strtotime($rowbefore1['today'])-strtotime($date2))/86400;
					if($dias <= -8) $payment_expiration.=' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
					if(($dias <= 0) and ($dias >= -7)) $payment_expiration.=' <span style="color:#FC0">('.abs($dias).")</span>"; 
					elseif($dias > 0) $payment_expiration.=' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
				} 
				
				$venc = intval(-1*abs($dias));
				$payment_expiration2= 'No';
				if($rowbefore1['expiration'] <= $rowbefore1['today']){
					$payment_expiration2= 'Si';
				}
								
					
				
				
				//HASTA AQUI 
				
				if($rowbefore1['route'] > 0){
				
				$ben_name = getBen($rowbefore1['parent'], $rowbefore1['btype'], $rowbefore1['provider'], $rowbefore1['collaborator'], $rowbefore1['intern'], $rowbefore1['client']);
				
				$cc = 0;
				if(($rowbefore1['sent_approve'] == 1) or ($rowbefore1['immediate'] == 1)){
					$cc = 1;
				}
				
				$thestatus = $rowbefore1['status'];
				if(($thestatus >= 2) and ($thestatus <= 4) and ($rowbefore1['approved'] == 1)){
					$thestatus = 8;
				}
				$payment_status = nextStage($thestatus,$rowbefore1['route'],$rowbefore1['headship'],$cc);
				
					
					$string.= "<tr>
        		      <td>$rowbefore1[id]</td>
        		      <td>$ben_name</td>
					  <td>$payment_status</td>
        		      <td>$payment_expiration</td>
					  <td>$payment_expiration2</td>
      		      	</tr>";
					$numbefore2++; 
				}
							
			}
		if($numbefore2 > 0){
		
			//		
			fnExpirated($workername,$workeremail,$numbefore2,$string);
			
		}
				
	
		} 
	}

}


?>