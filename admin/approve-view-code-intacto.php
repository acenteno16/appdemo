
<?php 
#intacto

include('session-approve.php');

require '../assets/PHPMailer/PHPMailerAutoload.php'; 
include('function-getnext.php');
include('fn-rejection.php');

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//Get vars
$userid = $_SESSION['userid'];
$id = $_GET['id'];

$approve = $_GET['approve']; 
$reason = $_GET['reason'];
$reason2 = $_GET['reason2'];

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

	$id_int = intval($id[$c]);  
	$chain_arr = explode(',', $chain);
	if(!in_array($id_int, $chain_arr)){
		
		//Get the last transaction User
		$querylasttime = "select * from times where payment = '$id_int' order by id desc limit 1";
		$resultlasttime = mysqli_query($con, $querylasttime);
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

		//Seleccionamos el pago
		$querypayment = "select * from payments where id = '$id_int'";
		$resultpayment = mysqli_query($con, $querypayment);
		$rowpayment = mysqli_fetch_array($resultpayment);
		
		
		//Leemos el estado del pago 
		$querypayment2 = "select * from times where payment = '$id_int' and now = '$now'";
		$resultpayment2 = mysqli_query($con, $querypayment2);
		$numpayment2 = mysqli_num_rows($resultpayment2);
		if($numpayment2 == 0){

			//Leemos el estado del pago 
			$status = $rowpayment['status']; 
			$gcomments2 = 0;
			$atype = $rowpayment['status'];
            
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

//Reprobar pago
$queryreject = "update payments set status = '$newstatustime', approved='$approve' where id = '$id_int'";
$resultreject = mysqli_query($con, $queryreject);
$gcomments = $comments;	

$gcomments = "El pago ha sido rechazado.";	
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id_int', '$today', '$now', '$now2', '$_SESSION[userid]', '$newstatustime', '$gcomments', '$reason', '$reason2')"; 
$resulttime = mysqli_query($con, $querytime); 
	
//Multiple Rejection
$query_multiple = "select id from payments where child = '$id_int'";
$result_multiple = mysqli_query($con, $query_multiple);
while($row_multiple = mysqli_fetch_array($result_multiple)){
	//Aqui rechazamos todos los hijos.
	
	$query_reject = "update payments set approved='2', status='$newstatustime', reason='$reason2' where id = '$row_multiple[id]'";
	$result_reject = mysqli_query($con, $query_reject);
	$gcomments = "Rechazado en Provisión.";

	//time stage 
	$querytime_reject = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$row_multiple[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '$newstatustime', '$gcomments', '$reason', '$reason2')"; 
	$resulttime_reject = mysqli_query($con, $querytime_reject); 
	
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
	
switch($atype){
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
    
//Seleccionamos la ruta especifica del trabajador que inicio session
//Perfil mas alto de la ruta
$queryroute = "select * from routes where type >= '2' and type <= '4' and unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' order by type desc limit 1"; //here we add the headship 
$resultroute = mysqli_query($con, $queryroute);
$rowroute = mysqli_fetch_array($resultroute); 

//perfil mas alto 
$routetype = $rowroute['type']; 

//Reconocer si el proveedor es una alcaldía    
$finalapprove = 0;  
$queryhall = "select * from providers where id = '$rowpayment[provider]' and name like '%alcaldia%'";
$resulthall = mysqli_query($con, $queryhall); 
$numhall = mysqli_num_rows($resulthall);
    
if(($_SESSION['email'] == "enavarro@casapellas.com") and ($numhall > 0)){
    $finalapprove = 1;
}    
  
#Comprobamos que Don Danilo es el proximo aprobado
$isdch = 0;
$querydch = "select * from routes where type > '$usertype' and type <= '4' and unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' order by type asc limit 1";
$resultdch = mysqli_query($con, $querydch);
$rowdch=mysqli_fetch_array($resultdch);
if($rowdch['worker'] == '226237'){
    $isdch = 1;
}    
  
if(($isdch == 1) and ($numhall > 0)){
    $finalapprove = 1; 
}      
    
//Si la transaccion es realizada por el perfil mas alto
if(($finalapprove == 1) or ($routetype == $usertype) or ($_SESSION["dch"] == "active")){
	
	//Aqui realizamos la actualizacion a las devoluciones
	//Le ponemos credit=1 para que tenga que pasar por el area de liquidacion
	//Las que estan en cero pasan y en provision se condiciona que esten en 1 o en 2
	
	
	$queryapprove = "update payments set status = '$newstatustime', approved = '1' where id = '$id_int'";
	$resultapprove = mysqli_query($con, $queryapprove);
	$gcomments = "Enhorabuena, el pago ha sido aprobado."; 
	
	//Retentions
	if($rowpayment['provider'] == 993){
		$querymayor = "update payments set mayorstage = '2' where id = '$id_int'";
		$resultmayor = mysqli_query($con, $querymayor);
	}
	if($rowpayment['provider'] == 994){
		$queryir = "update payments set irstage = '2' where id = '$id_int'";
		$resultir = mysqli_query($con, $queryir); 
	}

}
//Si la transaccion no es realizada por el perfil mas alto.
else{
	
	$queryapprove = "update payments set status = '$newstatustime' where id = '$id_int'";
	$resultapprove = mysqli_query($con, $queryapprove);
	
	//Aca metemos la nueva regla
	if(($rowpayment['currency'] == 1) and ($tc > 0)){  
		$usdamount = $rowpayment['payment']/$tc;
	}else{
		$usdamount = $rowpayment['payment'];
	}
	
	$nextroute = $newstatustime+1;
	
	$querynapprove = "select * from routes where type = '$nextroute' and unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' order by type desc limit 1";
	$resultnapprove = mysqli_query($con, $querynapprove);
	while($rownapprove=mysqli_fetch_array($resultnapprove)){
		$nextapprove_str.= $rownapprove['worker'].",";  
	}
	
	$nextapprove = explode(',', $nextapprove_str);
    
	//where abs means approved by sistem (Monto menor al limite)
	if((in_array("226237", $nextapprove)) and ($usdamount < 5000) and ($rowpayment['type'] != '4')){ 
		
		$queryapprove = "update payments set approved='1' where id = '$id_int'";
		$resultapprove = mysqli_query($con, $queryapprove);
        $queryapprove2 = "update payments set abs='1' where id = '$id_int'"; 
		$resultapprove2 = mysqli_query($con, $queryapprove2);
		$gcomments = "Enhorabuena, el pago ha sido aprobado. Monto excluye siguiente nivel de aprobaci&oacute;n.";
		
	}
	else{
		$gcomments = "Esperando la siguiente aprobaci&oacute;n.";
	}
	
}

$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id_int', '$today', '$now', '$now2', '$_SESSION[userid]', '$newstatustime', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime); 

if(($is_approved == 1) and (($rowpayment['immediate'] == 1) or ($rowpayment['hc'] == 1))){
	getNext($id_int,$newstatustime);
}

}

            
$chain.= $id_int.",";
}
} 
}   

	//End for
}

 if($_SESSION["dch"] == "active"){
	 //header("location: approve-special.php");
	 echo "<script>window.location='approve-special.php';</script>";
 }elseif($_SESSION["spellas"] == "active"){
	 //header("location: approve-special.php");
	 echo "<script>window.location='approve-spellas.php';</script>";
 }else{
	 //header("location: approve.php");
	 echo "<script>window.location='approve.php';</script>";
 } 
 


?>