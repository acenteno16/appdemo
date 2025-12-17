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

					Programación de Pagos 

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payment-schedule.php">Programación de pagos</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                        <li>
                        

							<a href="#">Generar archivos de bancos</a>


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

						

                    <?php 
$join_payment = 0;

$blocked = "";
if(isset($_GET['blocked'])){
	$blocked = $_GET['blocked'];
}

$sql1 = "";
if($blocked != ""){
	$sql1 = " and schedule.userid = '$blocked'";
}

$provider = "";
if(isset($_GET['provider'])){
	$provider = $_GET['provider'];
}

$sql2 = "";
if($provider != ""){
	$join_payment = 1;
	$sql2 = " and payments.provider = '$provider'";
}

$worker = "";
if(isset($_GET['worker'])){
	$worker = $_GET['worker'];
}

$sql3 = "";
if($worker != ""){
	$join_payment = 1;
	$sql3 = " and payments.collaborator = '$worker'";
}

$request = "";
if(isset($_GET['request'])){
	$request = $_GET["request"];
}

$sql4 = "";
if($request != ""){
	$join_payment = 1;
	$sql4 = " and payments.id = '$request'";
}

$pp = "";
if(isset($_GET['pp'])){
	$pp = $_GET["pp"];
}

$sql5 = "";
if($pp != ""){
	$sql5 = " and schedule.userid2 = '$pp'";
}

$pro = $_GET['pro'];
$sql6 = "";
if($pro > 0){
	if($pro == 2){
		$pro = 0;
	}
	$sql6 = " and schedule.vo = '$pro'"; 
}

$groupid = "";
if(isset($_GET['groupid'])){
	$groupid = $_GET['groupid'];
}

$sql7 = "";
if($groupid != ""){
	$sql7 = " and schedule.id = '$groupid'";
}						

$bank = "";
if(isset($_GET['bank'])){
	$bank = $_GET['bank'];
}
 
$sql8 = "";
if($bank != ""){
	$sql8 = " and schedule.bank = '$bank'";
}						

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8; 
						

if($join_payment == 1){ 
	$join2 = " inner join schedulecontent on schedule.id = schedulecontent.schedule inner join payments on payments.id = schedulecontent.payment";
}	
			
$join = "";

if(isset($join1)){
	$join.=$join1;
}

if(isset($join2)){
	$join.=$join2;
}
						

$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
} 

$query = "select schedule.* from schedule".$join." where status = '1' and schedule.vo = '1' and schedule.ammount > '0'".$sql." group by schedule.id order by schedule.id desc";  
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);  
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);      

$query1 = "select schedule.* from schedule".$join." where status ='1' and schedule.vo = '1' and schedule.ammount > '0'".$sql." group by schedule.id order by id desc limit ".$inicio.",".$tampagina;

if($_GET['echo'] == 1){
	echo $query."<br>".$query1;
}
						
$result1 = mysqli_query($con, $query1);
$next = "";
if($pagina < $totpagina) $next = $pagina+1;
$previous = "";
if($pagina > 1) $previous = $pagina-1;	


?>
                    
                    <div class="portlet-body">			
                        
