<?php 

include("session-remission.php"); 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

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

					Remisiones <small>Creación de remisiones</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payments.php">Pagos</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="payments-packages.php">Remisiones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Crear remisión</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							<? //Admin query
								$query = "select * from payments where userid = '$_SESSION[userid]' and approved = '1' and sent = '0'";
								
								/*
								Seleccionar todos los pagos que:
								 
								1. Sean del usuario que inició sesion.
								2. Que se encuentren provisionados. **Aqui haremos el cambio ya que la remision la hace el provisionador. En teoria el provisionador solo podra hacer remisiones provisionadas por el.
								3. Que esten aprobados por el ultimo nivel.
								4. Que no hallan sido enviados anteriormente. 
								*/
							
								$query = "select payments.* from payments inner join times on payments.id = times.payment where times.userid = '$_SESSION[userid]' and ((times.stage='8.00') or (times.stage='8.01') or (times.stage='8.04') or (times.stage='8.05') or (times.stage='8.06')) and payments.child='0' and payments.approved = '1' and ((payments.sent = '1')) group by payments.id"; 
								$result = mysqli_query($con, $query);
								echo $num = mysqli_num_rows($result);?>	Solicitudes

							provisionadas pendiente de remisión</div>

							

						</div>

						<div class="portlet-body">
                            
                            

							<div class="table-container">

								

							

								<?php 
								
                        
								
								if($_GET['echo'] == 1){
									echo $query;
								}
								#if(($num > 0) or ($num2 > 0)){
                                if(($num > 0)){ ?>
                                
                                <div class="note note-regular">Seleccione los pagos que desea adjuntar a esta remisión</div>
                                
                                	<form action="payments-packages-add-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">  
                                    <div class="table-scrollable">
                                    
                                    <table class="table table-striped table-bordered table-hover" id="packages">
 
								<thead>

								<tr role="row" class="heading">

									<th width="2%" id="mainselectall">
									<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('pid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>
                                    
										 </th>
                                         <th width="5%">

										 ID</th>

									

									<th width="30%">

										 Beneficiario</th>
									<th width="1%">

										 Comp</th>

									<th width="13%">Total Pagar</th>

									<th width="7%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
                                while($row=mysqli_fetch_array($result)){
								
                                    
                                    if($row['btype'] == 1){
								        $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								    }else{
									   $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								    }
								
								    $rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								    $rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								    #$theroute = $row['routeid'];
								    #$queryunit = "select company.id from companies inner join units on companies.code = units.companyCode where units.id = '$theroute'";
								    #$resultunit = mysqli_query($con, $queryunit);
								    #$rowunit = mysqli_fetch_array($resultunit);
									#$thecompanyid = $rowunit['company']; 
								
								?>
                                
                                <tr role="row" class="odd"> 
                                
                                <td class="sorting_1"><input name="pid[]" type="checkbox" id="pid[]" value="<?php echo $row['id']; ?>" class="checkboxes" onChange="sameCompany();" >
                                  <input name="tcompany[]" type="hidden" id="tcompany[]" value="<? echo $row['company']; ?>"></td> 

                                <td><?php echo $row['id']; echo '-'.$theroute; ?></td><td><?php ?><?php 
                                    
                                    if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/> '; 
                                    echo $rowprovider['code'].' | ';
								if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; }?></td>
									<td><? if(file_exists("companies/$row[company].png")) echo "<img src='companies/$row[company].png' width='25px'>"; ?></td>
									<td> <?php $querycurrency = "select * from currency where id = '$row[currency]'";
								$resultcurrency = mysqli_query($con, $querycurrency);
								$rowcurrency = mysqli_fetch_array($resultcurrency);
								echo $rowcurrency['pre'].' ';
								echo $rowcurrency['symbol'];
								echo $row['payment'].' ';
								echo $rowcurrency['name']; 
								
								?></td><td><?php 
									$date1 = date("Y-m-d");
									echo $date2 = date('d-m-Y',strtotime($row['expiration']));
									$dias	= (strtotime($date1)-strtotime($date2))/86400;
									if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
									if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>";
									elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
									?></td><td><?php echo $rowstage['content']; ?> 
									</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } ?>
                                  </tbody>

								</table></div>
                                  <input type="hidden" name="req_token" value="<? echo uniqid(); ?>">
                                  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Crear remisión</button>
                                
</form>
                                
                                <?php } else { ?>
                                
                                <div class="note note-danger"> 

						<p>

							NOTA: No hay pagos pendientes de remisionar.

						</p>

					</div>
                                <?php } ?><br>
                              
                        
                                
                              
						</div>
                        
   
                      </div>
                        
                        <div class="portlet-title">

							<div class="caption">
