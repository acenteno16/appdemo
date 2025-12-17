<?php include('fn-expiration.php'); ?>
<div class="row">
<div class="col-md-12">

   <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-rss"></i>

							<a href="dashboard.php" >Rechazadas en liberación</a>
                            
                     

						</li>



						


					</ul>
        
       
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Últimas Rechazadas

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php 
								
								include("sessions.php"); 
								
								$query = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and times.stage = '7.02' order by times.id desc limit 5";  
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
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								
								
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td>                                  <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row['btype'] == 1){ echo $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									echo $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last']; }?></td>
                                    <td>
									<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); } ?></td>
                                        <td>
										<?php 
										
										$iddelpago = $row['id'];
										echo $elvencimiento = getExpiration($iddelpago); 
										
										?></td><td>
                                        
                                       <?php 
									   
									   if($row['status'] == '14'){
										$querycancellation = "select * from times where stage = '14' and payment = '$row[id]'"; 
										$resultcancellation = mysqli_query($con, $querycancellation);
										$rowcancellation = mysqli_fetch_array($resultcancellation);
										$cancellationdate = date('d-m-Y',strtotime($rowcancellation["today"]));
										
										$querybank = "select * from banks where id = '$row[bank]'";
										$resultbank = mysqli_query($con, $querybank);
										$rowbank = mysqli_fetch_array($resultbank);
										$cancellationbank = $rowbank['name'];
										$cancellationref = $row["reference"];
										
										?>
                                        <a href="javascript:showCancellation('<?php echo $cancellationdate; ?>','<?php echo $row['cnumber']; ?>','<?php echo $cancellationbank; ?>','<?php echo $cancellationref; ?>');"><?php } 
										
										

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
								 
								 
								 if($row['status'] == '14'){ echo "</a>"; } ?>  
                                        
                                      
							
								
							</td><td>
                             
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                          
                            
                            </td></tr>
                                <?php }
								
								?>
                                <script>
								function showCancellation(today,cnumber,bank,ref){
									alert('Fecha de cancelacion: '+today+'\nCKPK: '+cnumber+'\nBanco: '+bank+"\nReferencia: "+ref); 
								}
								</script> 
                                   </tbody>

								</table>
                                
                                <a href="dashboard-releasing-rejected.php" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver Todas</a>
                                
<?php }else{ ?>
                                <div class="note note-info">
No hay rechhazos.</div>
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