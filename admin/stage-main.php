<?
if($_SESSION['email'] == 'jairovargasg@gmail.com'){
	#error_reporting(E_ALL);
	#ini_set('display_errors', TRUE);
	#ini_set('display_startup_errors', TRUE);
}

include_once("functions.php");  


$fvisor = isset($_GET['visor']) ? intval($_GET['visor']) : 0;
if($fvisor == 1){
	$gvisor = 1;
}
if(!isset($gvisor)){
	$gvisor = 0;
}



$minimalView = 0;

if($row['hc'] > 0){
	$minimalView = 1;
	$queryHC = "select * from hc where payment = '$row[id]'";
	$resultHC = mysqli_query($con, $queryHC);
	$rowHC = mysqli_fetch_array($resultHC);
}

$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
if(!isset($gvisor)){ $gvisor = 0; }
if($_SESSION['email'] == "jairovargasg@gmail.com1"){ $gvisor = 1; }

?>
<style>
hr{
	border: 1px solid #21355d;d
  	width: 100%;
}
.form-control[disabled]{
	color: #000000;
}
</style>	
<div class="form-body">																						
<?
	
if(($row['parent'] > 0) or ($row['child'] > 0)){ 
	
if($row['hc'] > 0){ 
	
?>
<div class="row">
<div class="col-md-2 ">
<div class="form-group">
<label>Monto General: </label>
<p>
<input type="text" class="form-control" value="<? echo sanitizedOutput($rowcurrency_pre['symbol']).number_format($row['globalpayment'],2); ?>" disabled>
</p>
<!--/row--></div>
</div>
<div class="col-md-2 ">
<div class="form-group">
<label>&nbsp; </label>
<p>
<input type="text" class="form-control" value="<?php echo sanitizedOutput($rowcurrency['name']); ?>" disabled>
</p>
<!--/row--></div>
</div>
<div class="col-md-12 ">
<div class="form-group">
<label>Descripción General:</label>
<p>
<textarea name="description2" rows="2" readonly class="form-control" id="description"><?php echo sanitizedOutput($row['zdescription']); ?></textarea>
</p>
<!--/row--></div>
</div>
<div class="col-md-12 table-container">
<div class="table-scrollable" id="templatewaiter" name="templatewaiter">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

	<thead>

	<tr role="row" class="heading">
   
    <th width="2%">IDS+</th>
    <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	if(($page_name == 'provision-view-cascade.php') or ($page_name == 'releasing-view.php') or ($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'provision-global-view-cascade.php')){ ?>
    <th width="20%">Batch</th>
    <th width="20%">Documento</th>
    <? } ?>
    <th width="34%">Proveedor</th>
	<th width="34%">Colaborador</th>
    <th width="50%">Monto<span style="color: #EEEEEE;">------------------</span></th>
	
	</tr>

	</thead>

	<tbody>

<?php 
	
	if($row['child'] > 0){
		$query_parentchilds = "select * from payments where approved != '9' and (id = '$row[child]' or child = '$row[child]') order by id asc";
		
	}						
	else{
		$query_parentchilds = "select * from payments where approved != '9' and (id = '$row[id]' or child = '$row[id]') order by id asc";
		
	}	
	$result_parentchilds = mysqli_query($con, $query_parentchilds);
	$parentchilds_approved = "";
	while($row_parentchilds=mysqli_fetch_array($result_parentchilds)){
	
		$parentchilds_approved = "";
		if($row_parentchilds['approved'] == 2){
			$parentchilds_approved = " <div class='btn red'>Rechazado</div>"; 
		}
	
		//Proveedor
		$row_benprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row_parentchilds[provider]'"));
		$benNameProvider = $row_benprovider['code'].' | '.$row_benprovider['name'];	
		
		//Collaborator
		$row_bencollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row_parentchilds[collaborator]'"));
		$ben_name = $row_bencollaborator['code'].' | '.$row_bencollaborator['first'].' '.$row_bencollaborator['last'];	
	
	//Currency
	$querycurrency = "select * from currency where id = '$row_parentchilds[currency]'"; 
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency =mysqli_fetch_array($resultcurrency);
	$ben_currency = $rowcurrency['pre'].' '.$rowcurrency['symbol'];
	
	//Amount
	$ben_ammount = $row_parentchilds['payment'];
	
	$class_parentchild = "";
	if($row['id'] == $row_parentchilds['id']){
		$class_parentchild = "success";
	}
?>							

	<tr role="row" class="odd <? echo $class_parentchild; ?>">
                                
    <td class="sorting_1"><?
        $child_str = "";
        if($row_parentchilds['parent'] > 0){
            $child_str = "+";
        }
	echo '<a href="payment-order-view.php?id='.$row_parentchilds['id'].'">'.$row_parentchilds['id'].$child_str.'</a> <input type="hidden" name="tableid[]" id="tableid[]" value="'.$row_parentchilds['id'].'">';
	?></td> 
   <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	if(($page_name == 'provision-view-cascade.php') or ($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'releasing-view.php') or ($page_name == 'provision-global-view-cascade.php')){ 
	
	
	$querybatch = "select * from batch where payment = '$row_parentchilds[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	$thedocument = "";
	while($rowbatch = mysqli_fetch_array($resultbatch)){
	 $thebatch = $rowbatch['nobatch'];
	 $thedocument.= $rowbatch['nodocument'].',';
	}
	
	$thedocument = substr($thedocument,0,-1)
	?>
	<td><input type="text" name="batch[]" id="batch[]" <? if($page_name == 'releasing-view.php'){ 
	 
	echo 'value="'.$thebatch.'"';
	echo ' disabled';
	} ?>></td>
	<td><input type="text" name="document[]" id="document[]" <? if($page_name == 'releasing-view.php'){ 
	 
	echo 'value="'.$thedocument.'"';
	echo ' disabled';
	} ?>></td>
    
		
		
		
	<? } ?>	
	<td><? echo sanitizedOutput($benNameProvider); ?></td>	
    <td><? echo sanitizedOutput($ben_name.$parentchilds_approved); ?></td>
    <td><? echo sanitizedOutput($ben_currency.number_format($ben_ammount,2)); ?></td>
    
    </tr>
                                                            
<?php 

} ?>  
                                
	</tbody> 

	</table>
											</div>
											</div>
											</div> 
<?	
}else{	

if($row['btype'] == 2){ 

	//Currency
	$querycurrency_pre = "select * from currency where id = '$row[currency]'"; 
	$resultcurrency_pre = mysqli_query($con, $querycurrency_pre); 
	$rowcurrency_pre =mysqli_fetch_array($resultcurrency_pre);
	
?>

<h3 class="form-section">Información de Pago Multiple</h3>
											
<div class="row">
<div class="col-md-2 ">
<div class="form-group">
<label>Monto General: </label>
<p>
<input type="text" class="form-control" value="<? echo $rowcurrency_pre['symbol'].number_format($row['globalpayment'],2); ?>" disabled>
</p>
<!--/row--></div>
</div>
<div class="col-md-2 ">
<div class="form-group">
<label>&nbsp; </label>
<p>
<input type="text" class="form-control" value="<? echo $rowcurrency['name']; ?>" disabled>
</p>
<!--/row--></div>
</div>
<div class="col-md-12 ">
<div class="form-group">
<label>Descripción General:</label>
<p>
<textarea name="description2" rows="2" readonly class="form-control" id="description"><?php echo $row['zdescription']; ?></textarea>
</p>
<!--/row--></div>
</div>
<div class="col-md-12 table-container">
<div class="table-scrollable" id="templatewaiter" name="templatewaiter">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

	<thead>

	<tr role="row" class="heading">
   
    <th width="2%">IDS+</th>
    <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	$showBatch = 0;
	if($page_name == 'payment-order-view.php') $showBatch++;
	if($row['status'] >= 8) $showBatch++;
	if(($page_name == 'provision-view-cascade.php') or ($page_name == 'releasing-view.php') or ($page_name == 'provision-view-covid-cascade.php') or ($showBatch > 1) or ($page_name == 'provision-global-view-cascade.php')){ ?>
    <th width="20%">Batch </th>
    <th width="20%">Documento(s)</th>
	<th width="20%">Link</th>
    <? } ?>
    <th width="68%">Colaborador</th>
    <th width="50%">Monto<?  echo '***'.$row['child'];  ?><span style="color: #EEEEEE;">------------------</span></th>
	</tr>
	</thead>
	<tbody>

<?php  
	if($row['child'] > 0){
		$query_parentchilds = "select * from payments where approved != '9' and (id = '$row[child]' or child = '$row[child]') order by id asc";
	}						
	else{
		$query_parentchilds = "select * from payments where approved != '9' and (id = '$row[id]' or child = '$row[id]') order by id asc";
	}	
	$result_parentchilds = mysqli_query($con, $query_parentchilds);
	$parentchilds_approved = "";
	while($row_parentchilds=mysqli_fetch_array($result_parentchilds)){
	
	$parentchilds_approved = "";
	if($row_parentchilds['approved'] == 2){
		$parentchilds_approved = " <div class='btn red'>Rechazado</div>"; 
	}
	
	//Collaborator
	$row_bencollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row_parentchilds[collaborator]'"));
	$ben_name = " <a href='javascript:copyThis($row_bencollaborator[code]);'><i class='fa fa-copy'></i></a> ".$row_bencollaborator['code'].' | '.$row_bencollaborator['first'].' '.$row_bencollaborator['last'];
	
	$ben_currency = $globalCurrencyPre[$row_parentchilds['currency']].' '.$globalCurrencySymbol[$row_parentchilds['currency']]; 
	
	//Amount
	$ben_ammount = $row_parentchilds['payment'];
	
	$class_parentchild = "";
	if($row['id'] == $row_parentchilds['id']){
		$class_parentchild = "success";
	}
?>							

	<tr role="row" class="odd <? echo $class_parentchild; ?>">
                                
    <td class="sorting_1"><?
        $child_str = "";
        if($row_parentchilds['parent'] > 0){
            $child_str = "+";
        }
	echo '<a href="payment-order-view.php?id='.$row_parentchilds['id'].'">'.$row_parentchilds['id'].$child_str.'</a> <input type="hidden" name="tableid[]" id="tableid[]" value="'.$row_parentchilds['id'].'">';
	?></td> 
   <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	if(($page_name == 'provision-view-cascade.php') or ($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'releasing-view.php') or ($page_name == 'provision-global-view-cascade.php') or ($showBatch > 1)){ 
	
	
	$querybatch = "select * from batch where payment = '$row_parentchilds[id]' and preturn = '$row[preturn]'";
	$resultbatch = mysqli_query($con, $querybatch);
	$thebatch = '';
	$thedocument = '';
	$theFiles = '';	
	while($rowbatch = mysqli_fetch_array($resultbatch)){
	
	 $rowbatch['id'].') '.$rowbatch['nobatch'].' === '.$rowbatch['nodocument'];
	 if($rowbatch['justfile'] == 0){	
		$thebatch.= $rowbatch['nobatch'];
	 	$thedocument.= $rowbatch['nodocument'].',';
	 }
	 $fileArrBatch  = explode('=',$rowbatch['linkdocument']);
	 $theFiles.= '<a href="visor.php?key='.$fileArrBatch[1].'" target="_blank" class="btn blue"><i class="fa fa-link"></i> Abrir</a>';	
		
	}
	
	$thedocument = substr($thedocument,0,-1)
	?>
	<td><input type="text" placeholder="***" name="batch[]" id="batch[]" <? if(($page_name == 'releasing-view.php') or ($showBatch > 1)){ 
	 
	echo 'value="'.$thebatch.'"';
	echo ' disabled';
	} ?> onkeypress="return justBatch(event);" class="form-control"></td>
	<td><input type="text" name="document[]" id="document[]" <? if(($page_name == 'releasing-view.php') or ($showBatch > 1)){ 
	 
	echo 'value="'.$thedocument.'"';
	echo ' disabled';
	} ?> onkeypress="return justDocuments(event);" placeholder="Multiples Ej: 88888,88888,88888" class="form-control"><br>
	</td>
	<td>
		<? if(($showBatch > 1) or ($page_name == 'releasing-view.php')){ echo $theFiles; }else{ ?>
		<select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit"; 
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
		<? } ?></td>	
    <? } ?>	
    <td><? echo $ben_name.$parentchilds_approved; ?></td>
    <td><? echo $ben_currency.number_format($ben_ammount,2); ?></td>
    </tr>
                                                            
<?php 

} ?>  
                                
	</tbody> 

	</table>
</div>
</div>
</div> 

<script>
	function copyThis(val) {
		// Copy the text inside the text field
  		navigator.clipboard.writeText(val);
	}
</script>	
<? }
elseif($row['btype'] == 3){
	
$query_parentchild = "select * from paymentstemplatesfiles where id = '$row[templateid]' order by id desc limit 1";
$result_parentchild = mysqli_query($con, $query_parentchild);
$row_parentchild = mysqli_fetch_array($result_parentchild);
	
$fileId = $row['id'];
if($row['child'] > 0){
	$fileId = $row['child'];
}	
$destino = "/home/paymentstemplates/$fileId/$fileId.xlsx";

if(!file_exists($destino)){ 
	$destino = "/home/paymentstemplates/$fileId/$fileId.xls";
}
	
if(file_exists($destino)){ 
	
	
	#require_once('classes/PHPExcel.php');
	#require_once('classes/PHPExcel/Reader/Excel2007.php');
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
	// Cargando la hoja de cálculo
    $objReader = new PHPExcel_Reader_Excel2007();
    $objPHPExcel = $objReader->load($destino);
    $objFecha = new PHPExcel_Shared_Date();
    // Asignar hoja de excel activa
    $objPHPExcel->setActiveSheetIndex(0);
	$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
	
	$filePath = $destino;
	
         


?>
											<h3 class="form-section">Información de Pago Multiple</h3>
											
											<div class="row">
											<div class="col-md-12 ">
												<div class="form-group">
													<label>Descripción General: </label>
                                                    <p><textarea name="description2" rows="2" readonly class="form-control" id="description"><?php echo $row['zdescription']; ?></textarea>
                                                    </p>
												</div>
											</div>
											<div class="col-md-12 table-container">
												<div class="table-scrollable" id="templatewaiter" name="templatewaiter">
												<table class="table table-striped table-bordered table-hover" id="datatable_orders">

													<thead>

		<tr role="row" class="heading">
   
    <th width="30%">IDS</th>
    <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	if(($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'provision-view-cascade.php') or ($page_name == 'provision-global-view-cascade.php') or ($row['status'] > 8) or ($page_name == "releasing-view.php")){ ?>
    <th width="30%">Batch</th>
    <th width="30%">Documento(s)</th>
	<th width="40%">Link<i style="color:#eeeeee;">--------------------------------------------------------------------------</i></th>
    <? } ?>
    <th width="30%">Código</th>
    <th width="13%">1er Apellido</th>
    <th width="13%">2do Apellido</th>
    <th width="13%">1er Nombre</th>
    <th width="13%">2do Nombre</th>
    <th width="30%">Empresa</th>
    <th width="25%">ID_Billetera</th>
    <th width="23%">Num_ID (cedula)</th>
    <th width="13%">Concepto</th>
    <th width="13%">Monto</th>
    <th width="13%">TIPO</th>
    <th width="13%">NUM_CTA_DEBITO</th>
    <th width="30%">UN</th> 
	
	</tr>

	</thead>

	<tbody>

<?php  
							
	

	
	for($i=2;$i<=$lastRow;$i++){ 
	
		$un = "";
	
		$code_parentchild = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
		$company_parentchild = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
		$phone_parentchild = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
		$nid_parentchild = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
		$first_parentchild = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
		$first2_parentchild = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
		$last_parentchild = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
		$last2_parentchild = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();	
		$concept_parentchild = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
		$ammount_parentchild = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
		$type_parentchild = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
		$account_parentchild = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue();
		$un = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue();
		
		$class_parentchild = "";
		
		$query_check_parentchild = "select id from interns where code = '$code_parentchild'";
		$result_check_parentchild = mysqli_query($con, $query_check_parentchild);
		$num_check_parentchild = mysqli_num_rows($result_check_parentchild);
		$row_check_parentchild = mysqli_fetch_array($result_check_parentchild);
		if($code_parentchild == $row['intern']){
			$class_parentchild = "success";
		}
		
		
		#if(($type_parentchild == 'C') or ($type_parentchild == 'c') or ($type_parentchild == 'D') or ($type_parentchild == 'd')){
		if(($type_parentchild == 'C') or ($type_parentchild == 'c')){				
		?>							

			<tr role="row" class="odd <? echo $class_parentchild; ?>">
                                
    		<td class="sorting_1"><? 
			if(($type_parentchild == "C") or ($type == "c")){ 
				
				$query_ids = "select id from payments where ((id = '$fileId') or (child = '$fileId')) and intern = '$code_parentchild'";
				$result_ids = mysqli_query($con, $query_ids);
				$num_ids = mysqli_num_rows($result_ids);
				$row_ids = mysqli_fetch_array($result_ids);
				$id_ids = $row_ids['id'];
				echo '<a href="?id='.$id_ids.'">'.$id_ids.'</a><input type="hidden" name="tableid[]" id="tableid[]" value="'.$id_ids.'">';
				
			} ?>
			</td>  	
    		<?
			if(($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'provision-global-view-cascade.php') or ($page_name == 'provision-view-cascade.php') or ($row['status'] > 8) or ($page_name == "releasing-view.php")){ 
			$batch_disabled = "";
		
		
			if(($row['status'] > 8)  or ($page_name == "releasing-view.php")){
				
				$querybatch = "select * from batch where payment = '$id_ids'";
				$resultbatch = mysqli_query($con, $querybatch);
				$thedocument = "";
				$theFiles = "";
				#$showBatch = 1;
				while($rowbatch = mysqli_fetch_array($resultbatch)){
	 				$thebatch = $rowbatch['nobatch'];
	 				$thedocument.= $rowbatch['nodocument'];
					$ldocuments = $rowbatch['linkdocument']; 
					$ldocuments = str_replace('http://getpay.casapellas.com.ni','', $ldocuments);
					$ldocuments = str_replace('/admin/','', $ldocuments);
					#$showBatch++;
			 
					$theFiles.= '<div class="input-group" id="amortizationText">
        			<input type="text" id="amortizationUrlHistory" name="amortizationUrlHistory" class="form-control" value="'.$ldocuments.'" readonly>
        			<span class="input-group-addon"> <a href="'.$ldocuments.'" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
					';
				}
			$thedocument = substr($thedocument,0,-1); 
			$batch_disabled = " disabled";
		}
	
	
	?>
	<td><? if(($type_parentchild == "C") or ($type == "c")){ ?><input class="form-control" style="width: 150px;"type="text" name="batch[]" id="batch[]" value="<? echo $thebatch; ?>" <? echo $batch_disabled; ?>><? } ?></td>
	<td><? if(($type_parentchild == "C") or ($type == "c")){ ?><input class="form-control" style="width: 150px;" type="text" name="document[]" id="document[]" value="<? echo $thedocument; ?>" <? echo $batch_disabled; ?>><? } ?></td> 
	<td>
		
		<? 
		if($theFiles != ''){ 
			echo $theFiles; 
		
		}else{ ?>
			<select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit 25"; 
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
		<? } ?></td>	
    <? } ?>
    <td><? echo $code_parentchild; ?></td>
    <td><? echo $last_parentchild; ?></td>
    <td><? echo $last2_parentchild; ?></td>
    <td><? echo $first_parentchild; ?></td>
    <td><? echo $first2_parentchild; ?></td>
    <td><? echo $company_parentchild; ?></td>
    <td><? echo $phone_parentchild; ?></td>
    <td><? echo $nid_parentchild; ?></td>
    <td><? echo $concept_parentchild; ?></td>
    <td><? echo str_replace('.00','',number_format($ammount_parentchild,2)); ?></td>
    <td><? echo $type_parentchild; ?></td>
    <td><? echo $account_parentchild; ?></td>
    <td><? echo $un; ?></td> 
    </tr>
                                                            
<?php 
$inc_ammount_parentchild+=$ammount_parentchild;
}
} ?>  
                                
	</tbody> 

	</table>
											</div>
											</div>
											</div>
											
											<? }
else{
	echo "Cargando... ".str_replace('paymentstemplates/', '', $destino);
} ?>

<? } 

if($row['child'] > 0){
	$parentid = $row['child']; 
}
else{
	$parentid = $id; 
}
	
	

?>
<div class="row">
	
<? 
if((($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'provision-global-view-cascade.php')) and (1 == 2)){ 
?>	
<div class="col-md-8"><label>Links adicionales:</label></div>
<div class="col-md-4">Opciones</div>
<div class="col-md-8 ">
												  <div class="form-group">
			    
			    										<? $queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit"; ?>	
                                                    <?php /*<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">*/ ?>
                                                    <select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 

$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
              </div>
												</div>
<div id="fileWaiter"></div>	
<div class="col-md-2"><a href="javascript:addFile();" class="btn blue">+</a></div>
 
	
<script type="text/javascript">
var noFile = 1;
function addFile(){
   var newFile = '<div class="" id="file'+noFile+'"><div class="col-md-8 "><div class="form-group"><select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div></div><div class="col-md-1"><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowFile('+noFile+');">-</button></div></div></div>'; 
     noFile++; 
	 $("#fileWaiter").append(newFile);
	 
	 Metronic.init(); 
  
}

function deleteRowFile(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("file"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
} 
}
</script>	
<? } ?>	
	
	
<div class="row"></div>	
<div class="col-md-4">
	
    <a href="exls.php?id=<?php echo $id; ?>" download="<?php echo $id.'.xlsx'; ?>" class="btn green">
        <i class="fa fa-download"></i> Descargar Excel
    </a>

	
	<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
</div>
	</div>

<? } } ?>  

