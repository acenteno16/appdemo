<?php include("session-schedule.php"); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<meta content="" name="description"/>

<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content ">

<!-- BEGIN HEADER -->

<?php include("header.php"); ?>

<!-- END HEADER -->

<div class="clearfix">

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<?php include("side.php"); ?>

	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<div class="page-content-wrapper">

		<div class="page-content">

		

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Programación de pagos <?php //<small>Ordenes de pago</small> ?> 
					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

				
                        <li>

							<a href="payment-schedule.php">Programación de pagos</a>

						

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			
           
            <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 <form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
<div class="note note-regular">
								<div class="row"><h4 style="margin-left:15px;">Opciones de desagrupación:</h4><br>

<div class="col-md-2">


										<label><strong>Forma de pago</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="1"></span> Transf. elect. </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="2"></span> Cheque </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="3"></span> TC </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="4"></span> Telepagos </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="5"></span> Internet </label>
											
									
									</div>
</div>
<div class="col-md-2">


										<label><strong>Moneda</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="1"></span> Cordobas </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="2"></span> Dolares </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="3"></span> Euros </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="4"></span> Yenes </label>
                                           
									</div>
</div>
<div class="col-md-2">


										<label><strong>Vencimiento</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="expiration[]" type="checkbox" id="expiration[]" value="1"></span> Vencidos</label>
                                            <label>
											<span class=""><input name="expiration[]" type="checkbox" id="expiration[]" value="2"></span> Por vencerse</label>
                                            <label>
											<span class=""><input name="expiration[]" type="checkbox" id="expiration[]" value="3"></span>  No vencidos</label>
                                           
									
									</div>
                                    <label><strong>VIPs</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="vip[]" type="checkbox" id="vip[]" value="1"></span> Grupo Pellas</label>
                                            <label>
											<span class=""><input name="vip[]" type="checkbox" id="vip[]" value="2"></span> VIPs externos</label>
                                           
                                           
									
									</div>
</div>
<div class="col-md-6">


										<label><strong>Tipo/Concepto/Sub Categoría</strong></label>
										
                                        <div class="row"><div class="col-md-4"><div class="checkbox-list">
											<label>
											<span class=""><input type="checkbox"></span> Vencidos. </label>
                                            <label>
											<span class=""><input type="checkbox"></span> Por vencerse </label>
                                            <label>
											<span class=""><input type="checkbox"></span>  No vencidos</label>
                                           
									
									</div></div>
                                              <div class="col-md-4"><div class="checkbox-list">
											<label>
											<span class=""><input type="checkbox"></span> Vencidos. </label>
                                            <label>
											<span class=""><input type="checkbox"></span> Por vencerse </label>
                                            <label>
											<span class=""><input type="checkbox"></span>  No vencidos</label>
                                           
									
									</div></div>
                                              <div class="col-md-4"><div class="checkbox-list">
											<label>
											<span class=""><input type="checkbox"></span> Vencidos. </label>
                                            <label>
											<span class=""><input type="checkbox"></span> Por vencerse </label>
                                            <label>
											<span class=""><input type="checkbox"></span>  No vencidos</label>
                                           
									
									</div></div>
                                    
    </div>                                
</div> 

    </div>                            
<div class="row">

<br><br>
						<div class="col-md-2">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-puzzle-piece"></i> Desagrupar</button> 
												
                 </div>                               
  
