<? 

include("session-admin.php");

$type = $_POST['type'];

if($type == 0){
	
	$query = "select payments.id from payments where payments.ret1a > '0' and payments.cnotification2= '1' and btype = '1'";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	echo $num = round($num/25)+1;
	
	
}
elseif($type == 1){
	
	require '//home/getpaycp/public_html/assets/PHPMailer/PHPMailerAutoload.php'; 
	//Envio de cancelación de retenciones
	//include('function-email-cancellation.php');
	//Envio de retenciones IR
	include('function-email-irretention.php');
	//Creacion de PDF retencion ir para envío
	include('pdf-ir-single.php'); 

	$forwarding = 1;
	
	$tampagina = 25;
	$pagina = $_POST['page'];
	if(!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio=($pagina-1)*$tampagina;
	}

	$query_main = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, payments.schedule, payments.approved, payments.today, payments.reason, payments.ret1a from payments where cnotification2 = '1' limit ".$inicio.",".$tampagina; 
	$result_main = mysqli_query($con, $query_main);
	$num_main = mysqli_num_rows($result_main);
	if($pagina == 1){ 
		
		
?>
			 <div class="portlet">
						<div class="portlet-title">

							<div class="caption">

<?php 
								
echo $num_main; ?> Envío activo</div>

							

					  </div>
				 
				 
				 <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

								
									<th width="5%">

										 ID</th>

									<th width="40%">

										 Proveedor</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">

										 Retencion

									</th>

									<th width="15%">

										 Documentos

									</th>

									<th width="17%">

										 Estado</th>

								</tr>

								</thead>

								<tbody>
									
								
	<? }
	
	
	if($num_main < 1){
		echo '<tr role="row" class="odd"><td colspan="6">Sin más envios pendientes.</td></tr>';
	}
	
	while($row_main=mysqli_fetch_array($result_main)){
		
		if($row_main['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row_main[provider]'"));
								}else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row_main[collaborator]'"));
								}
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row_main[currency]'"));
		
		makeRetention($row_main['id'],$con);
		sendEmailRetention($row_main['id'],$forwarding,'',$con); 
		
		$today = date('Y-m-d');
		$now = date('Y-m-d H:i:s');
		
		$queryTimes = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '999999999', '2', '$row_main[id]', '1', 'ESPELLAS')";
		$resultTimes = mysqli_query($con, $queryTimes);
		
		$queryUpdate = "update payments set cnotification2 = '0' where id = '$row_main[id]'"; 
		$resultUpdate = mysqli_query($con, $queryUpdate); 
		
		?>
									
			<tr role="row" class="odd">
									
									
								
									<td>
								<a href="payment-order-view.php?id=<?php echo $row_main['id']; ?>"><?php echo $row_main['id']; ?></a></td><td>                                  <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row_main['btype'] == 1){ echo $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									echo $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last']; }?></td>
                                    <td>
									<?php 
									
									
									if($row_main['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row_main['payment'], 2)); 
									if($rowcurrency['id'] == 1){
										$gtotal_nio+=$row_main['payment'];
									}
									if($rowcurrency['id'] == 2){
										$gtotal_usd+=$row_main['payment'];
									}
										
									
									} ?></td>
                                        <td>
										<?php 
										
										
										echo 'NIO C$'.$row_main['ret1a']; 
										
										?></td><td><?php  
										
$querybills = "select * from bills where payment = '$row_main[id]'";
$resultbills = mysqli_query($con, $querybills);								
while($rowbills = mysqli_fetch_array($resultbills)){
	echo $rowbills['number'].', '; 
}
									
									$thisStage = array();
									$thisStage[1] = "Solicitúd de envío";
									$thisStage[2] = "Intento de envio Fallido";
									$thisStage[3] = "Envío exitoso";
						
?>

								
							</td><td>
                            
                            <i class="fa fa-paper-plane"></i> Enviado</a>
                            
                            </td></tr>						
		<?
		
		
	}
	if($pagina == $num_main){
		echo "</table></div>";	
	}

}
elseif($type == 2){ 


$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, payments.schedule, payments.approved, payments.today, payments.reason, payments.ret1a from payments where payments.id > '0' and payments.ret1a > '0' and payments.cnotification2 = '1'";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);  

if($numdev > 0){
?>
<br>
 <div class="portlet">
						<div class="portlet-title">

							<div class="caption">

<?php 
								
echo $numdev; ?> Envío pendiente</div>

							

					  </div>



                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

								
									<th width="5%">

										 ID</th>

									<th width="40%">

										 Proveedor</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">

										 Retencion

									</th>

									<th width="15%">

										 Documentos

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //echo $query1; 
								while($row=mysqli_fetch_array($result)){
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
								<tr role="row" class="odd">
									
									
								
									<td>
								<a href="payment-order-view.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td><td>                                  <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row['btype'] == 1){ echo $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									echo $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last']; }?></td>
                                    <td>
									<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); 
									if($rowcurrency['id'] == 1){
										$gtotal_nio+=$row['payment'];
									}
									if($rowcurrency['id'] == 2){
										$gtotal_usd+=$row['payment'];
									}
										
									
									} ?></td>
                                        <td>
										<?php 
										
										
										echo 'NIO C$'.$row['ret1a']; 
										
										?></td><td><?php  
										
$querybills = "select * from bills where payment = '$row[id]'";
$resultbills = mysqli_query($con, $querybills);								
while($rowbills = mysqli_fetch_array($resultbills)){
	echo $rowbills['number'].', '; 
}
									
									$thisStage = array();
									$thisStage[1] = "Solicitúd de envío";
									$thisStage[2] = "Intento de envio Fallido";
									$thisStage[3] = "Envío exitoso";
						
?>

								
							</td><td>
                            
                            <a href="retentions-forwarding-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                         
                            
                            </td></tr>
								
									
                                <?php  }
								
								?>
									
									
                               
                                   </tbody>

								</table>
								
								

</div>


<? }else{ ?><br>
<div class="note note-regular">NOTA: Sin pendientes de envío.</div>
<? }
	
}


?>