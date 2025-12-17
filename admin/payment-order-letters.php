<?php 

include("session-request-bt.php");    

$id = $_GET['id']; 

$querypconfirm = "select * from letters where id = '$id'";
$resultpconfirm = mysqli_query($con, $querypconfirm);
$rowpconfirm = mysqli_fetch_array($resultpconfirm);

if($rowpconfirm['status'] != 0){
	//header('location: dashboard.php');
	echo "<script>alert('La solicitud se encuentra en otra etapa.'); window.location='letters.php';</script>";
	exit();
} 

if($rowpconfirm['userid'] != $_SESSION['userid']){
	//header('location: dashboard.php');
	echo "<script>alert('No se reconoce el Usuario.'); window.location='letters.php';</script>";
	exit();
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

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>


<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadRouteView()"> 

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

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Transferencias Bancarias

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="letters.php">Transferencias Bancarias</a>
                        <i class="fa fa-angle-right"></i>
                        </li>

						<li>

							<a href="#">Solicitudes de Transferencias</a>

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

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form name="porder" id="porder" action="payment-order-letters-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<?php echo $rowpconfirm['id']; ?>" readonly>  
								
															
													  </div>

													</div> 
                                                   
                                                   
                                                    
                                                   
                                                    
                                                    

													<!--/span-->

												</div>
												
												<h3  class="form-section">Información de la Transferencia</h3> 


                                                  
                                                  <div id="client-stage">

                                                  <div class="row">
 <div class="col-md-4"> 

<div class="form-group">
<label class="control-label">Tipo de Transacción</label> 
<select name="transaction" class="form-control" id="transaction" onChange="javascript:reloadaccount(1,this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowpconfirm['transaction'] == 1) echo "selected"; ?>>Transferencia</option>
<option value="2" <? if($rowpconfirm['transaction'] == 2) echo "selected"; ?>>Cordobización</option>
<option value="3" <? if($rowpconfirm['transaction'] == 3) echo "selected"; ?>>Dolarización</option>
<option value="4" <? if($rowpconfirm['transaction'] == 4) echo "selected"; ?>>Prestamo</option>
<option value="5" <? if($rowpconfirm['transaction'] == 5) echo "selected"; ?>>Abonos/Cancelaciones</option>
</select> 
                                                            

													  </div>

													</div>
													                                                  
<div class="col-md-4">

<div class="form-group">
<label class="control-label">Cuenta Origen</label> 
<select name="account1" class="form-control" id="account1" onChange="javascript:reloadaccount(2,this.value);">
<? 
if($rowpconfirm['account1'] > 0){ 
$query_account1 = "select companies.name, banks.name, banksaccounts.account2, currency.name from banksaccounts inner join banks on banksaccounts.bank = banks.id inner join currency on banksaccounts.currency = currency.id inner join companies on banksaccounts.company = companies.id where banksaccounts.id > '$rowpconfirm[account1]'";
$result_account1 = mysqli_query($con, $query_account1);
$row_account1 = mysqli_fetch_array($result_account1);
?>
<optgroup label="<? echo $row_account1[0]; ?>"></optgroup>
<option value="<? echo $rowpconfirm['account1']; ?>" selected><? echo $row_account1[1]." - ".$row_account1[2]." (".$row_account1[3].')'; ?></option>
<? }else{ ?>
<option>Seleccionar Tipo de transacción...</option>
<? } ?>
</select>
</div>

													</div>
				                                     
<div class="col-md-4"> 

<div class="form-group">
<label class="control-label">Cuenta Destino</label> 
<select name="account2" class="form-control" id="account2">
<? 
if($rowpconfirm['account2'] > 0){ 
$query_account2 = "select companies.name, banks.name, banksaccounts.account2, currency.name from banksaccounts inner join banks on banksaccounts.bank = banks.id inner join currency on banksaccounts.currency = currency.id inner join companies on banksaccounts.company = companies.id where banksaccounts.id > '$rowpconfirm[account2]'";
$result_account2 = mysqli_query($con, $query_account2);
$row_account2 = mysqli_fetch_array($result_account2);
?>
<optgroup label="<? echo $row_account2[0]; ?>"></optgroup>
<option value="<? echo $rowpconfirm['account1']; ?>" selected><? echo $row_account2[1]." - ".$row_account2[2]." (".$row_account2[3].')'; ?></option>
<? }else{ ?>
<option value="0" selected>Seleccionar Cuenta Origen...</option>
<? } ?>
</select>
                                                           
<?                                                           
/*
<select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);">
<option value="0" selected>Seleccionar</option>
<?
$query_banks = "select * from banks order by name";
$result_banks = mysqli_query($con, $query_banks);
while($row_banks=mysqli_fetch_array($result_banks)){
	$query_ac = "select * from currency where id = '$row_accounts[currency]'";
	$result_ac = mysqli_query($con, $query_ac);
	$row_ac = mysqli_fetch_array($result_ac);
		
	$acurrency = $row_ac['name'];
?>
<optgroup label="<? echo $row_banks['name']; ?>">
<? 
$query_accounts = "select * from banksaccounts where bank = '$row_banks[id]'";
$result_accounts = mysqli_query($con, $query_accounts); 
while($row_accounts=mysqli_fetch_array($result_accounts)){ ?>
	<option value="<? echo $row_accounts['id']; ?>" <? if($rowclient['type'] == 1) echo "selected"; ?>><? echo $row_accounts['account2']." ($acurrency)"; ?></option> 
<? } ?>
</optgroup>
<? } ?> 
</select>
*/
?>
													  </div>

													</div>
													                                                                  
</div>
</div>
<div class="row"></div> 

<? //<h3  class="form-section">Motivo de Devolución</h3> ?>

      
        
											  <div class="row">
													
													

													

                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description"><?php echo $rowpconfirm['description']; ?></textarea> 
<script>
/* 
function validateFirst(){
	var recipient = document.getElementById("dspayment").value;
	var provider = document.getElementById("provider").value;
	var collaborator = document.getElementById("collaborator").value;	
	if(recipient == 0){
	document.getElementById("dspayment").focus(); 
	alert('Usted debe de seleccionar el tipo de beneficiario.');
	}
	if((recipient == 1) && (provider == "")){
		document.getElementById("provider").focus(); 
		alert('Usted debe de seleccionar un Proveedor.');
		return false;
	}
	if((recipient == 2) && (collaborator == "")){
		document.getElementById("collaborator").focus(); 
		alert('Usted debe de seleccionar un Colaborador.');
		return false;
	}
}
*/
                    </script>	
                                                          
                 

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                    

 
 
       
   
          

                                                   
<?php //MONEDA ?>                                                      
<? /*<div class="col-md-12 ">   
<h3 class="form-section">Monto de la Devolución</h3></div>*/ ?>
        

<div class="col-md-4 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="<? if($rowpconfirm['amount'] > 0){ echo $rowpconfirm['amount']; } ?>" onkeypress="return justNumbers(event);">
                                                        
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
													<? /*
													<div class="col-md-9 "> 
												

 
<div class="form-group"> <label>Moneda:</label>
<div class="radio-list" style="margin-left:30px;">
<?php 

$querycurrency = "select * from currency"; 
$resultcurrency = mysqli_query($con, $querycurrency);
$checked = 1;
while($rowcurrency=mysqli_fetch_array($resultcurrency)){

?>
                                            <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input name="currency" type="radio" onChange="showTc(this.value);" id="currency" value="<?php echo $rowcurrency['id']; ?>" <? if($rowpconfirm['currency'] == $rowcurrency['id']) echo "checked"; ?>></span></div> <?php echo $rowcurrency['name']; ?></label>
											                                           <?php } ?> 
											
										</div><br>
									</div> </div>
													*/ ?>
									
									
											  
											  <? 
											  
											  $display = "none";
											  if(($rowpconfirm['transaction'] == 2) or (($rowpconfirm['transaction'] == 3))){
											  	$display = "block";
											  }
											  
											  ?>
												  <div class="col-md-4 " style="display: <? echo $display; ?>;" id="thetc">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="tc" type="text" class="form-control" id="tc" value="<? if($rowpconfirm['tc'] > 0){ echo $rowpconfirm['tc']; } ?>" onkeypress="return justNumbers(event);">
														<input name="floattotalbill" type="hidden" id="floattotalbill" value="">

                                                       
                                                      <!--/row--></div>
													</div>


 </div>    
 	
        
                                               
                                                       
                                                       
                                                       
                                                       <h3 class="form-section"><a id="files"></a>Archivos</h3>
                                                       
													 
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
                                                    <?php 
													
	$queryfile2 = "select * from lettersfiles where letter = '$_GET[id]' order by id asc";  
	$resultfile2 = mysqli_query($con, $queryfile2);
	$inc_files = 0;
	$filecount = 0;
	while($rowfile2 = mysqli_fetch_array($resultfile2)){
	$filecount++;
	if($filecount > 0){
		
	?>
                                                     <div class="col-md-10 ">
													  <div class="form-group">
	<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfile2['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>   
                                            
</div></div> 
                                                        
<?php 
//End while
$inc_files++;
}
//End if
}
 
?>
             <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
             <div id="fid_<? echo $inc_files; ?>"><div class="col-md-10 ">
													  <div class="form-group">
													    <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

</select><div class="row"></div></div></div>
             <div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile(<? echo $inc_files; ?>);">-</button></div>
             </div> 
                                                      
                                                    </div>
                                                    <div class="row"></div>
             
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
             <? $inc_files++; ?>                      
                                                     
<script type="text/javascript">
var tfile = <? echo $inc_files; ?>;
function agregar(){ 
	setTimeout(reloadTemplate, 1500);
	$.post("payment-order-refund-reload-files.php", { variable: tfile }, function(data){ 
		$("#emails").append(data);
	});
	
	tfile++;
	 
	
}

function reloadTemplate(){
	Metronic.init();
}
function eliminarFile(fid){
	 $('#fid_'+fid).remove(); 
}
</script>
                                              </div>
                                              
                                              
                                         
                                            
                                              
<? /*<div id="dbeneficiarie"> 
   <div class="row"></div>                                             
  <h3 class="form-section"><a id="beneficiaries"></a>Beneficiarios</h3>
  
  <div class="row">
  <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Lista de Beneficiarios:</label>

															<select name="beneficiarie" class="form-control" id="beneficiarie">
<option value="0" selected>Seleccionar</option>
															</select>

													  </div>

													</div>
                                                    </div>
</div>*/ ?> 

<div class="row"></div>
		
		<div class="row"></div>


<?php 

/*
$queryroutes = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.worker = '$_SESSION[userid]' and routes.type = 1 order by routes.unit";
//group by routes.unit
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);



if($numroutes == 1){
	$rowroutes = mysqli_fetch_array($resultroutes);
	if(strlen($rowroutes['unit']) == 4){
		
		$queryrname = "select * from units where code = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
		$rowrname = mysqli_fetch_array($resultrname);
		$thename = $rowrname['name'];
		$thecode = $rowrname['code'];
	
	}else{
	
		$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
		while($rowrname = mysqli_fetch_array($resultrname)){
		$thename.=$rowrname['name'];
		$thecode = $rowrname['code2'];
		}
		
		
	
	}
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
	$resultheadship = mysqli_query($con, $queryheadship);
	$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
	
	//
	?> 

  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3> 
  <p><?php echo $thecode." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></p>
   <div class="row">
   <div class="col-md-12" id="routeFill" onLoad="javascript:reloadRouteView();"> 
   </div>
   <input name="theroute" type="hidden" id="theroute" value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>">  
    </div>
	<?php
}
elseif($numroutes > 1){
	

?>
	  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3>

<div class="row">
 
  <div class="col-md-4">
 

													  <div class="form-group">

														<label class="control-label">Lista de Rutas:</label>  

															<select name="theroute" class="form-control" id="theroute" onchange="javascript:reloadRouteView();"> 
                                                  
<option value="0" selected>Seleccionar</option> 
<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
	
	//Special maded 29/Sept 2017
	
	$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
	$resultrname = mysqli_query($con, $queryrname);
	$numrname = mysqli_num_rows($resultrname);
	if($numrname == 0){
		$queryrname = "select * from units where code = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
	}
	$thename = "";
	while($rowrname = mysqli_fetch_array($resultrname)){
		$thename.=$rowrname['name']."/";
		$thecode = $rowrname['code2'];
		if($numrname == 0){
			$thecode = $rowrname['code'];
		}
		
	}
	
	$thename = substr($thename,0,-1);
	
	//End Special 
	
	/* Commented 27/Sept 2017
	if(strlen($rowroutes['unit']) == 4){
	
	$queryrname = "select * from units where code = '$rowroutes[unit]'";
	$resultrname = mysqli_query($con, $queryrname);
	$rowrname = mysqli_fetch_array($resultrname);
	$thename = $rowrname['name'];
	$thecode = $rowrname['code'];
		
		
	}
	else{
	
	
		$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
		while($rowrname = mysqli_fetch_array($resultrname)){
			$thename.=$rowrname['name']."/";
			$thecode = $rowrname['code2'];
		}		
	}
	*/ /*/*
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['route']) echo 'selected'; ?>><?php echo $thecode." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select>

													  </div>

												
                                                    
 
<br>

												

													</div>
                                             
                                                    
                                                    
  <div class="col-md-8" id="routeFill">
  
  
  </div>
   
                                                
                                                    
                                                    </div>
                                                    
                                                 
                                                 
  
                                                    
                                                
<?php } */ ?>   

                                                       										<!--/row--><!--/row--></div>
                                                                                            
                                                                                            
                                                                                            <div id="row"><div class="col-md-12 ">
													  <div class="form-group">
														<label>Notas del Solicitante:</label>
                                                        <textarea name="notes" rows="2" class="form-control" id="notes"><?php echo $rowpconfirm['notes']; ?></textarea>
	
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        
                                                      <!--/row--></div>
													</div></div> 


											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												
											

										
                                              <button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>
                                              <? /*<button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button>*/ ?>
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											  </div>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
											</div>

										</form>

										<!-- END FORM-->

									</div>

								</div>

							</div>

							

			<script>
			function saveDraft(){
				document.getElementById('newbutton').value = "draft";
				document.forms['porder'].submit();
			}
			
			</script>
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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?> 


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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

    
<script type="text/javascript"> 


function reloadsconcept(nid,i){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadsconcept2(0,i);
}

function reloadsconcept2(nid,i){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2_"+i).innerHTML = data;
	});
	
}

