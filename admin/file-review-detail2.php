<?php include("session-review.php");


?>
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

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:onFocus();">

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

					Remisiones <small>Revisión de Solicitudes</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="file-review.php">Remisiones</a>
                                   <i class="fa fa-angle-right"></i>
                                   </li>
                      

						<li>

							<a href="#"> Revisión de Solicitudes</a>

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

        
        	
                                
                               

<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					

							

							<div class="tab-pane" id="tab_1">

								
								                            <div class="portlet box blue">

									<div class="portlet-title">

									
                                        
                                         

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="file-review-detail-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Revisar Solicitud</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-12 ">
													  <div class="form-group">
														<label>ID de la solicitud:</label>
                                                        <input name="id" type="text" class="form-control" id="id" value="" onChange="javascript:this.form.submit;">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

								

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Revisar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>
            
             		     		<br>
                           
                                  
            
             		<div class="row">
				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

				Solicitudes

							</div>
                            

							<div class="actions">
                            <div style="margin-top:-20px;">		
															<select name="mayorstage" class="form-control" id="mayorstage" onChange="javascript:changer(this.value)">
                                                  
<option value="0" <?php if(!isset($_GET['type']) or ($_GET['type'] == 0)) echo 'selected'; ?>>Todos</option>
<option value="1" <?php if($_GET['type'] == 1) echo 'selected'; ?>>No Revisados</option>
<option value="2" <?php if($_GET['type'] == 2) echo 'selected'; ?>>Completos</option>
<option value="3" <?php if($_GET['type'] == 3) echo 'selected'; ?>>Todos los Incompletos</option>
<option value="4" <?php if($_GET['type'] == 4) echo 'selected'; ?>>Incompletos no aprobados</option>
<option value="5" <?php if($_GET['type'] == 5) echo 'selected'; ?>>Incompletos aprobados</option>					</select>

