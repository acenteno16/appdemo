<?


$systemOnline = 1;

if(($_SESSION['email'] == 'jairovargasg@gmail.com') or ($_SESSION['email'] == 'hgaitan@casapellas.com') or ($_SESSION['email'] == 'omiranda@casapellas.com') or ($_SESSION['masterKey'] == 'active')){
    $systemOnline = 1;
}

if($systemOnline == 1){
	#doNothing 
}
else{ 
	
	require_once('headers.php');
	require('includes.php');
	$requiredFiles = ['general', 'lock']; 
    
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
<body>

<div class="page-lock">

	<div class="page-logo">

		<a class="brand" href="#">

		<img src="../images/getpay-white-h.png" width="400px" alt="logo"/>

		</a>

	</div>

	<div class="page-body">

		<? //<img class="page-lock-img" src="../../assets/admin/pages/media/profile/profile.jpg" alt=""> ?>

		<div class="page-lock-info">

			<h1><? echo $_SESSION['firstname'].' '.$_SESSION['lastname']?></h1>

			<span class="email">

			<? echo $_SESSION['email']; ?> </span>

			<span class="locked">

			En mantenimiento. </span>

			

		</div>

	</div>

	<div class="page-footer-custom">

		 <? echo date('Y')?> &copy; GetPay - Grupo Casa Pellas.

	</div>

</div>
<?php loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<style nonce="<?= $nonce ?>">
	body{
		background-color: #3FC8EF;
	}
	.page-lock-info{
		float: left !important;
	}
	.email{
		color: #21355D !important;
	}
	h1, .locked{
		color: #21355D !important;
	}
</style>
<? exit(); } ?>