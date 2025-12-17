<?php 

include("session-withholding.php"); 

$hall = base64_decode($_GET['hall']); 

$queryhall = "select * from halls where id = '$hall'";
$resulthall = mysqli_query($con, $queryhall);
$rowhall = mysqli_fetch_array($resulthall);

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

					Retenciones <small>Alcaldías</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="withholding-mayor-tax-branch.php">Alcaldías</a>
                            <i class="fa fa-angle-right"></i>

							

						</li>
                         <li>

							<a href="#"><?php echo $rowhall['name']; ?></a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
              <div class="col-md-12">

			
                                                    
                                                    
                    <?php 
				  
				   $queryhallsmain = "select * from routes where type = '23' and unit = '999999999' and worker = '$_SESSION[userid]'";
				  $resulthallsmain = mysqli_query($con, $queryhallsmain);
				  $numhallsmain = mysqli_num_rows($resulthallsmain);
				  
				  				  
				  
				  $queryhalls = "select * from routes where type = '23' and worker = '$_SESSION[userid]'";
				  $resulthalls = mysqli_query($con, $queryhalls);
				  $numhalls = mysqli_num_rows($resulthalls);
				  
				  if(($numhalls > 0) and (!isset($_GET['hall']))){ ?>
            	  <div></div>
                  
                  <h3>Alcaldías</h3>
                  
                  <?php 
				  if($numhallsmain > 0){
					//start
				  $queryhall = "select * from halls where active = '1'"; 
				  $resulthall = mysqli_query($con, $queryhall);
				  while($rowhall = mysqli_fetch_array($resulthall)){
				  
				  ?>
                  <a href="?hall=<?php echo base64_encode($rowhall['id']); ?>">- <?php echo $rowhall['name']; ?></a><br>  
                  <?php }
				    
				
				
					//end  
				  }else{
				  if($numhalls == 1){
				  $rowhalls=mysqli_fetch_array($resulthalls);
				  
				  $queryhall = "select * from halls where id = '$rowhalls[unit]'"; 
				  $resulthall = mysqli_query($con, $queryhall);
				  $rowhall = mysqli_fetch_array($resulthall);
				  ?>
				  <script>
				  window.location = "?hall=<?php echo base64_encode($rowhall['id']); ?>"; 
				  </script>
				  <?php	  
				  }else{
				  while($rowhalls=mysqli_fetch_array($resulthalls)){ 
				  
				  $queryhall = "select * from halls where id = '$rowhalls[unit]'"; 
				  $resulthall = mysqli_query($con, $queryhall);
				  $rowhall = mysqli_fetch_array($resulthall);
				  
				  ?>
                  <a href="?hall=<?php echo base64_encode($rowhall['id']); ?>">- <?php echo $rowhall['name']; ?></a><br> 
                  
                  <?php }
				
				  }
				  }
				  ?>
                  
            </div>
            	  <div class="row"></div><br><br>
                  <?php }else{   
				  
				  $hall = base64_decode($_GET['hall']);
				  ?> 
                   <div class="row"></div><br><br>
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Retenciones Alcaldía

							</div>
                            </div>
                            

            
            	<form action="withholding-mayor-tax-branch.php" class="horizontal-form" method="get" enctype="multipart/form-data" ><input name="hall" type="hidden" id="hall" value="<? echo $_GET['hall']; ?>">

									<?php 
									if($_GET['filter'] == 1){
										include("withholding-filter.php");
									}else{ ?>
                                    <div class="note note-regular">
                                    <a href="withholding-mayor-tax-branch.php?hall=<? echo $_GET['hall']; ?>&filter=1">Ver Filtro</a>
                                    </div>
                                    <? } ?>

										</form>


						</div>

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<?php 
						
						$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$from = $_GET['from'];
$to = $_GET['to'];
$provider = $_GET['provider'];
$request = $_GET['request'];
$bill = $_GET['bill'];
$paymenten = $_GET['paymenten'];
$worker = $_GET['worker'];
$requester = $_GET['requester']; 

$joinhallsretention = 0;
$joinscheduletime = 0;
$jointime = 0;
$joinbill = 0;

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and times.today >= '$from'";
$sql1 = " and scheduletimes.today >= '$from'";
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and times.today <= '$to'";
$sql2 = " and scheduletimes.today <= '$to'";
}
$sql3 = "";
if($provider != ""){
$sql3 = " and payments.provider = '$provider'";
}
$sql4 = "";
if($request != ""){
$sql4 = " and payments.id = '$request'";
}
$sql5 = "";
if($bill != ""){
$sql5 = " and bills.number = '$bill'";
$joinbill = 1;
}
$sql6 = "";
if($worker != ""){
$sql6 = " and payments.collaborator = '$worker'";
}

$sql7 = "";
if($requester != ""){
$sql7 = " and payments.userid = '$requester'";
}

//JOINS
$joinscheduletime = 1; 

$join1 = "";
if($joinscheduletime == 1){
	$join1 = " inner join schedulecontent on schedulecontent.payment = payments.id left join scheduletimes on scheduletimes.schedule = schedulecontent.schedule";
}

$joinhallsretention = 1;
$join2 = "";
if($joinhallsretention == 1){
	$join2 = " inner join hallsretention on payments.id = hallsretention.payment";
}
$join3 = "";
if($jointime == 1){
	$join3 = " inner join times on payments.id = times.payment";
}