<?php 

$queryuser = "select * from workers where code = '$row[userid]'";
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
	

											
?>

<h3 class="form-section">Información del Solicitante</h3>
<div class="row"><!--/span-->
<div class="col-md-12">
<p><strong>Nombre:</strong> <?php echo sanitizedOutput($rowuser['first'])." ".sanitizedOutput($rowuser['last']); ?><br>
<strong>Código:</strong> <?php echo sanitizedOutput($rowuser['code']); ?><br>
<strong>Email:</strong> <?php echo sanitizedOutput($rowuser['email']); ?> <br>
<? if($rowuser['unitid'] > 0){ 
	$queryunit = "select * from units where id = '$rowuser[unitid]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
?>	
<strong>Unidad de Negocio:</strong> <?php echo $rowunit['newCode']; ?> | <?php echo $rowunit['companyName'].' '.$rowunit['lineName'].' '.$rowunit['locationName']; ?>
<? } ?>	
<?php 
if($row['notes'] != ""){ 
?>
<br>
<strong>Notas del solicitante:</strong> <?php echo sanitizedOutput($row['notes']); ?>
<?php } ?>
</p>
</div>
</div>
                                                
<h3 class="form-section">Información del Pago <? if($row['approved'] == 1) echo '<i class="fa fa-check"></i>'; ?></h3>

