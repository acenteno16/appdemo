<?php

session_start();

if(($_SESSION["admin"] == "active") or ($_SESSION["financemanager"] == "active") or ($_SESSION['insurers_report'] == "active")){
	include("../connection.php"); 
}else{
	session_destroy();
	header("location: ../?err=noInsurersReport");  	 
}

$now = date('Y-m-d'); 

$provider = $_POST['provider'];
$from = $_POST['from'];
$to = $_POST['to'];
$route = $_POST['route'];
$company = $_POST['company'];
$groupid = $_POST['groupid']; 
$tamount = $_POST['tamount'];
$ref = $_POST['ref'];
$pk = $_POST['pk'];
$bank = $_POST['bank'];
$doc = $_POST['doc'];

$sql = "";

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
}
else{
	if(($groupid != "") or ($pk != "") or ($ref != "") or ($doc != "")){
		//Do Nothing
	}else{
		echo "<script>alert('Debe de seleccionar inicio del periodo.');history.go(-1);</script>";
		exit();
	}
	
}

$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}
else{
	if(($groupid != "") or ($pk != "") or ($ref != "") or ($doc != "")){
		//Do Nothing
	}else{
		echo "<script>alert('Debe de seleccionar fin del periodo.');history.go(-1);</script>";
		exit();
	}
}

$sql3 = "";
if($route != ""){
	$sql3 = " and payments.route = '$route'";
}

$sql4 = "";
if($company != ""){
	$sql4 = " and payments.company = '$company'";
}

$sql5 = "";
if($provider != ""){
	$sql5 = " and payments.provider = '$provider'";
}

if(($from != "") and ($to != "")){
	$fecha = date($from);
	$nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

	if($nuevafecha <= $to){ 
		echo "<script>alert('Periodo maximo de 3 meses.');history.go(-1);</script>";
		exit(); 
	}
}
$sql6 = "";
if($groupid != ""){
	$sql6 = " and schedule.id = '$groupid'";
	$join_schedule = 1;
}
$sql7 = "";
if($tamount != ""){
	$tamount_min = $tamount-10;
	$tamount_max = $tamount+10; 
	$sql7 = " and schedule.ammount >= '$tamount_min' and schedule.ammount <= '$tamount_max'";
	$join_schedule = 1;
}

$sql8 = "";
if($ref != ""){
	$sql8 = " and payments.reference = '$ref'";
}

$sql9 = "";
if($pk != ""){
	$sql9 = " and payments.cnumber = '$pk'";
}

$sql10 = "";
if($bank != ""){
	$sql10 = " and payments.bank = '$bank'";
}

$sql11 = "";
if($doc != ""){
	$sql11 = " and bills.number = '$doc'";
}

$join1 = "";
if($join_schedule == 1){
	$join1 = " inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id";
}

$join = $join1.$join2;
$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11;

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


//$objPHPExcel->getActiveSheet()->freezePane('P1');
$objPHPExcel->getActiveSheet()->freezePane('A2');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'Proveedor')
            ->setCellValue('C1', 'Compañía')
            ->setCellValue('D1', 'UN')
			->setCellValue('E1', 'Solicitante')
            ->setCellValue('F1', 'Fecha Ing. Banco')
			->setCellValue('G1', 'Fecha de Cancelacion')
			->setCellValue('H1', 'CKPK')
			->setCellValue('I1', 'Banco')
			->setCellValue('J1', 'NO. RECIBO DE PRIMA')
			->setCellValue('K1', 'Monto')
			->setCellValue('L1', 'Moneda')
			->setCellValue('M1', 'TC')
			->setCellValue('N1', 'GID')
			->setCellValue('O1', 'WID')
			->setCellValue('P1', 'Provisionador');


$thisRequester = array();
$xlsRow = 2;

