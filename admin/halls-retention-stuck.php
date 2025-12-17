<?php 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["imistuck"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}
	 
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





<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>


<!-- END PAGE LEVEL STYLES -->

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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Retenciones Atascadas <small> Alcaldía</small></h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="retentions-home.php">Retenciones</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li><a href="#">Retenciones Atascadas</a>
                                </li>
                           
						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                
                 <div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="<? echo $_SERVER['PHP_FELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Filtro</h3> 

												<div class="row"><!--/span-->
													<div class="col-md-3">
														 <label>ID de solicitúd:</label>
														<input type="text" class="form-control" id="id" name="id" placeholder="ID" value="<? echo $_GET['id']; ?>">
													</div>
													<div class="col-md-3 ">
													<div class="form-group">
												    <label>Compañía:</label>
													<select name="company" class="form-control" id="company">
														  <option value="">Todas</option>
                                                         <?php $queryhalls = "select * from companies order by name";
														 $resulthalls = mysqli_query($con, $queryhalls);
														 while($rowhalls=mysqli_fetch_array($resulthalls)){
														 ?>
                                                         <option value="<?php echo $rowhalls['id']; ?>" <? if($_GET['company'] == $rowhalls['id']) echo "selected"; ?>><?php echo $rowhalls['name']; ?></option>
                                                         <?php } ?>
                                                         													    </select>
													
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													<div class="form-group">
												    <label>Alcaldía Sugerida:</label>
													<select name="hall" class="form-control" id="hall">
														  <option value="" selected>No</option>
                                                        <option value="1" <? if($_GET['hall'] == 1) echo "selected"; ?> >Si</option>
                                                        
                                                         													    </select>

                                                      <!--/row--></div>
													</div>
												  

													<!--/span-->

											
                                                  
                                                  <div class="col-md-3" > 
													  <div class="form-group">
                                                    <label class="control-label">Rango de Fechas: (Ingreso a banco)</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde" value="<? echo $_GET['from']; ?>">

												<span class="input-group-addon"><i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" value="<? echo $_GET['to']; ?>" >

											</div>

														  </div></div> 

											
										</div>
												<div class="row"></div>  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">


												<button type="button" onClick="go2('halls-retention-stuck.php');" class="btn red"><i class="fa fa-times"></i> Eliminar Filtro</button>
                                                <button type="submit" class="btn blue"><i class="fa fa-check"></i> Filtrar</button>
                                                <script>
                                                    function go2(URL){
                                                        window.location = URL;
                                                    }
                                                </script>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>
                    
<?
$today = date('Y-m-d'); 
$tampagina = 200;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina; 
}

$company = $_GET['company'];
$hall = $_GET['hall'];    
$id = $_GET['id'];
$from = $_GET['from'];
$to = $_GET['to']; 
$urlStr = "";
                    
$sql1 = "";
if($company != ""){
   $sql1 = " and payments.company = '$company'";
    $urlStr.= "&company=".$company;
}
$sql2 = "";
if($hall != ""){                    
    $urlStr.= "&hall=".$hall;
	$sql2 = " and payments.hall = '$hall'";
}
$sql3 = '';
if($id > 0){
	$sql3 = " and payments.id = '$id'";
	$urlStr.= "&id=".$id;
}
$sql4 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql4= " and times.today >= '$from'";
	$urlStr.="&from=$from";
}
$sql5 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql5 = " and times.today <= '$to'";
	$urlStr.="&to=$to";
}					
$sql = $sql1.$sql3.$sql4.$sql5;   
					
$query = "select payments.id from payments inner join times on payments.id = times.payment where times.stage = '13' and payments.approved = '1' and ret1void != '1' and (payments.status = '13' or payments.status = '14') and payments.mayorstage = '0' and payments.ret1a > '0'$sql group by payments.id";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

$query1 = "select payments.id, times.today, times.now2 from payments inner join times on payments.id = times.payment where times.stage = '13' and payments.approved = '1' and ret1void != '1' and (payments.status = '13' or payments.status = '14') and payments.mayorstage= '0' and payments.ret1a > '0'$sql group by payments.id order by times.id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 
                                                        
if($_GET['echo'] == 1){
    echo "Query: ".$query."<br>
          Query1: ".$query1;
} 
                    ?>
                                
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<? echo $numdev; ?> Retenciones Atascadas

							</div>
                            

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
<?php                                                        
                                                        
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;	
if($numdev > 0){		
		
		//start?>
     <form id="retentions" name="retentions" action="halls-retention-stuck-code.php" method="post" enctype="multipart/form-data">   
     <div class="note note-regular">Las retenciones cargadas en la tabla siguiente, son retenciones que no se generaron porque en el momento de cancelarse el pago no estaban anidadas a una Alcaldía en especifico. Con esta herramienta usted podrá crear dichas retenciones que quedaron atascadas. Cabe destacar que 
    si la alcaldía configurada no cuenta con retenciones disponibles, no se podra generar la retención.</div>
     
    
         
<p><strong>IDS:</strong> ID de Solicitud.<br>
<strong>Fecha IG:</strong> Fecha de ingreso a banco.</p>
 
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="2%">

										 <input type="checkbox" class="group-checkable" id="checkall0" onChange="javascript:checkAll0();" /> 
                                
                                  <script>
									  
									  function activateSelect(id){
										
										if(document.getElementById('theid-'+id).checked){
											document.getElementById('hallid-'+id).disabled = false;
										}else{
											document.getElementById('hallid-'+id).disabled = true;
										}
									}
									  
    function checkAll0(){
	 var checkall = document.getElementById('checkall0');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('approve0');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			 if(checkboxes[i].disabled == true){
			 	checkboxes[i].checked = false; 
			 }
		  
		  activateSelect(i);
	  }
	}
      </script>
      </th>
									<th>IDS</th>
                                    <th width="20%">Fecha IG</th>
                                    <th>Compañía</th>

									<th width="42%">

										 Proveedor/Colaborador</th>
                                         
                                         
                                         <? /*<th width="2%">

										 Cancelación</th>*/ ?>
                                         <th width="2%">

										 Monto</th>