function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'letters.php';
		}
}

function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function commas(unformatedAmmount){
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function clear1(){
	document.getElementById("retention1").value = ""; 
}

function clear2(){
	document.getElementById("retention2").value = "";
}

function deleteRow(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("roc"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function printLetter(){

	var clienttype = document.getElementById("clienttype").value;
	
	var description = document.getElementById("description").value;
	var totalbill = document.getElementById("totalbill").value;
	
	var i = 0;
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}


	var strdocuments = "";
	var currenttype = "";
	var currentnumber = "";
	var currenttoday = "";
	var currentamount = "";
	var currentcurrency = "";
	
	var types = "";
	var numbers = "";
	var todays = "";
	var amounts = "";
	var currencys = "";
	
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for(i=0;i<rocnumber.length; i++) { 
		//Reading Values
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		//Making the vars
		types = types+currenttype+"|||";
		numbers = numbers+currentnumber+"|||";
		todays = todays+currenttoday+"|||";
		amounts= amounts+currentamount+"|||";
		currencys= currencys+currentcurrency+"|||";	
	} 
	 
	strdocuments = "&roctype="+encodeURIComponent(types)+"&rocnumber="+encodeURIComponent(numbers)+"&roctoday="+encodeURIComponent(todays)+"&rocamount="+encodeURIComponent(amounts)+"&roccurrency="+encodeURIComponent(currencys); 
	var theroute = document.getElementById("theroute").value;

	if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value; 
		
		window.location = "payment-order-refund-pdf.php?clienttype="+encodeURIComponent(clienttype)+"&ccode="+encodeURIComponent(ccode)+"&cfirst="+encodeURIComponent(cfirst)+"&clast="+encodeURIComponent(clast)+"&caddress="+encodeURIComponent(caddress)+"&cnid="+encodeURIComponent(cnid)+"&ccity="+encodeURIComponent(ccity)+"&cemail="+encodeURIComponent(cemail)+"&cphone="+encodeURIComponent(cphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments; 
	}
	if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		window.location = "payment-order-refund-pdf-enterprise.php?clienttype="+encodeURIComponent(clienttype)+"&ccode2="+encodeURIComponent(ccode2)+"&cname="+encodeURIComponent(cname)+"&cruc="+encodeURIComponent(cruc)+"&cemail2="+encodeURIComponent(cemail2)+"&cphone2="+encodeURIComponent(cphone2)+"&caddress2="+encodeURIComponent(caddress2)+"&ccity2="+encodeURIComponent(ccity2)+"&crfirst="+encodeURIComponent(crfirst)+"&crlast="+encodeURIComponent(crlast)+"&crnid="+encodeURIComponent(crnid)+"&cremail="+encodeURIComponent(cremail)+"&crphone="+encodeURIComponent(crphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments;  
	}

	
	
//End of function printLetter() 
}



var roci = <?php if($roci > 0){ echo $roci; } else{ echo '1'; } ?>;
function addroc(){
	
	//var account = document.getElementsByName('accounts[]')[0].value;
	var selectoR =  document.getElementsByName('pertot');
	
	for (var i = 0, length = selectoR.length; i < length; i++) {
	
	if (selectoR[i].checked) {

		if(selectoR[i].value == 1){
			var readOnly1 = "";
			var readOnly2 = "readonly";
		}else{
			var readOnly1 = "readonly";
			var readOnly2 = "";
		}
}
	
	
}   	 

   var rocboxadd = '<div class="row" id="roc'+roci+'"><div class="col-md-2 "><div class="form-group"><select name="roctype[]" class="form-control" id="roctype[]"><option value="0" selected>Seleccionar</option><option value="1">ROC</option><option value="2">Factura</option> </select> </div></div><div class="col-md-2 "><div class="form-group"><input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" onKeyUp="javascript:calculateTheTotal();" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value=""  onKeyUp="javascript:calculateTheTotal();" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><select name="roccurrency[]" class="form-control" id="roccurrency[]"><option value="0" selected>Seleccionar</option><option value="1">Córdobas</option><option value="2">Dólares</option> </select></div></div><div class="col-md-1 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+roci+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     roci++; 
	 $("#rocwaiter").append(rocboxadd);  
	 
	 Metronic.init(); 
	 ComponentsPickers.init();
	 //init metronic core components
	
  
}
 
		
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
 <script type="application/javascript">
  
function reloadRouteView(){
	
	var myroute = document.getElementById('theroute').value; 
   $.post("reload-route.php", { myvariable: myroute, }, function(data){
	
  //alert(data); 
  document.getElementById('routeFill').innerHTML = data;
   
}); 
} 

function reloadaccount(selector,val){
	//Transsaction type (Tranferencia, Dolarizacion, Cordobización)
	var type = document.getElementById('transaction').value;
	//Si no se ha seleccionado el tipo,
	if(type == 0){ 
		alert('Debe de seleccionar un tipo de transaccion.');
		document.getElementById("account1").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Tipo de Transacción</option></select>';
		document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Cuenta Origen</option></select>';
	}else{
		
		//alert('Type: '+type+' | Selector: '+selector+' | Val: '+val);
		if(selector == 2){
			document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Cuenta Origen</option></select>';
		}
		
		showTc(type);  
		
		$.post("fn-reloadaccounts.php", { type: type, selector: selector, val: val }, function(data){ 
	 		if(selector == 1){
	 			document.getElementById("account1").innerHTML = data;
				document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar</option></select>';
	 		}
	 		if(selector == 2){
	 			document.getElementById("account2").innerHTML = data;
	 		}
		});
	}
	//reloadsconcept2(0,i);
}

 function showTc(theVal){
											  	//alert(theVal); 
												if((theVal == 2) || (theVal == 3)){
													document.getElementById('thetc').style.display = "block";
												}else{
													document.getElementById('thetc').style.display = "none";
												}
											  }

</script>


  
<?php 

function cleanLink($dirtyurl){ 

	$levels = explode('/', $dirtyurl);
	$levelsize = sizeof($levels);
	$levelsize = $levelsize-1;
	$cleanurl = $levels[$levelsize];
	$cleanurl = str_replace('visor.php?key=','',$cleanurl);
	
	return $cleanurl;
}



?>

<? /*
<script>
(function() {
   //Document.ready equivalent
	reloadRequirements("load");
	<? if($rowpconfirm['client'] != 0){ ?>
	clientType("load");
	benType(<? echo $rowclient['type']; ?>);
	
	<? } ?>
})();
</script>
*/ ?>