<? 
								
								/*
								Seleccionar todos los pagos que:
								 
								1. Sean del usuario que inició sesion.
								2. Que se encuentren provisionados. **Aqui haremos el cambio ya que la remision la hace el provisionador. En teoria el provisionador solo podra hacer remisiones provisionadas por el.
								3. Que esten aprobados por el ultimo nivel.
								4. Que no hallan sido enviados anteriormente. 
								*/
								$query = "select payments.* from payments inner join times on payments.id = times.payment where times.userid = '$_SESSION[userid]' and times.stage='1.00' and payments.approved = '1' and payments.sent = '0' group by payments.id";
								//Rep 5 Oct
								$query = "select payments.* from payments inner join times on payments.id = times.payment where ((times.userid = '$_SESSION[userid]') and (times.stage='1.00')) and payments.approved = '1' and payments.sent < '2' and payments.child='0' group by payments.id"; 
								$result = mysqli_query($con, $query);
								echo $num = mysqli_num_rows($result);
                                
                                /*$query2 = "select payments.* from payments inner join times on payments.id = times.payment where times.userid = '$_SESSION[userid]' and ((times.stage='jai8.00') or (times.stage='8.01') or (times.stage='8.04')) and payments.approved = '1' and payments.sent = '1' group by payments.id"; 
								$result2 = mysqli_query($con, $query2);
								$num2 = mysqli_num_rows($result2);*/
								?>
								Solicitudes pendientes de remisión

							</div>

							

						</div>

						<div class="portlet-body">
                            
                            

							<div class="table-container">

								

							

								<?php 
								//Admin query
								
								
								
								if($_GET['echo'] == 1){
									echo $query;
								}
								#if(($num > 0) or ($num2 > 0)){
                                if(($num > 0)){ ?>
                                
                                <div class="note note-regular">Seleccione los pagos que desea adjuntar a esta remisión</div>
                                
                                	<form action="payments-packages-add-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">  
                                    <div class="table-scrollable">
                                    
                                    <table class="table table-striped table-bordered table-hover" id="packages">
 
								<thead>

								<tr role="row" class="heading">

									<th width="2%" id="mainselectall">
									<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('pid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>
                                    
										 </th>
                                         <th width="5%">

										 ID</th>

									

									<th width="30%">

										 Beneficiario</th>
									<th width="1%">

										 Comp</th>

									<th width="13%">Total Pagar</th>

									<th width="7%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
                                while($row=mysqli_fetch_array($result)){
								
                                    
                                    if($row['btype'] == 1){
								        $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								    }else{
									   $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								    }
								
								    $rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								    $rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								    $theroute = $row['routeid'];
								   
								    #$queryunit = "select company.id from companies inner join units on companies.code = units.companyCode where units.id = '$theroute'";
								    #$resultunit = mysqli_query($con, $queryunit);
								    #$rowunit = mysqli_fetch_array($resultunit);
								
								
								    $thecompanyid = $rowunit['company']; 
								
								?>
                                
                                <tr role="row" class="odd"> 
                                
                                <td class="sorting_1"><input name="pid[]" type="checkbox" id="pid[]" value="<?php echo $row['id']; ?>" class="checkboxes" onChange="sameCompany();" >
                                  <input name="tcompany[]" type="hidden" id="tcompany[]" value="<? echo $thecompanyid; ?>"></td> 

                                <td><?php echo $row['id']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/> '; 
                                echo $rowprovider['code'].' | ';    
								if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; }?></td>
									<td><? if(file_exists("companies/$row[company].png")) echo "<img src='companies/$row[company].png' width='25px'>"; ?></td>
									<td> <?php $querycurrency = "select * from currency where id = '$row[currency]'";
								$resultcurrency = mysqli_query($con, $querycurrency);
								$rowcurrency = mysqli_fetch_array($resultcurrency);
								echo $rowcurrency['pre'].' ';
								echo $rowcurrency['symbol'];
								echo $row['payment'].' ';
								echo $rowcurrency['name']; 
								
								?></td><td><?php $date1 = date("Y-m-d");
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
                                <?php } ?>
                                  </tbody>

								</table></div>
                                <input type="hidden" name="req_token" value="<? echo uniqid(); ?>">
                                  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Crear remisión</button>
                                
</form>
                                
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos pendientes de remisionar.

						</p>

					</div>
                                <?php } ?><br>
                              
                            <a href="payments-packages.php"><label class="btn blue">
									<i class="fa fa-mail-reply"></i> Regresar a Remisiones </label> </a>
                                
                              
						</div>
                        
                       <br>
<div class="note note-regular">
 NOTA: El pago debe de estar provisionado para poder ser incluido en una remisión.</div>

                      </div>
                        
                        
                        
                        

					<!-- End: life time stats -->

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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
 
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>



<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 

});
				
function validateForm(){
	var cbox = 0;
	var i=0;
	for (var obj in document.getElementsByName('pid[]')){
		if (i<document.getElementsByName('pid[]').length){
			var mcheckbox = document.getElementById('pid[]')[i].checked;
			if(mcheckbox == true){
				cbox = 1;
			}
 		}
  		i++;
	}
	if(cbox == 0){
		alert('Usted debe de seleccionar al menos una solicitud.');
		return false;
	}
}

function sameCompany(){ 

	var i=0;
	var i2=0;
	for (var obj in document.getElementsByName('pid[]')){
 	if (i<document.getElementsByName('pid[]').length){

 	if(document.getElementsByName('pid[]')[i].checked == true){
	
	if(i2 == 0){
		var first_select = document.getElementsByName('tcompany[]')[i].value;
		i2++; 
	}
	
	var tcompany = document.getElementsByName('tcompany[]')[i].value;
	
	if(tcompany != first_select){
		document.getElementsByName('pid[]')[i].checked = false;
		alert('Favor realizar la remision con solicitudes de una misma compañia.');
		
	} 
 }

  }
  i++;
}


}



</script>
    

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>