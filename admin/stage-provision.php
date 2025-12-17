<? 
require_once('sessions.php');

$fvisor = isset($_GET['visor']) ? intval($_GET['visor']) : 0;
if($fvisor == 1){
	$gvisor = 1;
}
if(!isset($gvisor)){
	$gvisor = 0;
}


if($row['hall'] > 0){ 
?>
 <h3 class="form-section"><a id="provision"></a>Alcaldía</h3>
 <div class="row">
<div class="col-md-12"> <div class="form-group">
<?php 
	
	
$queryHall = $con->prepare("select name from halls where id = ?");
$queryHall->bind_param("i", $row['hall']);
$queryHall->execute();
$resultHall = $queryHall->get_result();
$rowhall = $resultHall->fetch_assoc();

echo $rowhall['name']; 

?>
</div></div>
</div>
<?php } ?>

<h4 class="block" style="font-weight:400;">Tipo de pago:</h4>
<div class="row">
<div class="col-md-12"> <div class="form-group">
									
										<div class="radio-list">
										<label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2"><input name="ptype" type="radio" disabled="disabled" id="optionsRadios4" value="1" <?php if($row['ptype'] == 1) echo 'checked="checked"'; ?>></span></div> 
										 Transferencia electrónica</label>
											<label class="radio-inline">
											<div class="radio1" ><span><input name="ptype" type="radio" disabled="disabled" id="optionsRadios5" value="2" <?php if($row['ptype'] == 2) echo 'checked="checked"'; ?>></span></div> 
											Cheque </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input name="ptype" type="radio" disabled="disabled" id="optionsRadios5" value="3" <?php if($row['ptype'] == 3) echo 'checked="checked"'; ?>></span></div> 
											Tarjeta de crédito </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input name="ptype" type="radio" disabled="disabled" id="optionsRadios5" value="4" <?php if($row['ptype'] == 4) echo 'checked="checked"'; ?>></span></div> 
											Telepagos </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input name="ptype" type="radio" disabled="disabled" id="optionsRadios5" value="5" <?php if($row['ptype'] == 5) echo 'checked="checked"'; ?>></span></div> 
											Internet  </label>                                            
											
										</div>
									</div> </div> </div>  



<? 


$queryBatch = $con->prepare("select * from batch where payment = ? and cic = '0'");
$queryBatch->bind_param("i", $row['id']);
$queryBatch->execute();
$resultBatch = $queryBatch->get_result();
$numBatch = $resultBatch->num_rows;


$queryBatch2 = $con->prepare("select * from batch where payment = ? and cic = '1'");
$queryBatch2->bind_param("i", $row['id']);
$queryBatch2->execute();
$resultBatch2 = $queryBatch2->get_result();
$numBatch2 = $resultBatch2->num_rows;


if(($numBatch > 0) or ($numBatch2 > 0)){

?>
<h4 class="block" style="font-weight:400;">Batch y documentos: </h4>                                          
											  
<?php  

}


if(($numBatch > 0)){
if(($gvisor == 1)){
	//do nothing
}
else{ 
?>

<div class="row">
<div class="col-md-2 ">
<div class="form-group">
<label>No. Batch:</label>
</div>
</div>                                    
<div class="col-md-2 ">
<div class="form-group">
<label>No. Documento:</label>
</div>
</div>
<div class="col-md-8 ">
<div class="form-group">
<label>Link del Documento:</label>
</div>
</div>
</div>

<?php }

while($rowBatch=$resultBatch->fetch_assoc()){
	
	$fileArrBatch  = explode('=',$rowBatch['linkdocument']);

	if(($gvisor == 1)){ ?>
	<p>No. Batch: <?php echo $rowBatch['nobatch']; ?><br>
	No. Documento: <?php echo $rowBatch['nodocument']; ?>
	</p><br>
	<div class="row">

	<div style="text-align:center;">
	
	<object data="efile.php?key=<? echo $fileArrBatch[1]; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>
    <? /*<object data="<?php echo $thefile; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>
    <iframe src="<?php echo $thefile; ?>" style="width:95%; height:700px; border: 10px solid #21355d;" frameborder="0"></iframe>*/ ?>
	<br>
	<br>
	</div>
<?php

if($filename == 'file-review-detail-check.php'){

}
?>

</div>
<?php }else{ 
$styleStr = "";
#if($row['cic'] == 1){ $styleStr = 'style="color:red;"'; } 
if($rowBatch['justfile'] == 0){
?>
 
<div class="row">
<div class="col-md-2 ">
<div class="form-group">
<input name="nobatch007[]" type="text" class="form-control" id="nobatch007[]" placeholder="" value="<?php echo $rowBatch['nobatch']; ?>" <? echo $styleStr; ?> readonly>
</div>
</div>
<div class="col-md-2 ">
<div class="form-group">
<input name="nodocument007[]" type="text" class="form-control" id="nodocument007[]" placeholder="" value="<?php echo $rowBatch['nodocument']; ?>" <? echo $styleStr; ?> readonly>
</div>
</div><div class="col-md-8 ">
<div class="form-group">
<input name="linkdocument007[]" type="text" class="form-control" id="linkdocument007[]" placeholder="" value="https://getpaycp.com/admin/visor.php?key=<? echo $fileArrBatch[1]; ?>" <? echo $styleStr; ?> readonly><a href="<?php 
echo "visor.php?key=$fileArrBatch[1]";
?>" class="btn blue" target="new">
<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
</div>
</div>
</div>
<? }else{ ?>
<div class="row">
<div class="col-md-12 ">
<div class="form-group">
<input name="linkdocument007[]" type="text" class="form-control" id="linkdocument007[]" placeholder="" value="https://getpaycp.com/admin/visor.php?key=<? echo $fileArrBatch[1]; ?>" <? echo $styleStr; ?> readonly><a href="<?php 
echo "visor.php?key=$fileArrBatch[1]";
?>" class="btn blue" target="new">
<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
</div>
</div>
</div>
<? } ?>
<?php } ?>
<?php }  

}