</div>
						
								</div>
                                </form>
                                
                                <br><br>
                <?php $form = $_POST['form'];
				if($form == 0){
				?>                
                                
				  <form id="theform" name="theform" action="payment-schedule-code.php" method="post" enctype="multipart/form-data">	
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Programación agrupada

							</div>

							<div class="actions">

								<a href="payment-schedule-manual.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Programación manual</span>

								</a>

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php $query = "select * from payments where status = '9'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>	
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="7%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="14%">

										 Estado

									</th>

									<th width="16%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?><input type="hidden" name="id[]" id="id[]" value="<?php echo $row['id']; ?>"></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $row['payment']; ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna orden de pago vinculada a esta cuneta.

						</p>

					</div>
                                <?php } ?>
                                </tbody>

								</table>
                                <div class="form-actions right">


											<div class="col-md-4"><input name="schedule[]" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value=""></div>
                                            	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Programar</button>
                                                
	</div>
                                
                                <?php /*<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Mis ordenes de Pagos

							</div>
</div>
                                
                               <a href="payments-packages-add.php" class="icon-btn">
							<i class="fa fa-barcode"></i>
							<div>
								 Crear
							</div>
							
							</a>
                            <a href="payments-packages.php" class="icon-btn">
							<i class="fa fa-plane"></i>
							<div>
								 Enviados
							</div>
						
							</a>

							</div>*/ ?>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                </form>
                
                <?php }else{ 
				
				$ptype = $_POST['ptype'];
				$table = 1;
				$groups = array();
				$sql = array();
			
				for($c=0;$c<=sizeof($ptype);$c++){
					
					if($ptype[$c] != 0){
						switch($ptype[$c]){
							case 1:
							$groups[] = "Transferencias electronicas";
							$sql[] = " and ptype = '0'";
							break;
							case 2:
							$groups[] = "Cheques";
							$sql[] = " and ptype = '1'";
							break;
							case 3:
							$groups[] = "Tarjetas de crédito";
							$sql[] = " and ptype = '2'";
							break;
							case 4:
							$groups[] = "Telepagos";
							$sql[] = " and ptype = 3";
							break;
							case 5:
							$groups[] = "Internet Banking";
							$sql[] = " and ptype = '4'";
							break;
							}
					}
				} 
				
				$currency = $_POST['currency'];
				
				for($c=0;$c<=sizeof($currency);$c++){
					
					if($currency[$c] != 0){
						switch($currency[$c]){
							case 1:
							$groups[] = "Cordobas";
							$sql[] = " and currency = '1'";
							break;
							case 2:
							$groups[] = "Dolares";
							$sql[] = " and currency = '2'";
							break;
							case 3:
							$groups[] = "Euros";
							$sql[] = " and currency = '3'";
							break;
							case 4:
							$groups[] = "Yenes";
							$sql[] = " and currency = 4";
							break;
							
							}
					}
				} 
				$expiration = $_POST['expiration'];
			
				for($c=0;$c<=sizeof($expiration);$c++){
					
					if($expiration[$c] != 0){
						switch($expiration[$c]){
							case 1:
							$groups[] = "Vencidos";
							$sql[] = " and currency = '1'";
							break;
							case 2:
							$groups[] = "Por vencerse";
							$sql[] = " and currency = '2'";
							break;
							case 3:
							$groups[] = "No vencidos";
							$sql[] = " and currency = '3'";
							break;
						
							}
					}
				} 
				?>
                  <div class="portlet">

						<div class="portlet-title">

							<div class="caption">
                         <?php echo 'Groups: '.sizeof($groups).'<br>'; 
						 echo implode($groups,',')
						 ?>
                         </div>
                     </div>
                  </div>
                <?php for($c=0;$c<sizeof($groups);$c++){
				?>
                  <form id="theform<?php echo $table; ?>" name="theform<?php echo $table; ?>" action="payment-schedule-code.php" method="post" enctype="multipart/form-data">	
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<?php echo $groups[$c]; ?>

							</div>

						
						</div>

						<div class="portlet-body">

							<div class="table-container">

								
								<?php $query = "select * from payments where status = '9'".$sql[$c];
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>	
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%"><input name="selectall" type="checkbox" id="selectall" value="3" onChange="javascript:selectAll<?php echo $table; ?>();"></th>
                                 <script>
								 		
										function selectAll<?php echo $table; ?>(){

i=0;
										
for (var obj in document.getElementsByName('theid<?php echo $table; ?>[]')){
 if (i<document.getElementsByName('theid<?php echo $table; ?>[]').length){
 chk = document.getElementsByName('theid<?php echo $table; ?>[]')[i];

	
$(chk)
  .change(function() {
    var $input = $( this );
   if($("#theid<?php echo $table; ?> span" ).hasClass('checked')){
	   $( "#theid<?php echo $table; ?> span" ).removeClass('checked');
   }else{
	 $( "#theid<?php echo $table; ?> span" ).addClass('checked');
	    }
  })
.change();
  }
 
 }
 i++;


}
	
									</script>
                                <th width="4%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="14%">

										 Estado

									</th>

									<th width="16%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1"> <input name="theid<?php echo $table; ?>[]" type="checkbox" id="theid<?php echo $table; ?>[]" value="<?php echo $row['id']; ?>"></td><td><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.number_format($row['payment'], 2); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos liberados con las caracteristicas de este grupo.

						</p>

					</div>
                                <?php } ?>
                                </tbody>

								</table>
                                <?php if($num > 0){ ?> <div class="form-actions right">


											<div class="col-md-4"><input name="schedule[]" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value=""></div>
                                            	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Programar</button>
                                                
	</div> <?php } ?>
                                
                               

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                </form>
                <?php $table++; }
			
				 } ?>

			</div>

			<!-- END PAGE CONTENT-->

		</div>

	</div>

	<!-- END CONTENT --> 

	<!-- BEGIN QUICK SIDEBAR -->

    <?php include("sidebar.php"); ?>

<!-- END QUICK SIDEBAR -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<?php include("footer.php"); ?>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script src="../assets/admin/pages/scripts/components-pickers.js"></script>


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();

        });

    </script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>