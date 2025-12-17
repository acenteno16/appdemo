<?php 

#require('headers.php');
$allowedRoles = ['generalsession', 'admin', 'providers'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general', 'chart'];   

$year = date('Y');
$month = date('m');

?>  
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>	
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row"> 
				<div class="col-md-12">
					<h3 class="page-title">Dashboard <small>Estadísticas y más</small></h3>
				</div>
			</div>
         <div class="row">
           <div class="col-md-12 ">
       
          
       <img src="../images/values.jpg" width="100%;">
       
       <? 
	   
	   #Desarrollo
	   if(($_SESSION['email'] == 'jairovargasg@gmail.com') or ($_SESSION['email'] == 'hgaitan@casapellas.com')){
			###include("dashboard-development.php");  
		} 
		#noticias
			   if($_GET['light'] == 1){
				
			}else{
		include("dashboard-news.php"); 
			   }
	   
	   
	    if(($_SESSION['financemanager'] == 'active') or ($_SESSION['admin'] == 1)){
			
			if($_GET['light'] == 1){
				
			}else{
				#control de liberadores
				include('dashboard-releasing-control.php');
		    	#control de programación
				include('dashboard-schedule-control.php'); 
				//include('realising-status.php');
	   	   		//include('dashboard-cancelled-payments.php');
			}
		}
		
		if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
			#plots  Pagos por etapa global y tesoreria
			if($_GET['light'] == 1){
				
			}else{
            	include('dashboard-cancelled-payments2.php'); 
			}
            
		}
		
		if(($_SESSION['approve1'] == 'active') or ($_SESSION['approve2'] == 'active') or ($_SESSION['approve3'] == 'active')){
			if($_GET['forced'] == 1){
			include('dashboard-cancelled-payments-manager.php'); 
			}
		}
		
	   if($_SESSION["request"] == "active"){
		   
		    if($_GET['light'] == 1){
				#	
			}else{
			   include("dashboard-request.php");
		   }
	   }
      
		
		?>

        </div>
             

	</div>

            
           <!-- END CONTENT -->

	<!-- BEGIN QUICK SIDEBAR -->

<?php include("sidebar.php"); ?>
</div>
<?php 
	include("footer.php"); 
	loadJS($requiredFiles, $nonce);
?>
</body>
</html>