<script>
function changer(value){
	window.location = "file-review-detail.php?type="+value;
}
</script>
</div>
													  </div>

						</div>

						<div class="portlet-body">

							<?php if(!isset($_GET['type']) or ($_GET['type'] == 0)){ ?>
                         <div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							
$query = "select * from payments where sent >= '2' and sent <= 5 and approved = 1 order by expiration asc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from payments where sent >= '2' and sent <= 5 and approved = 1 order by expiration asc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDP:</strong> ID de pago<br>
                               	    <strong>NOA:</strong> Número de archivos. </p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDP</th>
                                         <th width="20%">

										 Proveedor</th>
                                            <th width="10%">

										 Monto</th>
                                        

									<th width="2%">

										 NOA</th>

									
									
									

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						
								?>
                                
                                <tr role="row" class="odd <?php $sentvar = 0;
								switch($row['sent']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo 'danger';
								break;
								case 5:
								echo "success";
								$sentvar = 1;
								break;
								} ?>"> 
                                <td class="sorting_1"><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> <?php echo $row['id']; ?></a></td>
                                
                               <td>
                               <?php $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								echo $rowprovider['code'].' | '.$rowprovider['name'];
								
                                ?></td>
                                <td>
                                <?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].$row['payment'].' '.$rowcurrency['name']; ?></td>
                                <td><?php $queryfiles = "select * from files where payment = '$row[id]' order by status";
								$resultfiles = mysqli_query($con, $queryfiles);
								$numfiles = mysqli_num_rows($resultfiles);
								echo $numfiles;
							
								 ?></td>
                                <td>
                                <?php $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
							
								
								?>
                                </td>
                              
                              <td>
                              <?php if(($row['sent'] >= 2) and ($row['sent'] <= 5)){ if($sentvar == 0){?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                                <?php } }
								   if(($row['sent'] == 4) or($row['sent'] == 5)){  ?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-clock-o"></i> Esperando ser archivado</a>
                                <?php } 
								if(($row['sent'] == 3) and (($_SESSION["paymentschedule"] == "active") or ($_SESSION["provision2"] == "active") or ($_SESSION["authdata"] == "active"))){ ?> <a href="file-review-detail-approve.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Aprobar almacenado incompleto</a>
                                
                                <?php } ?>
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="file-review-detail.php?page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               

							</div>
                         <?php } elseif($_GET['type'] == 1){ ?>
                         <div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							
$query = "select * from payments where sent = '2' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from payments where sent = '2' order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDP:</strong> ID de pago<br>
                               	    <strong>NOA:</strong> Número de archivos. </p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDP</th>
                                         <th width="20%">

										 Proveedor</th>
                                            <th width="10%">

										 Monto</th>
                                        

									<th width="2%">

										 NOA</th>

									
									
									

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						
								?>
                                
                                <tr role="row" class="odd <?php switch($row['sent']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo 'danger';
								break;
								case 5:
								echo "success";
								break;
								} ?>"> 
                                <td class="sorting_1"><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> <?php echo $row['id']; ?></a></td>
                                
                               <td>
                               <?php $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								echo $rowprovider['code'].' | '.$rowprovider['name'];
								
                                ?></td>
                                <td>
                                <?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].$row['payment'].' '.$rowcurrency['name']; ?></td>
                                <td><?php $queryfiles = "select * from files where payment = '$row[id]' order by status";
								$resultfiles = mysqli_query($con, $queryfiles);
								$numfiles = mysqli_num_rows($resultfiles);
								echo $numfiles;
							
								 ?></td>
                                <td>
                                <?php $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
							
								
								?>
                                </td>
                              
                              <td>
                              <?php if(($row['sent'] >= 2) and ($row['sent'] <= 5)){ ?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                                <?php }
								   if(($row['sent'] == 4) or($row['sent'] == 5)){  ?>
                              <a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-clock-o"></i> Esperando ser archivado</a>
                                <?php } 
								if($row['sent'] == 3){ ?> <a href="file-review-detail-approve.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Aprobar almacenado incompleto</a> 
                                
                                <?php } ?>
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="file-review-detail.php?type='.$_GET['type'].'&page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               

							</div>
                         <?php } elseif($_GET['type'] == 2){ ?>
                         <div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							
$query = "select * from payments where sent = '5' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from payments where sent = '5' order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDP:</strong> ID de pago<br>
                               	    <strong>NOA:</strong> Número de archivos. </p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDP</th>
                                         <th width="20%">

										 Proveedor</th>
                                            <th width="10%">

										 Monto</th>
                                        

									<th width="2%">

										 NOA</th>

									
									
									

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						
								?>
                                
                                <tr role="row" class="odd <?php switch($row['sent']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo 'danger';
								break;
								case 5:
								echo "success";
								break;
								} ?>"> 
                                <td class="sorting_1"><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> <?php echo $row['id']; ?></a></td>
                                
                               <td>
                               <?php $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								echo $rowprovider['code'].' | '.$rowprovider['name'];
								
                                ?></td>
                                <td>
                                <?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].$row['payment'].' '.$rowcurrency['name']; ?></td>
                                <td><?php $queryfiles = "select * from files where payment = '$row[id]' order by status";
								$resultfiles = mysqli_query($con, $queryfiles);
								$numfiles = mysqli_num_rows($resultfiles);
								echo $numfiles;
							
								 ?></td>
                                <td>
                                <?php $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
							
								
								?>
                                </td>
                              
                              <td>
                              <?php if(($row['sent'] >= 2) and ($row['sent'] <= 5)){ ?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                                <?php }
								   if(($row['sent'] == 4) or($row['sent'] == 5)){  ?>
                              <a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-clock-o"></i> Esperando ser archivado</a>
                                <?php } 
								if($row['sent'] == 3){ ?> <a href="file-review-detail-approve.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Aprobar almacenado incompleto</a> 
                                
                                <?php } ?>
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="file-review-detail.php?type='.$_GET['type'].'&page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               

							</div>
                         <?php } elseif($_GET['type'] == 3){ ?>
                         <div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							
$query = "select * from payments where sent = '3' or sent = '4' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from payments where sent = '3' or sent = '4' order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1);  

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDP:</strong> ID de pago<br>
                               	    <strong>NOA:</strong> Número de archivos. </p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDP</th>
                                         <th width="20%">

										 Proveedor</th>
                                            <th width="10%">

										 Monto</th>
                                        

									<th width="2%">

										 NOA</th>

									
									
									

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						
								?>
                                
                                <tr role="row" class="odd <?php switch($row['sent']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo 'danger';
								break;
								case 5:
								echo "success";
								break;
								} ?>"> 
                                <td class="sorting_1"><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> <?php echo $row['id']; ?></a></td>
                                
                               <td>
                               <?php $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								echo $rowprovider['code'].' | '.$rowprovider['name'];
								
                                ?></td>
                                <td>
                                <?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].$row['payment'].' '.$rowcurrency['name']; ?></td>
                                <td><?php $queryfiles = "select * from files where payment = '$row[id]' order by status";
								$resultfiles = mysqli_query($con, $queryfiles);
								$numfiles = mysqli_num_rows($resultfiles);
								echo $numfiles;
							
								 ?></td>
                                <td>
                                <?php $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
							
								
								?>
                                </td>
                              
                              <td>
                              <?php if(($row['sent'] >= 2) and ($row['sent'] <= 5)){ ?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                                <?php }
								   if(($row['sent'] == 4) or($row['sent'] == 5)){  ?>
                              <a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-clock-o"></i> Esperando ser archivado</a>
                                <?php } 
								if($row['sent'] == 3){ ?> <a href="file-review-detail-approve.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Aprobar almacenado incompleto</a> 
                                
                                <?php } ?>
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="file-review-detail.php?type='.$_GET['type'].'&page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               

							</div>
                         <?php } elseif($_GET['type'] == 4){ ?>
                         <div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							
$query = "select * from payments where sent = '3' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from payments where sent = '3' order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDP:</strong> ID de pago<br>
                               	    <strong>NOA:</strong> Número de archivos. </p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDP</th>
                                         <th width="20%">

										 Proveedor</th>
                                            <th width="10%">

										 Monto</th>
                                        

									<th width="2%">

										 NOA</th>

									
									
									

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						
								?>
                                
                                <tr role="row" class="odd <?php switch($row['sent']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo 'danger';
								break;
								case 5:
								echo "success";
								break;
								} ?>"> 
                                <td class="sorting_1"><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> <?php echo $row['id']; ?></a></td>
                                
                               <td>
                               <?php $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								echo $rowprovider['code'].' | '.$rowprovider['name'];
								
                                ?></td>
                                <td>
                                <?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].$row['payment'].' '.$rowcurrency['name']; ?></td>
                                <td><?php $queryfiles = "select * from files where payment = '$row[id]' order by status";
								$resultfiles = mysqli_query($con, $queryfiles);
								$numfiles = mysqli_num_rows($resultfiles);
								echo $numfiles;
							
								 ?></td>
                                <td>
                                <?php $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
							
								
								?>
                                </td>
                              
                              <td>
                              <?php if(($row['sent'] >= 2) and ($row['sent'] <= 5)){ ?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                                <?php }
								   if(($row['sent'] == 4) or($row['sent'] == 5)){  ?>
                              <a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-clock-o"></i> Esperando ser archivado</a>
                                <?php } 
								if($row['sent'] == 3){ ?> <a href="file-review-detail-approve.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Aprobar almacenado incompleto</a> 
                                
                                <?php } ?>
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="file-review-detail.php?type='.$_GET['type'].'&page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               

							</div>
                         <?php } elseif($_GET['type'] == 5){ ?>
                         <div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							
$query = "select * from payments where sent = '4' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from payments where sent = '4' order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDP:</strong> ID de pago<br>
                               	    <strong>NOA:</strong> Número de archivos. </p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDP</th>
                                         <th width="20%">

										 Proveedor</th>
                                            <th width="10%">

										 Monto</th>
                                        

									<th width="2%">

										 NOA</th>

									
									
									

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						
								?>
                                
                                <tr role="row" class="odd <?php switch($row['sent']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo 'danger';
								break;
								case 5:
								echo "success";
								break;
								} ?>"> 
                                <td class="sorting_1"><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> <?php echo $row['id']; ?></a></td>
                                
                               <td>
                               <?php $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								echo $rowprovider['code'].' | '.$rowprovider['name'];
								
                                ?></td>
                                <td>
                                <?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].$row['payment'].' '.$rowcurrency['name']; ?></td>
                                <td><?php $queryfiles = "select * from files where payment = '$row[id]' order by status";
								$resultfiles = mysqli_query($con, $queryfiles);
								$numfiles = mysqli_num_rows($resultfiles);
								echo $numfiles;
							
								 ?></td>
                                <td>
                                <?php $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
							
								
								?>
                                </td>
                              
                              <td>
                              <?php if(($row['sent'] >= 2) and ($row['sent'] <= 5)){ ?>
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                                <?php }
								   if(($row['sent'] == 4) or($row['sent'] == 5)){  ?>
                              <a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-clock-o"></i> Esperando ser archivado</a>
                                <?php } 
								if($row['sent'] == 3){ ?> <a href="file-review-detail-approve.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Aprobar almacenado incompleto</a> 
                                
                                <?php } ?>
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="file-review-detail.php?type='.$_GET['type'].'&page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               

							</div>
                         <?php } ?>
                          

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                                
                 
                
			</div>



							</div>

							

							

							

							

							

							

					

					</div>

				</div>

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

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar



});

</script>

    
    <script type="text/javascript">

function onFocus(){	
	document.getElementById("id").focus();
}
						</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>