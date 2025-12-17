<?php include("sessions.php"); 

$year = date('Y');
$month = date('m');
								 
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" class="no-js">

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1" name="viewport"/>

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

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<link href="../assets/global/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN PAGE STYLES -->

<link href="../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<!-- END PAGE STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.flot.pie.js"></script>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content">

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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row"> 

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Dashboard <small>Estadísticas y más</small>

					</h3>

					<?php /*<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

						</li>

						


					</ul>*/ ?>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN DASHBOARD STATS -->

			<?php /*<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Solicitante</a>

						</li>

						


					</ul>
           <div class="row">
           <div class="col-md-12 ">
			
           <div class="form-body">
									<h4 class="form-section">Pagos cancelados</h4>
                                    </div></div>

				  <?php //SOLICITADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '1' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Cordobas</div>

						</div>

					

					</div>
                    

				</div>
                <?php //RECHAZADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						
                        <div class="visual">

							<i class="fa fa-dollar"></i>

						</div>

						<div class="details">

							<div class="number">

								  <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '2' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Dolares</div>

						</div>

					

					</div>
                    

				</div>
                <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-euro"></i>

						</div>

						<div class="details">

							<div class="number">

								  <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '3' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Euros</div>

						</div>

					

					</div>
                    

				</div>
                  <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-yen"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '4' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Yenes</div>

						</div>

					

					</div>
                    

				</div>
           </div> */ ?>
			
        
         <div class="row">
           <div class="col-md-12 ">
           
            <?php if($_SESSION['president'] == 'active'){
				//Presidente
				include("dashboard-president.php");
				}  
			?>
            
            
            
	   <?php if($_SESSION['manager'] == 'active'){ ?> 
   
        <?php include("dashboard-manager.php"); ?>
                    
          <?php /* <div class="row">
           <div class="col-md-12 ">
			
           <div class="form-body">
									<h4 class="form-section">Pagos cancelados</h4>
                                    </div></div>

				  <?php //SOLICITADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '1' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Cordobas</div>

						</div>

					

					</div>
                    

				</div>
                <?php //RECHAZADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						
                        <div class="visual">

							<i class="fa fa-dollar"></i>

						</div>

						<div class="details">

							<div class="number">

								  <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '2' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Dolares</div>

						</div>

					

					</div>
                    

				</div>
                <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-euro"></i>

						</div>

						<div class="details">

							<div class="number">

								  <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '3' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Euros</div>

						</div>

					

					</div>
                    

				</div>
                  <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-yen"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '4' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Yenes</div>

						</div>

					

					</div>
                    

				</div>
                
                <div class="col-md-12 ">
			
           <div class="form-body">
									<h4 class="form-section">Pie</h4>
                                    </div></div>
                                    
              
			
        </div> </div>*/ ?>
        
        <?php } ?>
        
       
        
        <?php if($_SESSION['financemanager'] == 'active'){
			include('dashboard-financemanager.php');
			/*<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Gerente financiero</a>

						</li>

						


					</ul>
           <div class="row">
           <div class="col-md-12 ">
			
           <div class="form-body">
									<h4 class="form-section">Pagos cancelados</h4>
                                    </div>
                                    
                                    </div>

				  <?php //SOLICITADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '1' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Cordobas</div>

						</div>

					

					</div>
                    

				</div>
                <?php //RECHAZADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						
                        <div class="visual">

							<i class="fa fa-dollar"></i>

						</div>

						<div class="details">

							<div class="number">

								  <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '2' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Dolares</div>

						</div>

					

					</div>
                    

				</div>
                <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-euro"></i>

						</div>

						<div class="details">

							<div class="number">

								  <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '3' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Euros</div>

						</div>

					

					</div>
                    

				</div>
                  <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="fa fa-yen"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.currency = '4' and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' group by times.payment";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 ?>

							</div>

							<div class="desc">

								Yenes</div>

						</div>

					

					</div>
                    

				</div>
           </div>*/ 
		   } ?>
            
            
            
           <?php if($_SESSION['request'] == 'active'){
				//Solicitante
				include("dashboard-request.php");
				}  
			?>
            
             <?php if($_SESSION['approve1'] == 'active'){
				//Solicitante
				include("dashboard-approve1.php");
				}  
			
          if($_SESSION["releasing"] == 'active'){?>  
           
          <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Liberador</a>

						</li>

						


					</ul>
           <div class="row">
           
            <?php //released ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						
                        <div class="visual">

							<i class="fa fa-check"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query= "select * from times where stage = '9' and YEAR(today) = '$year' and MONTH(today) = '$month'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo str_replace('.00','',number_format($num, 2));
								 ?>

							</div>

							<div class="desc">

								Liberados</div>

						</div>

					

					</div>
                    

				</div>

				  <?php //PENDING RELEASING ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

                        <div class="visual">

							<i class="fa fa-clock-o"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select * from payments where status = '8'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo str_replace('.00','',number_format($num, 2));
								 ?>

							</div>

							<div class="desc">

								Pendientes</div>

						</div>

					

					</div>
                    

				</div>
                
                <?php //DAILY PROM RELEASING ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-calculator"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select * from times where stage = '9' and YEAR(today) = '$year' and MONTH(today) = '$month'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo str_replace('.00','',number_format($num/date('d'), 2)); 
								 
								 
								  
								 ?>

							</div>

							<div class="desc">

								PROM diario</div>

						</div>

					

					</div>
                    

				</div>

           </div>
           
           <?php } ?>
         <?php if($_SESSION["provision"] == 'active'){ ?>
          <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Provisionador</a>

						</li>

						


					</ul>
           <div class="row">

				  <?php //provisioned ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<?php $query= "select * from times where stage = '8' and YEAR(today) = '$year' and MONTH(today) = '$month'";
						?> 
                        <div class="visual">

							<i class="fa fa-check"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num;
								 ?>

							</div>

							<div class="desc">

								Provisionados</div>

						</div>

					

					</div>
                    

				</div>
                
                <?php //devoluciones ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<?php $query= "select * from times where stage = '11' and YEAR(today) = '$year' and MONTH(today) = '$month'";
						?> 
                        <div class="visual">

							<i class="fa fa-reply"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num;
								 ?>

							</div>

							<div class="desc">

								Devoluciones</div>

						</div>

					

					</div>
                    

				</div>
                
                 <?php //provisin pending ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<?php $query= "select * from payments where (status = '2' or status = '3' or status = '4') and approved = '1'";
						?> 
                        <div class="visual">

							<i class="fa fa-clock-o"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num;
								 ?>

							</div>

							<div class="desc">

								Pendientes</div>

						</div>

					

					</div>
                    

				</div>
                
                 <?php //DAILY PROM PROVISSION ?>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-calculator"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php echo number_format($num/date('d'), 2); 
								 
								 
								  
								 ?>

							</div>

							<div class="desc">

								PROM diario</div>

						</div>

					

					</div>
                    

				</div>

           </div>
           <?php } ?>
           
           
           <?php if($_SESSION["treasury"] == 'active'){ ?>
           <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Jefe de tesorería</a>

						</li>

						


					</ul>
           <div class="row">

				  <?php //provisioned ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<?php //Si es el reporte de todos los pagos aprobados que no han sido cancelados
						 //$query= "select * from payments where approved = '1' and status < '14'"; 
						 //si es el reporte de los pagos que estan programados
						 $query= "select * from payments where approved = '1' and status = '12'"; 
						?> 
                        <div class="visual">

							<i class="fa fa-clock-o"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num;
								 ?>

							</div>

							<div class="desc">

								Pendientes</div>

						</div>

					

					</div>
                    

				</div>
                
           
                
                 <?php //DAILY PROM PROVISSION ?>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">
                    <?php $query= "select * from times where stage = '13' and YEAR(today) = '$year' and MONTH(today) = '$month'"; 
					 $result = mysqli_query($con, $query);
					 $num = mysqli_num_rows($result);
					?>
						<div class="visual">

							<i class="icon-calculator"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php echo number_format($num/date('d'), 2); 
								 
								 
								  
								 ?>

							</div>

							<div class="desc">

								PROM diario</div>

						</div>

					

					</div>
                    

				</div>

           </div>
           <br>
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos pendientes por compañía

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $query = "select * from payments where approved = '1' and status = '12' group by provider order by expiration";
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
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-schedule-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay pagos pendientes.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>
<?php } ?>

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
<?php /*
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
*/ ?>
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

<script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>



<script src="../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->

<script src="../assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<?php ?> 
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php ?>

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/index.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

	<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core componets

   Layout.init(); // init layout

   QuickSidebar.init() // init quick sidebar

   Index.init();   

   Index.initDashboardDaterange();

   Index.initJQVMAP(); // init index page's custom scripts



   Index.initCharts(); // init index page's custom scripts

   Index.initChat();

   Index.initMiniCharts();


   ComponentsPickers.init();

});

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
