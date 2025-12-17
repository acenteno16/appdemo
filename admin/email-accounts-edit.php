<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from mailer where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();

?><!DOCTYPE html>
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
          
          <h3 class="page-title">Cuentas de Correo Electronico <small>Editor</small> </h3>
          <ul class="page-breadcrumb breadcrumb">
           
            <li> <i class="fa fa-home"></i> <a href="dashboard.php">Inicio</a> <i class="fa fa-angle-right"></i> </li>
            <li> <a href="email-accounts.php">Cuentas de Correo Electronico</a> <i class="fa fa-angle-right"></i> </li>
            <li> Editor</li>
          </ul>
          
          <!-- END PAGE TITLE & BREADCRUMB--> 
          
        </div>
      </div>
      
      <!-- END PAGE HEADER--> 
      
      <!-- BEGIN PAGE CONTENT-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable tabbable-custom boxless tabbable-reversed">
            <div class="tab-pane" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption">
                    <?php //Form Sample ?>
                  </div>
                 
                </div>
                <div class="portlet-body form"> 
                  
                  <!-- BEGIN FORM-->
                  
                  <form action="email-accounts-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Email/Username:</label>
                            <input name="mailUsername" type="text" class="form-control" id="mailUsername" value="<? echo $row['mailUsername']; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Servidor/Host:</label>
                            <input name="mailHost" type="text" class="form-control" id="mailHost" value="<? echo $row['mailHost']; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label class="control-label">Puesto/Port:</label>
                           <input name="mailPort" type="text" class="form-control" id="mailPort" value="<? echo $row['mailPort']; ?>">
                        </div>
                     
                        <div class="col-md-3">
                          <label class="control-label">SSL/TLS:</label>
                          <select name="mailTLS" class="form-control" id="mailTLS">
                            <option value="0">No</option>
                            <option value="1" <? if($row['mailTLS'] == 1) echo "selected"; ?>>TLS</option>
							<option value="2" <? if($row['mailTLS'] == 2) echo "selected"; ?>>SSL</option>
                          </select>
                        </div>
						  
						   <div class="row"></div>
						  
						   <div class="col-md-3">
                          <label class="control-label">Remitente/From: [Email]</label>
                           <input name="mailFrom" type="text" class="form-control" id="mailFront" value="<? echo $row['mailFrom']; ?>">
                        </div>
						    <div class="col-md-3">
                          <label class="control-label">Remitente/From: [Nombre]</label>
                           <input name="mailFromName" type="text" class="form-control" id="mailFromName" value="<? echo $row['mailFromName']; ?>">
                        </div>
						  
						     <div class="row"></div>
						  
						  <div class="col-md-3"><h3>Password:</h3></div>
						  
						  <div class="row"></div>
						  
						  <div class="col-md-3">
                          <label class="control-label">Password:</label>
                           <input name="password" type="password" class="form-control" id="password" value="<? if($row['mailPassword'] != '') echo 'holamundo'; ?>" disabled>
                        </div>
						   <div class="row"></div>
						  
						  <div class="col-md-3">
                          <label class="control-label">Nuevo password:</label>
                           <input name="password1" type="password" class="form-control" id="password1" value="">
                        </div>
						  
						  <div class="col-md-3">
                          <label class="control-label">Confirmación nuevo password:</label>
                           <input name="password2" type="password" class="form-control" id="password2" value="">
                        </div>
						  <div class="row"></div>
						  <div class="col-md-12">
						  <p class="redText"><br>* Utilice los campos de "nuevo password" y "confirmación de nuevo password" para definir o cambiar una contraseña.</p>
						  </div>
                        
                        <!--/span--> 
                        
                      </div>
                      
                      <!--/row--><!--/row--> 
                      
                      <!--/row-->
                      
                      <div class="row"></div>
                      
                      <!--/row--></div>
                    <div class="form-actions right">
                     <a href="email-accounts.php"><button type="button" class="btn default"> Cancelar</button></a>
                      <button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
                      <input name="id" type="hidden" id="id" value="<? echo $row['id']; ?>">
                    </div>
                  </form>
                  
                  <!-- END FORM--> 
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- END PAGE CONTENT--> 
      
    </div>
  </div>
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<?php include('foot.php'); ?> 