if(($numBatch2 > 0)){
?>
<h4 class="block" style="font-weight:400;">Batch y documentos CIC: [E1]</h4>  
<div class="row">
<div class="col-md-3 ">
<div class="form-group">
<label>No. Batch:</label>
</div>
</div>                                    
<div class="col-md-3 ">
<div class="form-group">
<label>No. Documento:</label>
</div>
</div>
<div class="col-md-6 ">
<div class="form-group">
<label>Link del Documento:</label>
</div>
</div>
</div>
<?
while($rowBatch2=mysqli_fetch_array($resultBatch2)){	
	$fileArrBatch2  = explode('=',$rowBatch2['linkdocument']);
?>
<div class="row">
<div class="col-md-3 ">
<div class="form-group">
<input name="nobatch007[]" type="text" class="form-control" id="nobatch007[]" placeholder="" value="<?php echo $rowBatch2['nobatch']; ?>" <? echo $styleStr; ?> readonly>
</div>
</div>
<div class="col-md-3 ">
<div class="form-group">
<input name="nodocument007[]" type="text" class="form-control" id="nodocument007[]" placeholder="" value="<?php echo $rowBatch2['nodocument']; ?>" <? echo $styleStr; ?> readonly>
</div>
</div><div class="col-md-6 ">
<div class="form-group">
<input name="linkdocument007[]" type="text" class="form-control" id="linkdocument007[]" placeholder="" value="<?php echo "https://getpaycp.com/admin/visor.php?key=$fileArrBatch2[1]";  ?>" <? echo $styleStr; ?> readonly><a href="<?php 
echo "visor.php?key=$fileArrBatch2[1]";
?>" class="btn blue" target="new"> 
<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
</div>
</div>
</div>

<? } 

}

$queryProvision = $con->prepare("select * from tProvision where payment = ?");
$queryProvision->bind_param("i", $row['id']);
$queryProvision->execute();
$resultProvision = $queryProvision->get_result();
$numProvision = $resultProvision->num_rows;

$billCurrency = '';
if($row['currency'] == 1){
	$billCurrency = 'COR';
}elseif($row['currncy'] == 2){
	$billCurrency = 'USD';
}