<th width="2%">

										 Ruta</th>
                                         <th width="2%">

										 Alcaldía</th>

									<th width="14%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php
    
    
    $querycompany = "select * from companies";
    $resultcompany = mysqli_query($con, $querycompany);
    while($rowcompany=mysqli_fetch_array($resultcompany)){
        $theCompany["$rowcompany[id]"] = $rowcompany['name'];
    } 
    $inc = 0;
    while($row2=mysqli_fetch_array($result1)){
        
        $querypayment = "select * from payments where id = '$row2[0]'";
        $resultpayment = mysqli_query($con, $querypayment);
        $row = mysqli_fetch_array($resultpayment);
	
	$rowhalls2 = mysqli_fetch_array(mysqli_query($con, "select * from halls where id = '$row[hall]'"));
	
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$theprovider = $flag." ".$rowprovider['code']." | ".$rowprovider['name'];
	}else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
		$theprovider = $flag." ".$rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
	}

    $suggestion = "";
    if($_GET['hall'] == 1){
		$suggestion = $row['hall'];
    }
?>				
                                <tr role="row" class="odd">
									<td class="sorting_1"> <input name="theid[]" type="checkbox" id="theid-<? echo $inc; ?>" value="<?php echo $row['id']; ?>" onChange="activateSelect(<? echo $inc; ?>);" class="approve0" ></td>
                                  <td><a href="payment-order-view.php?id=<? echo $row['id']; ?>" target="_blank"> <?php echo $row["id"]; ?></a></td>
                                    <td>
                                    <? echo date('d-m-Y',strtotime($row2[1]))." <br>@".date('h:i a', strtotime($row2[2]));; ?>
                                    </td>
                                    <td>
                                    <? echo $theCompany[$row['company']]?>
                                    </td>
                                  
                                  <td><?php echo $theprovider; ?></td>
                                  <?php /*<td> 
       /* if($row['status'] == 13){
           echo "NA"; 
        }else{
            $querycdate = "select * from times where payment = '$row[id]' and stage = '14.00'";
			$resultcdate = mysqli_query($con, $querycdate);
			$rowcdate = mysqli_fetch_array($resultcdate);
        
			$todayc = strtotime($rowcdate['today']);
			$todayc = date('d-m-Y', $todayc);
            echo $todayc;
        } echo $row[1]; </td>*/
								  
								   ?>
                                  <td><?php echo "C$".$row["ret1a"]; ?></td>
                                  <td><?php echo $row["route"]; ?></td>
                                  <td><?php 
								  /*$queryhall = "select * from halls where units like '%$row[route]%'"; 
								  $resulthall = mysqli_query($con, $queryhall);
								  $rowhall = mysqli_fetch_array($resulthall);
								  if($rowhall['name'] == ""){
									  echo "ND";
								  }else{
								  	echo $rowhall['name'];
								  }
								  */
								  
								  ?>
                                  <select name="hallid[]" id="hallid-<? echo $inc; $inc++; ?>" class="disableBorder" disabled>
                                  <option value="0" selected>Definida en provisión</option>  
                                  <?php 
								  $queryhall = "select * from halls where active = '1'"; 
								  $resulthall = mysqli_query($con, $queryhall);
								  while($rowhall = mysqli_fetch_array($resulthall)){
								  ?> 
                                  <option value="<?php echo $rowhall['id']; ?>" <? if($rowhall['id'] == $suggestion) echo "selected"; ?> ><?php echo $rowhall['name']; ?></option> 
                                  <?php } ?>
                                  </select></td>
                                  <td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" target="_blank">  

									 <span class="label label-primary">
									<i class="fa fa-search"> </i> Ver </span></a>
                                    
                                    &nbsp; <a href="javascript:deleteStuck(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar atasco</span></a>
                                   
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
									
								
                                </tbody>

								</table>
    
    
    <div class="form-actions right">
<select name="datetype" id="datetype">
    <option value="0">Fecha de Hoy</option>
    <option value="1">Fecha ingreso a banco</option>
        
        </select>
<button type="submit" class="btn blue"><i class="fa fa-check"></i> Procesar</button>
<button type="button" class="btn red" onClick="javascript:deleteCascade();"><i class="fa fa-trash-o"></i> Eliminar seleccionadas</button>
<input name="scheduleid" type="hidden" id="scheduleid" value="<?php echo $_GET['id']; ?>"> 

</p>                                         

							</div>
    </form>  
	<style>
		.disableBorder:disabled{
			border: 1px solid #82090B;
			color: #cccccc;
		}
		
	</style>
	<script>
function deleteCascade(){

	var myForm = document.getElementById("retentions");
	var caction = myForm.action;
	myForm.action = "halls-retention-stuck-delete-cascade.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="?page=<?php echo $previous.$urlStr; ?>r">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i.'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="?page='.$i.$urlStr.'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="?page=<?php echo $next.$urlStr; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            <?php }else{ ?>
                            
                            <div class="note note-success">
                            <p>No se encontró ninguna retención atascada.</p>
                            </div>
                            <?php } ?>
                      

</div></div>

</div>


							

			<script>
				function deleteStuck(id){
		if (confirm("Usted desea eliminar este atasco?\n- Si usted no desea eliminar este atasco presione cancelar.")==true){
			window.location="halls-retention-stuck-delete.php?id="+id;	
	} 
}
			</script>				

							

					<?php //table } ?>		

							

							

					

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