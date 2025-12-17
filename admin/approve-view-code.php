<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include('session-approve.php');
require('fn-relative.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 
include('function-getnext.php');
include('fn-rejection.php');
require('sanitize.php');

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//Get vars
$userid = $_SESSION['userid'];
$id = $_GET['id'];

#$approve = isset($_GET['approve']) ? sanitizeInput($_GET['approve'], $con) : '';
#$approve = isset($_GET['reason']) ? sanitizeInput($_GET['reason'], $con) : '';
#$approve = isset($_GET['reason2']) ? sanitizeInput($_GET['reason2'], $con) : '';

if(isset($_GET['approve'])) $approve = $_GET['approve']; 
if(isset($_GET['reason'])) $reason = $_GET['reason'];
if(isset($_GET['reason2'])) $reason2 = $_GET['reason2'];
$chain = '';

//El pago debe de tener aprobado o reprobado
if($approve == 0){
	exit("<script>alert('Debe de seleccionar una opcion de aprobado.')</script>");
}

//Leemos el tipo de cambio a la fecha 
$querytc = "select * from tc where today = '$today'";
$resulttc = mysqli_query($con, $querytc);
$rowtc = mysqli_fetch_array($resulttc);
$tc = $rowtc['tc'];

//For (Array de pagos)
for($c=0;$c<sizeof($id);$c++){ 

 
	$id_int = isset($id[$c]) ? intval($id[$c]) : 0;
	$chain_arr = explode(',', $chain);
	if(!in_array($id_int, $chain_arr)){
		
		if((fnRelative($id_int) == true) or ($_SESSION["dch"] == "active")){
		
		//Get the last transaction User
		$querylasttime  = $con->prepare("select * from times where payment = ? order by id desc limit 1");
		$querylasttime->bind_param("i", $id_int);
		$querylasttime->execute();
		$resultlasttime = $querylasttime->get_result();
		$rowlasttime = mysqli_fetch_array($resultlasttime);
			
		//Cancel action if is the same user
		if(($rowlasttime['userid'] == $_SESSION['userid']) and ($rowlasttime['stage'] >= 2) and ($_SESSION["dch"] != "active")){  
				?>
    			<script>
    			alert('No se puede realizar la gestion debido a que el ultimo registro encontrado es del mismo usuario.');
				window.location = "approve.php"; 
    			</script>
    			<?php exit(); 
		}
		
		$querypayment = $con->prepare("select * from payments where id = ?");
		$querypayment->bind_param("i", $id_int);
		$querypayment->execute();
		$resultpayment = $querypayment->get_result();
		$numpayment = $resultpayment->num_rows;
		$rowpayment = mysqli_fetch_array($resultpayment);
		
		
		//Leemos los timepos para asegurarnos de que esta solicitud de aprobacion no halla procesado este ID de solicitud de pago.
		$querypayment2 = $con->prepare("select * from times where payment = ? and now = '$now'");
		$querypayment2->bind_param("i", $id_int);
		$querypayment2->execute();
		$resultpayment2 = $querypayment2->get_result();
		$numpayment2 = $resultpayment2->num_rows;
		
		if($numpayment2 == 0){
			
			//Leemos el estado del pago 
			$status = $rowpayment['status']; 
			$gcomments2 = 0;
            
			if(($status == 1) or ($status == 2) or ($status == 3)){           
						
				############################################################			
				#    												       #	
				#	####   #####  #####  #####	 ####  ##### #####  ###    #
				#	#   #  #	     #   #      #        #   #      #  #   #
				#	####   #####     #   #####  #        #   #####  #   #  #
				#	#  #   #         #   #      #        #   #      #  #   #
				#   #   #  #####  ###    #####   ####    #   #####  ###    #
				#													       #    
				############################################################

				//Si el pago no es aprobado
				if($approve[$c] == 2){
	
	
					switch($status){
						case 1:
							$newstatustime = 5;
							break;
						case 2:
							$newstatustime = 6;
							break;
						case 3:
							$newstatustime = 7;
							break;	
					} 
	
					// Prepara la consulta
					$queryReject = $con->prepare("UPDATE payments SET status = ?, approved = '2' WHERE id = ?");
					$queryReject->bind_param("ii", $newstatustime, $id_int);
					$resultReject = $queryReject->execute();
					$gcomments = $comments;
					
					$gcomments = "El pago ha sido rechazado.";	
					$queryTime = $con->prepare("insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$queryTime->bind_param("issssssss", $id_int,$today,$now,$now2,$_SESSION['userid'],$newstatustime,$gcomments,$reason,$reason2);
					$resultTime = $queryTime->execute();
					
					//Multiple Rejection
					$query_multiple  = $con->prepare("select id from payments where child = ?");
					$query_multiple ->bind_param("i", $id_int);
					$query_multiple ->execute();
					$result_multiple = $query_multiple->get_result();
					while($row_multiple = mysqli_fetch_array($result_multiple)){
						
						//Aqui rechazamos todos los hijos.
						$queryRejectChild = $con->prepare("update payments set approved='2', status=?, reason=? where id = ?");
						$queryRejectChild->bind_param("isi", $newstatustime, $reason2, $row_multiple['id']);
						$resultRejectChild = $queryRejectChild->execute();
						$gcomments = "Rechazado en Aprobado.";
						
						$queryRejectChildTimes = $con->prepare("insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$queryRejectChildTimes->bind_param("issssisss", $row_multiple['id'],$today,$now,$now2,$_SESSION['userid'],$newstatustime,$gcomments,$reason,$reason2);
						$resultRejectChildTimes = $queryRejectChildTimes->execute();
						
					}
				
					fnReject($id_int,$_SESSION['userid']);  

				} 

				#############################################################
				#   											            #
				#   ####   ####   ####   ####    ###   #  #  #####  ###     #
				#   #   #  #   #  #   #  #   #  #   #  #  #  #      #  #    #
				#   #####  ####   ####   ####   #   #  # #   #####  #   #   #
				#   #   #  #      #      #  #   #   #  ##    #      #  #    #
				#   #   #  #      #      #   #   ###   #     #####  ###     #
				#													        #
				#############################################################

				//Si el pago es aprobado
				else{

					$is_approved = 1;
	
					switch($status){
							#Si el pago esta ingresado
						case 1:
							#este usuario es aprobado 1    
							$usertype = 2;
							break;
							#si el pagos esta aprobado1    
						case 2:
							$usertype = 3;
							#el usuario es aprobado2    
							break;
							#Si el pago esta aprobado2    
						case 3:
							#el usuario es aprobado3    
							$usertype = 4;
							break;
					}

					$newstatustime = $status+1; 
    
					//Perfil mas alto de la ruta del pago
					$queryroute = "select * from routes where type >= '2' and type <= '4' and unitid = '$rowpayment[routeid]' and headship = '$rowpayment[headship]' order by type desc limit 1"; 
					$resultroute = mysqli_query($con, $queryroute);
					$rowroute = mysqli_fetch_array($resultroute); 
					$routetype = $rowroute['type']; 

					//Reconocer si el proveedor es una alcaldía    
					$finalapprove = 0;  
					$isHall = 0;
					if($rowpayment['provider'] > 0){
						$queryhall = "select hall from providers where id = '$rowpayment[provider]'";
						$resulthall = mysqli_query($con, $queryhall); 
						$rowhall = mysqli_fetch_array($resulthall);
						if($rowhall['hall'] == 1){
							$isHall = 1; 
						}	
					}   
					
					if(($rowpayment['currency'] == 1) and ($tc > 0)){  
						$usdamount = $rowpayment['payment']/$tc;
					}else{
						$usdamount = $rowpayment['payment'];
					}
  
					#Comprobamos que Don Danilo es el proximo aprobado
					$isdch = 0;
					$nextroute = $newstatustime+1;
					$finalapproveReason = '';
					$finalapproveAbs = '';

					$querydch = "select * from routes where type = '$nextroute' and unitid = '$rowpayment[routeid]' and headship = '$rowpayment[headship]' order by type desc";
					$resultdch = mysqli_query($con, $querydch);
					while($rowdch=mysqli_fetch_array($resultdch)){
						if($rowdch['worker'] == '226237'){
							$isdch = 1;
						} 
					}
  
					#abs: approved by sistem
					if(($isdch == 1) and ($isHall == 1)){
						$finalapprove = 1; 
						$finalapproveAbs = ", abs='1'"; 
					}    
					
					if(($isdch == 1) and ($usdamount < 5000) and ($rowpayment['type'] != '4') and ($rowpayment['company'] != 6)){
						$finalapprove = 1; 
						$finalapproveReason = ' Monto excluye siguiente nivel de aprobaci&oacute;n.';
						$finalapproveAbs = ", abs='1'";
					}
    
					//Si la transaccion es realizada por el perfil mas alto
					if(($finalapprove == 1) or ($routetype == $usertype) or ($_SESSION["dch"] == "active")){
						
						$queryapprove = $con->prepare("update payments set status = ?, approved = '1' $finalapproveAbs where id = ?");
						$queryapprove->bind_param("ii", $newstatustime,$id_int);
						$queryapprove->execute();
						$gcomments = "Enhorabuena, el pago ha sido aprobado.".$finalapproveReason;
					
						//Retentions
						if($rowpayment['provider'] == 993){
							$queryIMI = $con->prepare("update payments set mayorstage = '2' where id = ?");
							$queryIMI->bind_param("i", $id_int);
							$queryIMI->execute();
						}
						if($rowpayment['provider'] == 994){
							$queryIR = $con->prepare("update payments set irstage = '2' where id = ?");
							$queryIR->bind_param("i", $id_int);
							$queryIR->execute();
						}

					} 
					//Si la transaccion no es realizada por el perfil mas alto.
					else{
	
						$queryApprove = $con->prepare("update payments set status = ? where id = ?");
						$queryApprove->bind_param("ii", $newstatustime,$id_int);
						$queryApprove->execute();
						$gcomments = "Esperando la siguiente aprobaci&oacute;n.";
						
					}
	
					$queryTime = $con->prepare("insert into times (payment, today, now, now2, userid, stage, comment) values (?, ?, ?, ?, ?, ?, ?)");
					$queryTime->bind_param("issssis", $id_int,$today,$now,$now2,$_SESSION['userid'],$newstatustime,$gcomments);
					$queryTime->execute();

					if(($is_approved == 1) and (($rowpayment['immediate'] == 1) or ($rowpayment['hc'] == 1))){
						getNext($id_int,$newstatustime);
					}

				}
        
				$chain.= $id_int.",";
			}
		} 
		
		}
	}   

	//End for
}

 if($_SESSION["dch"] == "active"){
	 echo "<script>window.location='approve-special.php';</script>";
 }else{
	 echo "<script>window.location='approve.php';</script>";
 } 

?>