<div class="row"><!--/span-->
<div class="col-md-2">
<div class="form-group">
<label class="control-label">ID de Pago:</label>
<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo sanitizedOutput($row['id']); ?>" readonly>
<div title="Page 5">
<div><div></div>
</div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="form-group">

	<label class="control-label">Compañía:</label>
<? 
$querycompany = "select name, ruc from companies where id = '$row[company]'";
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);
?>
<input name="companyname" type="text" class="form-control" id="companyname" value="<?php echo sanitizedOutput($rowcompany['name']); ?>" readonly>
								
<div title="Page 5">
<div>
<div></div>
</div>
</div>
</div>
</div>
  <div class="col-md-3">
<div class="form-group">

	<label class="control-label">RUC:</label> 

<input name="companyname" type="text" class="form-control" id="companyname" value="<?php echo sanitizedOutput($rowcompany['ruc']); ?>" readonly>
								

</div>
</div>  
    
	
	<? 
	if($row['immediate'] == 1){ 
	?><div class="col-md-2">

<div class="form-group">
<label class="control-label">Inmediato:</label>
<input name="paymenttypei" type="text" class="form-control" id="paymenttypei" value="Si" readonly>
<div title="Page 5">
<div>
<div></div>
</div>
</div>
</div>
</div><? } ?>
	
	<? 
	if($row['hc'] == 1){ 
		
	
	?>
	<div class="row"></div>
	<div class="col-md-2">

<div class="form-group">
<label class="control-label">Tipo de pago:</label>
<input name="paymenttypehc" type="text" class="form-control" id="paymenttypehc" value="Capital Humano" readonly>
<div title="Page 5">
<div>
<div></div>
</div>
</div>
</div>
</div>
	
	<div class="col-md-2">
		
	
	
	<? 
		switch($rowHC['hctype']){
			case 1:
				$hcstype = 'Ayudas economicas';
					break;
			case 2:
				$hcstype = 'Embargo judicial';
			break;
				case 3:
				$hcstype = 'Pensión alimenticia';
			break;
				case 4:
				$hcstype = 'IR Laboral';
			break;
				case 5:
				$hcstype = 'INSS Labora/Patronal';
			break;
				case 7:
				$hcstype = 'INATEC';
			break;
				case 8:
				$hcstype = 'Comisiones';
			break;
				case 9:
				$hcstype = 'Horas extras';
			break;
				case 10:
				$hcstype = 'Bonos';
			break;
				case 11:
				$hcstype = 'Vacaciones';
			break;
				case 12:
				$hcstype = 'Aguinaldo';
			break;
				case 13:
				$hcstype = 'Prestamos';
			break;
				case 14:
				$hcstype = 'Liquidación de colaboradores';
			break;
				case 15:
				$hcstype = 'Salarios';
			break;
		}
		
		?>

<div class="form-group">
<label class="control-label">Sub-tipo:</label>
<input name="paymenttypehc" type="text" class="form-control" id="paymenttypehc" value="<? echo $hcstype; ?>" readonly>
<div title="Page 5">
<div>
<div></div>
</div>
</div>
</div>
</div>
	<? } ?>
												  

													  

</div>
                                                
<h3 class="form-section">Información del <?php 
switch($row['btype']){
	case 1:
	echo 'Proveedor';
	break;
	case 2:
	echo 'Colaborador';
	break;
	case 3:
	echo "Pasante";
	break;
	case 4:
	echo "Cliente";
	break;
} ?> <input name="dspayment" type="hidden" id="dspayment" value="<?php echo $row['btype']; ?>"></h3>

<div class="row"><!--/span-->
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Código | Nombre:</label>
<?php 
//Si es Provedor										
if($row['btype'] == 1){
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select id, code, name, term, ruc from providers where id = '$row[provider]'"));
	$stage_term = $rowprovider['term'];
	$providercode = $rowprovider['code'];
	$providerid = $rowprovider['id'];
	$providerRuc = $rowprovider['ruc'];
	$providerTerm = $rowprovider['term'];
?>
<input name="provider_name" type="text" class="form-control" id="provider_name" value="<?php echo sanitizedOutput($rowprovider['code'])." | ".sanitizedOutput($rowprovider['name']); ?>" readonly> 
	
	<?php }
