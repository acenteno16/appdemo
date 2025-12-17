<?php
require( 'headers.php' );
$allowedRoles = [ 'admin', 'request' ];
require( "sessionCheck.php" );
require( 'includes.php' );
$requiredFiles = [ 'general', 'datepicker', 'select2'];

$id = isset( $_GET[ 'id' ] ) ? intval( $_GET[ 'id' ] ) : 0;

$querypconfirm = "SELECT * FROM payments WHERE id = ?";
$stmtpconfirm = $con->prepare( $querypconfirm );
$stmtpconfirm->bind_param( "i", $id );
$stmtpconfirm->execute();
$resultpconfirm = $stmtpconfirm->get_result();
$rowpconfirm = $resultpconfirm->fetch_assoc();
$stmtpconfirm->close();

if ( $rowpconfirm[ 'status' ] != 0 ) {
  header( 'location: payments.php' );
  exit();
}

if ( $rowpconfirm[ 'userid' ] != $_SESSION[ 'userid' ] ) {
  header( 'location: payments.php' );
  exit();
}

$typeinc = 0;
$global_limit = 25;
if ( $_SESSION[ 'email' ] == "iespinoza@casapellas.com.ni" ) {
  $global_limit = 100;
}
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
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
<?php include("side.php"); ?>
<div class="page-content-wrapper">
<div class="page-content">
  <div class="row">
    <div class="col-md-12">
      <h3 class="page-title">Pagos <small>Solicitud de Pago</small></h3>
      <ul class="page-breadcrumb breadcrumb">
        <li><i class="fa fa-home"></i> <a href="dashboard.php">Inicio</a> <i class="fa fa-angle-right"></i></li>
        <li><a href="payments.php">Pagos</a></li>
        <i class="fa fa-angle-right"></i>
        <li><a href="#">Solicitudes de pagos</a></li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tabbable tabbable-custom boxless tabbable-reversed">
        <div class="tab-pane" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title"></div>
            <div class="portlet-body form">
              <form action="payment-order-code.php" class="horizontal-form" enctype="multipart/form-data" id="porder" method="post" name="porder">
                <div class="form-body">
                  <h3 class="form-section">Información del Proveedor/Colaborador</h3>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">ID de Pago:</label>
                        <input class="form-control" id="id" name="id" readonly type="text" value="<?php echo $rowpconfirm['id']; ?>"/>
                      </div>
                    </div>
                    <?php
                    $queryfilemain = "SELECT * FROM files WHERE payment = ? AND bill = 0 ORDER BY id ASC LIMIT 1";
                    $stmtfilemain = $con->prepare($queryfilemain);
                    $stmtfilemain->bind_param("i", $id);
                    $stmtfilemain->execute();
                    $resultfilemain = $stmtfilemain->get_result();
                    $rowfilemain = $resultfilemain->fetch_assoc();
                    $fileFound = 0;
                    ?>
                    <div class="col-md-10">
                      <div class="form-group">
                        <label>Archivo:</label>
                        <input id="fileid[]" name="fileid[]" type="hidden" value="<?php echo $rowfilemain['id']; ?>"/>
                        <select class="form-control select2me" data-placeholder="Seleccionar..." id="file[]" name="file[]">
                          <option value="">Seleccionar</option>
                          <?php
                          $queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
                          $resultfbox = mysqli_query($con, $queryfbox);
                          while ($rowfbox = mysqli_fetch_array($resultfbox)) {
                              $selected = '';
                              if ((strlen($rowfilemain['link']) > 10) && (cleanLink($rowfilemain['link']) == $rowfbox['url'])) {
                                  $selected = 'selected';
                                  $fileFound = 1;
                              }
                              echo "<option $selected value='http://getpay.casapellas.com.ni/admin/visor.php?key={$rowfbox['url']}'>{$rowfbox['id']} | {$rowfbox['title']}</option>";
                          }
                          if ($fileFound == 0) {
                              $theMainLink = cleanLink($rowfilemain['link']);
                              if ($theMainLink != '') {
                                  $queryfbox2 = "select * from filebox where url = '$theMainLink'";
                                  $resultfbox2 = mysqli_query($con, $queryfbox2);
                                  $rowfbox2 = mysqli_fetch_array($resultfbox2);
                                  echo "<option selected value='http://getpay.casapellas.com.ni/admin/visor.php?key={$rowfbox2['url']}'>{$rowfbox2['id']} | {$rowfbox2['title']}</option>";
                              }
                          }
                          ?>
                        </select>
                        <br/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Tipo de Beneficiario:</label>
                        <select class="form-control" id="dspayment" name="dspayment">
                          <option value="0">Seleccionar</option>
                          <option value="1" <?php if ($rowpconfirm['btype'] == 1) echo 'selected'; ?>>Proveedores</option>
                          <option value="2" <?php if ($rowpconfirm['btype'] == 2) echo 'selected'; ?>>Colaboradores</option>
                        </select>
                      </div>
                    </div>

                    <?php if ($_SESSION['company'] == 2) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Pago inmediato:</label>
                        <select class="form-control" id="immediate" name="immediate">
                          <option value="0" <?php if ($rowpconfirm['immediate'] == 0) echo 'selected'; ?>>No</option>
                          <option value="1" <?php if ($rowpconfirm['immediate'] == 1) echo 'selected'; ?>>Sí</option>
                        </select>
                      </div>
                    </div>
                    <?php } ?>
                  </div>

                  <div class="row" id="dproviders" style="display:<?php echo ($rowpconfirm['btype'] == 1 ? 'block' : 'none'); ?>;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Código | Nombre:</label>
                        <select class="form-control select2me" data-placeholder="Seleccionar..." id="provider" name="provider">
                          <option value=""></option>
                          <?php
                          $queryproviders = "select * from providers where active = '1'";
                          $resultproviders = mysqli_query($con, $queryproviders);
                          while ($rowproviders = mysqli_fetch_array($resultproviders)) {
                              $selected = ($rowpconfirm['provider'] == $rowproviders['id']) ? 'selected' : '';
                              echo "<option $selected value='{$rowproviders['id']}'>{$rowproviders['code']} | {$rowproviders['name']} ({$rowproviders['term']} días de plazo)</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row" id="dworkers" style="display:<?php echo ($rowpconfirm['btype'] == 2 ? 'block' : 'none'); ?>;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Código | Nombre:</label>
                        <select class="form-control select2me" data-placeholder="Seleccionar..." id="collaborator" name="collaborator">
                          <option value=""></option>
                          <?php
                          $queryworkers = "select * from workers where active = '1'";
                          $resultworkers = mysqli_query($con, $queryworkers);
                          while ($rowworkers = mysqli_fetch_array($resultworkers)) {
                              $selected = ($rowpconfirm['collaborator'] == $rowworkers['id']) ? 'selected' : '';
                              echo "<option $selected value='{$rowworkers['id']}'>{$rowworkers['code']} | {$rowworkers['name']}</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Descripción:</label>
                        <textarea name="description" id="description" rows="2" class="form-control"><?php echo $rowpconfirm['description']; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Tipo de cambio:</label>
                        <input type="text" class="form-control" id="exchange" name="exchange" value="<?php echo $rowpconfirm['exchange']; ?>" readonly />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Moneda:</label>
                        <select name="currency" id="currency2pay" class="form-control">
                          <?php
                          $querycurrency = "select * from currency order by id asc";
                          $resultcurrency = mysqli_query($con, $querycurrency);
                          while ($rowcurrency = mysqli_fetch_array($resultcurrency)) {
                              $selected = ($rowpconfirm['currency'] == $rowcurrency['id']) ? 'selected' : '';
                              echo "<option value='{$rowcurrency['id']}' $selected>{$rowcurrency['name']}</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <input type="hidden" name="nochange" id="nochange" value="<?php echo $rowpconfirm['nochange']; ?>">
                    <input type="hidden" name="paymenttype" value="<?php echo $rowpconfirm['paymenttype']; ?>">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Total Factura:</label>
                        <input type="text" name="total" id="total" class="form-control" readonly value="<?php echo number_format($rowpconfirm['total'], 2); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Retención IR:</label>
                        <input type="text" name="retention1" id="retention1" class="form-control" value="<?php echo number_format($rowpconfirm['retention1'], 2); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Retención Alcaldía:</label>
                        <input type="text" name="retention2" id="retention2" class="form-control" value="<?php echo number_format($rowpconfirm['retention2'], 2); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Notas:</label>
                        <textarea name="comments" rows="2" class="form-control"><?php echo $rowpconfirm['comments']; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions right">
                    <input type="hidden" id="newbutton" name="newbutton" value="save">
                    <button type="submit" class="btn green" id="btnSave"><i class="fa fa-check"></i> Guardar</button>
                    <button type="button" class="btn blue" id="btnSaveDraft"><i class="fa fa-pencil"></i> Guardar como borrador</button>
                    <button type="button" class="btn default" id="btnCancel"><i class="fa fa-times"></i> Cancelar</button>
                  </div>

                </div> <!-- form-body -->
              </form>
            </div> <!-- portlet-body -->
          </div> <!-- portlet box -->
        </div> <!-- tab-pane -->
      </div> <!-- tabbable -->
    </div> <!-- col-md-12 -->
  </div> <!-- row -->
</div> <!-- page-content -->
</div> <!-- page-content-wrapper -->
</div> <!-- page-container -->

<?php include("footer.php"); ?>
</body>

<script nonce="<?= $nonce ?>">
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("porder");
  if (form) {
    form.addEventListener("submit", function (e) {
      if (typeof validateForm === 'function' && !validateForm()) {
        e.preventDefault();
      }
    });
  }

  const dspayment = document.getElementById("dspayment");
  if (dspayment) {
    dspayment.addEventListener("change", function () {
      selectRecipient();
      loadInsurerInfoCaller(this.value);
    });
  }

  const provider = document.getElementById("provider");
  if (provider) {
    provider.addEventListener("change", function () {
      loadInsurerInfo(this.value);
      loadCreditcardInfo(this.value);
      loadcurrency2pay();
    });
  }

  const collaborator = document.getElementById("collaborator");
  if (collaborator) {
    collaborator.addEventListener("change", function () {
      validateBill();
      loadcurrency2pay();
    });
  }
  const description = document.getElementById("description");
  if (description) {
    description.addEventListener("focus", validateFirst);
  }

  const btnSaveDraft = document.getElementById("btnSaveDraft");
  if (btnSaveDraft) {
    btnSaveDraft.addEventListener("click", function () {
      document.getElementById("newbutton").value = "draft";
      form.submit();
    });
  }

  const btnCancel = document.getElementById("btnCancel");
  if (btnCancel) {
    btnCancel.addEventListener("click", function () {
      if (confirm("¿Está seguro de cancelar esta solicitud?")) {
        window.location.href = "payments.php";
      }
    });
  }

  document.querySelectorAll('input[name="bill[]"]').forEach(input => {
    input.addEventListener("change", function () {
      validateFirst();
      validateBill();
    });
  });

  document.querySelectorAll('input[name="stotal[]"]').forEach(input => {
    input.addEventListener("keypress", justNumbers);
    input.addEventListener("keyup", function () {
      reloadNumbers(this.value);
    });
  });
});
</script>
</html>
<?php
// Este bloque se deja vacío en esta parte del archivo porque ya hemos cerrado el HTML y agregado el <script>.
// Si hay lógica adicional en el archivo original, se puede insertar aquí, pero según lo procesado, el cierre de la estructura ya se realizó correctamente.
?>
