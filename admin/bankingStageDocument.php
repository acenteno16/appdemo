<?

include('session-bankingDebt.php');
include_once('functions.php');

$queryTransaction = "select * from bankingDebtTransactions where bankingDebt = '$row[id]' order by id desc limit 1";
$resultTransaction = mysqli_query( $con, $queryTransaction );
$numTransaction  = mysqli_num_rows($resultTransaction);
$rowTransaction = mysqli_fetch_array( $resultTransaction );
$rowTransaction['type'].'++'.$rowTransaction['id'];
if(($row['type'] == 1) or ($row['type'] == 2)){
  ?>
<div id="loansDiv" class="row">
  <div class="row"></div>
  <? switch($rowTransaction['type']){
	  case 0:
	  	$ttype = 'Desembolso';
		  break;
	  case 1:
		  $ttype ='Abono';
		  break;
		case 2:
		  $ttype ='Pago de interés';
		  break;
		  case 3:
		  $ttype ='Cancelación';
		  break;
		   case 4:
		  $ttype ='Abono + Intereses';
		  break;
		   case 5:
		  $ttype ='Cancelación + Intereses';
		  break;
  } 

?>	
 <? #Referencia ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Tipo de transacción:</label>
      <input type="text" id="trtype" name="trtype" class="form-control" value="<? echo $ttype; ?>" readonly>
    </div>
  </div>
	
	  <? #Referencia ?>
	<? if($rowTransaction['type'] > 0){ ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Monto:</label>
      <input type="text" id="tramount" name="tramount" class="form-control" value="<? echo $pre.str_replace('.00','',number_format($rowTransaction['amount'],2)); ?>" readonly>
    </div>
  </div>
	 <div class="col-md-3 ">
    <div class="form-group">
      <label>Interes:</label>
      <input type="text" id="trinterest" name="trinterest" class="form-control" value="<? echo $pre.str_replace('.00','',number_format($rowTransaction['interest'],2)); ?>" readonly>
    </div>
  </div>
	<? } ?>
	
<div class="row"></div>	
  <? #} ?>	
  <? #Tabla de amortizacion ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Tabla de amortizacion:</label>
      <div class="input-group" id="amortizationText">
        <input type="text" id="amortizationUrl" name="amortizationUrl" class="form-control" value="<? echo activeDomain($rowTransaction['amortization']); ?>" readonly>
        <span class="input-group-addon"> <a href="<? echo activeDomain($rowTransaction['amortization']); ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
    </div>
  </div>
  <? #Movimiento bancario ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Movimiento Bancario:</label>
      <div class="input-group" id="amortizationText">
        <input type="text" id="amortizationUrl" name="amortizationUrl" class="form-control" value="<? echo activeDomain($rowTransaction['bankingmovement']); ?>" readonly>
        <span class="input-group-addon"> <a href="<? echo activeDomain($rowTransaction['bankingmovement']); ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
    </div>
  </div>
  <? #Referencia ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Referencia:</label>
      <input type="text" id="amortizationUrl" name="amortizationUrl" class="form-control" value="<? echo $rowTransaction['reference']; ?>" readonly>
    </div>
  </div>
	 <? #Fecha Banco ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Fecha Banco:</label>
      <input type="text" id="dateBank" name="dateBank" class="form-control" value="<? echo $rowTransaction['dateBank']; ?>" readonly>
    </div>
  </div>
    
    <div class="row"></div>
    
    <? 
    $queryBills = "select * from bankingDebtBills where bankingDebt = '$row[id]'";
    $resultBills = mysqli_query($con, $queryBills);
    $numBills=mysqli_num_rows($resultBills);
    if($numBills > 0){
    ?>
    <div class="col-md-12 ">
    <div class="form-group">
      <label>Facturas:</label>
     
    </div>
  </div>
    
    <? 
    
    while($rowBills=mysqli_fetch_array($resultBills)){
    ?>
  
    
    <div class="col-md-3 ">
    <div class="form-group">
     
      <div class="input-group" id="amortizationText">
        <input type="text" id="amortizationUrl" name="amortizationUrl" class="form-control" value="<? echo activeDomain($rowBills['url']); ?>" readonly>
        <span class="input-group-addon"> <a href="<? echo activeDomain($rowBills['url']); ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
    </div>
  </div>
    
    
    <? } } ?>
	
  <div class="row"></div>
</div>
  <? }  elseif($row['type'] == 3){ ?>
  <div id="lettersDiv">

    <? #proforma de proveedor ?>
    <div class="col-md-3 ">
      <div class="form-group">
        <label>Proforma:</label>
        <div class="input-group" id="proformaText" style="display: none;">
          <input type="text" id="proformaUrl" name="proformaUrl" class="form-control" value="" readonly>
          <span class="input-group-addon"> <a href="javascript:showFile5('proforma');"><i class="fa fa-times"></i></a> </span> </div>
        <div class="input-group" id="proformaFile">
          <input name="proforma" type="file" class="form-control" id="proforma" value="">
          <span class="input-group-addon"> <a href="javascript:uploadFile('proforma');"><i class="fa fa-cloud-upload"></i></a> </span> </div>
        <br>
        <progress id="progressBar5" value="0" max="100" style="width:100%;"></progress>
        <br>
        <span id="loaded_n_total5"></span><br>
        <span id="status5"></span> </div>
    </div>
    <? #swift1 ?>
    <div class="col-md-3 ">
      <div class="form-group">
        <label>Swift de emision:</label>
        <div class="input-group" id="swift1Text" style="display: none;">
          <input type="text" id="swift1Url" name="swift1Url" class="form-control" value="" readonly>
          <span class="input-group-addon"> <a href="javascript:showFile6('swift1');"><i class="fa fa-times"></i></a> </span> </div>
        <div class="input-group" id="swift1File">
          <input name="swift1" type="file" class="form-control" id="swift1" value="">
          <span class="input-group-addon"> <a href="javascript:uploadFile('swift1');"><i class="fa fa-cloud-upload"></i></a> </span> </div>
        <br>
        <progress id="progressBar6" value="0" max="100" style="width:100%;"></progress>
        <br>
        <span id="loaded_n_total6"></span><br>
        <span id="status6"></span> </div>
    </div>
    <? #swift2 ?>
    <div class="col-md-3 ">
      <div class="form-group">
        <label>Swift de confirmación:</label>
        <div class="input-group" id="swift2Text" style="display: none;">
          <input type="text" id="swift2Url" name="swift2Url" class="form-control" value="" readonly>
          <span class="input-group-addon"> <a href="javascript:showFile7('swift2');"><i class="fa fa-times"></i></a> </span> </div>
        <div class="input-group" id="swift2File">
          <input name="swift2" type="file" class="form-control" id="swift2" value="">
          <span class="input-group-addon"> <a href="javascript:uploadFile('swift2');"><i class="fa fa-cloud-upload"></i></a> </span> </div>
        <br>
        <progress id="progressBar7" value="0" max="100" style="width:100%;"></progress>
        <br>
        <span id="loaded_n_total7"></span><br>
        <span id="status7"></span> </div>
    </div>
    <? #swift3 ?>
    <div class="col-md-3 ">
      <div class="form-group">
        <label>Swift de aviso:</label>
        <div class="input-group" id="swift3Text" style="display: none;">
          <input type="text" id="swift3Url" name="swift3Url" class="form-control" value="" readonly>
          <span class="input-group-addon"> <a href="javascript:showFile8('swift3');"><i class="fa fa-times"></i></a> </span> </div>
        <div class="input-group" id="swift3File">
          <input name="swift3" type="file" class="form-control" id="swift3" value="">
          <span class="input-group-addon"> <a href="javascript:uploadFile('swift3');"><i class="fa fa-cloud-upload"></i></a> </span> </div>
        <br>
        <progress id="progressBar8" value="0" max="100" style="width:100%;"></progress>
        <br>
        <span id="loaded_n_total8"></span><br>
        <span id="status8"></span> </div>
    </div>
    <? #Comisiones ?>
    <div class="col-md-3 ">
      <div class="form-group">
        <label>Comisiones:</label>
        <div class="input-group" id="commissionText" style="display: none;">
          <input type="text" id="commissionUrl" name="commissionUrl" class="form-control" value="" readonly>
          <span class="input-group-addon"> <a href="javascript:showFile9('commission');"><i class="fa fa-times"></i></a> </span> </div>
        <div class="input-group" id="commissionFile">
          <input name="commission" type="file" class="form-control" id="commission" value="">
          <span class="input-group-addon"> <a href="javascript:uploadFile('commission');"><i class="fa fa-cloud-upload"></i></a> </span> </div>
        <br>
        <progress id="progressBar9" value="0" max="100" style="width:100%;"></progress>
        <br>
        <span id="loaded_n_total9"></span><br>
        <span id="status9"></span> </div>
    </div>
    <? #letter ?>
    <div class="col-md-3 ">
      <div class="form-group">
        <label>Cancelacion Carta de crédito:</label>
        <div class="input-group" id="letterText" style="display: none;">
          <input type="text" id="letterUrl" name="letterUrl" class="form-control" value="" readonly>
          <span class="input-group-addon"> <a href="javascript:showFile10('letter');"><i class="fa fa-times"></i></a> </span> </div>
        <div class="input-group" id="letterFile">
          <input name="letter" type="file" class="form-control" id="letter" value="">
          <span class="input-group-addon"> <a href="javascript:uploadFile('letter');"><i class="fa fa-cloud-upload"></i></a> </span> </div>
        <br>
        <progress id="progressBar10" value="0" max="100" style="width:100%;"></progress>
        <br>
        <span id="loaded_n_total10"></span><br>
        <span id="status10"></span> </div>
    </div>
    <div class="row"></div>
	<? 
	$queryproviders = "select id, code, name from providers where id = '$row[provider]'";
    $resultproviders = mysqli_query( $con, $queryproviders );
    $rowproviders = mysqli_fetch_array($resultproviders);
	
	$queryroutes = "select code, code2, name from units order by code";
    $resultroutes = mysqli_query($con, $queryroutes);
    $rowroutes = mysqli_fetch_array($resultroutes);
	
	  ?>

  </div>
  <? } ?>