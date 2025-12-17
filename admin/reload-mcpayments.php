<?php include("session-manager.php"); 
 
$currency = $_POST['currency'];
								
								$today = date('Y-m-d'); 
								$querymcpayment = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and currency = '$currency' and workers.unit = '$_SESSION[unit]' limit 10";
								$resultmcpayment = mysqli_query($con, $querymcpayment);  
								$nummcpayment = mysqli_num_rows($resultmcpayment);
								if($nummcpayment > 0){ 
								
								?>
                                
                               <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="17%">

										 Nombre</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="14%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($rowmcpayment=mysqli_fetch_array($resultmcpayment)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowmcpayment[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$rowmcpayment[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$rowmcpayment[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowmcpayment['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($rowmcpayment['payment'], 2)); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-view.php?id=<?php echo $rowmcpayment['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                               
                            
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay registros.</div>
<?php } ?>
                                   