$query = "select payments.company, payments.id, payments.route, payments.provider, bills.number, bills.ammount, bills.stotal2, bills.exempt2, bills.exempt, bills.ret1a, bills.ret2a, bills.currency, payments.cnumber, bills.tc, bills.tax, bills.ret1, bills.ret2, payments.reference, payments.userid, schedulecontent.schedule from bills inner join payments on bills.payment = payments.id inner join times on times.payment = bills.payment inner join schedulecontent on payments.id = schedulecontent.payment".$join." where times.stage = '14'".$sql.' order by schedulecontent.schedule'; 
$result = mysqli_query($con, $query);
$inc = 0;
$inc2 = 0;
$num = mysqli_num_rows($result);	
while($row=mysqli_fetch_array($result)){


	if($thisRequester[$row['userid']] == ''){
		$queryrequester = "select code, first, last from workers where code = '$row[userid]'";
		$resultrequester = mysqli_query($con, $queryrequester);
		$rowrequester = mysqli_fetch_array($resultrequester);
		$requester = $rowrequester['code']." | ".$rowrequester['first']." ".$rowrequester['last'];
		
		$thisRequester[$row['userid']] = $requester;
	}
	
	$queryprovisioner = "select code, workers.first, workers.last from workers inner join times on workers.code = times.userid where times.stage = '8.00' and times.payment = '$row[id]' order by times.id desc limit 1";
	$resultprovisioner = mysqli_query($con, $queryprovisioner);
	$rowprovisioner = mysqli_fetch_array($resultprovisioner);
	$provisioner = $rowprovisioner['code']." | ".$rowprovisioner['first']." ".$rowprovisioner['last'];
	

	if($incrementator == 0){
		$current_id = $row[1];	
		$incrementator = 1; 
	}		
			
	if(($current_id != $row[1])){
	
		$querynotes = "select * from notes where payment = '$current_id'";
		$resultnotes = mysqli_query($con, $querynotes);
		$numnotes = mysqli_num_rows($resultnotes);
		
		
		$notes_total = 0;		
		if($numnotes > 0){
			
			
			while($rownotes=mysqli_fetch_array($resultnotes)){
			
			$note_date = date('d-m-Y', strtotime($rownotes['today']));
		 		
			$xlsRow++;
				
			$objPHPExcel->setActiveSheetIndex(0)
			//IDS 
			->setCellValue('A'.$xlsRow, $current_id)
			//IDS 
			->setCellValue('B'.$xlsRow, $provider)
			//Company
			->setCellValue('C'.$xlsRow, $company)
			//UN
			->setCellValue('D'.$xlsRow, $row[2])
			//Fecha TEXTO
			->setCellValue('F'.$xlsRow, "Fecha Nota:")
			//Fecha Nota
			->setCellValue('G'.$xlsRow, $note_date)
			//No Documento
			->setCellValue('J'.$xlsRow, $rownotes['number'])
			//Monto
			->setCellValue('K'.$xlsRow, $rownotes['ammount'])
			//Moneda
			->setCellValue('M'.$xlsRow, $currencyname)
			//TC
			//->setCellValue('K'.$xlsRow, $row[13])
			//IS A NOTE
			->setCellValue('P'.$xlsRow, 'NOTA')
			//IS A NOTE
			->setCellValue('Q'.$xlsRow, $rownotes['reason']); 
			
			$objPHPExcel->getActiveSheet()
    		->getStyle('K'.$xlsRow)
    		->getNumberFormat()
    		->setFormatCode('$#,##0.00');
			
			$objPHPExcel->getActiveSheet()->getStyle('K'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			
			$notes_total+= $rownotes['ammount'];
		
			}
		}
					
		$current_id = $row[1];
	}
	
	//Banco
	$querybank = "select today from times where payment = '$row[1]' and stage = '13.00'";
  	$resultbank = mysqli_query($con, $querybank);
  	$rowbank = mysqli_fetch_array($resultbank);
  	$today_bank = $rowbank['today'];
	$today_bank = date('d-m-Y', strtotime($today_bank));
	
	//Fecha de Cancelacion
	$querycancellation = "select today from times where payment = '$row[1]' and stage = '14.00'";
  	$resultcancellation = mysqli_query($con, $querycancellation);
  	$rowcancellation = mysqli_fetch_array($resultcancellation);
  	$today_cancellation = $rowcancellation['today'];
	$today_cancellation = date('d-m-Y', strtotime($today_cancellation));
	
	//Proveedor
	$query_provider = "select code, name from providers where id = '$row[provider]'";
	$result_provider = mysqli_query($con, $query_provider);
	$row_provider = mysqli_fetch_array($result_provider);
	$provider = $row_provider['code']." | ".$row_provider['name']; 
	
	//Compañía
	$rowcompany = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row[0]'"));
	$company = $rowcompany['name']; 
	
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where id = '$row[3]'"));
	$ben_code = $rowprovider['code'];
	$ben_name = $rowprovider['name'];
	
	//Moneda
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select name from currency where id = '$row[11]'"));
	$currencyname = $rowcurrency['name'];
	
	//The Bank
	$query_thebank = "select banks.name from banks inner join schedule on schedule.bank = banks.id where schedule.id = '$row[19]'";
	$result_thebank = mysqli_query($con, $query_thebank);
	$row_thebank = mysqli_fetch_array($result_thebank);
	$the_bankname = $row_thebank['name'];
	
	$webid_title = "Subtotal GID ".$webid;
	
	if($inc > 0){
		$xlsRow++;
	}
	$inc++;
	
	if((($webid != "") and ($webid != $row[19]))){
		 
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('J'.$xlsRow, $webid_title)
				->setCellValue('K'.$xlsRow, $webid_total-$notes_total); 
				$objPHPExcel->getActiveSheet()->getStyle('K'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		
		$webid_total = 0;
		$xlsRow++;
		
	}
		
	$webid_total+= $row[5];
	if($row[19] != "Array"){
		$webid = $row[19]; 
	}else{
		$webid = "";
	}
	
	
	if($row[17] != "Array"){
		$webid2 = $row[17]; 
	}else{
		$webid2 = "";
	}
		
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				//IDS 
				->setCellValue('A'.$xlsRow, $row[1])
				//IDS 
				->setCellValue('B'.$xlsRow, $provider)
				//Company
				->setCellValue('C'.$xlsRow, $company)
				//UN
				->setCellValue('D'.$xlsRow, $row[2])
				//Requester
				->setCellValue('E'.$xlsRow, $requester)
				//Fecha INGRESO A BANCO
				->setCellValue('F'.$xlsRow, $today_bank)
				//Fecha CANCELACION
				->setCellValue('G'.$xlsRow, $today_cancellation)
				//CKPK 
				->setCellValue('H'.$xlsRow, $row[12])
				//Bank Name
				->setCellValue('I'.$xlsRow, $the_bankname)
				//No Documento
				->setCellValue('J'.$xlsRow, $row[4])
				//Monto
				->setCellValue('K'.$xlsRow, $row[5])
				
				//Moneda
				->setCellValue('L'.$xlsRow, $currencyname)
				//TC
				->setCellValue('M'.$xlsRow, $row[13])
				//Exento IMI
				->setCellValue('N'.$xlsRow, $webid)
				//Exento IMI
				->setCellValue('O'.$xlsRow, $webid2)
				//Exento IMI
				->setCellValue('P'.$xlsRow, $provisioner);
				
				$objPHPExcel->getActiveSheet()->getStyle('K'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				
				
				
				if($num == $inc){
					$xlsRow++;
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('J'.$xlsRow, $webid_title)
						->setCellValue('K'.$xlsRow, $webid_total-$notes_total); 
						
						$objPHPExcel->getActiveSheet()->getStyle('K'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		
					$webid_total = 0;
		
		
	}
		
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-pagos-a-proveedores.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