<? if($num > 0){ ?>

<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<? //echo $numdev; ?> Grupos de programación (Pendientes de generar archivos de Banco)

							</div>
                           
                           <div class="actions">

                                
                                <a href="payment-schedule-group-records.php" class="btn default blue-stripe">

								<i class="fa fa-list"></i>

								<span class="hidden-480">

								Todos los Grupos</span>

								</a>

							

							</div>
                            

						</div>

						

					</div>
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

								<? /*	<th width="2%">
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

										 </th>*/ ?>
                                         <th width="2%">GID</th>
                                         
                                           <th width="2%">Compañía</th>

									<th width="10%">

										 Usuario</th>
										<th width="5%">

										 Fecha</th>
										<th width="5%">

										 Hora</th>

									

									<th width="10%">

										 Monto

									</th>
                                    
                                   
                                     <th width="6%">

										Solicitudes

									</th>
									<th width="6%">

										Pagar en

									</th>
									<th width="6%">

										Pagar con

									</th>
									<th width="6%">

										Plan

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								
								while($row=mysqli_fetch_array($result1)){
								
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid2]'")); 
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$querymain = "select * from schedulecontent where schedule = '$row[id]'"; 
								$resultmain = mysqli_query($con, $querymain);
								$gpayment = 0;
								$npayments = 0;
								while($rowmain = mysqli_fetch_array($resultmain)){
									$querypayment = "select * from payments where id = '$rowmain[payment]'";
									$resultpayment = mysqli_query($con, $querypayment);
									$rowpayment = mysqli_fetch_array($resultpayment); 
									$gpayment+=$rowpayment['payment'];
									$npayments++;
									 
								}
									 
								if(($npayments == 0) or ($gpayment == 0)){
									//do Nothing
								}else{	
								?>
                                
                                <tr role="row" class="odd <?php 
								if($row['bankfile'] == 1){
									echo "success"; 
								} 
								?>"> 
                                
                                <? /* <td class="sorting_1" id="maintheid<?php //echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td> */ ?>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><? 
								 
								  $querycompany = "select companies.name from companies inner join units on companies.id = units.company inner join payments on (payments.route = units.code or payments.route = units.code2) inner join schedulecontent on payments.id = schedulecontent.payment where schedulecontent.schedule = '$row[0]'";
								  $resultcompany = mysqli_query($con, $querycompany);
								  $rowcompany = mysqli_fetch_array($resultcompany);
								  if($rowcompany['name'] != ""){
									  echo $rowcompany['name'];
								  }else{
									  echo "NA";
								  }
								  
								 
								  
								  
								 
								  ?></td>
                                  <td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
                                    
</td>
<td><?php echo date('h:i:s a', strtotime($row['now2'])); ?></td>
                                
                               <td>
                               
                               <?php 
							   switch($row['currency']){
								  case 1:
								  $pre = "NIO C$";
								  $currency = "Córdobas";
								  break;
								  case 2:
								  $pre = "USD U$";
								  $currency = "Dólares";
								  break;
								  case 3:
								  $currency = "Euros";
								  break;
								  case 4:
								  $currency = "Yenes";
								  break;
							  }
							  
							   
								
								echo $pre.str_replace('.00','',number_format($gpayment,2));
								
							   ?>
                               
                               </td>
                               
                            <td><?php 
								echo $npayments;
								?> 
									
							</td>
                           <td>
                           <? 
						   if($row['bank'] != ""){
						   	$querybanks = "select * from banks where id = '$row[bank]'";
							$resultbanks = mysqli_query($con, $querybanks);
						   	$rowbanks = mysqli_fetch_array($resultbanks);
						   	$bank_name = $rowbanks['name'];
						   	echo $bank_name;
						   }
							
							if($row['thebank2'] > 0){
								$theBank = $row['thebank2'];
							}else{
								$theBank = $row['bank'];
							}
							   
							   ?>
						   </td>
									
									<td>
									  <select name="theBank[]" class="form-control" id="theBank_<? echo $row['id']; ?>" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select id, name from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($theBank == $rowbanks['id']) echo 'selected'; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?> 
 
</select>
									</td>
									
									<td>
									  <select name="thePlan[]" class="form-control" id="thePlan_<? echo $row['id']; ?>" style="margin-top:1px;">
<option value="0">Plan</option>
<?php $querybanks = "select id, name from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($theBank == $rowbanks['id']) echo 'selected'; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?> 
 
</select>
									</td>
                            
                            
                            <td><a href="javascript:generateFile(<? echo $row['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Generar</a>
                            
                            
                            </td></tr>
                                <?php 
								
								}
			   					}
								
								?>
                                   </tbody>

								</table>
                                </div>
						
					
						
						<script>
							function generateFile(ref){
								var bank = document.getElementById('theBank_'+ref).value;
								window.location = "templateGenerator.php?id="+ref+'&bank='+bank;
							}
						</script>
                                <br>
                                <div class="note note-regular">
                                GID: ID de grupo.
                                
                                </div>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="payment-schedule-group.php?page=<?php echo $previous; ?>">
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
		  echo '<li><a href="payment-schedule-group.php?page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payment-schedule-group.php?page=<?php echo $next; ?>">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                                    
 <?php } else { 
							
								?>
                                
                                <div class="note note-success">

						<p>

							NOTA: No hay grupos de programación pendientes ingreso a banco.

						</p>

					</div>
                                <?php } ?>
                                </div></div></div>
                             
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

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/table-managed.js"></script> 

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
TableManaged.init(); 
});

</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>
	
<script>
	function cleanfilert(){
		window.location = "payment-schedule-group.php";
	}
	</script>