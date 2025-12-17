<?

require( 'headers.php' );
$allowedRoles = [ 'admin', '2FA' ];
require( "sessionCheck.php" );
require( 'includes.php' );
$requiredFiles = [ 'general', 'datepicker', 'select2' ];
require( 'sanitize.php' );

$id = isset( $_GET[ 'id' ] ) ? intval( $_GET[ 'id' ] ) : 0;

$querypconfirm = "SELECT * FROM workers WHERE id = ?";
$stmtpconfirm = $con->prepare( $querypconfirm );
$stmtpconfirm->bind_param( "i", $id );
$stmtpconfirm->execute();
$resultpconfirm = $stmtpconfirm->get_result();
$row = $resultpconfirm->fetch_assoc();
$stmtpconfirm->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="favicon.ico" rel="shortcut icon"/>
<?php loadCSS($requiredFiles, $nonce); ?>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
  <?php include("side.php"); ?>
  <div class="page-content-wrapper">
    <div class="page-content"> 
      
      <!-- BEGIN PAGE HEADER-->
      
      <div class="row">
        <div class="col-md-12"> 
          
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          
          <h3 class="page-title"> Usuarios <small>2FA</small> </h3>
          <ul class="page-breadcrumb breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="dashboard.php">Inicio</a> <i class="fa fa-angle-right"></i> </li>
            <li> <a href="#">Opciones</a> <i class="fa fa-angle-right"></i> </li>
            <li> <a href="workers-2fa.php">Usuarios</a> <i class="fa fa-angle-right"></i> </li>
            <li> <a href="#">Ver</a> </li>
          </ul>
          
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="portlet box blue">
            <div class="portlet-title"> </div>
            <div class="portlet-body form"> 
              
              <!-- BEGIN FORM-->
              
              <form name="porder" id="porder" action="workers-2fa-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">
                <div class="form-body">
                  <h3  class="form-section">Información del Colaborador</h3>
                  <div id="client-stage">
                    <div class="row">
                      <div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nombre:</label>
                            <input name="code" type="text" class="form-control" id="code" value="<? echo $row['first'].' '.$row['last']; ?>" disabled>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="form-group">
                            <label>Email:</label>
                            <input name="unit" type="text" class="form-control" id="unit" value="<? echo $row['email']; ?>" disabled>
                          </div>
                        </div>
                        <div class="row"></div>
                        <div class="col-md-3 ">
                          <div class="form-group">
                            <label>Activo:</label>
                            <input name="active" type="text" class="form-control" id="first" value="<? if($row['active'] ==1) echo 'Si'; else echo 'No'; ?>" disabled>
                          </div>
                        </div>
                        <div class="col-md-3 ">
                          <div class="form-group">
                            <label>2FA Solicitado:</label>
                            <input name="first" type="text" class="form-control" id="first" value="<? if($row['uid'] != ''){ echo 'Si @'.$row['uidNow']; }else{ echo 'No'; } ?>" disabled>
                          </div>
                        </div>
                        <div class="col-md-3 ">
                          <div class="form-group">
                            <label>2FA Activo:</label>
                            <input name="first" type="text" class="form-control" id="first" value="<? if($row['msActive'] ==1) echo 'Si'; else echo 'No'; ?>" disabled>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                  <h3  class="form-section">Herramientas</h3>
                  <div class="row">
                    <div class="col-md-3">
                      <select name="tools" class="form-control" id="tools">
                        <option value="0" selected>Seleccionar</option>
                        <option value="1">Forzar Reautenticar 2FA</option>
                      </select>
                    </div>
                  </div>
                  <div class="row"></div>
                </div>
                <div class="form-actions right" style=" margin-top:10px;">
                  <div style="margin-right: 10px;">
                    <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Procesar</button>
                  </div>
                  <input name="id" type="hidden" id="id" value="<? echo $row['id']; ?>">
                  </span> </div>
              </form>
              
              <!-- END FORM--> 
              
            </div>
          </div>
          <br>
          <br>
          <div class="portlet">
            <div class="portlet-title">
              <div class="caption"> Logs de inicio de sesión </div>
            </div>
          </div>
          <div class="tabbable tabbable-custom boxless tabbable-reversed">
            <?php ///// table ?>
            <div class="tab-pane" id="tab_1">
              <div class="row"><!--/span-->
                
                <div class="col-md-12">
                  <?php 
					
					$today = date('Y-m-d'); 
					$query = "select * from login where email = '$row[email]' order by id desc limit 100"; 
					$result = mysqli_query($con, $query);
					
					$thisResponse = array();
					$thisResponse[0] = 'Rechazado';
					$thisResponse[1] = 'Aprobado';
					
					$thisResponse2 = array();
					$thisResponse2[0] = '';
					$thisResponse2[1] = '+Solicitado';
					$thisResponse2[2] = '+Configurado';
					$thisResponse2[3] = '+ErrorConfig';
					$thisResponse2[4] = '+ErrorInicio';
					$thisResponse2[5] = '+Iniciado';
					
					?>
                  <table class="table table-striped table-bordered table-hover" id="datatable_orders">
                    <thead>
                      <tr role="row" class="heading">
                        <th width="2%"> ID</th>
						  <th width="18%"> Fecha</th>
                        <th width="16%"> IP</th>
                        <th width="16%"> Dispositivo</th>
                        <th width="16%"> Navegador</th>
                        <th width="16%"> Lenguaje</th>
                        <th width="16%"> Respuesta</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row=mysqli_fetch_array($result)){ ?>
                      <tr role="row" class="odd">
						  <td class="sorting_1"><?= $row['id']; ?></td>
						  <td><?php echo $row["today"].' @'.$row['totime']; ?></td>
                        <td><?php echo $row["ip"]; ?></td>
                        <td><?php echo $row["device"]; ?></td>
                        <td><?php echo $row["browser"]; ?></td>
                        <td><?php echo $row["language"]; ?></td>
                        <td><?php echo $thisResponse[$row["response"]].$thisResponse2[$row['2fa']]; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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