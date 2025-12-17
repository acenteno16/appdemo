<? 

include("session-schedule.php");
require('functions.php');

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;
$gIr = isset($_GET['gIr']) ? sanitizeInput(intval($_GET['gIr']), $con) : 0;
$gImi = isset($_GET['gImi']) ? sanitizeInput(intval($_GET['gImi']), $con) : 0;

$querypayment = "select id, ret1a, ret2a, hall, company from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

if($gImi == 1){
	
	require_once('imiGenerator.php');
	
	$queryHall = "select active from halls where id = '$rowpayment[hall]'";
	$resultHall = mysqli_query($con, $queryHall);
	$rowHall = mysqli_fetch_array($resultHall);
				
	#generamos retencion imi si existe y si está activa la sucursal
	if(($rowpayment['ret1a'] > 0) and ($rowHall['active'] == 1)){
		createIMIRetention($rowpayment['id'], '0', '0'); 
	}
	
}


if($gIr == 1){

	$queryCompany = "select id, iractive from companies where id = '$row[company]'";
	$resultCompany = mysqli_query($con, $queryCompany);
	$rowCompany=mysqli_fetch_array($resultCompany);
	$irActive = $rowCompany['iractive'];
	
	if($irActive == 1){
		
		require_once('pdf-ir-single.php');
		
		#Anulacion de retenciones ir anteriores
		$voidtoday = date('Y-m-d');
	
		#Anulacion IR
		$queryIrCheck = "select id from irretention where payment = '$id' and void = '0'";
		$resultIrCheck = mysqli_query($con, $queryIrCheck);
		$numIrCheck = mysqli_num_rows($resultIrCheck);
		if($numIrCheck > 0){
		
			while($rowIrCheck=mysqli_fetch_array($resultIrCheck)){
				$queryIrVoid = "update irretention set void='1', voidcomments='Anulada por getPay para generar una nueva.', voiduserid='999999999', voidtoday='$voidtoday' where id = '$rowIrCheck[id]'"; 
				$resultIrVoid = mysqli_query($con, $queryIrVoid);
			}
	
		}	

		//IR Rets
		$sqlret2 = "";
    	$idretstr = "";

    	if(($rowpayment['ret2a'] > 0)){
		
			$thisToday = date('Y-m-d');
        	$queryauth = "select id from authorized where company = '$company' and '$thisToday' >= today order by id desc limit 1";
        	$resultauth = mysqli_query($con, $queryauth);
			$rowauth = mysqli_fetch_array($resultauth);
			$authorized = $rowauth['id'];
                    
			//Mandamos a anular cualquier retencion que halla sido creada anteriormente
			$gid = "Nueva retencion generada por manual.";
			$queryvoid = "update irretention set void='1' and voidcomments='$gid' where payment = '$rowpayment[id]' and void = '0'"; 
			$resultvoid = mysqli_query($con, $queryvoid);
			
			$querydocs = "select * from bills where payment = '$rowpayment[id]' and ret2a > '0' group by ret2";
			$resultdocs = mysqli_query($con, $querydocs);
			while($rowdocs=mysqli_fetch_array($resultdocs)){
			
				//leer el ultimo id2
				$querycompany2 = "select number from irretention where company = '$company' order by id desc limit 1";
				$resultcompany2 = mysqli_query($con, $querycompany2);
				$rowcompany2 = mysqli_fetch_array($resultcompany2);
				$number = $rowcompany2['number'];
					
				//Sumarle uno para obeter el nuevo numero
				$number = $number+1;

				$strdocuments = "";
				$querydocscontent = "select * from bills where payment = '$rowpayment[id]' and ret2a > '0' and ret2 = '$rowdocs[ret2]'";
				$resultdocscontent = mysqli_query($con, $querydocscontent);
				$numdocscontent = mysqli_num_rows($resultdocscontent);
				while($rowdocscontent=mysqli_fetch_array($resultdocscontent)){ 
					$strdocuments.=$rowdocscontent['id'].",";
		
				} 
				
				if($numdocscontent > 0){
				
					$strdocuments = substr($strdocumentsr, 0, -1);
			
				}
				
				$queryret = "insert into irretention (today, now, payment, company, number, bills, authorized) values ('$today', '$now', '$rowpayment[id]', '$company', '$number', '$strdocuments', '$authorized')"; 
				$resultret = mysqli_query($con, $queryret); 
				$idret = mysqli_insert_id($con);
				$idretstr.= $idret.",";
				$sqlret2 = ", irstage = '1'"; 
				$idretstr = substr($idretstr, 0, -1);
			
			//Aca creamos la retencion.
			makeRetention($rowpayment['id'],0,$con);
	
			}
			//Si no hay un mon to de retencion IR
		}
	else{
		$idret = 0;
	}
		
	}
	
	
}

#$notesRep = "Pago reparado no se genero la etapa de ingreso a banco."; 
#$query2 = "insert into times (payment, today, now, now2, userid, stage, comment, stage2) values ('$id', '$today', '$now', '$now2', 'GETPAY', '$thestage', '$notesRep', 'Pago reparado')"; 
#$result2 = mysqli_query($con, $query2); 

header('location: '.$_SERVER['HTTP_REFERER']); 

?>