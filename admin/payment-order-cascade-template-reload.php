<?

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
exit();
require('session-request.php'); 
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$query_payments = $con->prepare("select type from payments where id = ?");
$query_payments->bind_param("i", $id);
$query_payments->execute();
$result_payments = $query_payments->get_result();
$row_payments = $result_payments->fetch_assoc();


$destino = "paymentstemplates/".$id."/".$id.".xls"; 


if(file_exists($destino)){ 
	
           
?>	
 			
	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

	<thead>

	<tr role="row" class="heading">
   
    <th width="30%">Código</th>
    <th width="30%">Empresa</th>
    <th width="25%">ID_Billetera</th>
    <th width="13%">Num_ID (cedula)</th>
    <th width="13%">1er Nombre</th>
    <th width="13%">2do Nombre</th>
    <th width="13%">1er Apellido</th>
    <th width="13%">2do Apellido</th>
    <th width="13%">Concepto</th>
    <th width="13%">Monto</th>
    <th width="13%">TIPO</th>
    <th width="13%">NUM_CTA_DEBITO</th>
    <th width="30%">ESTADO</th>
    <th width="30%">BENEFICIARIO</th>
    <th width="30%">Unidad</th>
	
	</tr>

	</thead>

	<tbody>

<?php  
	
	
	try {
		$spreadsheet = IOFactory::load($filePath);
		$sheet = $spreadsheet->getActiveSheet();
		$lastRow = $sheet->getHighestRow();
	} 
	catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    	die('Error al cargar el archivo Excel: ' . $e->getMessage());
	}
		
		
	$interns_add = 0;
	$interns_okay = 0;
	$interns_err = 0;						
	
	$workers = 0;
	$count_workers = 0;
	$count_interns = 0;
	
	
	//Check
	for($i=2;$i<=$lastRow;$i++){
	
		
		$code = $sheet->getCell('A' . $i)->getCalculatedValue();
		$company = $sheet->getCell('B' . $i)->getCalculatedValue();
		$phone = $sheet->getCell('C' . $i)->getCalculatedValue();
		$phone = str_replace(' ', '', $phone); // Eliminar espacios en el número de teléfono
		$nid = $sheet->getCell('D' . $i)->getCalculatedValue();
		$first = $sheet->getCell('E' . $i)->getCalculatedValue();
		$first2 = $sheet->getCell('F' . $i)->getCalculatedValue();
		$last = $sheet->getCell('G' . $i)->getCalculatedValue();
		$last2 = $sheet->getCell('H' . $i)->getCalculatedValue();
		$concept = $sheet->getCell('I' . $i)->getCalculatedValue();
		$ammount = $sheet->getCell('J' . $i)->getCalculatedValue();
		$type = $sheet->getCell('K' . $i)->getCalculatedValue();
		$account = $sheet->getCell('L' . $i)->getCalculatedValue();
		$blank = $sheet->getCell('O' . $i)->getCalculatedValue();
		$unit = $sheet->getCell('M' . $i)->getCalculatedValue();
		
		if(($type == "C") or ($type == 'c') or ($type == "D") or ($type == "d")){
			//Do Nothing
		}
		else{
			$err_str.= "La Columna K solo puede contener 'C'  o 'D'/ ";
			$err++;
		}
		
		$check_nid = str_replace(' ','',$nid);
		$check_nid = str_replace('-','',$check_nid);
		if(strlen($check_nid) != 14){
			$err_str.= "No se reconoce el campo Cédula/ ";
			$err++;
		}
			
		$check_phone = str_replace(' ','',$phone);
		$check_phone = str_replace('-','',$check_phone);
		if(strlen($check_phone) != 8){
			$err_str.= "Telefono debe de ser de 8 digitos/ ";
			$err++;
		}
			
		if($blank != ""){
			$err_str.= "Ultima Columna debe ser la columna N/ ";
			$err++;
		}
		
	}
	
	//Write
	for($i=2;$i<=$lastRow;$i++){ 
	
		$code = $sheet->getCell('A' . $i)->getCalculatedValue();
		$company = $sheet->getCell('B' . $i)->getCalculatedValue();
		$phone = $sheet->getCell('C' . $i)->getCalculatedValue();
		$phone = str_replace(' ', '', $phone); // Eliminar espacios en el número de teléfono
		$nid = $sheet->getCell('D' . $i)->getCalculatedValue();
		$first = $sheet->getCell('E' . $i)->getCalculatedValue();
		$first2 = $sheet->getCell('F' . $i)->getCalculatedValue();
		$last = $sheet->getCell('G' . $i)->getCalculatedValue();
		$last2 = $sheet->getCell('H' . $i)->getCalculatedValue();
		$concept = $sheet->getCell('I' . $i)->getCalculatedValue();
		$ammount = $sheet->getCell('J' . $i)->getCalculatedValue();
		$type = $sheet->getCell('K' . $i)->getCalculatedValue();
		$account = $sheet->getCell('L' . $i)->getCalculatedValue();
		$blank = $sheet->getCell('O' . $i)->getCalculatedValue();
		$unit = $sheet->getCell('M' . $i)->getCalculatedValue();
		
		$color = "";
		$template_err_status = 0;
		
		if(($type == "C") or ($type == "c")){
			$credit+= $ammount;
			
			$is_intern = 1;
			if(isWorker($code, $con) == true){
				
				$is_intern = 0;
				if(isIntern($code, $con) == true){
					$is_intern = 1;
				}
			}
			
			if($is_intern == 1){
				
				$count_interns++;
				$bentype = "Pasante";
				$bentype_int = 3;
				$queryinterns = "select * from interns where code = '$code'";
				$resultinterns = mysqli_query($con, $queryinterns);
				$numinterns = mysqli_num_rows($resultinterns);
				if($numinterns == 0){
					$color = "active";
			
					if($code != ""){
						$queryinsert = "insert into interns (code, first, first2, last, last2, company, phone, nid) values ('$code', '$first', '$first2', '$last', '$last2', '$company', '$phone', '$nid')";
						$resultinsert = mysqli_query($con, $queryinsert);
						$interns_add++;
						$status = "Agregado";
					}
			
				}	
				else{
			
					$rowinterns = mysqli_fetch_array($resultinterns);
					$err_str = "";
					$err = 0;
			
					if(str_replace(' ','',$rowinterns['phone']) != str_replace(' ','',$phone)){
						//$err_str.= "Billetera Móvil (Teléfono)/ ";
						//$err++;
					}
					if($rowinterns['nid'] != $nid){
						$err_str.= "Cédula/ ";
						$err++;
					}
					if($rowinterns['first'] != $first){
						$err_str.= "Primer nombre/ ";
						$err++;
					}
					if($rowinterns['first2'] != $first2){
						$err_str.= "Segundo nombre/ ";
						$err++;
					}
					if($rowinterns['last'] != $last){
						$err_str.= "Primer apellido/ ";
						$err++;
					}
					if($rowinterns['last2'] != $last2){
						$err_str.= "Segundo apellido/ ";
						$err++;
					}	
			
					if($err > 0){
						$color = "danger";
						$status = "Error /".$err_str;
						$interns_err++;
						$template_err_status = 1; 
				
					}else{
						$color = "success";
						$status = "Reconocido";
						$interns_okay++;
					}
		
				} 
			
			}
			else{
				$is_worker = 1;
				$bentype_int = 2;
				$count_workers++; 
				$query_check = "select code, first, last from workers where code = '$code'";
				$result_check = mysqli_query($con, $query_check);
				$row_check = mysqli_fetch_array($result_check); 
				$str_collaborators.=  $row_check['code']." | ".$row_check['first']." ".$row_check['last'].", ";
			}
		}
		
		elseif(($type == 'D') or ($type == 'd')){
			$debit+= $ammount;
		}
		
				
?>							

	<tr role="row" class="odd <? if(($type == "C") or ($type == "c")) echo $color; if(($row_payments['type'] == 2) and ($is_worker == 1)) echo " danger"; if(($row_payments['type'] == 5) and ($is_intern == 1)) echo " danger"; ?>">
                                
    <td class="sorting_1"><? echo $code; ?></td>
    <td><? echo $company; ?></td>
    <td><? echo $phone; ?></td>
    <td><? echo $nid; ?></td>
    <td><? echo $first; ?></td>
    <td><? echo $first2; ?></td>
    <td><? echo $last; ?></td>
    <td><? echo $last2; ?></td>
    <td><? echo $concept; ?></td>
    <td><? echo str_replace('.00','',number_format($ammount,2)); ?></td>
    <td><? echo $type; ?></td>
    <td><? echo $account; ?></td>
    <td><? if(($type == "C") or ($type == "c")) echo $status; ?></td>
    <td><? if(($type == "C") or ($type == "c")) echo $bentype; ?></td> 
    <td><? if(($type == "C") or ($type == "c")) echo $unit; ?></td> 
    </tr>
                                                            
<?php 
$inc_ammount+=$ammount; 

} ?>  
                                
	</tbody> 

	</table>
	
