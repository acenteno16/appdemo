<? 

#echo 'Btype: '.$row['btype'];

if(($row['parent'] == 1) or ($row['child'] > 0)){ 

if($row['btype'] == 2){


}
elseif($row['btype'] == 3){
 
$destino = "paymentstemplates/".$row['id']."/".$row['id'].'.xls';  
	
if(file_exists($destino)){ 
	
	
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
	// Cargando la hoja de cálculo
    $objReader = new PHPExcel_Reader_Excel2007();
    $objPHPExcel = $objReader->load($destino);
    $objFecha = new PHPExcel_Shared_Date();
    // Asignar hoja de excel activa
    $objPHPExcel->setActiveSheetIndex(0);
	$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
	
           


?>
											<h3 class="form-section">Información de Pago Multiple</h3>
											
											<div class="row">
											<div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción General: </label>
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
   
    <th width="30%">IDS</th>
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
		
		

if($type_parentchild != ''){				
?>							

	<tr role="row" class="odd <? echo $class_parentchild; ?>">
                                
    <td class="sorting_1"><? 
	
	if(($type_parentchild == "C") or ($type == "c")){
	if($row['child'] != 0){
		$query_ids = "select payments.id from payments inner join interns on payments.intern = interns.code where payments.child = '$row[child]' and interns.code = '$code_parentchild'";
		$result_ids = mysqli_query($con, $query_ids);
		$num_ids = mysqli_num_rows($result_ids);
		if($num_ids > 0){
			$row_ids = mysqli_fetch_array($result_ids);
			$id_ids = $row_ids['id'];
		}else{
			$id_ids = $row['child'];
		}
		
		echo '<a href="approve-view-interns.php?id='.$id_ids.'">'.$id_ids.'</a>';

	}
	
	else{
		$query_ids = "select payments.id from payments inner join interns on payments.intern = interns.code where payments.child = '$row[id]' and interns.code = '$code_parentchild'";
		$result_ids = mysqli_query($con, $query_ids);
		$num_ids = mysqli_num_rows($result_ids);
		if($num_ids > 0){
			$row_ids = mysqli_fetch_array($result_ids);
			$id_ids = $row_ids['id'];
		}else{
			$id_ids = $row[0];
		}
		
		echo '<a href="approve-view-interns.php?id='.$id_ids.'">'.$id_ids.'</a>';
	}
	}
	
	
	
	?></td> 	
    <td><? echo $code_parentchild; ?></td>
    <td><? echo $company_parentchild; ?></td>
    <td><? echo $phone_parentchild; ?></td>
    <td><? echo $nid_parentchild; ?></td>
    <td><? echo $first_parentchild; ?></td>
    <td><? echo $first2_parentchild; ?></td>
    <td><? echo $last_parentchild; ?></td>
    <td><? echo $last2_parentchild; ?></td>
    <td><? echo $concept_parentchild; ?></td>
    <td><? echo str_replace('.00','',number_format($ammount_parentchild,2)); ?></td>
    <td><? echo $type_parentchild; ?></td>
    <td><? echo $account_parentchild; ?></td>
    <td><? echo $un; ?></td> 
    </tr>
                                                            
<?php 
$inc_ammount_parentchild+=$ammount_parentchild;
} } ?>  
                                
	</tbody> 

	</table>
											</div>
											</div>
											</div>
											
											<? } ?>

<? } 

}?>