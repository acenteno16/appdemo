<? 

require('admin/headers.php');

session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
<style nonce="<?= $nonce ?>">
	.modal{ 
		display: none !important;
	}
	footer{
		background-color: #21355D !important;
	}
	.overlay{
		background-color: #3FC8EF !important;
	}
	#mc-subscribe1{
		background-color: #51BF87 !important;
		border: none;
	}

.modal {
  position: fixed;
  z-index: 9999;
  left: 0; top: 0;
  width: 100%; height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}
.modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border-radius: 6px;
  width: 90%;
  max-width: 400px;
  text-align: center;
  font-family: sans-serif;
}
.modal-success {
  border-left: 6px solid #4CAF50;
}
.modal-warning {
  border-left: 6px solid #ff9800;
}
.modal-error {
  border-left: 6px solid #f44336;
}
.close-btn {
  color: #aaa;
  float: right;
  font-size: 24px;
  cursor: pointer;
}
</style>
<script nonce="<?= $nonce ?>">
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("customModal");
    const modalContent = document.getElementById("modalContent");
    const closeBtn = document.querySelector(".close-btn");
    const messageEl = document.getElementById("modalMessage");

    const params = new URLSearchParams(window.location.search);
    const code = params.get("error"); // incluye errores y éxito

    if (code) {
        let type = "modal-error"; // por defecto
        let msg = "Ocurrió un error desconocido.";

        switch (code) { 
			case 'null':
                return;
                break;
			case 'correo_invalido':
                msg = "Correo electrónico no válido. Intente de nuevo.";
                break;
            case 'token_expirado':
                msg = "El enlace ha expirado. Solicite uno nuevo.";
                break;
            case 'limite_excedido':
                msg = "Ha excedido el número de intentos. Espere unos minutos.";
                break;
            case 'mailer_error':
                msg = "No se pudo enviar el correo. Contacte al administrador.";
                break;
            case 'exito':
                msg = "Las instrucciones han sido enviadas por correo electrónico.";
                type = "modal-success";
                break;
            case 'sin_coinsidencia':
                msg = "No se encontró un registro con ese correo. Verifique.";
                type = "modal-warning";
                break;
        }

        // Asignar mensaje y estilo
        messageEl.textContent = msg;
        modalContent.classList.add(type);
        modal.style.display = "block";
		
		setTimeout(() => { modal.style.display = "none"; }, 5000);
    }

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
</script>
</head>
<body>
<div class="hero-unit">   
  
  <!--HTML5 Video-->
  <? /*	
  <video autoplay loop muted id="bgvid">
    <?php //<source src="/images/christmas.mp4" type="video/mp4"> ?>     
	<?php /*<source src="video/vb.ogv" type="video/ogg">
	<source src="video/vb.webm" type="video/webm">*/ /*
	?>
  </video>
  */ ?>
  <!--HTML5 Video end-->

  <div class="overlay"></div>
  <!--container-->
  <div class="container">
   <?php //include('header'); ?>
    <div class="cta">
      <div class="row">
        <div class="col-md-6 center-block">
          <header class="welcome-message text-center">
          
            <h1>Bienvenidos a <br>
				<span class="highlight"><img src="images/getpay-white-h.png" data-at2x="images/getpay-white-h.png" alt="logo" width="350"></span></h1>
            <h2>Inicio de Sesión</h2>
            <!--sub-form-->
            <div class="sub-form">
              <form role="form" id="mc-form" action="/login-code.php" method="post" enctype="multipart/form-data" autocomplete="off"> 
                <input type="email" placeholder="Email " required value="<?php echo isset($_COOKIE['getpay']) ? htmlspecialchars($_COOKIE['getpay']) : ''; ?>" name="username" id="username" autocomplete="off"> 
                <input type="password" placeholder="Contraseña" required value="" name="password" id="password" autocomplete="off">
				<button type="submit" class="button" id="mc-subscribe1" value="Subscribe" name="subscribe">Iniciar Sesión</button> 
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
              </form>
              <p class="terms"><a href="#" class="nPassword">Establecer nueva contraseña?</a></p>
				<script nonce="<?= $nonce ?>">
					document.addEventListener("DOMContentLoaded", function() {
						const form = document.getElementById('mc-form');
						document.querySelector(".nPassword").addEventListener("click", function(e) {
							e.preventDefault();
							const email = document.getElementById('username').value.trim();
							if (!email) {
								alert("Por favor, escriba su correo electrónico para reestablecer su contraseña.");
								return;
							}
							// Eliminar campo password antes de enviar
							const passwordField = document.getElementById('password');
							if (passwordField) {
								passwordField.remove();
							}
							form.action = "/forget.php";
							form.submit();
						});
					});
				</script>

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
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
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
<? include('admin/foot.php'); ?>