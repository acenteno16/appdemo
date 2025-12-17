<? 

include_once('functions.php');

?>
<div class="row"></div>
<div class="col-md-12">

   <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-basket"></i>

							<a href="dashboard.php">Solicitudes</a>
                            
                     

						</li>



						


					</ul>
           <div class="row">

				  <?php //SOLICITADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-plus"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php 
								 
								 $query = "select * from payments where userid = '$_SESSION[userid]' and YEAR(today) = '$year' and MONTH(today) = '$month'"; 
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num;
								 ?>

							</div>

							<div class="desc">

								Solicitados</div>

						</div>

					

					</div>
                    

				</div>
                <?php //RECHAZADOS ?>
                <? 
				
				$firstday = date("Y-m-1");;
				$queryrequestrejected = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and payments.userid='$_SESSION[userid]' and times.today >= '$firstday' and times.stage = '1'";
				
				?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat red-intense">

						
                        <div class="visual">

							<i class="icon-trash"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php 
								 
								 
								 
								 //$queryrequestrejected = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and payments.userid='$_SESSION[userid]' and (times.stage = '5' or times.stage='6' or times.stage='7' or times.stage='7.01' or times.stage='7.2' or times.stage='7.03' or times.stage='7.04' or times.stage='7.05' or times.stage='7.06'  or times.stage='7.07') and times.today >= '$firstday'";
								 
								 
								 //$queryrequestrejected = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and payments.userid='$_SESSION[userid]' and (times.stage = '5' or times.stage='6' or times.stage='7' or times.stage='7.01' or times.stage='7.2' or times.stage='7.03' or times.stage='7.04' or times.stage='7.05' or times.stage='7.06'  or times.stage='7.07')";
								 
								 $resultrequestrejected = mysqli_query($con, $queryrequestrejected);
								 $numrequestrejected = mysqli_num_rows($resultrequestrejected);
								 echo $numrequestrejected;
								 ?>

							</div>

							<div class="desc">

								Rechazados</div>

						</div>

					

					</div>
                    

				</div>
                <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-calculator"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select * from payments where userid = '$_SESSION[userid]' and YEAR(today) = '$year' and MONTH(today) = '$month'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo number_format($num/date('d'), 2); 
								 
								 
								  
								 ?>

							</div>

							<div class="desc">

								PROM diario</div>

						</div>

					

					</div>
                    

				</div>
                
                <?php //Pagos cancelados ?>
              <?php /*  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						
                        <div class="visual">

							<i class="fa fa-check"></i>

						</div>

						<div class="details">

							<div class="number">

							<?php $query = "select * from payments where userid = '$_SESSION[userid]' and YEAR(today) = '$year' and MONTH(today) = '$month' and status='14'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 
								 
								  
								 ?>
							</div>

							<div class="desc">

								Liberados</div>

						</div>

					

					</div>
                    

				</div> */ ?>
              
           </div>
          <br>
           <?php if($numrequestrejected > 0){ ?>
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos rechazados

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and payments.userid='$_SESSION[userid]' and (times.stage = '5' or times.stage='6' or times.stage='7') and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' limit 10";
								$result = mysqli_query($con, $query);  
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>
                                
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
                                <?php while($row=mysqli_fetch_array($result)){
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select stage from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select content from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select pre, symbol from currency where id = '$row[currency]'"));  
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php 
								echo $ben_name; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(intval(-1*abs($dias))).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay devoluciones.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div> 

			<!-- END PAGE CONTENT-->

		</div>
        <?php } ?>
         <br>
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos aprobados pendientes de cancelación

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $query = "select * from payments where userid = '$_SESSION[userid]' and approved='1' and status < '14'";
								$result = mysqli_query($con, $query);  
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 ID</th>

									

									<th width="17%">

										 Beneficiario</th>

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
                                <?php while($row=mysqli_fetch_array($result)){
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select stage from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select content from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select pre, symbol from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								echo $ben_name;	
								?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay pagos pendientes de cancelación.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>
        </div>