$join4 = "";
if($joinbill == 1){
	$join4 = " inner join bills on payments.id = bills.payment";
}

$join = $join1.$join2.$join3.$join4;

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7;  

$query = "select payments.* from payments".$join." where scheduletimes.stage = '5.00' and payments.hall = '$hall' and payments.mayorstage = '1' and payments.ret1a > '0'".$sql.' group by payments.id order by hallsretention.id asc'; 
	

								
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
								echo $num; ?> Retenciones pendientes | <?php echo $rowhall['name']; ?>

							</div>
                            <div class="actions">

								<a href="withholding-income-tax-groups-branch.php?hall=<?php echo $_GET['hall']; ?>" class="btn default blue-stripe"> 

								<i class="fa fa-check"></i>

								<span class="hidden-480">

								Ver grupos de cancelación</span>

								</a>

								                                
                                

							</div>

						</div>

						

					</div>
                    <div class="portlet-body">
                             
                             <form action="withholding-mayor-tax-branch-request-code.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								 
								<?php
								
							
								if($num > 0){ ?> 
                                
                               	<?php //echo $query; ?>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
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
                                    <th width="6%">IDR</th>
                                    <th width="2%">IDS</th>
                                    <th width="2%">Fecha Retención</th>
									
									<th width="17%">Proveedor/Colaborador</th>
									<th width="11%">Total Pagar</th>
									<th width="14%">Estado de retención</th>
									<th width="5%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								//if($nioammount > 1){
							
									
								$flag = "";
								if($rowprovider['flag'] == 1) $flag = '<img src="../images/flag.png" width="13"  alt=""/>'; 
								
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
									$theprovider = $flag." ".$rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
									$theprovider = $flag." ".$rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php
								  
								  $queryret = "select * from hallsretention where payment = '$row[id]'"; 
								  $resultret = mysqli_query($con, $queryret);
								  $rowret = mysqli_fetch_array($resultret);
								  echo $rowret['serial'].'-'.$number = str_pad((int) $rowret['number'],4,"0",STR_PAD_LEFT);
								  
								  
								  ?> 
                                  <td><?php 
								  
								 
								  //echo $rowret['serial'].'-'.$number;
								  echo $row['id'];
								  
								  
								  ; ?></td>
                                  <td>
                                   <?php
                                   /*$querycancellation = "select * from times where payment = '$row[id]' and stage = '14.00'";
  $resultcancellation = mysqli_query($con, $querycancellation);
  $rowcancellation = mysqli_fetch_array($resultcancellation);
  echo date('d-m-Y',strtotime($rowcancellation['today']));
  */
  
  
   $querycancellation = "select scheduletimes.today from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$row[id]'";  
								  
  $resultcancellation = mysqli_query($con, $querycancellation);
  $rowcancellation = mysqli_fetch_array($resultcancellation);
  echo date('d-m-Y',strtotime($rowcancellation['today'])); 
   
  ?>
                                  </td>
                                  <td><?php echo $theprovider; ?></td>
                                  <td><?php /*if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								  ?><br> */ ?>
                                  <?php echo 'C$'.str_replace('.00','',number_format($row['ret1a'],2)).' Cordobas'; ?>

</td>
                                
                                <td>
								
								<?php /*if($row['mayorstage'] == 0){
									echo "Pendiente de cancelación";
								}else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}*/ 
								
								if($row['status'] == 14){
									echo "Finalizado (Tesorería)";
								}else{
									echo "Cancelado (CFO)";
								}
								
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
							
							
							
							<?php /*<a href="withholding-mayor-tax-repair.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Reparar</a>*/ ?>
                            
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                        
							
                                
                                
                               <div class="form-actions right">


<button type="submit" class="btn blue"><i class="fa fa-check"></i> Solicitar pago</button> <input name="hall" type="hidden" id="hall" value="<?php echo $_GET['hall']; ?>"> 
                                               
                                             <button type="button" class="btn blue"  onClick="javascript:genExcel();"><i class="fa fa-file-excel-o"></i> Excel preliminar</button> 
                                                 <button type="button" class="btn blue"  onClick="javascript:genPDF();"><i class="fa fa-file-pdf-o"></i> Generar PDF</button> 
                                                
                                               
<script>
function genExcel(){
	var myForm = document.getElementById("form2"); 
	var caction = myForm.action;
	myForm.action = "withholding-mayor-tax-excel.php";
	myForm.submit();
	myForm.action = caction;
	
}

function genPDF(){
	var myForm = document.getElementById("form2"); 
	var caction = myForm.action;
	myForm.action = "withholding-mayor-tax-pdf.php"; 
	myForm.submit();
	myForm.action = caction;
	
}
</script>


<?php /*<script>
function pdfPrint(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "withholding-mayor-tax-pdf.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>*/ ?>
                                                

                                                              

							</div>
                                

                            
                                <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA:
                             No hay ninguna retención de Alcaldía por generar.
							  	

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

					</div>
                  
                    
                 

					<!-- End: life time stats -->

				</div>

			</div>
            <br><br>&nbsp;<br><br>
            <?php } ?>
               

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

<script src="../assets/admin/pages/scripts/table-managed.js"></script>


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();
TableManaged.init();


        });

</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>