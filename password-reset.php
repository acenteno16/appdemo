<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8"/>
<title>Casa Pellas | Aplicación de Pagos</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
<style nonce="<?= $nonce ?>">
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
            case 'blank':
                msg = "La contraseña no puede estar en blanco.";
                break;
            case 'notmatch':
                msg = "Las contraseñas no coinciden.";
                break;
            case 'tooshort':
                msg = "La contraseña debe tener al menos 8 caracteres.";
                break;
            case 'toolong':
                msg = "La contraseña no debe superar los 25 caracteres.";
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

<!-- BEGIN BODY -->

<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->

<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->

<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->

<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->

<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->

<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->

<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->

<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->

<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->

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

	<form class="login-form" action="password-reset-code.php" method="post"> 

		<h3 class="form-title">Reestablezca su contraseña</h3>

		<div class="alert alert-danger display-hide">

			<button class="close" data-close="alert"></button>

			<span>

			Ingrese Usuario y Contraseña. </span>

		</div>

		<div class="form-group">

			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

			

			<div class="input-icon">

				<i class="fa fa-user"></i>

				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Contraseña" name="password1" id="password1"/>

			</div>

		</div>

		<div class="form-group">

		

			<div class="input-icon">

				<i class="fa fa-lock"></i>

				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirmar Contraseña" name="password2" id="password2"/>

		      <input name="token" type="hidden" id="token" value="<?php echo $_GET['token']; ?>">
			</div>

		</div>

		<div class="form-actions">

			

			<button type="submit" class="btn green pull-right">

			Reestablecer <i class="m-icon-swapright m-icon-white"></i>

			</button>
<br><br>
		</div>

		

		

	

	</form>

	<!-- END LOGIN FORM -->

	<!-- BEGIN FORGOT PASSWORD FORM -->

  

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

<script nonce="<?= $nonce ?>">
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
<? include('admin/foot.php'); ?>