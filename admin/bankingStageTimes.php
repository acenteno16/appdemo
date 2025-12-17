<? 

include('session-bankingDebt.php');

?>

<div class="row"></div>
<h3  class="form-section">Tiempos</h3> 

<?

#$queryTransactionHistory = "select bankingDebtBalance.*, bankingDebtTransactions.type as ttype, bankingDebtTransactions.amortization, bankingDebtTransactions.bankingmovement, bankingDebtTransactions.reference, bankingDebtTransactions.void, bankingDebtTransactions.reason, bankingDebtTransactions.bill, bankingDebtTransactions.promissory from bankingDebtBalance inner join bankingDebtTransactions on bankingDebtBalance.transaction = bankingDebtTransactions.id where bankingDebtBalance.bankingDebt = '$row[id]'";
$queryTransactionHistory = "select bankingDebtTimes.* from bankingDebtTimes where bankingDebt = '$row[id]'";
$resultTransactionHistory = mysqli_query( $con, $queryTransactionHistory );
echo 'NUM: '.$numTransactionHistory  = mysqli_num_rows($resultTransactionHistory);

if($_GET['echo'] == 1){
	echo '<br>Query: '.$queryTransactionHistory;
	echo '<br>Num: '.$numTransactionHistory;
}
if($numTransactionHistory > 0){
	
	
?>
<table class="table table-striped table-bordered table-hover" id="datatable_orders" style=" width: 100%">
<thead>
<tr role="row" class="heading">
	<th>TID</th>
	<th>Fecha</th>
	<th>Hora</th>
	<th>usuario</th>
	<th>Tipo</th>
	<th>Interés</th>
	<th>Principal</th>
	<th>Balance</th>
	<th>Opciones</th>
</tr>
</thead>	
<? while($rowTransactionHistory = mysqli_fetch_array($resultTransactionHistory)){ 
	
	switch($rowTransactionHistory['ttype']){
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
		  case 6:
		  $ttype ='Regresado a documentacion';
		  break;
		  case 7:
		  $ttype ='Regresado a contabilizacion';
		  break;
  } 
	
	?>	
	<tr <? if($rowTransactionHistory['void'] == 1){ echo 'class="danger"'; } ?>> 
		<td><? echo $rowTransactionHistory['id']; ?></td>
		<td><? echo date("d-m-Y", strtotime($rowTransactionHistory['today'])); ?></td>
		<td><? echo date('h:i:s a', strtotime($rowTransactionHistory['totime'])); ?></td>
		<td><?php 
                                
                                if($rowTransactionHistory['userid'] == 'GETPAY'){
                                    echo "Sistema Getpay";
                                }else{
                                    $queryuser = "select * from workers where code = '$rowTransactionHistory[userid]'";
								    $resultuser = mysqli_query($con, $queryuser);
								    $rowuser = mysqli_fetch_array($resultuser);
								
								    echo  $theuser = '<a href="mailto:'.$rowuser['email'].'">'.$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']."</a>";    
                                }                  
                                 ?></td>
		<td><? echo $ttype; ?></td>
		<td><? echo $pre.str_replace('.00','',number_format($rowTransactionHistory['interest'],2)); ?></td>
		<td><? echo $pre.str_replace('.00','',number_format($rowTransactionHistory['amount'],2)); ?></td>
		<td><? echo $pre.str_replace('.00','',number_format($rowTransactionHistory['balance'],2)); ?></td>
		<td><a href="javascript:showMore(<? echo $rowTransactionHistory['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-angle-down"></i> Ver Transacción</a></td>
		
									<script>
									function showMore(id){
										$("#detail"+id).slideToggle();
									}
									</script>
	</tr>
	<tr id="detail<? echo $rowTransactionHistory['id']; ?>" style="display: none;">
		<td colspan="9">
		
	<? 
		$stInfo = 0;
		if($rowTransactionHistory['amortization'] != '') $stInfo++;
		if($rowTransactionHistory['bankingmovement'] != '') $stInfo++;
		if($rowTransactionHistory['reference'] != '') $stInfo++;
			
	if($stInfo > 0){		
			?>		
			
	<div class="row">
	<? #Tabla de amortizacion ?>
  	<div class="col-md-3 ">
    <div class="form-group">
      <label>Tabla de amortizacion:</label>
      <div class="input-group" id="amortizationText">
        <input type="text" id="amortizationUrlHistory" name="amortizationUrlHistory" class="form-control" value="<? echo $rowTransactionHistory['amortization']; ?>" readonly>
        <span class="input-group-addon"> <a href="<? echo $rowTransactionHistory['amortization']; ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
    </div>
  </div>
  	<? #Movimiento bancario ?>
  	<div class="col-md-3 ">
    <div class="form-group">
      <label>Movimiento Bancario:</label>
      <div class="input-group" id="amortizationText">
        <input type="text" id="amortizationUrlHistory" name="amortizationUrlHistory" class="form-control" value="<? echo $rowTransactionHistory['bankingmovement']; ?>" readonly>
        <span class="input-group-addon"> <a href="<? echo $rowTransactionHistory['bankingmovement']; ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
    </div>
  </div>
  	<? #Referencia ?>
  	<div class="col-md-3 ">
    <div class="form-group">
      <label>Referencia:</label>
      <input type="text" id="amortizationUrlHistory" name="amortizationUrlHistory" class="form-control" value="<? echo $rowTransactionHistory['reference']; ?>" readonly>
    </div>
  </div>
  <? /*#Factura ?>
   <div class="col-md-3">
      <div class="form-group">
        <label>Factura:</label>
        <div class="input-group">
          <input type="text" id="bdSwift1Url" name="bdSwift1Url" class="form-control" value="<? echo $rowTransactionHistory['bill']; ?>" readonly>
          <span class="input-group-addon"> <a href="<? echo $rowTransactionHistory['bill']; ?>" target="_blank"><i class="fa fa-search"></i></a> </span> 
		</div>
        </div>
    </div> */ ?>
  <? #Pagaré 
        
    if($rowTransactionHistory['promissory'] != ''){    ?>
   <div class="col-md-3">
      <div class="form-group">
        <label>Pagaré:</label>
        <div class="input-group">
          <input type="text" id="bdPromissory" name="bdPromissory" class="form-control" value="<? echo $rowTransactionHistory['promissory']; ?>" readonly>
          <span class="input-group-addon"> <a href="<? echo $rowTransactionHistory['promissory']; ?>" target="_blank"><i class="fa fa-search"></i></a></span> 
		</div>
        </div>
    </div>
    <? } ?>    
	</div>
            
    <div class="row"></div> 
            <? 
            $queryBills = "select * from bankingDebtBills where bankingDebt = '$id' and transaction = '$rowTransactionHistory[id]'";
		    $resultBills = mysqli_query($con, $queryBills);
		    $numBills = mysqli_num_rows($resultBills);
            if($numBills > 0){
            ?>
            <h3>Factura(s):</h3>
            <div class="row">
            <? 
        
           
            while($rowBills=mysqli_fetch_array($resultBills)){ ?>
            <div class="col-md-3 ">
              <div class="form-group">
                <div class="input-group" id="nofileText">
                  <input type="text" id="billUrl" name="billUrl[]" class="form-control" value="<? echo $rowBills['url'];  ?>" readonly>
                  <span class="input-group-addon"> <a href="<? echo $rowBills['url'];  ?>" target="_blank"><i class="fa fa-search"></i></a> </span> 
                </div>
              </div>
            </div>
            <? } ?>
            </div>    
            
            <? } ?>
            
            
	<?
	
	}else{
		echo "<strong>Comentarios:</strong> $rowTransactionHistory[reason]";
	}
		$queryRecords = "select * from bankingDebtRecords where bankingDebt = '$id' and transaction = '$rowTransactionHistory[id]'";
		$resultRecords = mysqli_query($con, $queryRecords);
		$numRecords = mysqli_num_rows($resultRecords);
		if($numRecords > 0){ 
		?>
		<div class="row"></div>
		<h4>Contabilización</h4>
		<? ?>
		
		<div class="row">
<div class="col-md-3 ">
  <div class="form-group">
    <label>Batch</label>
  </div>
</div>
<div class="col-md-3 ">
  <div class="form-group">
    <label>Documento(s):</label>
  </div>
</div>
<div class="col-md-4 ">
  <div class="form-group">
    <label>Archivo:</label>
  </div>
</div>	
<?	
while($rowRecords=mysqli_fetch_array($resultRecords)){
?>
	
<div class="col-md-3 ">
  <div class="form-group">
    <input name="nobatch[]" type="text" class="form-control" id="batch[]" value="<? echo $rowRecords['batch']; ?>" readonly>
  </div>
</div>
<div class="col-md-3 ">
  <div class="form-group">
    <input name="nodocument[]" type="text" class="form-control" id="document[]" value="<? echo $rowRecords['document']; ?>" readonly>
  </div>
</div>
<div class="col-md-3 ">
  <div class="form-group">
    <div class="input-group" id="nofileText">
      <input type="text" id="nofileUrl" name="nofileUrl[]" class="form-control" value="<? echo $rowRecords['url'];  ?>" readonly>
      <span class="input-group-addon"> <a href="<? echo $rowRecords['url'];  ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
  </div>
</div>
<div class="row"></div>
<? } ?>
</div>
		<? } ?>
		</td></tr>
	
<? } ?>
</table>
<? } ?>