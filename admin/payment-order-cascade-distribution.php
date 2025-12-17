<? 

include("session-request.php"); 

$id  = $_GET['id'];

$destino = "paymentstemplates/".$id."/".$id.".xls"; 

if(file_exists($destino)){ 
	require_once('classes/PHPExcel.php');
	require_once('classes/PHPExcel/Reader/Excel2007.php');
	// Cargando la hoja de cálculo
    $objReader = new PHPExcel_Reader_Excel2007();
    $objPHPExcel = $objReader->load($destino);
    $objFecha = new PHPExcel_Shared_Date();
    // Asignar hoja de excel activa
    $objPHPExcel->setActiveSheetIndex(0);
	$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
	
	for($i=2;$i<=$lastRow;$i++){
	
		$code = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
		$ammount = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
		$type = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
		$unit = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue();
		
		if(($type == "C") or ($type == "c")){
			$unit_arr[] = $unit;
			$ammount_arr[$unit]+= $ammount; 
			$users_arr[$unit].= $code.',';  
		}
		if(($type == "D") or ($type == "d")){
			$ammount_debit+= $ammount;
		}
		
	}
	//End for
	
	$unit_unique = array_unique($unit_arr);
	
	foreach($unit_unique as $aa){
	
		$percent = $ammount_arr[$aa]*100/$ammount_debit;
		$percent = number_format($percent,2);
		$percent_total+=$percent;
		$this_ammount = number_format($ammount_arr[$aa],2);
		echo '<br>'.$query_distribution = "insert into distribution (payment, unit, percent, total, ddelete) values ('$id', '$aa', '$this_percent', '$this_ammount', '0')";
		//$result_distribution = mysqli_query($con, $query_distribution);
		$num_dis++;
		
	}
	
	echo '<br>Total: '.$percent_total;
	echo '<br>Num dis: '.$num_dis;
	

}
//End if

?>