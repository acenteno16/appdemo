<?

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('admin/headers.php');
require('admin/config.php');

if(!isset($_SESSION)){ session_start(); }

$_SESSION['2fa_verified'] = false;

if($_SESSION['2fa_verified'] == true){
	header('location: dashboard.php'); 
}
elseif(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	include("connection.php");
}else{
	if(isset($_SESSION)){ session_destroy(); }
	header("location: /?err=nosession_sessions");	  
} 
	
include('online.php');
$uid = $_SESSION["uid"];

$query = "select email from workers where uid = '$uid' AND uidNow >= NOW() - INTERVAL 10 MINUTE";
$query = "select email from workers where uid = '$uid'";
if($_SESSION['email'] == 'jairovargasg@gmail.com'){
	echo $query;
}
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
if($num < 1){
	exit("<script> alert('El token de autenticación esta vencido. favor vuelva a iniciar sesion.'); window.location = '/'; </script>");
}


?>
<!DOCTYPE html>
<html>
<head>
<?php /*<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet'>*/ ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GetPay | Grupo Casa Pellas</title>
<meta name="description" content="Getpay - Casa Pellas">
<link href="admin/login/css/bootstrap.min.css" rel="stylesheet">
<link href="admin/login/css/font-awesome.min.css" rel="stylesheet">
<link href="admin/login/css/main.css" rel="stylesheet">
<link href="admin/login/css/blue.css" rel="alternatel stylesheet" title="blue">
<style nonce="<?= $nonce; ?>">
	body{
		background: #21355D !important;
	}
	.modal-content{
				background: #40C8EF !important;
				}
	.modal {
  display: none;
  position: fixed;
  z-index: 999;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.6);
}

.modal-content {
  background-color: #fff;
  margin: auto;
  padding: Q0px;
  border: 1px solid #888;
  width: 90%;
  max-width: 400px;
  border-radius: 10px;
  box-shadow: 0px 0px 20px #00000066;
  text-align: center;
}

.modal-content h2 {
  margin-top: 0;
}

.qr-container img {
  margin: 20px 0;
  width: 200px;
  height: 200px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}
.close:hover {
  color: #000;
}
.container{
	background: #21355D !important;
	}
	#code{
		width: 80%; margin: 0px auto;
	}
	.greenBtn{
		background-color: #28a745;     /* Verde éxito */
  color: white;                  /* Texto blanco */
  border: none;
  padding: 10px 20px;
  font-size: 14px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
	}
	.greenBtn:hover{
		background-color: #228C39;     /* Verde éxito */
	}
	</style>
<script nonce="<?= $nonce; ?>">
function openQRModal() {
  document.getElementById('qrModal').style.display = 'block';
}

function closeQRModal() {
  document.getElementById('qrModal').style.display = 'none';
}
	
document.addEventListener("DOMContentLoaded", function () {
	openQRModal();
});	

</script>
</head>
	
<body>

<div class="hero-unit" >   
  

  <!--container-->
  <div class="container" >
    <?php //include('header'); ?>
    
    <!--cta-->
    <div class="cta">
      <div class="row">
        <div class="col-md-6 center-block">
          <header class="welcome-message text-center" >
          
          
            <!--sub-form-->
            <div class="sub-form">
              <br><br><br><br><br><br><br><br><br>
             
				<div><br>
<!-- Modal (capa flotante) -->
<div id="qrModal" class="modal" >
  <div class="modal-content" >
    <br>
	  <img src="images/getpay-white-h.png" data-at2x="images/getpay-white-h.png" alt="logo" width="250"><br><br>
    <h2>Autenticación de Dos Factores</h2>
    <p>Abre la aplicaciòn de Microsoft autenticator desde tu celular para conpletar la autenticaciòn.</p>
 
    <form method="POST" action="loginVerify.php">
      <label for="code">Ingresa el código de 6 dígitos:</label> 
      <input type="text" name="code" class="form-control" id="code" required><br>
      <button type="submit" class="greenBtn">Verificar</button><br><br>  
		
    </form>
  </div>
</div>
				
             
             
            </div>
            <!--sub-form end--> 
          </header>
        </div>
      </div>
    </div>
    <!--cta end--> 
    
  </div>
  <!--container end--> 
  
</div>

<!--footer-->
<footer class="site-footer text-center"> 
  <!--container-->
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
        
        <!--Social media-->
        <?php /*
		<ul class="social-footer">
          <li class="slide-left"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li class="slide-top"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li class="slide-top"><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
          <li class="slide-right"><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
        */ ?>
		<!--Social media end--> 
        
        <small class="slide-top">&copy; <?php echo date('Y');?> 
