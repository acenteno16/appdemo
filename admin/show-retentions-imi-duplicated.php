<?php include("session-retentions.php"); ?>

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

					Retenciones <small>Alcaldía</small> 

					</h3>

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
                        <li>

							<a href="withholding-mayor-tax.php">Alcaldía</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Visor Global</a>

							

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
				  
			   
				  
				  $hall = $_GET['hall'];
				  ?>                              
                                                    
                  <div class="col-md-12">
                  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data" >
				  <?php include("withholding-filter.php"); ?>
                 <input type="hidden" name="hall" id="hall" value="<?php echo $_GET['hall'];  ?>"> 
                  
                  </form>
               
                  </div>
                  
                  <div class="row"></div><br><br>
                  
                  
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<? 
								
	
/*
$querymain = "select payments.* from payments inner join bills on payments.id = bills.payment inner join hallsretention on payments.ret1id = hallsretention.id where	payments.id > '0' and payments.ret1a > '0'".$sql.' and payments.status >= 13 group by payments.id'; 
$querymain = "select payments.* from payments inner join bills on payments.id = bills.payment inner join hallsretention on payments.ret1id = hallsretention.id where	hallsretention.payment > '0' and payments.ret1a > '0'".$sql.' group by payments.id'; 
*/
/*
$querymain1 = "select payments.* from payments inner join bills on payments.id = bills.payment inner join hallsretention on payments.id = hallsretention.payment where	hallsretention.payment > '0' and payments.ret1a > '0'".$sql." group by payments.id order by hallsretention.id desc limit ".$inicio.",".$tampagina;
*/			  
				  
$global_company = 0;
$global_hall = 0;

$queryaccess = "select * from routes where type = '23' and worker = '$_SESSION[userid]'";
$resultaccess = mysqli_query($con, $queryaccess);
while($rowaccess = mysqli_fetch_array($resultaccess)){
	if($rowaccess['company'] == "999999999"){
		$global_company = 1;
	}
	if($rowaccess['unit'] == "999999999"){
		$global_hall = 1;
	}
	
	$companies[] = $rowaccess['company'];
	$halls[] = $rowaccess['unit']; 
	
}

				  
$today = date('Y-m-d'); 
$tampagina = 1000;
if(isset($_GET['pagination'])){
	$tampagina = $_GET['pagination'];
}

$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

if($_GET['form'] != 1){
	$limit = 100;
}
$inner_halls = 0;
$to = $_GET['to'];
$provider = $_GET['provider'];
$request = $_GET['request'];
$bill = $_GET['bill'];
$paymenten = $_GET['paymenten'];
$worker = $_GET['worker'];
$requester = $_GET['requester']; 

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and payments.today >= '$from'";
$inner_payments = 1;
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and payments.today <= '$to'";
$inner_payments = 1;
}
$sql3 = "";
if($provider != ""){
$sql3 = " and payments.provider = '$provider'";
$inner_payments = 1;
}
$sql4 = "";
if($request != ""){
$sql4 = " and hallsretention.payment = '$request'";
}
$sql5 = "";
if($bill != ""){
$sql5 = " and bills.number = '$bill'";
$inner_bills = 1;
}
$sql6 = "";
if($worker != ""){
$sql6 = " and payments.collaborator = '$worker'";
$inner_payments = 1;
}

$sql7 = "";
if($requester != ""){ 
$sql7 = " and payments.userid = '$requester'";
$inner_payments = 1;
}

$sql8 = "";
$retentionno = $_GET['retentionno'];
if($retentionno != ""){
	$retentionno_arr = explode('-', $retentionno);
	
	$sql8 = " and hallsretention.serial = '$retentionno_arr[0]'";
	$sql8.= " and hallsretention.number = '$retentionno_arr[1]'"; 
}

$sql9 = "";
if($_GET['status'] == ""){
	switch($_GET['status']){
		case 1:
		$sql9 = " and payments.irprinted = '0'";
		$inner_payments = 1;
		break;
		case 2:
		$sql9 = " and payments.irprinted = '1'";
		$inner_payments = 1; 
		break; 
	}
		
}

$sql10 = "";

if($global_hall == 1){
	if($_GET['thehall'] != ""){
		$sql10 = " and hallsretention.hall = '$_GET[thehall]'"; 
	}
}else{
	$foreach_hall = "";
	if($_GET['thehall'] != ""){
		$sql11 = " and halls.company = '$_GET[thecompany]'";
		$inner_halls = 1; 
	}else{
	for($c=0;$c<sizeof($halls);$c++){
		$hall_pre = "";
		if($c > 0){
			$hall_pre = " or ";
		}
		$foreach_hall.= $company_pre."(hallsretention.hall = '$halls[$c]')";  
	}
	
	$foreach_hall = " and (".$foreach_hall.")";
	$sql10 = $foreach_hall; 
	//$inner_halls = 1;
 }
	
}






