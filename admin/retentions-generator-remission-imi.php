<?php 

include("session-retentions.php"); 

/* ?>

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

					Remisiones <small>Retenciones Alcaldía</small> 

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

							<a href="withholding-mayor-tax.php">Alcaldía</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Grupos de cancelación</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
<div class="col-md-12">
				  <? 
				  
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

						Remisiones de Retenciones <?php 							
$hallid = base64_decode($_GET['hall']);
$queryhall = "select * from halls where id = '$hallid'"; 
$resulthall = mysqli_query($con, $queryhall);
$rowhall = mysqli_fetch_array($resulthall);
echo $rowhall['name']; ?>

							</div>
                            
                            <div class="actions">

								
                                
                                <a href="retentions-generator-remission-imi-groups.php?hall=<? echo $_GET['hall']; ?>" class="btn default blue-stripe">
 
								<i class="fa fa-truck"></i>

								<span class="hidden-480">

								Ver Remisiones</span>

								</a>

							

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">



							
                             
                            
                             
                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								
								<?php 
								
	
				  
				  
				  
				  $today = date('Y-m-d'); 
$tampagina = 50;
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
$from = $_GET['from'];
$to = $_GET['to'];
$provider = $_GET['provider'];
$request = $_GET['request'];
$bill = $_GET['bill'];
$paymenten = $_GET['paymenten'];
$worker = $_GET['worker'];
$requester = $_GET['requester']; 

$inner_payments = 0;
$inner_bills = 0;

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and hallsretention.created >= '$from'";
$inner_payments = 1;
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and hallsretention.created <= '$to'";
$inner_payments = 1;
}
$sql3 = "";
if($provider != ""){
$sql3 = " and payments.provider = '$provider'";
$inner_payments = 1;
}
$sql4 = "";
if($request != ""){
$sql4 = " and payments.id = '$request'";
$inner_payments = 1;
}
$sql5 = "";
if($bill != ""){
$sql5 = " and bills.number = '$bill'";
$inner_bills = 1;
$inner_payments = 1;
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

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9;

if($inner_payments == 1){
	$inner1 = " inner join payments on hallsretention.payment = payments.id";
}
if($inner_bills == 1){
	$inner2 = " inner join bills on payments.id = bills.payment";
	$inner_payments = 1;
}


$inner = $inner1.$inner2;

$hall = base64_decode($hall);

//$querymain = "select payments.* from payments inner join bills on payments.id = bills.payment inner join hallsretention on payments.ret1id = hallsretention.id where	payments.id > '0' and payments.ret1a > '0' and hallsretention.hall = '$hallid'".$sql.' and payments.status >= 13 group by payments.id';
$querymain = "select hallsretention.* from hallsretention".$inner." where hallsretention.status > '0' and hallsretention.remissionstatus = '0' and hallsretention.hall = '$hall'".$sql; 
$resultmain = mysqli_query($con, $querymain);
$nummain = mysqli_num_rows($resultmain);
$totpagina = ceil($nummain / $tampagina);  

//$querymain1 = "select payments.* from payments inner join bills on payments.id = bills.payment inner join hallsretention on payments.ret1id = hallsretention.id where	payments.id > '0' and payments.ret1a > '0' and hallsretention.hall = '$hallid'".$sql." and payments.status >= 13 group by payments.id order by hallsretention.id desc limit ".$inicio.",".$tampagina;
 
$querymain1 = "select hallsretention.* from hallsretention".$inner." where hallsretention.status > '0' and hallsretention.remissionstatus = '0' and hallsretention.hall = '$hall'".$sql." order by hallsretention.id desc limit ".$inicio.",".$tampagina;
$resultmain1 = mysqli_query($con, $querymain1);


if($_SESSION['email'] == 'jairovargasg@gmail.com'){
	echo $querymain;
	echo '<br>'.$querymain1; 
}
						
if(($nummain > 0)){ ?>                        
<?php ?>							
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

										Generada   </th>

									<? /*<th width="14%">

										 Estado  

									</th>*/ /*/*?>

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
                                
                                <tr role="row" class="odd <?php if($row['imiprinted'] == 1) echo 'success'; if($row['ret1void']) echo "danger"; ?>">  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $rowmain['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php 
								  
								 
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
                                
                               <? /* <td><?php 
								
								if($row['mayorstage'] == 0){
									
									$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'")); 
									echo $rowstage['content']; 
								}else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
									
							
								
							</td>*/ /*/*?><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
                           
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
     <input name="hall" type="hidden" id="hall" value="<? echo $_GET['hall']; ?>">                          
<div class="form-actions right">

<? 
if($_SESSION['imiprint'] == "active"){ 
?>
<button type="button" class="btn blue" onClick="javascript:makeRemission();"><i class="fa fa-truck"></i> Remisionar seleccionadas</button> 

<script>
function makeRemission(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "retentions-generator-remission-imi-code.php";
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



						</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>
*/ ?>