//Si es Colaborador
elseif($row['btype'] == 2){
	$rowprovider = $rowprovider['code'];
	$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where id = '$row[collaborator]'")); 
?> 
		  <input name="collaborator_name" type="text" class="form-control" id="collaborator_name" value="<?php echo $rowcollaborator['code']." | ".$rowcollaborator['first'].' '.$rowcollaborator['last']; ?>" readonly> 
	<?php }
//Si es Pasante
elseif($row['btype'] == 3){
	$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select code, first, last from interns where code = '$row[intern]'"));
	$providercode = $rowcollaborator['id']; 
	?> 
		  <input name="intern_client" type="text" class="form-control" id="intern_name" value="<?php echo $rowcollaborator['code']." | ".$rowcollaborator['first'].' '.$rowcollaborator['last']; ?>" readonly> 
	<?php } 
//Si es Cliente
elseif($row['btype'] == 4){
	$rowclient = mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$row[client]'"));
	$providercode = $rowclient['code']; 
	
	if($rowclient['type'] == 1){
		$clientname = $rowclient['first'].' '.$rowclient['last'];
	}else{
		$clientname = $rowclient['name'];
	}
	
	?> 
	<input name="client_name" type="text" class="form-control" id="client_name" value="<?php echo $rowclient['code']." | ".$clientname; ?>" readonly>
<?php }	?>
	
<? if(($row['btype'] == 1) and ($row['cc'] > 0)){ ?>
	
	<div class="row"><div class="col-md-12">
<div class="form-group">
<label class="control-label">Tarjeta de crédito:</label>
<?php 
//Si es Provedor										

	$rowCc = mysqli_fetch_array(mysqli_query($con, "select number, assigned from creditcards where id = '$row[cc]'"));

?>
<input name="thisCc" type="text" class="form-control" id="thisCc" value="<?php echo $rowCc['number'].' | '.$rowCc['assigned']; ?>" readonly> 
	
		</div></div></div>
	
	<?php }
	?>
														
														
														
														
															<div title="Page 5">
                                                            
                                                              <input name="provider" type="hidden" id="provider" value="<?php echo $providerid; ?>">  
                                                            
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div>
	
	<? if($providerRuc != ''){ ?>
	
	
	<div class="col-md-9">
													<div class="form-group">
													<label class="control-label">RUC:</label>
													<input name="providerRuc" type="text" class="form-control" id="providerRuc" value="<?php echo $providerRuc; ?>" readonly style="font-weight: bold;font-size: 15px !important;"> 
													</div>
													</div>	
	<? } ?>
	<? if($providerTerm != ''){ ?>
	
	
	<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Plazo de crédito:</label>
													<input name="providerTerm" type="text" class="form-control" id="providerTerm" value="<?php echo $providerTerm.' días'; ?>" readonly style="font-weight: bold;font-size: 15px !important;"> 
													</div>
													</div>	
	<? } ?>
													
											
													<? 
													if(($row['btype'] == 4) and ($rowclient['type'] == 1)){ 
													?>
													<div class="col-md-12">
													<div class="form-group">
													<label class="control-label">Dirección:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['address']; ?>" readonly> 
													</div>
													</div>	
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Ciudad:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['city']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Cédula:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['nid']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3"> 
													<div class="form-group">
													<label class="control-label">Email:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['email']; ?>" readonly> 
													</div>
													</div>	
													<div class="col-md-3"> 
													<div class="form-group">
													<label class="control-label">Teléfono:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['phone']; ?>" readonly> 
													</div>
													</div>		
														
													<? } ?>
													
													<? 
													if(($row['btype'] == 4) and ($rowclient['type'] == 2)){ 
													?>
													<div class="col-md-12">
													<div class="form-group">
													<label class="control-label">Dirección:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['address']; ?>" readonly> 
													</div>
													</div>	
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Ciudad:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['city']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">RUC:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['ruc']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3"> 
													<div class="form-group">
													<label class="control-label">Email:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['email']; ?>" readonly> 
													</div>
													</div>	
													<div class="col-md-3"> 
													<div class="form-group">
													<label class="control-label">Teléfono:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['phone']; ?>" readonly> 
													</div>
													</div>	
													<div class="row"></div>
													<div class="col-md-12">
													<h3>Información del Representante Legal</h3>		
													</div>
													
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Nombres:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['rfirst']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Apellidos:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['rlast']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Cédula:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['rnid']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Email:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['remail']; ?>" readonly> 
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
													<label class="control-label">Phone:</label>
													<input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowclient['rphone']; ?>" readonly> 
													</div>
													</div>
													<? } ?>

													<!--/span-->

												</div>
                                                
<?php 

if((($_SERVER['SCRIPT_NAME'] == "/admin/releasing-view.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/provision-view.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/provision-view-covid.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/provision-view-covid-cascade.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/provision-approve-view.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/payment-order-view.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/provision-global-view.php") or ($_SERVER['SCRIPT_NAME'] == "/admin/releasing-special-view.php"))){
	if($row['hc'] == 0){
		include("payment-order-view-resume.php");  
	}
} ?>




												<!--/row--><!--/row-->
		<h3 class="form-section">Concepto de Pago</h3>
        
												<div class="row">
                                           <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción: </label>
                                                        <p>
                                                          <textarea name="description2" rows="2" readonly class="form-control" id="description"><?php echo $row['description']; ?></textarea>
                                                        </p>
                                                          
                 
                                                      <!--/row--></div>
													</div>  
                                           </div>
                                            
                                            
