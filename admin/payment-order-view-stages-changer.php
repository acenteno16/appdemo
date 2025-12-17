<? 

require('session-admin.php');
require('functions.php');

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = isset($_POST['paymentid']) ? sanitizeInput($_POST['paymentid'], $con) : null;
$thestage = isset($_POST['thestage']) ? sanitizeInput($_POST['thestage'], $con) : 0;
$reason = isset($_POST['reason']) ? sanitizeInput($_POST['reason'], $con) : null;
 
if($thestage == 0){
	echo "<script>alert('Seleccionar un Estado.');history.go(-1);</script>";
	exit(); 
}
if($reason == ""){
	echo "<script>alert('Ingresar un motivo o razon.');history.go(-1);</script>";
	exit();
}

$sql = "";

//Check Payment
$queryPayment = "SELECT approved, parent FROM payments WHERE id = ?";
$stmtPayment = $con->prepare($queryPayment);
$stmtPayment->bind_param("i", $id); // "i" porque se asume que $id es un entero
$stmtPayment->execute();
$resultPayment = $stmtPayment->get_result();
$rowPayment = $resultPayment->fetch_assoc();

#Rechazar solicúd
if($thestage == 1){
    
    require '../assets/PHPMailer/PHPMailerAutoload.php'; 
    include('fn-rejection.php');
    
    //Rechazo
    $queryReject = "update payments set status = '7.12', approved='2' where id = '$id'";
    $resultReject = mysqli_query($con, $queryReject); 

    $gcomments = "La solicitud ha sido rechazada por Administrador.";	
    $queryTime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.12', '$gcomments', '$reason', '$reason2')"; 
    $resultTime = mysqli_query($con, $queryTime); 
				
    fnReject($id,$_SESSION['userid']); 
        
    if($rowPayment['parent'] > 0){
	   $querypaymentchilds = "select * from payments where child = '$id'"; 
	   $resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	   while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		    $queryReject2 = "update payments set status = '7.12', approved='2' where id = '$rowpaymentchilds[id]'";
            $resultReject2 = mysqli_query($con, $queryReject2); 

            $queryTime2 = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '7.12', '$gcomments', '$reason', '$reason2')"; 
            $resultTime2 = mysqli_query($con, $queryTime2); 
	
	  }
    }
}
#Regresar a borrador
elseif($thestage == 2){
    
    #Borrador
    $status = "0";
    $stage = "0.04";
	$sql.=" and approved='0'"; 
    
    $queryUpdate = "update payments set status = '$status'$sql where id = '$paymentid'"; 
    $resultUpdate = mysqli_query($con, $queryUpdate);
    
    $queryTime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$stage', '$reason')"; 
    $resultTime = mysqli_query($con, $queryTime); 
    
}
#Rechazar solicitudes dependientes
elseif($thestage == 3){
    
    #Nos aseguramos que el ID principal esté rechazado.
    if($rowPayment['approved'] != 2){
        echo "<script>alert('El pago no se encuentra rechazado.');history.go(-1);</script>";
        exit();
    }
    if($rowPayment['parent'] == 0){
        echo "<script>alert('La solicitud no es madre.');history.go(-1);</script>";
        exit();
    }
    
    #seleccionamos la infoemacion del rechazo original
    $queryRejected = "select times.* from times inner join stages on times.stage = stages.ststus where times.payment = '$id' and stages.rejection = '1' order by id desc limit 1";
    $resultRejected = mysqli_query($con, $queryReject);
    $rowReject = mysqli_fetch_array($resultReject);
	       
    #Mandamos a llamar todos los pagos hijos
    $querypaymentchilds = "select * from payments where child = '$id'"; 
    $resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
    while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){ 
        
        echo "<br><br>-".$queryReject2 = "update payments set status = '$rowReject[stage]', approved='2' where id = '$rowpaymentchilds[id]'";
        #$resultReject2 = mysqli_query($con, $queryReject2); 

        echo "<br>-".$queryTime2 = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$rowpaymentchilds[id]', '$rowReject[today]', '$rowReject[now]', '$rowReject[now2]', '$_SESSION[userid]', '$rowReject[stage]', '$gcomments', '$reason', '$reason2')"; 
        #$resultTime2 = mysqli_query($con, $queryTime2);  
	
    }

    
}
#Regresar a Programación
elseif($thestage == 4){

    $queryfirst = "select * from schedulecontent where payment = '$id'";
    $resultfirst = mysqli_query($con, $queryfirst);
    $rowfirst = mysqli_fetch_array($resultfirst);

    $schedule = $rowfirst['schedule'];

    $querydelete = "delete from schedulecontent where payment = '$id'";
    $resultdelete = mysqli_query($con, $querydelete);


    $querymain = "select * from schedulecontent where schedule = '$schedule'";
    $resultmain = mysqli_query($con, $querymain);
    $nummain = mysqli_num_rows($resultmain);
    while($rowmain=mysqli_fetch_array($resultmain)){
	   $querypayments = "select * from payments where id = '$rowmain[payment]'";
	   $resultpayments = mysqli_query($con, $querypayments);
	   $rowpayments = mysqli_fetch_array($resultpayments);
	   $gpayment+= $rowpayments['payment']; 
    }
    
    $queryPayment = "update payments set status = '9', schedule='0000-00-00' where id = '$id'";
	$resultPayment = mysqli_query($con, $queryPayment); 
	
	$queryTimes = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '13.04', 'Eliminado de la programacion.', '$reason')";
	$resultTimes = mysqli_query($con, $queryTimes); 
    
    $queryschedule = "update schedule set ammount='$gpayment' where id = '$schedule'";
    $resultschedule = mysqli_query($con, $queryschedule); 
    
}
#Regresar a Provision
elseif($thestage == 5){

    $queryfirst = "select * from schedulecontent where payment = '$id'";
    $resultfirst = mysqli_query($con, $queryfirst);
    $numfirst = mysqli_num_rows();
    if($numfirst > 0){
        $rowfirst = mysqli_fetch_array($resultfirst);
        $schedule = $rowfirst['schedule'];
        
        $querydelete = "delete from schedulecontent where payment = '$id'";
        $resultdelete = mysqli_query($con, $querydelete);
        
        $querymain = "select * from schedulecontent where schedule = '$schedule'";
        $resultmain = mysqli_query($con, $querymain);
        $nummain = mysqli_num_rows($resultmain);
        while($rowmain=mysqli_fetch_array($resultmain)){
	       $querypayments = "select * from payments where id = '$rowmain[payment]'";
	       $resultpayments = mysqli_query($con, $querypayments);
	       $rowpayments = mysqli_fetch_array($resultpayments);
	       $gpayment+= $rowpayments['payment']; 
        }
        
        $queryPayment = "update payments set schedule='0000-00-00' where id = '$id'";
	    $resultPayment = mysqli_query($con, $queryPayment); 
        
        $queryschedule = "update schedule set ammount='$gpayment' where id = '$schedule'";
        $resultschedule = mysqli_query($con, $queryschedule); 
    }
    
    $querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
    $resultlasttime = mysqli_query($con, $querylasttime);
    $rowlasttime=mysqli_fetch_array($resultlasttime);

    $laststatus = $rowlasttime['stage'];

    $queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$id'";
    $resultapprove = mysqli_query($con, $queryapprove);
    if(!$resultapprove){
	?><script>alert('No se pudo');</script><?php }
    $gcomments = "El pago ha sido regresado a provisiÃ³n.";

    //time stage
    $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '11', '$gcomments', '$reason')"; 
    $resulttime = mysqli_query($con, $querytime);

    if($rowpayment['parent'] > 0){
	   $querypaymentchilds = "select * from payments where child = '$id'";
	   $resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	   while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		  $queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$rowpaymentchilds[id]'";
		  $resultapprove = mysqli_query($con, $queryapprove);
		
		  $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '11', '$gcomments', '$reason')"; 
		  $resulttime = mysqli_query($con, $querytime);
	
	
	}
	
}
    
    
    
}
#Regresar a Provision
elseif($thestage == 6){

    $queryfirst = "select * from schedulecontent where payment = '$id'";
    $resultfirst = mysqli_query($con, $queryfirst);
    $numfirst = mysqli_num_rows();
    if($numfirst > 0){
        $rowfirst = mysqli_fetch_array($resultfirst);
        $schedule = $rowfirst['schedule'];
        
        $querydelete = "delete from schedulecontent where payment = '$id'";
        $resultdelete = mysqli_query($con, $querydelete);
        
        $querymain = "select * from schedulecontent where schedule = '$schedule'";
        $resultmain = mysqli_query($con, $querymain);
        $nummain = mysqli_num_rows($resultmain);
        while($rowmain=mysqli_fetch_array($resultmain)){
	       $querypayments = "select * from payments where id = '$rowmain[payment]'";
	       $resultpayments = mysqli_query($con, $querypayments);
	       $rowpayments = mysqli_fetch_array($resultpayments);
	       $gpayment+= $rowpayments['payment']; 
        }
        
        $queryPayment = "update payments set schedule='0000-00-00' where id = '$id'";
	    $resultPayment = mysqli_query($con, $queryPayment); 
        
        $queryschedule = "update schedule set ammount='$gpayment' where id = '$schedule'";
        $resultschedule = mysqli_query($con, $queryschedule); 
    }
    

    $queryapprove = "update payments set status = '2', preturn = preturn + 1 where id = '$id'";
    $resultapprove = mysqli_query($con, $queryapprove);
    if(!$resultapprove){
	?><script>alert('No se pudo');</script> 
    <?php }
    $gcomments = "El pago ha sido regresado a Aprobaldo1.";

    //time stage
    $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '2.10', '$gcomments', '$reason')"; 
    $resulttime = mysqli_query($con, $querytime);

    if($rowpayment['parent'] > 0){
	   $querypaymentchilds = "select * from payments where child = '$id'";
	   $resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	   while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		  $queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$rowpaymentchilds[id]'";
		  $resultapprove = mysqli_query($con, $queryapprove);
		
		  $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '11', '$gcomments', '$reason')"; 
		  $resulttime = mysqli_query($con, $querytime);
	
	
	}
	
}
    
    
    
}
#Regresar a =Liberación
elseif($thestage == 7){

    $queryfirst = "select * from schedulecontent where payment = '$id'";
    $resultfirst = mysqli_query($con, $queryfirst);
    $numfirst = mysqli_num_rows();
    if($numfirst > 0){
        $rowfirst = mysqli_fetch_array($resultfirst);
        $schedule = $rowfirst['schedule'];
        
        $querydelete = "delete from schedulecontent where payment = '$id'";
        $resultdelete = mysqli_query($con, $querydelete);
        
        $querymain = "select * from schedulecontent where schedule = '$schedule'";
        $resultmain = mysqli_query($con, $querymain);
        $nummain = mysqli_num_rows($resultmain);
        while($rowmain=mysqli_fetch_array($resultmain)){
	       $querypayments = "select * from payments where id = '$rowmain[payment]'";
	       $resultpayments = mysqli_query($con, $querypayments);
	       $rowpayments = mysqli_fetch_array($resultpayments);
	       $gpayment+= $rowpayments['payment']; 
        }
        
        $queryPayment = "update payments set schedule='0000-00-00' where id = '$id'";
	    $resultPayment = mysqli_query($con, $queryPayment); 
        
        $queryschedule = "update schedule set ammount='$gpayment' where id = '$schedule'";
        $resultschedule = mysqli_query($con, $queryschedule); 
    }
    
    $querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
    $resultlasttime = mysqli_query($con, $querylasttime);
    $rowlasttime=mysqli_fetch_array($resultlasttime);

    $laststatus = $rowlasttime['stage'];

    $queryapprove = "update payments set approved = '1', status='8', preturn = preturn + 1 where id = '$id'";
    $resultapprove = mysqli_query($con, $queryapprove);
    if(!$resultapprove){
	?><script>alert('No se pudo');</script><?php }
    $gcomments = "El pago ha sido regresado a liberaciÃ³n.";

    //time stage
    $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '9.01', '$gcomments', '$reason')"; 
    $resulttime = mysqli_query($con, $querytime);

    if($rowpayment['parent'] > 0){
	   $querypaymentchilds = "select * from payments where child = '$id'";
	   $resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	   while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		  $queryapprove = "update payments set approved='1', status = '8', preturn = preturn + 1 where id = '$rowpaymentchilds[id]'";
		  $resultapprove = mysqli_query($con, $queryapprove);
		
		  $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '9.01', '$gcomments', '$reason')"; 
		  $resulttime = mysqli_query($con, $querytime);
	
	
	}
	
}
    
    
    
}


header('location: '.$_SERVER['HTTP_REFERER']); 


?>