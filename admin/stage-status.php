<?

$color = "";

$queryBillDate = $con->prepare("select * from bills where payment = ? order by billdate asc limit 1");
$queryBillDate->bind_param("i", $row['id']);
$queryBillDate->execute();
$resultBillDate = $queryBillDate->get_result();
$rowBillDate = $resultBillDate->fetch_assoc();

if($row['status'] == "14.00"){
	
	$queryTimex = $con->prepare("select * from times where payment = ? and stage = '14' order by id desc limit 1");
	$queryTimex->bind_param("i", $row['id']);
	$queryTimex->execute();
	$resultTimex = $queryTimex->get_result();
	$rowTimex = $resultTimex->fetch_assoc();

	$fecha_actual = $rowTimex['today'];
	
	$s = strtotime($row['expiration'])-strtotime($fecha_actual);
	$leftdays = intval($s/86400); 
	if($leftdays < 0){
		//echo "Pago vencido";
		$themessage = '<span style="color:#F00;">Pagado con '.str_replace('-','',$leftdays)." días de vencimiento</span>";
	}else{
		if($leftdays == 0){
			$themessage = "Pagado en fecha limite de vencimiento";
		}else{
			$themessage = "Pagado con ".$leftdays." día(s) de anticipación.";
		}
	}
	
}
//Si el pago no ha sido cancelado
else{
	
	$fecha_actual = date("Y-m-d");
	$s = strtotime($row['expiration'])-strtotime($fecha_actual);
	$leftdays = intval($s/86400); 
	if($leftdays <= 0){
		//echo "Pago vencido";
		$themessage = '<span style="color:#F00;">Vencido hace '.str_replace('-','',$leftdays)." días</span>";
	}else{
		$themessage = $leftdays." días restantes";
	}
}

?>
<h3 class="form-section"><a id="status"></a>Estado</h3>
<p><strong>Fecha de solicitud:</strong> <?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
<strong>Fecha de última factura:</strong> <?php echo date('d-m-Y',strtotime($rowBillDate['billdate'])); ?><br>
<strong>Plazo de crédito:</strong> <?php echo $stage_term; ?> días <br>
<strong>Fecha de vencimiento:</strong> <?php echo $expiration = date('d-m-Y',strtotime($row['expiration'])); ?><br>
<strong>Días Rentantes: </strong><?php echo $themessage;

								
								?>
                                              </p>