<span class="bold"><img src="images/gcp-white.png" width="300"> </span></small><br>
<span class="developerHome">Desarrollado por: <a href="http://multitechlabs.com/" target="_blank" class="developerHome"><img src="images/mt-white.png" width="25"> MultiTech Labs</span></a></div>  <br><br><br><br>
    </div> 
  </div>
  <!--container end--> 
  
</footer>
<!--footer end--> 

<!--PRELOAD-->
<? /*	
<div id="preloader">
  <div id="status"></div>
</div> */ ?>
<!--end PRELOAD-->  
<script nonce="<?= $nonce ?>" src="index.js"></script>  
<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<? /*
<script src="admin/login/js/jquery-1.11.1.min.js"></script> 
<script src="admin/login/js/retina.min.js"></script> 
<script src="admin/login/js/waypoints.min.js"></script> 
<script src="admin/login/js/jquery.animateNumber.min.js"></script> 
<script src="admin/login/js/jquery.fadethis.min.js"></script> 
<script src="admin/login/js/jquery.downCount.js"></script>  
<script src="admin/login/js/main.js"></script>
*/ ?>
</body>
</html>


<?php /* 
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Casa Pellas | Aplicación de Pagos</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<meta content="" name="description"/>

<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link href="assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>

<link href="assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
<link rel="apple-touch-icon" href="cp.png" /> 

</head>

<!-- BEGIN BODY -->



<body class="login">

<!-- BEGIN LOGO -->

<div class="logo">

	<a href="index.html">

	<img src="images/casa-pellas.png" alt="" width="300"/>

	</a>

</div>

<!-- END LOGO -->

<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

<div class="menu-toggler sidebar-toggler">

</div>

<!-- END SIDEBAR TOGGLER BUTTON -->

<!-- BEGIN LOGIN -->

<div class="content">

	<!-- BEGIN LOGIN FORM -->

	<form class="login-form" action="login-code.php" method="post"> 

		<h3 class="form-title">Ingrese a su cuenta</h3>

		<div class="alert alert-danger display-hide">

			<button class="close" data-close="alert"></button>

			<span>

			Ingrese Usuario y Contraseña. </span>

		</div>

		<div class="form-group">

			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

			<label class="control-label visible-ie8 visible-ie9">Email</label>

			<div class="input-icon">

				<i class="fa fa-user"></i>

				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Usuario" name="username"/>

			</div>

		</div>

		<div class="form-group">

			<label class="control-label visible-ie8 visible-ie9">Contraseña</label>

			<div class="input-icon">

				<i class="fa fa-lock"></i>

				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Contraseña" name="password"/>

			</div>

		</div>

		<div class="form-actions">

			

			<button type="submit" class="btn green pull-right">

			Iniciar <i class="m-icon-swapright m-icon-white"></i>

			</button>
<br><br>

	<h4><a href="help-login.php">Centro de ayuda aqui &raquo;</a></h4>
		</div>

		

		<div class="forget-password">

			<h4>Olvido su contraseña?</h4>

			<p>

				 Haga click <a href="javascript:;" id="forget-password">

				aqui </a>

				para leer las instrucciones.

			</p>

		</div>

	

	</form>

	<!-- END LOGIN FORM -->

	<!-- BEGIN FORGOT PASSWORD FORM -->

  <form class="forget-form" action="forget.php" method="post">

		<h3>Olvido su contraseña?</h3>

		<p>

			Ingrese su correo electrónico para solicitar sus datos de ingreso.

		</p>

		<div class="form-group">

			<div class="input-icon">

				<i class="fa fa-envelope"></i>

				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>

			</div>

		</div>

		<div class="form-actions">

			<button type="button" id="back-btn" class="btn">

			<i class="m-icon-swapleft"></i> Atrás </button>

			<button type="submit" class="btn green pull-right">

			Enviar <i class="m-icon-swapright m-icon-white"></i> 

			</button>

		</div>

	</form>

	<!-- END FORGOT PASSWORD FORM -->

<!-- BEGIN REGISTRATION FORM --></div>

<!-- END COPYRIGHT -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>

<script src="assets/global/plugins/respond.min.js"></script>

<script src="assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

<script src="assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="assets/admin/pages/scripts/login.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

		jQuery(document).ready(function() {     

		  Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar

		  Login.init();

		});

	</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
*/ ?>