<?	if(($count_interns > 0) and ($count_workers > 0)){
		$template_errors++;
		$template_errors_str.="Colaboradores y Pasantes Mezclados";
	}
	if(($row_payments['type'] == 2) and ($count_workers > 0)){
		$template_errors++;
		$template_errors_str.="Se reconocieron Colaboradores.";
	}
	if(($row_payments['type'] == 5) and ($count_interns > 0)){
		$template_errors++;
		$template_errors_str.="No se reconocen Colaboradores."; 
	}
	
	
	echo $str_collaborators;
	?>
	<p>
	<? if($row_payments['type'] == 2){ ?>
	<strong>Pasantes agregados:</strong> <? echo $interns_add; ?> <i class="fa fa-check-square-o"></i><br>
	<strong>Pasantes reconocidos:</strong> <? echo $interns_okay; ?> <i class="fa fa-check-square-o"></i><br>
	<strong>Pasantes con error:</strong> <? echo $interns_err; if($interns_err == 0) echo ' <i class="fa fa-check-square-o"></i>'; ?>
	<? } ?> 
	<br>
	<strong>Colaboradores Reconocidos:</strong> <? echo $count_workers; ?> <i class="fa fa-check-square-o"></i> <br>
	<strong>Diferencia:</strong> <? $dif = $credit-$debit; if($dif == 0){ echo 'Sin diferencia <i class="fa fa-check-square-o"></i>'; }else{ $template_errors++; $template_errors_str.= "Se encontró una diferencia entre el crédito y el débito."; echo $dif.' <i class="fa fa-minus-square-o"></i>'; $template_err_status = 1; } ?>
	
	<br><strong>Errores en plantilla:</strong> <? if($template_errors_str == ""){ echo "0"; }else{ echo $template_errors_str; } 
	if($template_errors == 0) echo ' <i class="fa fa-check-square-o"></i>'; ?> <br>
	</p>	
	
<input type="hidden" name="template_isset" id="template_isset" value="1">
<input type="hidden" name="template_err" id="template_err" value="<? echo $template_err_status; ?>">
<input type="hidden" name="template_id" id="template_id" value="<? echo $row['id']; ?>">
<input type="hidden" name="template_stotal" id="template_stotal" value="<? echo $credit; ?>">
<input type="hidden" name="template_total" id="template_total" value="<? echo $credit; ?>">
<input type="hidden" name="template_ben_int" id="template_ben_int" value="<? echo $bentype_int; ?>">														
<? }else{ ?>

<p>No cargó el arvhivo.</p>

<? } ?>

<? 

function isIntern($code, $con){
	$queryinterns = "select id from interns where code = '$code'";
	$resultinterns = mysqli_query($con, $queryinterns);
	$numinterns = mysqli_num_rows($resultinterns);
	if($numinterns > 0){
		return true;
	}else{
		return false;
	}
}

function isWorker($code, $con){
	$queryworkers = "select id from workers where code = '$code'";
	$resultworkers = mysqli_query($con, $queryworkers);
	$numworkers = mysqli_num_rows($resultworkers);
	if($numworkers > 0){
		return true;
	}else{
		return false;
	}
}

?>