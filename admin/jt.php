<?php include("session-treasury.php"); ?>
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

					Jefatura de Tesorería <small>Home</small>  

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						
                        <li>
<i class="fa icon-grid"></i>
							<a href="#">JT</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

			<? //Ingreso a banco ?>
			<a href="payment-schedule-approve3.php">	
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; cursor:pointer;">

					<div class="dashboard-stat blue" style="height:150px;">

						<div class="visual">

							<i class="fa icon-grid"></i>

						</div>

						<div class="details">

							<div class="number">
Ingreso a<br>banco
							</div>

							<div class="desc" style="margin-bottom: -1px; font-weight: 500;">

								
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
			</a>		
			<? //Fondo disponible ?>
			<a href="balance.php">	
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; cursor:pointer;">

					<div class="dashboard-stat blue" style="height:150px;">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">
Fondo Disponible
							</div>

							<div class="desc" style="margin-bottom: -1px; font-weight: 500;">

								
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
			</a>
			<? //Proveedores ?>
			<a href="providers.php">	
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; cursor:pointer;">

					<div class="dashboard-stat blue" style="height:150px;">

						<div class="visual">

							<i class="fa fa-group"></i>

						</div>

						<div class="details">

							<div class="number">
Proveedores
							</div>

							<div class="desc" style="margin-bottom: -1px; font-weight: 500;">

								
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
			</a>	
			<? //Manejo de pagos ?>
			<a href="payment-management.php">	
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; cursor:pointer;">

					<div class="dashboard-stat blue" style="height:150px;">

						<div class="visual">

							<i class="fa icon-basket"></i>

						</div>

						<div class="details">

							<div class="number">
Manejo de pagos
							</div>

							<div class="desc" style="margin-bottom: -1px; font-weight: 500;">

								
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
			</a>
			<? //Ingresos Vencidos ?>
			<a href="show-expirated-payments-request.php">	
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; cursor:pointer;">

					<div class="dashboard-stat blue" style="height:150px;">

						<div class="visual">

							<i class="fa fa-clock-o"></i>

						</div>

						<div class="details">

							<div class="number">
Ingresos Vencidos
							</div>

							<div class="desc" style="margin-bottom: -1px; font-weight: 500;">

								
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
			</a>		
						
						

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

function calculateBalance(){

	totalpayment=0;
	
	i=0;
for (var obj in document.getElementsByName('theid[]')){
 if (i<document.getElementsByName('theid[]').length){

 if(document.getElementsByName('theid[]')[i].checked == true){
	tpayment =  document.getElementsByName('tpayment[]')[i].value;
	//alert('var: '+tpayment);
	totalpayment += parseFloat(tpayment);
 }

  }
  i++;
}
balance = document.getElementById('balance').value;
newbalance = balance-totalpayment;
document.getElementById('thenumber').innerHTML = 'C$'+commas(newbalance);
document.getElementById('thenumbersum').innerHTML = 'C$'+commas(totalpayment);
document.getElementById('cbalancefloat').value = newbalance;
document.getElementById('cbalance').value = commas(newbalance);
}

function calculateBalance2(){

	totalpayment2=0;
	
	i=0;
for (var obj in document.getElementsByName('theid2[]')){
 if (i<document.getElementsByName('theid2[]').length){

 if(document.getElementsByName('theid2[]')[i].checked == true){
	tpayment2 =  document.getElementsByName('tpayment2[]')[i].value;
	//alert('var: '+tpayment);
	totalpayment2 += parseFloat(tpayment2);
 }

  }
  i++;
}
balance2 = document.getElementById('balance2').value;
newbalance2 = balance2-totalpayment2;
document.getElementById('thenumber2').innerHTML = 'USD$'+commas(newbalance2);
document.getElementById('thenumbersum2').innerHTML = 'USD$'+commas(totalpayment2);
document.getElementById('cbalancefloat2').value = newbalance2;
document.getElementById('cbalance2').value = commas(newbalance2);
}

function validateForm(){
	cbalance = document.getElementById('cbalancefloat').value;
	if(cbalance < 0){
		alert('No hay fondo disponible para cubrir estos pagos.');
		return false;
	}
	
	/*Ciclo por factura*/
	
    var i = 0;
	var size = document.getElementsByName('wid[]'); 
	var selections = 0;
	for (i = 0; i < size.length; i++) { 
 		var theid = document.getElementsByName('theid[]')[i];
		var wid = document.getElementsByName('wid[]')[i]; 
		if(theid.checked == true){
			var thevalue = theid.value;
		}else {
			var thevalue = 0;
		}
		document.getElementsByName('id[]')[i].value = thevalue;
		
		if((theid.checked == true) && (wid.value == "")){
			alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
			wid.focus();
			return false; 
		} 
		if(theid.checked == true){
			selections++;
		}
	
	}
	if(selections == 0){
		alert('Usted debe de seleccionar al menos un grupo de cancelacion.');
		return false
	}
		
	
/*Fin de ciclo por factura */
	
}

function validateForm2(){
	cbalance2 = document.getElementById('cbalancefloat2').value;
	if(cbalance2 < 0){
		alert('No hay fondo disponible para cubrir estos pagos.');
		return false;
	}
	
	
	
	
		/*Ciclo por factura*/
	
    var i2 = 0;
	var size2 = document.getElementsByName('wid2[]');
	var selections2 = 0; 
	for (i2 = 0; i2 < size2.length; i2++) { 
 		var theid2 = document.getElementsByName('theid2[]')[i2];
		var wid2 = document.getElementsByName('wid2[]')[i2]; 
		if(theid2.checked == true){
			var thevalue2 = theid2.value;
		}else {
			var thevalue2 = 0;
		}
		
		document.getElementsByName('id2[]')[i2].value = thevalue2;
		if((theid2.checked == true) && (wid2.value == "")){
			alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
			wid2.focus();
			return false; 
		} 
		if(theid2.checked == true){
			selections2++;
		}
	
	}
	if(selections2 == 0){
		alert('Usted debe de seleccionar al menos un grupo de cancelacion.');
		return false; 
	}
	
		
	
/*Fin de ciclo por factura */
}


function validateForm3(){
	
	
    var i3 = 0;
	var size3 = document.getElementsByName('wid3[]');
	var selections3 = 0; 
	for (i3 = 0; i3 < size3.length; i3++) { 
 		var theid3 = document.getElementsByName('theid3[]')[i3];
		var wid3 = document.getElementsByName('wid3[]')[i3]; 
		if(theid3.checked == true){
			var thevalue3 = theid3.value;
		}else {
			var thevalue3 = 0;
		}
		document.getElementsByName('id3[]')[i3].value = thevalue3;
		
		if((theid3.checked == true) && (wid3.value == "")){
			alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
			wid3.focus();
			return false; 
		} 
		if(theid3.checked == true){
			selections3++;
		}
	
	}
	if(selections3 == 0){
		alert('Usted debe de seleccionar al menos un grupo de cancelacion.');
		return false; 
	}
	
	
	
/*Fin de ciclo por factura */
}

function commas(unformatedAmmount) {
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}


</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>