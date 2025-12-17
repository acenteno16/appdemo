<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('headers.php');
$allowedRoles = ['admin', 'providers'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from clients where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();

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
	
	
	
	
	
	
	
	
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<?php include('foot.php'); ?> 
<script nonce="<?= $nonce ?>">
	
	// body onLoad 	
	document.addEventListener("DOMContentLoaded", function () {
		reloadNumbers();
	});	
	
	
	document.addEventListener('DOMContentLoaded', function () {
		document.getElementById('bill').addEventListener('click', function (e) {
			if (e.target.classList.contains('deleteBillBtn')) {
				e.preventDefault();
				var id = e.target.getAttribute('data-id');
				deleteBill(id);
			}	  
		});
	});
	
</script>	