<? 
	
	if($row['btype'] == 4){ 
											
$query_refund = "select * from clientsrefund where payment = '$row[id]'";
$result_refund = mysqli_query($con, $query_refund);
$row_refund = mysqli_fetch_array($result_refund);
											
if($row_refund['bline'] > 0){
	$querybline = "select name from blines where id = '$row_refund[bline]'";
	$resultbline = mysqli_query($con, $querybline);
	$rowbline = mysqli_fetch_array($resultbline);
	$the_bline = $rowbline['name'];
}
											
switch($row_refund['devtype']){
	case 1:
	$refund_type = "Primas";
	break;
	case 2:
	$refund_type = "Reservas";
	break;
	case 3:
	$refund_type = "Excedentes";
	break;
	case 4:
	$refund_type = "Seguros";
	break;
	case 5:
	$refund_type = "Productos";
	break;
	case 6:
	$refund_type = "PMP";  
	break; 
	case 7:
	$refund_type = "Leasing";  
	break; 
	case 8:
	$refund_type = "Autoflex";  
	break; 
	case 9:
	$refund_type = "Saldo a favor del cliente"; 
	break; 
    case 10:
	$refund_type = "FIDEM"; 
	break; 
}
											
											
											?>
                                                    
                                        <h3 class="form-section">Información de Devolución</h3> 
        
										<div class="row">
                                         <? //Refun Type ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Tipo:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $refund_type; ?>" readonly >

                                                      <!--/row--></div>
										 </div>
                                         
                                         <? //Refun Type 
										 if($row_refund['bline'] > 0){
										 ?>
                                         
                                          <div class="col-md-6 ">
													  <div class="form-group">
														<label>Linea de Negocio:</label>
                                                        <input name="tbline" type="text" class="form-control" id="tbline" value="<? echo $the_bline;
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                         <? } ?>
                                          
                                           <? if($row_refund['rsvp'] != "0000-00-00"){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Reservación:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo date("d-m-Y", strtotime($row_refund['rsvp']));
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['report'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Informe de Negociación:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['report'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                           <? if($row_refund['brand'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Marca:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['brand'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['model'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Modelo:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['model'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          
                                          <? if($row_refund['part_number'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Parte:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['part_number'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['policy'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Póliza:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['policy'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['claim'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Reclamo:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['claim'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['plate'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Placa:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['plate'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                           
                                        </div> 
  <? 
	$query_rocs = "select * from clientsdocuments where payment = '$row[id]'";
	$result_rocs = mysqli_query($con, $query_rocs);
	$num_rocs = mysqli_num_rows($result_rocs);
	if($num_rocs > 0){
  ?>  
	<div class="row">
	<div class="col-md-12 ">
	<div class="form-group">
	<label style="font-size: 18px;">Recibo(s) de Caja / Factura(s):</label>
	</div>
	</div>
	<? while($row_rocs=mysqli_fetch_array($result_rocs)){ ?>
	<div class="row"></div>
		
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Tipo:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? switch($row_rocs['type']){ case 1: echo "ROC"; break; case 2: echo "Factura"; break; } ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Número:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_rocs['number']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Fecha:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo date('d-m-Y', strtotime($row_rocs['today'])); ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Monto:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo number_format($row_rocs['amount'],2); ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Moneda:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? switch($row_rocs['currency']){ case 1: echo "Córdobas"; break; case 2: echo "Dólares"; break; } ?>"  readonly >                                                        
		</div> 
		</div>
		
		
	<? } //End While ?>
	</div>
 <? } //End Recibos de Caja / Facturas ?>
                                          
                                           <? 

	if(($row_refund['cardholder'] != "") or ($row_refund['bank'] > 0) or ($row_refund['account'] != "")){
	
	$query_bankrefund = "select name from banks where id = '$row_refund[bank]'";
	$result_bankrefund = mysqli_query($con, $query_bankrefund);
	$row_bankrefund = mysqli_fetch_array($result_bankrefund);
	$bank_refund = $row_bankrefund['name'];
	
  ?>  
	<div class="row">
	<div class="col-md-12 ">
	<div class="form-group">
	<label style="font-size: 18px;">En caso de Tarjetas:</label>
	</div>
	</div>
	
	<div class="row"></div>
		
		<div class="col-md-4 ">
		<div class="form-group">
		<label>Nombre Titular:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['cardholder']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Banco:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $bank_refund; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label># CTA/Tarjeta:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['account']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Vencimiento:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['expiration']; ?>"  readonly >                                                        
		</div>
		</div>
		
	
	</div>
 <? } //End Tarjetas ?>
	
    <? 
	if($row_refund['seller'] != ""){ 
	?>
    <div class="row">
	<div class="col-md-12 ">
	<div class="form-group">
	<label style="font-size: 18px;">Información del Vendedor:</label>
	<? 
	
	$queryseller = "select * from workers where code = '$row_refund[seller]'";
	$resultseller = mysqli_query($con, $queryseller);
	$rowseller = mysqli_fetch_array($resultseller);
	
	?>
	</div>
	</div>
	
	<div class="row"></div>
		
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Nombre:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowseller['first']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Apellido:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowseller['last']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Email:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowseller['email']; ?>"  readonly >                                                         
		</div>
		</div>
		<div class="col-md-3 "> 
		<div class="form-group">
		<label>Telefono:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['seller_phone']; ?>"  readonly >                                                        
		</div>
		</div>
		
	
	</div>
                                          <? } ?>
                                           
                                                     
<? } //End id (btype == 4) ?>    
                                                     
<? 

$querybills = $con->prepare("select * from bills where payment = ?");
$querybills->bind_param("i", $id);
$querybills->execute();
$resultbills = $querybills->get_result();
$numbills = $resultbills->num_rows;
$ibills = 1;

?>

<h3 class="form-section"><? echo $numbills; ?> Documento(s)</h3>
<?php 
$gstotal = 0;
$gstotal2 = 0;
$billcomma = 0;
$billcomma2 = 0;
$billcomma3 = 0;
$totalbills = 0;
$totaltax = 0;
$totalintur = 0;
$totalexempt = 0;
$totalexempt2 = 0;
$totalstotal = 0;
$gbstotal = 0; ###
while($rowbills=$resultbills->fetch_assoc()){	
														  
if($rowbills['tax'] > 0){
	$billcomma.= $rowbills['stotal']+$rowbills['tax'].',';
	$billcomma3.= $rowbills['stotal'].',';														  
}else{
	$billcomma.= $rowbills['ammount'].','; 
	$billcomma3.= $rowbills['ammount'].','; 
}

$billcomma2.= $rowbills['tax'].',';

if($rowbills['retfamily'] > 0){
	$familyname  = $queryfam = "select code, name from retfamilycontent where id = '$rowbills[retfamily]'";
	$resultfam = mysqli_query($con, $queryfam);
	$rowfam = mysqli_fetch_array($resultfam);
	$familyname = $rowfam['code']." | ".$rowfam['name'];
}else{
	$familyname = "Sin Tipo de retencion";
}											  ?>
                                                   
<input type="hidden" id="billid[]" name="billid[]" value="<?php echo $rowbills['id']; ?>">  
<div class="row"> 
<div class="col-md-12">DOC#<? echo $ibills." ($rowbills[id])";  ?></div>
</div>

	
<? if($rowbills['ncatalog'] == 1){ ?>
	
<div class="row"> 
<? //Tipo de Pago ?>  
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Tipo de pago:</label>
                                                        <input name="type[]" type="text" class="form-control" id="type[]" value="<?php $queryw1 = "select * from accountingCategories where id = '$rowbills[type]'";
														$resultw1 = mysqli_query($con, $queryw1);
														$roww1 = mysqli_fetch_array($resultw1);
														echo $roww1['name']; ?>" readonly> 
						
                                                          
                       <br>

                       
                                                        <div class="row"></div>
                                                      <!--/row--></div>
  </div>
<? //Concepto de Pago ?>  
<div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>

<input name="conceptLabel[]" type="text" class="form-control" id="conceptLabel[]" value="<?php $queryw2 = "select * from accountingCategories where id = '$rowbills[concept]'";
														$resultw2 = mysqli_query($con, $queryw2);
														$roww2 = mysqli_fetch_array($resultw2); 
														echo $roww2['name']; ?>" readonly> 
														  <input type="hidden" name="concept[]" id="concept[]" value="<? echo $rowbills['concept']; ?>">
                                                        
													  </div>

  </div>
<? if($minimalView == 0){ ?>  	 	
<? //Categoria de Pago ?>
<div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Categoria:</label>
											 				<input name="concept2[]" type="text" class="form-control" id="concept2[]" value="<?php $queryw3 = "select * from accountingCategories where id = '$rowbills[concept2]'";
														$resultw3 = mysqli_query($con, $queryw3);
														$roww3 = mysqli_fetch_array($resultw3);
														echo $roww3['name']; ?>" readonly>
													</div> 

  </div>
<? }else{ ?> 
<?php //Monto ?>
<div class="col-md-3 ">
													  <div class="form-group">
													  
                                                      <label>Total:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" onChange="javascript:reloadNumbers(this.value);" value="<?php echo str_replace('.00','',number_format($rowbills['ammount'],2)); ?>" readonly>
						
                                                          
                       <br>

                       
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>	
<? } ?>	
</div>	
<? }else{ ?>
	<div class="row"> 
	<? //Tipo de Pago ?>  
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Tipo de pago:</label>
                                                        <input name="type[]" type="text" class="form-control" id="type[]" value="<?php $queryw1 = "select * from categories where id = '$rowbills[type]'";
														$resultw1 = mysqli_query($con, $queryw1);
														$roww1 = mysqli_fetch_array($resultw1);
														echo $roww1['name']; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
  </div>
<? //Concepto de Pago ?>  
<div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>

<input name="conceptLabel[]" type="text" class="form-control" id="conceptLabel[]" value="<?php $queryw2 = "select * from categories where id = '$rowbills[concept]'";
														$resultw2 = mysqli_query($con, $queryw2);
														$roww2 = mysqli_fetch_array($resultw2);
														echo $roww2['name']; ?>" readonly> 
														  <input type="hidden" name="concept[]" id="concept[]" value="<? echo $rowbills['concept']; ?>">
                                                        
													  </div>

  </div>
<? if($minimalView == 0){ ?>		
<? //Categoria de Pago ?>
<div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Categoria:</label>
											 				<input name="concept2[]" type="text" class="form-control" id="concept2[]" value="<?php $queryw3 = "select * from categories where id = '$rowbills[concept2]'";
														$resultw3 = mysqli_query($con, $queryw3);
														$roww3 = mysqli_fetch_array($resultw3);
														echo $roww3['name']; ?>" readonly>
													</div> 

  </div>
<? }else{ ?>	
<?php //Monto ?>
<div class="col-md-3 ">
													  <div class="form-group">
													  
                                                      <label>Total:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" onChange="javascript:reloadNumbers(this.value);" value="<?php echo str_replace('.00','',number_format($rowbills['ammount'],2)); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>	
<? } ?>	
</div>
<? } ?>	

<? if($minimalView == 0){ ?>	                                               
<div class="row">                                                
<?php //Tipo de cocumemento ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Tipo de Documento:</label>
                                                        <input name="dtype[]" type="text" class="form-control" id="dtype[]" value="<?php 
														$querydtype = "select * from documenttype where id = '$rowbills[dtype]'";
														$resultdtype = mysqli_query($con, $querydtype);
														$rowdtype=mysqli_fetch_array($resultdtype);
														echo $rowdtype['name']; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>									
<?php //Factura No ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Factura No:</label>
                                                        <input name="bill[]" type="text" class="form-control" id="bill[]" value="<?php echo $rowbills['number']; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Fecha de recibido ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Recibido de Factura:</label> 
                                                        <input name="billdate2[]" type="text" class="form-control form-control-inline" id="billdate2[]" value="<?php $billdate2 = strtotime($rowbills['billdate2']);
														echo date('d-m-Y', $billdate2); ?>" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
<?php //Fecha de Documento ?>  
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Factura:</label> 
                                                        <input name="billdate[]" type="text" class="form-control form-control-inline" id="billdate[]" value="<?php $billdate = strtotime($rowbills['billdate']);
														echo date('d-m-Y', $billdate); ?>" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
</div>
<? } ?>	
<? if($minimalView == 0){ ?>		
<div class="row">
<?php //stotal1 ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Sub-total (que graba IVA):</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="<?php  echo number_format($rowbills['stotal'],2); $gstotal+=$rowbills['stotal']; ?>" readonly>                              
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //stotal2 ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Sub-total (exento de IVA):</label>
                                                        <input name="stotal2[]" type="text" class="form-control" id="stotal2[]" value="<?php echo number_format($rowbills['stotal2'],2); $gstotal2+=$rowbills['stotal2']; ?>" readonly>                              
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Monto Alojamiento ?>
<div class="col-md-3 ">
													  <div class="form-group">
													  
                                                      <label>Monto Alojamiento:</label>
                                                        <input name="inturammount[]" type="text" class="form-control" id="inturammount[]" onChange="javascript:reloadNumbers(this.value);" value="<?php echo str_replace('.00','',number_format($rowbills['intur'],2)); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Monto Intur ?>
<div class="col-md-3 ">
													  <div class="form-group">
													  
                                                      <label>Monto Intur:</label>
                                                        <input name="inturammount2[]" type="text" class="form-control" id="inturammount2[]" onChange="javascript:reloadNumbers(this.value);" value="<?php echo str_replace('.00','',number_format($rowbills['inturammount'],2)); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Subtotal ?>                                                     
<div class="col-md-3 "> 
													  <div class="form-group">
														<label>Sub-total:</label>
                                                        <input name="bstotal[]" type="text" class="form-control" id="bstotal[]" value="<?php $bstotal = $rowbills['stotal']+$rowbills['stotal2']; echo number_format($bstotal,2); $gbstotal+=$bstotal; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                    
<?php //IVA ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="<?php  echo number_format($rowbills['tax'],2); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Monto ?>
<div class="col-md-3 ">
													  <div class="form-group">
													  
                                                      <label>Total:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" onChange="javascript:reloadNumbers(this.value);" value="<?php echo str_replace('.00','',number_format($rowbills['ammount'],2)); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //TC ?>                                                     
<div class="col-md-3 ">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="btc[]" type="text" class="form-control" id="btc[]" value="<?php  if($rowbills['currency'] == 2){ echo $rowbills['tc']; } else{ echo "NA"; }  ?>" readonly>                                                           

<br>


                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                                                  
<?php //Cantidad en letras ?>                                    
<div class="col-md-6 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters[]" type="text" class="form-control" id="letters[]" value="<?php if($rowbills['letters'] == ''){ echo toLetters($rowbills['ammount']); echo $rowbills['currency']; } else echo $rowbills['letters'];  ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
<?php //Cantidad en letras ?>                                    
<div class="col-md-6 ">
													  <div class="form-group">
														<label>Familia de retenciones:</label> 
                                                        <input name="lettersfam[]" type="text" class="form-control" id="lettersfam[]" value="<?php echo $familyname;  ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
<?php //Retencion Alcaldía ?>                               
<div class="col-md-3 ">
													  <div class="form-group">
														<label>IMI: (C$ Córdobas)</label>
                                                        <input name="bimi[]" type="text" class="form-control" id="bimi[]" value="<?php echo str_replace('.00','',number_format($rowbills['ret1a'], 2));  ?>" readonly>                                                            

<br> 


                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Exento IMI ?>                                                  
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Exento IMI:</label>
                                                        <input name="exempt2[]" type="text" class="form-control" id="exempt2[]" value="<?php echo $rowbills['exempt2'];  ?>" readonly>

                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 	
<?php //Retencion IR ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>IR: (C$ Córdobas)</label>
                                                        <input name="bir[]" type="text" class="form-control" id="bir[]" value="<?php echo str_replace('.00','',number_format($rowbills['ret2a'], 2));  ?>" readonly>                                                           

<br>


                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
<?php //Exento IR ?>                                                  
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Exento IR:</label>
                                                        <input name="exempt[]" type="text" class="form-control" id="exempt[]" value="<?php echo $rowbills['exempt'];  ?>" readonly>
<input type="hidden" name="ret1a[]" id="ret1a[]" value="0">
<input type="hidden" name="ret2a[]" id="ret2a[]" value="0">
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 	

</div><? } ?>	
<? $ibills++; ?>                                                     
                                                     
<?php if($rowbills['cut'] == 1){ echo '<div class="row"><div class="col-md-12 "><div class="note note-danger">Nota: Esta factura no corresponde al periodo fiscal.</div></div></div>'; }
        ?>
<input name="ibillid[]" type="hidden" id="ibillid[]" value="<? echo $rowbills['id']; ?>">
<hr style="color:#0123B2;">
                                                  
     <?php 
	 
	 $totalbills += $rowbills['ammount'];
	 $totaltax += $rowbills['tax']; 
	 $totalintur += $rowbills['inturammount'];
	 $totalexempt += $rowbills['exempt'];
	 $totalexempt2 += $rowbills['exempt2'];
	 
	 if($rowbills['stotal'] == 0.00){
		 $totalstotal += $rowbills['ammount']; 
	 }else{
		 $totalstotal += $rowbills['stotal'];
	 }
	 
	 $billcurrency = $rowbills['currency'];
	 
	
	
	 
	 
	 } //End Documents
	 
	 ?>  
    
     <div class="row">
<? if($minimalView == 0){ ?>
<?php //SUBTOTAL QUE GRABA IVA ?>
<div class="col-md-2 ">
    
													  <div class="form-group">
														<input type="hidden" name="stotalbillcomma" id="stotalbillcomma" value="<?php echo $billcomma; ?>">
                                                        <input type="hidden" name="stotalbillcomma2" id="stotalbillcomma2" value="<?php echo $billcomma2; ?>">
                                                        <input type="hidden" name="stotalbillcomma3" id="stotalbillcomma3" value="<?php echo $billcomma3; ?>">
                                                        <label>S.total grava IVA:</label>
                                                        <input name="stotalbill" type="text" class="form-control" id="stotalbill" value="<?php echo number_format($gstotal, 2); ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                               
<?php //SUBTOTAL EXENTO DE IVA?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>S.total exento  IVA:</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="<?php echo number_format($gstotal2, 2); ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
    <!--/row--></div>
	   </div>                                        
<?php //SUBTOTAL ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>S.total:</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="<?php echo number_format($gbstotal, 2); ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //IVA FACTURAS ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="<?php echo number_format($totaltax, 2); ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<? } 	?>		 	 
<?php //TOTAL FACTURAS ?>     
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
														<input name="totalbill" type="text" class="form-control" id="totalbill" value="<?php echo str_replace('.00','',number_format($totalbills, 2)); ?>" readonly>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>

                                             
<?php 
//Moneda
$querycurrency0 = "select * from currency where id = '$billcurrency'"; 
$resultcurrency0 = mysqli_query($con, $querycurrency0);
$rowcurrency0 = mysqli_fetch_array($resultcurrency0);
?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Moneda:</label>
														<input name="bill2" type="text" class="form-control" id="bill2" value="<?php echo $rowcurrency0['name']; ?>" readonly><input name="bcurrencynew" type="hidden" id="bcurrencynew" value="<?php echo $billcurrency; ?>"><input id="stotalbillmen1000" name="stotalbillmen1000" type="hidden" value="">  <input id="stotalbillmay1000" name="stotalbillmay1000" type="hidden" value="">
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>

<? if($minimalView == 0){ ?>		 
<?php //INTUR FACTURAS ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>INTUR:</label>
                                                        <input name="totalintur" type="text" class="form-control" id="totalintur" value="<?php echo $totalintur; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>													
<?php //TOTAL EXENTO IMI ?>     
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total exento IMI:</label>
														<input name="gexempt" type="text" class="form-control" id="gexempt2" value="<?php echo str_replace('.00','',number_format($totalexempt2, 2)); ?>" readonly> 
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //TOTAL EXENTO ?>     
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total exento IR:</label>
														<input name="gexempt" type="text" class="form-control" id="gexempt" value="<?php echo str_replace('.00','',number_format($totalexempt, 2)); ?>" readonly> 
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                  
<?php /*
#if($row['cbank'] > 0){                         
//COMISIONES BANCARIAS ?>     
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Comisión bancaria: <? echo doubleval($row['cbank']); ?></label>
														<input name="cbank" type="text" class="form-control" id="cbank" value="<?php echo doubleval($row['cbank']); #str_replace('.00','',number_format($row['cbank'], 2)); ?>" readonly> 
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
<? */ ?>		 
<? } ?>
                                                    
                                                    
         </div>      
         
                                         <? if($minimalView == 0){ ?>		
                                                    <h3 class="form-section">Retenciones</h3>
                                                    	<div class="row">
                                                    
                                                    <? //% alcaldia?>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>% Alcaldía:</label>
                                                        <input name="retention1old" type="text" class="form-control" id="retention1old" placeholder="%" value="<?php echo $row['ret1']."%"; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <? //Monto alcaldía ?>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														
           <label>Monto Alcaldía: (C$ Córdobas)</label>                                             <input name="retention1ammountold" type="text" class="form-control" id="retention1ammountold" placeholder="Monto" value="<?php echo str_replace('.00','',number_format($row['ret1a'], 2)); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                           <? //% IR?>      
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>% IR:</label>
                                                        <input name="retention2old" type="text" class="form-control" id="retention2old" value="<?php echo $row['ret2']."%"; ?>" readonly>
						
                                                          
                       <br> 

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <? //Monto IR ?>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
			    <label>Monto IR: (C$ Córdobas)</label>											
                                                        <input name="retention2ammountold" type="text" class="form-control" id="retention2ammountold" placeholder="Monto" value="<?php echo str_replace('.00','',number_format($row['ret2a'], 2)); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                   
                                                    <?php if(($row['hall'] > 0)){ ?>
                                                    
                                                    <div class="col-md-12 ">
													  <div class="note note-regular"><strong>Sucursal:</strong> <? 
													  $queryhall = "select * from halls where id = '$row[hall]'";
													  $resulthall = mysqli_query($con, $queryhall);
													  $rowhall = mysqli_fetch_array($resulthall);
													  echo $rowhall['name'];
													  
													  
											$allworkers = "";
											$queryroutepa = "select * from routes where type = '23' and unit = '$row[hall]'";
											$resultroutepa = mysqli_query($con, $queryroutepa);
											$numroutepa = mysqli_num_rows($resultroutepa);
											if($numroutepa > 0){
												echo "<br><strong>Encargados:</strong> ";
												while($rowroutepa = mysqli_fetch_array($resultroutepa)){
													$queryroutepa2 = "select * from workers where code = '$rowroutepa[worker]'";
													$resultroutepa2 = mysqli_query($con, $queryroutepa2);
													$rowroutepa2 = mysqli_fetch_array($resultroutepa2);
													$allworkers.= $rowroutepa2['first']." ".$rowroutepa2['last'].", ";
												}
												echo substr($allworkers,0,-2);
											}
													  ?>
														</div>
                                                      
                                                      </div>
                                                      <?php } ?> 
                                                   
                                                   
                                                   
                                                    <?php if(($row['acp'] == 1) or ($row['acp2'] == 1)){ ?>
                                                    
                                                    
													<div class="col-md-12 ">
<div class="note note-danger">
<label><strong>Nota:</strong> Retenciones asumidas por Grupo Casa Pellas. <?php if($row['acp'] == 1){ echo "<br>- Alcaldía"; } if($row['acp2'] == 1){ echo "<br>- DGI"; } ?></label>											
<div class="row"></div>
</div>
</div>
													
													<?php } ?>
                                                    
<? if($row['manualrets'] == 1){ ?>
<div class="col-md-12">
<a href="javascript:showMretentions();">Ver retenciones Manuales</a>  
</div> 
<script>
function showMretentions(){
	var mstatus = document.getElementById('mretentions').style;
	if(mstatus.display == "block"){
		mstatus.display = "none";
	}else{
		mstatus.display = "block"; 
	}
}
</script>
<div class="col-md-12" id="mretentions" style="display:none">
<h3>Retenciones Manuales</h3>

<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="13%">Tipo</th>
									<th width="18%">Fecha</th>
									<th width="16%">Número</th>
                                    <th width="16%">Factura(s)</th>
									<th width="25%">Total Factura(s)</th>
                                    <th width="10%">Porcentaje</th>
									<th width="28%">Total Retencion</th>

								  </tr>

								</thead>

								<tbody>
                               <?php 
							   
							   

	
$querymretentions = $con->prepare("select * from manualretentions where payment = ? order by type");
$querymretentions->bind_param("i", $id);
$querymretentions->execute();
$resultmretentions = $querymretentions->get_result();
$nummretentions = $resultmretentions->num_rows;
while($rowmretentions = $resultmretentions->fetch_assoc()){

?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php 
								switch($rowmretentions['type']){
									case 1;
									echo "IMI";
									break;
									case 2:
									echo "IR";
									break;
								}
								
								?></td><td><?php echo date('d-m-Y',strtotime($rowmretentions['today'])); ?></td><td><?php echo $rowmretentions['number']; ?></td>
                                <td>
                                <? echo $rowmretentions['bills']; ?>
                                </td>
                                
                                <td><?php 
							
							echo "C$".$rowmretentions['totalbill']; 
								 ?></td>
                                 <td>
                                 <? echo str_replace('.00','',$rowmretentions['percent'])."%"; ?>
                                 </td> 
                                <td><? echo "C$".$rowmretentions['totalretention']; ?></td>
                               <?php /* <td>
								<span <?php if($row['expiration'] < date('Y-m-d')) echo 'style="color:#F00;"'; ?>><?php echo date('d-m-Y',strtotime($row['expiration'])); ?></span>
							</td>
                               <td>
								<?php $day2 = strtotime('+'.$rowprovider['term'].' day',strtotime($day1));
							    $day2 = date('Y-m-d',$day2);
								
								$days = (strtotime(date('Y-m-d'))-strtotime($day1))/86400;
								
								$leftdays = $rowprovider['term']-$days;

								if($leftdays <= 0){
									//echo "Pago vencido";
									echo '<span style="color:#F00;">'.$leftdays." días</span>";
								}else{
									echo $leftdays." días";
								}
								 
								?>
							</td> */ ?>
                          </tr>
                          
                          <?php 
						  
						  $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  $note = $rowstage['note'];
						  $thereason = $rowstatus['reason'];
						  
						  ?>
                                                        
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
                                
                                </div>

<? } ?> 													<!--/span-->

												</div>
	
	<? } ?>
                                                
                                                
                                            <?php 
	
											$querynotes = $con->prepare("select * from notes where payment = ?");
											$querynotes->bind_param("i", $row['id']);
											$querynotes->execute();
											$resultnotes = $querynotes->get_result();
											$numnotes = $resultnotes->num_rows;
											if($numnotes > 0){
												 
											
											 
											 ?>
                                               <h3 class="form-section"><a id="files"></a>Notas de Débito</h3>
	
												<div class="row"><!--/span--> 
                                                <div class="col-md-2 ">Fecha</div>
                                                <div class="col-md-2 ">Número</div>
                                                <div class="col-md-2 ">Monto</div>
                                                <div class="col-md-6 ">Razón</div>
											  
											  <?php while($rownotes=$resultnotes->fetch_assoc()){ ?>
													<div class="col-md-2 ">
													<div class="form-group">
										        	<input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo date('d-m-Y', strtotime($rownotes['today'])); ?>" readonly><br><div class="row"></div></div></div> 
                                                   	<div class="col-md-2 ">
													<div class="form-group">
										        	<input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $rownotes['number']; ?>" readonly><br><div class="row"></div></div></div> 
                                                    <div class="col-md-2 ">
													<div class="form-group">
													<input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value="<?php echo str_replace('.00','',number_format($rownotes['ammount'], 2)); ?>" readonly>
													<br>
                       
														
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
                                                    <div class="col-md-6 ">
													  <div class="form-group">
													    <input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value="<?php echo $rownotes['reason']; ?>" readonly> 
						
                                                          
                       <br>
                       
                     

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 

                                            
                                                     
                                                                                       
                                                    <?php } ?>
                                              </div>
                                              
                                              <?php } ?>
                                                
                                                
                                                  <h3 class="form-section">Pago a  <?php switch($row['btype']){
														case 1:
														echo 'Proveedor';
														break;
														case 2:
														echo 'Colaborador';
														break;
														case 3:
														echo 'Pasante';
														break;
														case 4:
														echo 'Cliente';
														break;
													} ?></h3>
                                                  
                                              <div class="row"><!--/span-->
                                                <div class="col-md-3 ">
													  <div class="form-group">
			    <label><strong style="font-size:18px;">Monto a Pagar:</strong></label>
			    											
                                                        <input name="paymentold" type="text" class="form-control" id="paymentold" placeholder="Calculo automático" value="<?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].str_replace('.00','',number_format($row['payment'], 2))." ".$rowcurrency['name']; ?>" readonly style="font-weight:800;border:1px solid #21355d;"> <?php //OOO 
														if($_SERVER['SCRIPT_NAME'] == '/admin/payment-order-repair-currency2.php'){ ?> <div class="col-md-3 "> 
													  <div class="form-group">
			    <label>Moneda a Pagar</label><input type="hidden" name="nochange" id="nochange" value="1" >                                              
 <select name="currency2pay" class="form-control" id="currency2pay" onChange="javascript:reloadNumbers();"> 
<option value="1">Córdobas</option> 
<option value="2">Dólares</option>  
</select>
</div>
</div>  <?php } //OOO ?><input name="ppayment" type="hidden" id="ppayment" value="<?php echo $row['payment']; ?>"><input name="billcurrency2" type="hidden" id="billcurrency2" value="<?php echo $rowcurrency[0]; ?>">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												</div>  
                                                  </div>
	
	
	
	
                                                  
<h3 class="form-section"><a id="files"></a>Archivos</h3>

<?php 

$query2 = "select * from files where payment = '$id' order by id asc";
$result2 = mysqli_query($con, $query2);
while($row2=mysqli_fetch_array($result2)){	
	
	$fileArr  = explode('=', $row2['link']);
           
	if(($gvisor == 1)){  
					
	 

?>

<div style="text-align:center;">

<object data="efile.php?key=<? echo $fileArr[1]; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>
	
<? /*<object data="<?php echo $thefile; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>
<iframe id="stageMain" src="<?php echo $thefile; ?>" style="width:95%; height:700px; border: 10px solid #21355d;" frameborder="0"></iframe> */ ?> 
<br><br>
</div> 
<?php
$filename = $_SERVER['SCRIPT_NAME'];
$filenamearr = explode('/',$filename);
$filenamesize = sizeof($filenamearr);
$filenamesize--;
$filename = $filenamearr[$filenamesize];

  } 
	
else{ ?>
                         
<div class="col-md-10 ">
													  <div class="form-group">
										        <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $fileArr[1]; ?>" readonly><br><div class="row"></div></div></div>      
                                                       
<div class="col-md-2 ">
                             <a href="visor.php?key=<?php  
							 echo $fileArr[1]; 
							 ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a> 
                                                                                                      </div>                                                     
                         
<?php 

} //End else

} //End while of files  ?>
<div class="row"></div>			
<?
													  
$query2 = "select * from filesAdditional where payment = '$id' order by id asc";
$result2 = mysqli_query($con, $query2);
$numPayments2 = mysqli_num_rows($result2);
if($numPayments2 > 0){ ?>
<h3 class="form-section"><a id="files2"></a>Archivos Adicionales</h3>
<? 													  
while($row2=mysqli_fetch_array($result2)){	
	$fileArr2  = explode('=', $row2['link']);
	?>
<div class="col-md-10 ">
													  <div class="form-group">
										        <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $fileArr2[1]; ?> @<? echo $row2['totime']; ?> Nota: <? echo $row2['comments']; ?>" readonly><br><div class="row"></div></div></div>      
                                                       
<div class="col-md-2 ">
                             <a href="visor.php?key=<?php  
							 echo $fileArr2[1]; 
							 ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a> 
                                                                                                      </div>     											  
<?  } #end while
	} #end if num 
?>
<div class="row"></div>													  
<?
 
 if(isset($checker)){
 if(($checker == 1)){ 
 ?>
<div class="row"></div>
<div style="text-align:right; margin-right:30px;">

<input name="aorder" type="checkbox" id="aorder" value="1" <?php if($rowreview['aorder'] == 1) echo 'checked'; ?>> Archivos de solicitud 
</div>
<?php } } ?>                                            
	
	
	<? if($row['solvencyExpiration'] != '0000-00-00'){ ?>
                                              
                                               <h3 class="form-section"><a id="solvency"></a>Solvencia Fiscal</h3>
	
	
	
	
			<div class="row">
													
													<div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Expiración de la Solvencia:</label>
                                                        <?
                                                        $solvencyDate = "-";
                                                        if ( $row[ 'solvencyExpiration' ] != "0000-00-00" ) {
                                                          if ( $row[ 'solvencyExpiration' ] != "1969-12-31" ) {
															   if ( $row[ 'solvencyExpiration' ] != "1970-01-01" ) {
                                                            $solvencyDate = strtotime( $row[ 'solvencyExpiration' ] );
                                                            $solvencyDate = date( 'j-n-Y', $solvencyDate );
                                                          }
														  }
                                                        }
                                                        ?>

									  <input name="solvency" type="text" class="form-control form-control-inline" id="solvency" value="<?php echo $solvencyDate; ?>" readonly> 
																									

													</div>
                                               
                                               </div>
				
	</div>
	
	<? } ?>
	
	<div class="row">
                                                  <!--/span--> 
<?php 
		
$querySolvency = "select * from paymentsSolvency where payment = '$row[id]' order by id desc limit 1"; 
$resultSolvency = mysqli_query($con, $querySolvency);
$numSolvency = mysqli_num_rows($resultSolvency);			
while($rowSolvency=mysqli_fetch_array($resultSolvency)){											 
  
	
	$fileArr2  = explode('=', $rowSolvency['link']); 
	
	
	
if(($gvisor == 1)){
	
	

?>

<div style="text-align:center;">

<object data="efile.php?key=<? echo $fileArr2[1]; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>


<? /*<iframe id="stageMain" src="<?php echo $thefile; ?>" style="width:95%; height:700px; border: 10px solid #21355d;" frameborder="0"></iframe> */ ?> 
<br><br>
</div> 
<?php
$filename = $_SERVER['SCRIPT_NAME'];
$filenamearr = explode('/',$filename);
$filenamesize = sizeof($filenamearr);
$filenamesize--;
$filename = $filenamearr[$filenamesize];

  } 
else{ ?>
		
	<? /*	
                         
<div class="col-md-10 ">
													  <div class="form-group">
										        <input name="sfile[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $rowSolvency['link']; ?>" readonly><br>
														  
														  
														  
														  <div class="row"></div>
	
	</div></div>      
                                                       
<div class="col-md-2 ">
                             <a href="<?php  
							 echo str_replace('www.','',$rowSolvency['link']);
							 ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a> 
                                                                                                      </div>   
																									  
																									  */ ?>
		
		<div class="col-md-10 ">
													  <div class="form-group">
										        <input name="sfile[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?  echo "https://getpaycp.com/admin/visor.php?key=$fileArr2[1]"; ?>" readonly><br>
														  
														  
														  
														  <div class="row"></div>
	
	</div></div>      
                                                       
<div class="col-md-2 ">
                             <a href="<?php  
							 echo "visor.php?key=$fileArr2[1]";
							 ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a> 
                                                                                                      </div>  
                         
<?php 

} //End else

} //End while of files 

 
?>                                              </div>
                                         
                                         
                                                <h3 class="form-section"><a id="files"></a>Distribución del Pago:</h4>
                                            
<?php 

if($row['distributable'] == 1){
#$querydistribution = "select * from distribution where payment = '$_GET[id]' and preturn = '$row[preturn]'"; 
$querydistribution = "select * from distribution where payment = '$row[id]'"; 
$resultdistribution = mysqli_query($con, $querydistribution);
$numdistribution = mysqli_num_rows($resultdistribution);      

?>
<div class="row">
<div class="col-md-6 ">                                                   
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="33%">

										Unidad</th>

									<?php /*<th width="12%">

										Cuenta</th>*/ ?>

									<th width="33%">

										 Porcentaje</th>
<th width="33%">

										 Total</th>
				

								  </tr>

								</thead>

								<tbody>
                            	<?php while($rowdistribution=mysqli_fetch_array($resultdistribution)){
											
											$queryNewUnit = "select code, newCode from units where id = '$rowdistribution[unitid]'";
											$resultNewUnit = mysqli_query($con, $queryNewUnit);
											$rowNewUnit = mysqli_fetch_array($resultNewUnit);
											
											if($row['ncatalog'] == 1){
												$unitId = $rowNewUnit['newCode'];
											}else{
												$unitId = $rowNewUnit['code'];
											}
									
								?>                               
                                <tr role="row" class="odd">
                                <td><?php echo $unitId; ?></td>
                                 <?php /*<td><?php echo $rowdistribution['account']; ?></td>*/ ?>
                               <td><?php echo str_replace('.00','',$rowdistribution['percent']).'%'; ?></td>
                                <td><?php
								echo number_format($rowdistribution['total'], 2); ?></td>
                                </tr> 
                                <?php } ?>
                                </tbody></table>
                                </div>
</div>
                                <div class="row">&nbsp;</div>
<?php } else { ?>
<p>Sin distribución</p>
<?php } ?>
<? 

if($row['credit'] > 0){ 
	
	$fileArrCredit  = explode('=',$row['creditlink']);
	
	?>
<h3 class="form-section"><a id="credit"></a>Liquidación de Saldo:</h4>
<div class="row">
<div class="col-md-3 ">
<div class="form-group">
<label>Batch:</label>											
<input name="creditbath" type="text" class="form-control" id="creditbath" placeholder="" value="<?php echo $row['creditbatch']; ?>" readonly>
<div class="row"></div></div></div>

<div class="col-md-3 ">
<div class="form-group">
<label>Documento:</label>											
<input name="retention2ammountold" type="text" class="form-control" id="retention2ammountold" placeholder="Monto" value="<?php echo $row['creditdocument']; ?>" readonly>

<div class="row"></div></div></div>

<div class="col-md-6">
<div class="form-group">
<label>Link:</label>											
<input name="retention2ammountold" type="text" class="form-control" id="retention2ammountold" placeholder="Monto" value="<?php echo "visor.php?key=$fileArrCredit[1]";  ?>" readonly>
<a href="<?php echo "visor.php?key=$fileArrCredit[1]";  ?>" class="btn blue" target="_blank">
<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
<div class="row"></div></div></div> 
</div>
<? } ?>

<?php 
/*
function urlProcessor($furl,$fprocess,$fuser = null){
	switch($fprocess){
		case 1:
		//GET THE code ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('visor.php?key=','',$furl);
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$foutput = $furl;
		break;
		case 2:
		//GET THE FULL URL
		$foutput = '/admin/visor.php?key='.$furl;
		break;
		case 3:
		$fchar = urlProcessor($furl, 1);
		$foutput = "../files/folder_".$fuser."/".str_replace(' ','%20',$fchar).".pdf";
		break; 
		case 4:
		//GET THE visor ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$foutput = $furl;
		break;
	}
	
	return $foutput; 
}
*/
?>
<input type="hidden" name="cut" id="cut" value="<?php echo $rowpconfirm['cut']; ?>">