$sql11 = "";
if($global_company == 1){
	if($_GET['thecompany'] != ""){
		$sql11 = " and halls.company = '$_GET[thecompany]'";
		$inner_halls = 1; 
	}
}else{
	$foreach_company = "";
	if($_GET['thecompany'] != ""){
		$sql11 = " and halls.company = '$_GET[thecompany]'";
		$inner_halls = 1; 
	}else{
	for($c=0;$c<sizeof($companies);$c++){
		$company_pre = "";
		if($c > 0){
			$company_pre = " or ";
		}
		$foreach_company.= $company_pre."(halls.company = '$companies[$c]')";  
	}
	
	$foreach_company = " and (".$foreach_company.")";
	$foreach_company2 = str_replace('id','company',$foreach_company); 
	$sql11 = $foreach_company; 
	$inner_halls = 1;
 }
	
}
	

$inner1 = "";
if($inner_payments == 1){
	$inner1 = " inner join payments on hallsretention.payment = payments.id";
}
$inner2 = "";
if($inner_bills == 1){  
	$inner2 = " inner join bills on hallsretention.payment = bills.payment";
}
$inner3 = "";
if($inner_halls == 1){  
	$inner3 = " inner join halls on hallsretention.hall = halls.id";
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11;
$inner = $inner1.$inner2.$inner3;


$querymain = "select hallsretention.*, count(*) from hallsretention".$inner." where status > '0'".$sql." group by payment having count(*) > 1"; 

$resultmain = mysqli_query($con, $querymain);
echo $nummain = mysqli_num_rows($resultmain);
$totpagina = ceil($nummain / $tampagina);  

$querymain1 = "select hallsretention.*, count(*) from hallsretention".$inner." where status > '0'".$sql." group by payment having count(*) > 1 order by hallsretention.payment desc limit ".$inicio.",".$tampagina." ";  
$resultmain1 = mysqli_query($con, $querymain1);

						
						?>
                        
                        Retenciones <?php 							
$hallid = base64_decode($_GET['hall']);
$queryhall = "select * from halls where id = '$hallid'"; 
$resulthall = mysqli_query($con, $queryhall);
$rowhall = mysqli_fetch_array($resulthall);
echo $rowhall['name']; ?>

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">



							
                             
                            
                             
                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								
								<?

if($_SESSION['email'] == 'jairovargasg@gmail.com'){ 
	echo $querymain; 
}
				
if(($nummain > 0)){ ?>                        
							
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
                                         <th width="2%">

										 IDS</th>
                                          <th width="8%"> 

										 IDR</th>
                                         <th width="8%"> 

										 UN</th>

									

									<th width="17%">

										Proveedor/Colaborador</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										Generada</th>

								<th width="14%">

										 SUC 

									</th>
                                    <th width="14%">

										 Coincidencias 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($rowmain=mysqli_fetch_array($resultmain1)){
								
							$query = "select * from payments where id = '$rowmain[payment]'";
							$result = mysqli_query($con, $query);
							$row = mysqli_fetch_array($result);
							
								//if($nioammount > 1){
							
									
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$queryprovider = "select * from workers where id = '$row[collaborator]'";
									$rowprovider = mysqli_fetch_array(mysqli_query($con, $queryprovider));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd <?php if($row['imiprinted'] == 1) echo 'success';  if($rowmain['void'] == 1) echo ' danger' ?>">  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $rowmain['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php 
								  
								  /*$queryret = "select * from hallsretention where payment = '$row[id]'";
								  $resultret = mysqli_query($con, $queryret);
								  $rowret = mysqli_fetch_array($resultret);
								  */
								  $number = str_pad((int) $rowmain['number'],4,"0",STR_PAD_LEFT);
								  
								  echo $rowmain['serial'].'-'.$number;
								  
								  ; ?></td>
                                  <td><?php echo $row['route']; ?></td>
                                  
                            
                                  <td><?php echo $providercollaborator;  ?></td>
                                  <td> <?php echo 'C$'.str_replace('.00','',number_format($row['ret1a'],2)).' Cordobas'; ?>

</td>
                                  <td>
                                  <?php 
								  $queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '3.00' and schedulecontent.payment = '$row[id]'"; 
$resultretdate = mysqli_query($con, $queryretdate);  
$rowretdate = mysqli_fetch_array($resultretdate); 

if($rowretdate['today'] >= '2017-01-23'){
	

  echo date('d-m-Y',strtotime($rowretdate['today'])); 
}else{
	  $queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$row[id]'"; 
$resultretdate = mysqli_query($con, $queryretdate);  
$rowretdate = mysqli_fetch_array($resultretdate); 

 echo date('d-m-Y',strtotime($rowretdate['today'])); 

}

								  
								  ?>
                                  </td>
                                          
                            <td><?  if($rowmain['void'] == 1){
								$queryhall = "select name from halls inner join hallsbook on halls.id = hallsbook.hall where hallsbook.serial = '$rowmain[serial]'";  
								$resulthall = mysqli_query($con, $queryhall);
								$rowhall = mysqli_fetch_array($resulthall);
								echo $rowhall['name']; 
							}else{
								$queryhall = "select name from halls where id = '$row[hall]'";
								$resulthall = mysqli_query($con, $queryhall);
								$rowhall = mysqli_fetch_array($resulthall);
								echo $rowhall['name']; 
								}
							 ?></td>
                             
                             <td>
                            <? 
							$querycc = "select * from hallsretention where payment = '$rowmain[payment]'"; 
							$resultcc = mysqli_query($con, $querycc);
							while($rowcc=mysqli_fetch_array($resultcc)){
								//echo $rowcc['serial'].$rowcc['number'].", ";
								 $number = str_pad((int) $rowcc['number'],4,"0",STR_PAD_LEFT);
								 
								  
								  echo $rowcc['serial'].'-'.$number.', ';
							}
							
							?> 
                             </td>
                             
                                
                                <? /*<td><?php 
								
								if($row['mayorstage'] == 0){
									
									$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'")); 
									echo $rowstage['content']; 
								}
								else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
									
							
								
							</td>
                            */ ?><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver solicitud</a><br><br>
                            
                          <? 
						  if($rowmain['void'] == 0){ 
						  if($_SESSION['imivoid'] == "active"){
						  ?>
                            <a href="retentions-generator-imi-global-void-rd.php?id=<?php echo $rowmain['id']; ?>" class="btn btn-xs yellow btn-editable" target="_blank"><i class="fa fa-search"></i> Anular + RD</a><br><br>
                            
                             <a href="retentions-generator-imi-global-void.php?id=<?php echo $rowmain['id']; ?>" class="btn btn-xs red btn-editable" target="_blank"><i class="fa fa-search"></i> Anular</a> <?
							 
						  }
						  
							  }else{ ?>
								<a href="javascript:alert('<? if($rowmain['voidcomments'] != ''){ echo $rowmain['voidcomments']; }else{ echo "Sin comentarios de anulación."; }?>');">Anulada</a>
                                
								<? } ?>
                           
                            
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                               
<div class="form-actions right">

<? if($_SESSION['imiprint'] == "active"){ ?>
<button type="button" class="btn blue" onClick="javascript:pdfPrint();"><i class="fa fa-print"></i> Imprimir</button>

<script>
function pdfPrint(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "retentions-generator-imi-pdf.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
<? }
 if($_SESSION['imiexcel'] == "active"){ ?>
 
<button type="button" class="btn blue" onClick="javascript:pdfExcel();"><i class="fa  fa-file-excel-o"></i> Generar excel</button>

<script>
function pdfExcel(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "excel-imi.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
 <? } ?>
                                                

                                                              

							
</div>   

   <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="payments.php?page=<?php echo $previous; ?>&status=<?php echo $_GET['status']; ?>&hall=<?php echo $_GET['hall']; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
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
		  echo '<li><a href="'.str_replace('/admin/','',$_SERVER['SCRIPT_NAME']).'?page='.$i .'&status='.$_GET['status'].'&hall='.$_GET['hall'].'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments.php?page=<?php echo $next; ?>&status=<?php echo $_GET['status']; ?>&hall=<?php echo $_GET['hall'];  ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                          
<?php } else { 						
?>
<div class="note note-danger">

						<p>

							NOTA: No se encontró ningúna retención.

						</p>

					</div>
<?php } ?> 
                             
                                
                                

						</div></form>

					</div>
                  
                    
                 

					<!-- End: life time stats -->

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


<? /*
function voidRetRd(id){
	if(confirm('La opcion Anular + RD se utiliza para anular una retencion que se debe de redireccionar a otra sucursal. Si') == true){
		window.location = ""+id;
	}
}

function voidRet(id){
	if(confirm('La opcion de anular se utiliza para anular por completop la retencion en getPay. Si se necesita retencion para este pago debera de hacerce manual.') == true){
		window.location = ""+id;
	}
}
*/ ?>
						</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>