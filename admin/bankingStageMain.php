<? 

include('session-bankingDebt.php');   

$queryMainBalance = "select balance from bankingDebtBalance where bankingDebt = '$id' order by id desc limit 1";
$resultMainBalance = mysqli_query($con, $queryMainBalance);
$rowMainBalance = mysqli_fetch_array($resultMainBalance);

if ( $row[ 'type' ] == 1 ) {
  $thisType = 'Linea de crédito revolvente';
}
if ( $row[ 'type' ] == 2 ) {
  $thisType = 'Linea de crédito largo plazo';
}
if ( $row[ 'type' ] == 3 ) {
  $thisType = 'Carta de crédito';
}

?>
<div class="row">
	
													<div class="col-md-3">

													  <div class="form-group">

												<label class="control-label">ID desembolso:</label>
										
											  <input name="bdId" type="text" class="form-control" id="bdId" value="<?php if($row['id'] > 0 ) echo $row['id']; else echo 'Auto'; ?>" readonly>  
								
															
													  </div>

													</div> 
	
  <? #Numero de prestamo ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Tipo:</label>
      <input name="bdType" type="text" class="form-control" id="bdType" value="<? echo $thisType; ?>" onkeypress="return justNumbers(event);" readonly>
      
      <!--/row--></div>
  </div>
    
    <? #Contrato 
    $queryContracts = "select * from bankingDebtContracts where id = '$row[contract]'";
    $resultContracts = mysqli_query($con, $queryContracts);
    $rowContracts = mysqli_fetch_array($resultContracts);
    ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Contrato:</label>
      <input name="contract" type="text" class="form-control" id="contract" value="<? echo $rowContracts['title']; ?>" readonly>
      
      <!--/row--></div>
  </div>
    
    
  <div class="row"></div>
  <? #Compañia ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Compañía:</label> 
      <?

      $querycompanys = "select * from companies where id = '$row[company]'";
      $resultcompanys = mysqli_query( $con, $querycompanys );
      $rowcompanys = mysqli_fetch_array( $resultcompanys );
      ?>
      <input type="text" class="form-control" value="<? echo $rowcompanys['name'];  ?>" readonly>
    </div>
  </div>
  <? #Banco ?>
  <div class="col-md-3">
    <div class="form-group">
      <label class="control-label">Banco:</label>
      <?
      $queryfbanks = "select * from banks where id = '$row[bank]'";
      $resultfbanks = mysqli_query( $con, $queryfbanks );
      $rowfbanks = mysqli_fetch_array( $resultfbanks );
      ?>
      <input type="text" class="form-control" value="<? echo $rowfbanks['name'];  ?>" readonly>
    </div>
  </div>
  <? #Numero de prestamo ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>No. Desembolso:</label>
      <input name="bdNumber" type="text" class="form-control" id="bdNumber" value="<? echo $row['number']; #$row['contract']; ?>" readonly>
      </div>
  </div>
  <? #Fecha de apertura ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Fecha apertura:</label>
      <input name="bdDate1" type="text" class="form-control " id="bdDate1" value="<? echo date("d-m-Y", strtotime($row['date1'])); ?>" readonly>
    </div>
  </div>
	<div class="row"></div>
  <? #Fecha proxima de pago ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Fecha pago/cancelación:</label>
      <input name="bdDate2" type="text" class="form-control " id="bdDate2" value="<? echo date("d-m-Y", strtotime($row['date2'])); ?>" readonly>
    </div>
  </div>

	  <? #Moneda ?>
  <div class="col-md-3">
    <div class="form-group">
      <label class="control-label">Moneda:</label>
      <?
      if ( $row[ 'currency' ] == 1 ) {
        $thisCurrency = 'Córdobas';
		  $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
		  $pre = 'U$';
      }


      ?>
      <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $thisCurrency; ?>" onkeypress="return justNumbers(event);" readonly>
    </div>
  </div>
	
  <? #Monto ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Monto:</label>
      <input name="bdAmount" typse="text" class="form-control" id="bdAmount" value="<? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?>" onkeypress="return justNumbers(event);" readonly>
      
      <!--/row--></div>
  </div>

	<? #Balance ?>
  <div class="col-md-3 ">
    <div class="form-group">
      <label>Balance:</label>
      <input name="bdBalance" typse="text" class="form-control" id="bdBalance" value="<? echo $pre.str_replace('.00','',number_format($rowMainBalance['balance'],2)); ?>" readonly>
      
      <!--/row--></div>
  </div>
	
	<? if($row['type'] == 3){ 
	
	$queryproviders = "select id, code, name from providers where id = '$row[provider]' order by name";
	$resultproviders = mysqli_query($con, $queryproviders);
	$rowproviders = mysqli_fetch_array($resultproviders);
																		  
	$queryroutes = "select code, code2, name from units where (code = '$row[unit]' or code2 = '$row[unit]')order by code";
	$resultroutes = mysqli_query($con, $queryroutes);
	$rowroutes = mysqli_fetch_array($resultroutes); 
	
	?>
	<div class="row"></div>
	<? #Proveedor ?> 
    <div class="col-md-3">
      <div class="form-group">
        <label class="control-label">Proveedor:</label>
        <input type="text" id="provider" name="provider" class="form-control" value="<? echo $rowproviders['name']; ?>" readonly>
      </div>
    </div>
    <? #Unidad de negocio?>
    <div class="col-md-3">
      <div class="form-group">
        <label class="control-label">Unidad de negocio:</label>
        <input type="text" id="provider" name="provider" class="form-control" value="<? echo $rowroutes['name']; ?>" readonly>
      </div>
    </div>
<? } ?>
</div>
