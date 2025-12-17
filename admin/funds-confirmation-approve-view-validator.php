<?

include('sessions.php');

$id = $_POST['id'];
$bankReference = trim($_POST['bankreference']);

$queryFund = "select * from funds where id = '$id'";
$resultFund = mysqli_query($con, $queryFund);
$rowFund = mysqli_fetch_array($resultFund);

$query = "select * from funds where bankreference = '$bankReference' and approved = '1' and bank = '$rowFund[bank]' and currency = '$rowFund[currency]' and company = '$rowFund[company]'";
$query = "select * from funds where bankreference = '$bankReference' and approved = '1' and currency = '$rowFund[currency]' and company = '$rowFund[company]'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);


#No se encontró referecia bancaria


if(($bankReference == '') or ($bankReference == ' ') or ($bankReference == '')){ 
	echo '0';
	exit();
}
#se encontró una o más solicitudes
elseif($num > 0){
	echo '<div class="col-md-12"<br><br>
		 <div class="note note-danger">NOTA: La referecia ingresada ya ha sido registrfada en una solicitud o varias solicitudes CDF. Sin embargo, puede que el banco halla usado la misma referencia para dos  transacciones diferentes. Favor revisar cual es el caso y apruebe o rechaze la solicitúd despues de analizar los datos.</div>
		 <h3 class="form-section">Transacciones</h3>
		 <table class="table table-striped table-bordered table-hover" id="datatable_orders">
		 <thead>
		 <tr role="row" class="heading">
		 <th width="13%">ID</th>
		 <th width="18%">Fecha</th>
		 <th width="16%">Usuario</th>
		 <th width="28%">Opciones</th>
		 </tr>
		 </thead>
		 <tbody>';
	while($row = mysqli_fetch_array($result)){ ?>
		<tr role="row" class="odd">
									<td class="sorting_1"><?php echo $row['id']; ?></td>
									<td><?php echo date('d-m-Y',strtotime($row['today'])); echo ' @'.date('h:i:s a', strtotime($row['now2'])); ?></td>
									
                                	
                                	<td><?php 
                                
                                	if($rowstatus[userid] == 'GETPAY'){
                                    	echo "Sistema Getpay";
                                	}else{
                                    	$queryuser = "select * from workers where code = '$row[userid]'";
										$resultuser = mysqli_query($con, $queryuser);
								    	$rowuser = mysqli_fetch_array($resultuser);
								
								    	echo  $theuser = '<a href="mailto:'.$rowuser['email'].'">'.$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']."</a>";    
                                	} ?>
									</td>
									<td><a href="funds-confirmation-view.php?id=<? echo $row['id']; ?>" target="_blank" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td>
                             	</tr>
	<? }
	echo ' </tbody></table>';  ?>

<div class="row">


														
<div class="col-md-3 ">
																<div class="form-group"><label>Aprobar:</label>
																	<select name="fApproved" class="form-control" id="fApproved">
																		<option value="2" selected>No</option>
																		<option value="1">Si</option></select>
																</div>
															</div>	
	
	<div class="col-md-12 ">
																<div class="form-group"><label>Comentarios:</label>
																	<textarea name="fReason" rows="2" class="form-control" id="fReason"></textarea> 
																</div> 
															</div>
	</div>

	<?
}
else{ 
	echo '1'; 
	exit();
} 
?>