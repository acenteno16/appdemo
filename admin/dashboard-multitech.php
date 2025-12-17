<?php 


//include('fn-expiration.php'); ?>
<div class="row">
<div class="col-md-12">
<ul class="page-breadcrumb breadcrumb">
<li><i class="fa"><img src="../images/mt.png" width="15" height="15" /></i>
<a href="dashboard.php">MultiTech</a>
</li>
</ul>
        
       
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pendientas de cancelación

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php 
								
								//include("sessions.php"); 
								
								$query = "select * from payments where approved != '2' and status > 0 and status < '14' and provider = '824'";  
								$result = mysqli_query($con, $query);   
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 
                               
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="40%">

										 Proveedor</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">

										 Vencimiento

									</th>

									<th width="15%">

										 Estado

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //echo $query1; 
								while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td>
                                <td><img src="../images/flag.png" width="13" alt=""/><? echo $rowprovider['code']." | ".$rowprovider['name'];
								?>
                                </td>
                                <td>
								<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); } ?></td>
                                        <td>
										<?php 
										
										$iddelpago = $row['id'];
										echo $elvencimiento = getExpiration2($iddelpago); 
										
										?></td><td>
                                        
                                       <?php 
										

$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
						
if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
								$color == "yellow";
								if($rowstatus['color'] != ""){
									$color = $rowstatus['color']; 
								}
								echo '<button type="button" class="btn '.$color.'">'.$rowstatus['stage2'].'</button>';
							}else{    
							$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['content'];
							}
								 
								 
								 
                                        
                                      
							?>
								
							</td><td>
                             
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                          
                            
                            </td></tr>
                                <?php }
								
								?>
                               
                                   </tbody>

								</table>
                            
                                
<?php }else{ ?>
                                <div class="note note-info">
No se encontraron solicitudes pendientes.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div> 

			<!-- END PAGE CONTENT-->

		</div>
     
         
        </div>
        </div>
        <div class="row"></div>
        
       
      <?php

function getExpiration2($paymentid){
	
	$querypayment = "select * from payments where id = '$paymentid'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$date1 = date("Y-m-d");
	$date2 = $rowpayment['expiration'];
	$date3 = date('d-m-Y',strtotime($rowpayment['expiration'])); 
	if($date2 == "0000-00-00"){
		$date2 = date("Y-m-d"); 
		$date3 = date('d-m-Y',strtotime($date2)); 
	}
	
	
	if($rowpayment['status'] == 14){
		$querytime = "select * from times where payment = '$paymentid' and stage = '14.00' limit 1";
		$resulttime = mysqli_query($con, $querytime);
		$rowtime = mysqli_fetch_array($resulttime);
		
		$date1 = $rowtime['today'];
	}


	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -8) $parentesis = ' <span style="color:#060">('.intval(abs($dias)).")</span>";
	if(($dias <= 0) and ($dias >= -7)) $parentesis =  ' <span style="color:#FC0">('.intval(abs($dias)).")</span>";
	elseif($dias > 0) $parentesis = ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>";
	
	$vencimiento = $date3." ".$parentesis;
	return($vencimiento); 
	
}

?>