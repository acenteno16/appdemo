<?php

session_start();
if(($_SESSION['refund_report'] == "active") or ($_SESSION['admin'] == 'active')){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noRefundReport");  	 
}

#require 'functions.php';

$now = date('Y-m-d'); 

$client = $_POST['client'];
$from = $_POST['from'];
$to = $_POST['to'];
$route = $_POST['route'];
$company = $_POST['company'];
$stage = $_POST['stage'];
$status = $_POST['status'];

$sql = "";

$sql1 = "";
if($from != ""){
	if($stage != 0){
		$from = date("Y-m-d", strtotime($from));
		$sql1 = " and times.stage = '$stage' and times.today >= '$from'";
		$param++;
	}else{
		
		$from = date("Y-m-d", strtotime($from));
		$sql1 = " and ((times.stage = '2' and times.today >= '$from') or (times.stage = '14' and times.today >= '$from'))";
		$param++;
		
		#echo "<script>alert('Debe de seleccionar el estado del rango.');history.go(-1);</script>";
		#exit();
	}
	
}else{
	if(($client != "")){
		//Do Nothing
	}else{
		echo "<script>alert('Debe de seleccionar inicio del periodo.');history.go(-1);</script>";
		exit();
	}	
}

$sql2 = "";
if($to != ""){
	if($stage != 0){
		$to = date("Y-m-d", strtotime($to));
		$sql2 = " and times.stage = '$stage' and times.today <= '$to'";
		$param++;
	}else{
		
		$to = date("Y-m-d", strtotime($to));
		$sql2 = " and ((times.stage = '2' and times.today <= '$to') or (times.stage = '14' and times.today <= '$to'))";
		$param++; 
		
		#echo "<script>alert('Debe de seleccionar el estado del rango.');history.go(-1);</script>";
		#exit();
	}
}else{
	if(($client != "")){
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
if($client != ""){
	$sql5 = " and payments.client = '$client'";
}

$fecha = date($from);
$nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

if($nuevafecha <= $to){ 
	//echo "<script>alert('Periodo maximo de 3 meses.');history.go(-1);</script>";
	//exit();
}

$sql6 = "";
if($status > 0){
	if($status == 1){
		$sql6 = " and payments.status = '14'";
	}elseif($status == 2){
		$sql6 = " and payments.status < '14'";
	}
}

$join = $join1.$join2;
$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6;

$query = "select payments.id, payments.client, payments.company, payments.userid, payments.ammount, payments.currency, payments.routeid from payments inner join times on times.payment = payments.id ".$join." where payments.status > '0' and payments.approved != '2' and payments.type = '4'".$sql." group by payments.id order by payments.id";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

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
			->setCellValue('B1', 'Tipo Cliente')
			->setCellValue('C1', 'Cliente')
            ->setCellValue('D1', 'Compañía')
            ->setCellValue('E1', 'UN')
			->setCellValue('F1', 'Linea')
			->setCellValue('G1', 'Solicitante')
			->setCellValue('H1', 'Tipo')
			->setCellValue('I1', 'Fecha Solicitud')
            ->setCellValue('J1', 'Fecha Ing. Banco')
			->setCellValue('K1', 'Fecha de Cancelación')
			->setCellValue('L1', 'Monto')
			->setCellValue('M1', 'Moneda')
			->setCellValue('N1', 'Estado');  

$xlsRow = 2;
$globalThisUnit = array();
while($row=mysqli_fetch_array($result)){ 

	$queryrequester = "select * from workers where code = '$row[userid]'";
	$resultrequester = mysqli_query($con, $queryrequester);
	$rowrequester = mysqli_fetch_array($resultrequester);
	$requester = $rowrequester['code']." | ".$rowrequester['first']." ".$rowrequester['last'];
	
	//Banco
	$querybank = "select today from times where payment = '$row[0]' and stage = '13.00'";
  	$resultbank = mysqli_query($con, $querybank);
	$numbank = mysqli_num_rows($resultbank);
	if($numbank > 0){
		$rowbank = mysqli_fetch_array($resultbank);
  		$today_bank = $rowbank['today'];
		$today_bank = date('d-m-Y', strtotime($today_bank));
	}
	else{
		$today_bank = "NA";
	}
  	
	
	//Fecha de Solicitud
	$queryrequest = "select today from times where payment = '$row[0]' and stage = '1.00'";
  	$resultrequest = mysqli_query($con, $queryrequest);
	$numrequest = mysqli_num_rows($resultrequest);
	if($numrequest > 0){
		$rowrequest = mysqli_fetch_array($resultrequest);
  		$today_request = $rowrequest['today'];
		$today_request = date('d-m-Y', strtotime($today_request));
	}
	else{
		$today_request = "NA";
	}
  	
	
	//Fecha de Cancelación
	$querycancellation = "select today from times where payment = '$row[0]' and stage = '14.00'";
  	$resultcancellation = mysqli_query($con, $querycancellation);
  	$numcancellation = mysqli_num_rows($resultcancellation);
	if($numcancellation > 0){
		$rowcancellation = mysqli_fetch_array($resultcancellation);
  		$today_cancellation = $rowcancellation['today'];
		$today_cancellation = date('d-m-Y', strtotime($today_cancellation));
	}
	else{
		$today_cancellation = "NA";
	}
	
	
	//Client
	$query_client = "select code, name, first, last, type from clients where code = '$row[client]'";
	$result_client = mysqli_query($con, $query_client);
	$row_client = mysqli_fetch_array($result_client); 
	$client_name = "";
	if($row_client['type'] == 1){ 
		$client_type = "Natural";
		$client_name = $row_client['code']." | ".$row_client['first'];
	}
	else{
		$client_type = "Juridica";
		$client_name = $row_client['code']." | ".$row_client['name'];
	}
	
	//Compañía
	$rowcompany = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row[2]'"));
	$company = $rowcompany['name']; 

	//Moneda
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select name from currency where id = '$row[5]'"));
	$currencyname = $rowcurrency['name'];
	
	//Dev Type
	$rowdev = mysqli_fetch_array(mysqli_query($con, "select devtype, bline from clientsrefund where payment = '$row[0]'"));
	$dev_type = "";
	switch($rowdev['devtype']){
		case 1:
		$dev_type = "Primas";
		break;
		case 2:
		$dev_type = "Reservas";
		break;
		case 3:
		$dev_type = "Excedentes";
		break;
		case 4:
		$dev_type = "Seguros";
		break;
		case 5:
		$dev_type = "Productos";
		break;
	}
	
	
	$querystatus = "select stage from times where payment = '$row[0]' order by id desc limit 1";
	$resultstatus = mysqli_query($con, $querystatus);
	$rowstatus = mysqli_fetch_array($resultstatus);
	
	$querystatusname = "select name from stages where id = '$rowstatus[0]'";
	$resultstatusname = mysqli_query($con, $querystatusname);
	$rowstatusname = mysqli_fetch_array($resultstatusname);
	
	$the_line = "NA";
	$querybline = "select name from blines where id = '$rowdev[bline]'";
	$resultbline = mysqli_query($con, $querybline);
	$rowbline = mysqli_fetch_array($resultbline);
	$the_line = $rowbline['name'];
	
	if($globalThisUnit[$row['routeid']] == ''){
		$queryThisUnit = "select * from units where id = $row[routeid]";
		$resultThisUnit = mysqli_query($con, $queryThisUnit);
		$rowThisUnit=mysqli_fetch_array($resultThisUnit);
		$globalThisUnit[$rowThisUnit['id']] = $rowThisUnit['newcode'];
		
	}
	
	$the_status = $rowstatusname['name'];
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				//IDS 
				->setCellValue('A'.$xlsRow, $row[0]) //ok
				//Client type
				->setCellValue('B'.$xlsRow, $client_type)
				//Client Code and Name 
				->setCellValue('C'.$xlsRow, $client_name) //ok
				//Company
				->setCellValue('D'.$xlsRow, $company) //ok
				//UN
				->setCellValue('E'.$xlsRow, $globalThisUnit[$row['routeid']]) //ok
				//LINEA
				->setCellValue('F'.$xlsRow, $the_line) //ok
				//Requester
				->setCellValue('G'.$xlsRow, $requester) //ok
				//Requester
				->setCellValue('H'.$xlsRow, $dev_type) //ok
				//Fecha INGRESO A BANCO
				->setCellValue('I'.$xlsRow, $today_request) //ok
				//Fecha CANCELACION
				->setCellValue('J'.$xlsRow, $today_bank) //ok
				//CKPK 
				->setCellValue('K'.$xlsRow, $today_cancellation) //ok
				//No Documento
				->setCellValue('L'.$xlsRow, $row['ammount'])
				//Monto
				->setCellValue('M'.$xlsRow, $currencyname)
				//Estado
				->setCellValue('N'.$xlsRow, $the_status);
				
				$objPHPExcel->getActiveSheet()->getStyle('L'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				
				$xlsRow++;
				
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-devoluciones.xlsx"');
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