if($numProvision > 0){ ?>
<h4 class="block" style="font-weight:400;">Provisión getPay:</h4>   	

<? while($rowProvision=$resultProvision->fetch_assoc()){ ?>

<div class="row"><br></div>
<div class="col-md-2">
<div class="form-group">
<label>No. Factura:</label>
	<input name="pVisorBillNumber[]" type="text" class="form-control" id="pVisorBillNumber[]" placeholder="" value="<? echo $rowProvision['bill']; ?>" readonly>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label>Compañía:</label>
	<input name="pVisorCompany[]" type="text" class="form-control" id="pVisorCompany[]" placeholder="" value="<? echo $rowProvision['company']; ?>">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Fecha Libro Mayor:</label>
	<input name="pVisorLMDate[]" type="text" class="form-control date-picker" id="pVisorLMDate[]" placeholder="" value="<? echo $rowProvision['todayLM'] ?>" readonly>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label>Moneda:</label>
	<input name="pVisorCurrency[]" type="text" class="form-control" id="pVisorCurrency[]" placeholder="" value="<? echo $billCurrency; ?>" readonly>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label>TC:</label>
	<input name="pVisorBillTc[]" type="text" class="form-control" id="pVisorBillTc[]" placeholder="" value="<? echo $rowProvision['']; ?>" readonly>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Monto a pagar:</label>
	<input name="pVisorBillPaymentLabel[]" type="text" class="form-control" id="pVisorBillPaymentLabel[]" placeholder="" value="<? echo number_format($rowProvision['amount']); ?>" readonly>
	
</div>
</div>	
		
		<div class="row"><br></div>
		
		<div class="col-md-4">
		<div class="form-group">
		<label>Cuenta contable:</label>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
		<label>Auxiliar:</label>
		</div>
		</div>
		<div class="col-md-1">
		<div class="form-group">
		<label>Tipo:</label>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
		<label>Importe:</label>
		</div>
		</div>
		<div class="col-md-3">
		<label>REF:</label><br>
		</div>
		<div class="row"></div>

		<? 
		$queryProvisionContent = "select * from tProvisionContent where provision = '$rowProvision[id]'";
		$resultProvisionContent = mysqli_query($con, $queryProvisionContent);
		while($rowProvisionContent=mysqli_fetch_array($resultProvisionContent)){
		?>
		<div class="col-md-4">
		<div class="form-group">
		<input name="pVisorAccount[]" type="text" class="form-control" id="pAVisorccount[]" placeholder="" value="<? echo $rowProvisionContent['account']; ?>" readonly>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
		<input name="VisorpAux[]" type="text" class="form-control" id="pVisorAux[]" placeholder="" value="<? echo $rowProvisionContent['aux']; ?>" readonly>
		</div>
		</div>
		<div class="col-md-1">
		<div class="form-group">
		<input name="pVisorAuxType[]" type="text" class="form-control" id="pVisorAuxType[]" placeholder="" value="<? echo $rowProvisionContent['auxType']; ?>" readonly>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
		<input name="pVisorAmountLabel[]" type="text" class="form-control" id="pVisorAmountLabel[]" placeholder="" value="<? echo $rowProvisionContent['amount']; ?>" readonly>
		</div>
		</div>
		<div class="col-md-3">
		<div class="form-group">
		<input name="pVisorLabel[]" type="text" class="form-control" id="pVisorLabel[]" placeholder="" value="<? echo $rowProvisionContent['ref']; ?>" readonly>
		</div>
		</div>
		<div class="row"></div>
		<? } ?>

<? } ?>
	
<? }

if(($numBatch > 0) or ($numBatch2 > 0)){
 
  if(isset($checker)){
  if(($checker == 1)){ 
 
 ?>
 
<div style="text-align:right; margin-right:30px;">
<input name="aprovision" type="checkbox" id="aprovision" value="1" <?php if($rowreview['aprovision'] == 1) echo 'checked'; ?>> Archivos de provisión
</div>
<?php } } } ?>

<?php 

$queryprovider2 = "select * from providers where id = '$row[provider]'";
$resultproviders2 = mysqli_query($con, $queryprovider2);
$rowproviders2 = mysqli_fetch_array($resultproviders2);

if($rowproviders2['international'] == 1){
?>
<div class="row"></div>
<h3 class="form-section">Proveedores Internacionales</h3>
<div class="col-md-6 ">
<div class="form-group">
<label>No. de Solicitud:</label>
<input name="internationalno" type="text" class="form-control" id="internationalno" placeholder="" value="<?php echo $row['internationalno']; ?>" readonly> 
</div></div>
<div class="col-md-6 ">
<div class="form-group">
<label>Link:</label>
<input name="internationallink" type="text" class="form-control" id="internationallink" placeholder="" value="<?php echo $row['internationallink']; ?>" readonly><br><br>
</div></div>
<?php } ?>
<? if($row['pdescription'] != ""){ ?>
<div class="row"></div>
<div class="row"><div class="col-md-12 ">
<div class="form-group">
<label>Notas del Provisionador:</label> 
<input name="pdescription" type="text" class="form-control" id="pdescription" placeholder="" value="<?php echo $row['pdescription']; ?>" readonly> 
</div> 
</div></div>
<?php } ?>  


<? if($row['releasingnotes'] != ""){ ?>
<div class="row"></div>
<h3 class="form-section">Liberación</h3>
<div class="row"><div class="col-md-12 ">
<div class="form-group">
<label>Notas del Liberador:</label> 
<input name="releasingnotes" type="text" class="form-control" id="ireleasingnotes" placeholder="" value="<?php echo $row['releasingnotes']; ?>" readonly> 
</div>
</div></div>
<?php } ?>        