<br>
                                             
                                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">


									<th width="13%">TID</th>

									<th width="18%">Fecha</th>

									<th width="16%">Hora</th>

									<th width="25%">Acción</th>

									<th width="28%">Por Usuario</th>

									
								  </tr>

								</thead>

								<tbody>
                               <?php 
									
									$i = 0;
									$querystatus = $con->prepare("select * from times where payment = ? order by id asc");
									$querystatus->bind_param("i", $row['id']);
									$querystatus->execute();
									$resultstatus = $querystatus->get_result();
									while ($rowstatus = $resultstatus->fetch_assoc()){
	
	
	
												  
												  
												  
											if($i == 0){
												$day1 = $rowstatus['today'];
											}
											$i++;
											
											
											  ?>
									<tr role="row" class="odd"><td class="sorting_1"><?php echo $rowstatus['id']; ?>
                                    <? /*if($_SESSION['email'] == "jairovargasg@gmail.com"){ ?>
                                    <a href="javascript:deleteTime(<?php echo $rowstatus['id']; ?>,0);">X</a>
                                    <a href="javascript:deleteTime(<?php echo $rowstatus['id']; ?>,1);">V</a>
                                    <? }*/ ?></td>
										
									<td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td>
									<td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                	<td><?php 
								
								if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
									$color == "yellow";
									if($rowstatus['color'] != ""){
										$color = $rowstatus['color']; 
									}
									echo '<button type="button" class="btn '.$color.'" onClick="makeAlert('."'".$rowstatus['comment'].": ".$rowstatus['reason']."'".');">'.$rowstatus['stage2'].'</button>';
									
									echo '<a href="javascript:makeAlert('."'".$rowstatus['comment'].": ".$rowstatus['reason']."'".');"><i class="fa fa-wechat"></i> </a>';
								}else{    
								
								//$schedule_vo_msg = "vo:".$schedule_vo."s:".$rowstatus['stage']." s2:".$rowstatus['stage2'];
									
									
									$schedule_vo_msg = "";
									 
									if($rowstatus['stage'] == 12){ 
										$querygschedule = "select schedule.vo from schedule left join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$_GET[id]'";
										$resultgschedule = mysqli_query($con, $querygschedule);
										$rowgschedule = mysqli_fetch_array($resultgschedule);
										if($rowgschedule['vo'] == 0) $schedule_vo_msg = " Paso: 1/2";
									}
									
								$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								
									$commentadd = "";
									if($rowstatus['reason2'] > 0){
										$querysreason = "select * from reason where id = '$rowstatus[reason2]'";
										$resultsreason = mysqli_query($con, $querysreason);
										$rowsreason = mysqli_fetch_array($resultsreason);
										$commentadd.= '\nMotivo: '.$rowsreason['name'];
									}
									if($rowstatus['reason'] != ''){
										if($rowstatus['reason2'] == 0){
											$commentadd.= '\nMotivo: Otro';
										}
										$commentadd.= '\nComentario: '.$rowstatus['reason'];
									}
									echo '<a href="javascript:makeAlert('."'".$rowstatus['comment'].$commentadd."'".')">'.$rowstage['content'].$schedule_vo_msg.'</a>';
									echo '<a href="javascript:makeAlert('."'".$rowstatus['comment'].$commentadd."'".')"><i class="fa fa-wechat"></i> Ver comentario</a>';
							}
								 ?></td>
                                <td><?php 
                                
                                if($rowstatus['userid'] == 'GETPAY'){
                                    echo "Sistema Getpay";
                                }else{
                                    $queryuser = "select * from workers where code = '$rowstatus[userid]'";
								    $resultuser = mysqli_query($con, $queryuser);
								    $rowuser = mysqli_fetch_array($resultuser);
								
								    echo  $theuser = '<a href="mailto:'.$rowuser['email'].'">'.$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']."</a>";    
                                }                  
                                 ?></td>
                              
                          </tr>
                          
                          <?php 
						  
						  $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  $note = $rowstage['note'];
						  $thereason = $rowstatus['reason'];
						  
						  ?>
                                                        
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
                                <p>TID: ID de transacción.</p>
                                
                                <?php if($thecomment != ""){ ?>
<div class="row"><div class="col-md-12 ">
<div class="note note-<?php echo $note;
?>">
Gestión: <?php echo $thecomment; 

if(($row['approved'] == 2) and ($row['reason'] > 0)){
	$queryreason0 = "select name from reason where id = '$row[reason]'";
	$resultreason0 = mysqli_query($con, $queryreason0);
	$rowreason0 = mysqli_fetch_array($resultreason0); 
	echo "<br>*".$rowreason0['name'];
}

if($thereason != ""){ ?><br>
<?php echo $thereason; ?>
<?php } ?>
</div> </div></div>
<?php } ?>
							
								
							<? 

	switch($row['cnotification']){
		case 0:
			$cNot = 'No hay solicitud de envío. La solicitud de envío se genera en la etapa de ingreso al banco. Si el pago no ha sido ingresado al banco, es normal que no exista una solicitud de envío.';
			break;
		case 1:
			$cNot = 'En cola de envío. Ya se generó el envío de la notificación de la cancelación de esta solicitud de pago. Sin embargo, la solicitud está siendo procesada por el servidor de correos. Este proceso no debería tomar más de 24 horas.';
			break;
		case 2:
			$cNot = 'Enviado.';
			break;
			
	}

	echo "<strong>Envío de cancelación: </strong>$cNot";
	
	$queryMailerLog = $con->prepare("select * from mailerLog where payment = ? and type = '1'");
	$queryMailerLog->bind_param("i", $row['id']);
	$queryMailerLog->execute();
	$resultMailerLog = $queryMailerLog->get_result();
	$rowMailerLog = $resultMailerLog->fetch_assoc();
	while($rowMailerLog=$resultMailerLog->fetch_assoc()){
		echo "<br>- $rowMailerLog[today] / $rowMailerLog[message]";
	}
	echo "<br><strong>Reenvío de cancelación:</strong> ";
	$queryMailerLog = $con->prepare("select * from mailerLog where payment = ? and type = '3'");
	$queryMailerLog->bind_param("i", $row['id']);
	$queryMailerLog->execute();
	$resultMailerLog = $queryMailerLog->get_result();
	$rowMailerLog = $resultMailerLog->fetch_assoc();
	while($rowMailerLog=$resultMailerLog->fetch_assoc()){
		echo "<br>- $rowMailerLog[today] / $rowMailerLog[message]";
	}


	if($row['ret2a'] > 0){
		switch($row['rnotification']){
		case 0:
			$rNot = 'No hay solicitud de envío. La solicitud de envío se genera en la etapa de ingreso al banco. Si el pago no ha sido ingresado al banco, es normal que no exista una solicitud de envío.';
			break;
		case 1:
			$rNot = 'En cola de envío. Ya se generó el envío de la retención de esta solicitud de pago. Sin embargo, la solicitud está siendo procesada por el servidor de correos. Este proceso no debería tomar más de 24 horas.';
			break;
		case 2:
			$rNot = 'Enviado';
			break;
		case 3: 
			$rNot = 'Envío anulado'; 
			break;
		}
		
		echo "<br><strong>Envío de retención:</strong> $rNot";
		$queryMailerLog = $con->prepare("select * from mailerLog where payment = ? and type = '2'");
		$queryMailerLog->bind_param("i", $row['id']);
		$queryMailerLog->execute();
		$resultMailerLog = $queryMailerLog->get_result();
		$rowMailerLog = $resultMailerLog->fetch_assoc();
		while($rowMailerLog=$resultMailerLog->fetch_assoc()){
			echo "<br>- $rowMailerLog[today] / $rowMailerLog[message]";
		}	
		echo "<br><strong>Reenvío de retención:</strong> ";
		$queryMailerLog = $con->prepare("select * from mailerLog where payment = ? and type = '4'");
		$queryMailerLog->bind_param("i", $_GET['id']);
		$queryMailerLog->execute();
		$resultMailerLog = $queryMailerLog->get_result();
		$rowMailerLog = $resultMailerLog->fetch_assoc();
		while($rowMailerLog=$resultMailerLog->fetch_assoc()){
			echo "<br>- $rowMailerLog[today] /  $rowMailerLog[message]";
		}
		
	}


?>
					
      <script>
	  function makeAlert(message){
		  alert(message); 
	  }
      function deleteTime(id,approved){
          window.location = "stage-status-delete-time.php?id="+id+"&approved="+approved;
      }      
	  </script>              