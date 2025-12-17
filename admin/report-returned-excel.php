<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

session_start();

if(($_SESSION['payments_report'] == 'active') or ($_SESSION["globaltimes_report"] == "active") or ($_SESSION['admin'] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=no_payments_report");	
}

$now = date('Y-m-d'); 

$provider = $_POST['provider'];
$worker = $_POST['worker'];
$request = $_POST['request'];
$userid = $_POST['userid'];

$from = $_POST['from'];
$to = $_POST['to'];
$route = $_POST['route'];
$company = $_POST['company'];


$sql = "";

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from)); 
	$sql1 = " and times.today >= '$from'";
	$param++;
}else{
	echo "<script>alert('Debe de seleccionar inicio del periodo.');history.go(-1);</script>";
	exit();
}

$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}else{
	echo "<script>alert('Debe de seleccionar fin del periodo.');history.go(-1);</script>";
	exit();
}

$fecha = date($from);
$nuevafecha = strtotime ( '+17 month' , strtotime ( $fecha ) ) ; 
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

if($nuevafecha <= $to){ 
	echo "<script>alert('Periodo maximo de 17 meses.');history.go(-1);</script>";
	exit();
}

$sql3 = "";
if($route != ""){
	$sql3 = " and payments.route = '$route'";
	$param++;
}
$sql4 = "";
if($company != ""){
	$sql4 = " and payments.company = '$company'";
	$param++;
}
$sql5 = "";
if($provider != ""){
	$sql5 = " and payments.provider = '$provider'";
}
$sql6 = "";
if($worker != ""){
	$sql6 = " and payments.collaborator = '$worker'";
}
$sql7 = "";
if($request != ""){
	$sql7 = " and payments.userid = '$request'";
}
$sql8 = "";
if($userid != ""){
	$sql8 = " and times.userid = '$userid'"; 
}

$thisStage = array();
$sql_reject = "";
$query_reject = "select id, name from stages where name2 = 'Regresado'";
$result_reject = mysqli_query($con, $query_reject);
$num_reject = mysqli_num_rows($result_reject);
$i_reject = 1;
while($row_reject=mysqli_fetch_array($result_reject)){
	$thisStage[$row_reject['id']] = $row_reject['name'];
	if($i_reject == 1){
		$sql_reject.= " and ((times.stage = '$row_reject[id]')";
	}else{
		$sql_reject.= " or (times.stage = '$row_reject[id]')";
	}
	if($i_reject == $num_reject){
		$sql_reject.= ")";
	}
	$i_reject++;
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8;
$query = "select select payments.id, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.userid as requester, payments.payment, payments.currency, payments.route, payments.company, times.reason, times.userid as nullifier, times.today as ttoday, times.comment as tcomment, times.stage, times.reason, times.reason2 from times inner join payments on times.payment = payments.id where payments.id > '0'".$sql.$sql_reject.' order by times.today desc';
$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.userid as requester, payments.payment, payments.currency, payments.route, payments.company, times.reason, times.userid as nullifier, times.today as ttoday, times.now2 as ttotime, times.comment as tcomment, times.stage, times.reason, times.reason2 from payments inner join times on payments.id = times.payment where payments.id > '0'".$sql.$sql_reject.' order by times.id desc';
$result = mysqli_query($con, $query);

require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID Solicitud')
            ->setCellValue('B1', 'Solicitante')
            ->setCellValue('C1', 'Compañía')
            ->setCellValue('D1', 'UN')
			->setCellValue('E1', 'Beneficiario')
			->setCellValue('F1', 'Tipo')
			->setCellValue('G1', 'Giro')
			->setCellValue('H1', 'Nac/Internac')
			->setCellValue('I1', 'Monto')
			->setCellValue('J1', 'Moneda')
			->setCellValue('K1', 'Regresado por')
			->setCellValue('L1', 'Etapa')
			->setCellValue('M1', 'Motivo')
			->setCellValue('N1', 'Comentarios')
			->setCellValue('O1', 'Fecha')
			->setCellValue('P1', 'Hora');  


$thisCurrency = array(); 
$queryCurrency = "select id, name from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){ 
	$thisCurrency[$rowCurrency['id']] = $rowCurrency['name'];
}
$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany = mysqli_fetch_array($resultCompany)){	
	$thisCompany[$rowCompany['id']] = $rowCompany['name'];
} 

$xlsRow = 2; 
while($row=mysqli_fetch_array($result)){ 
	
	$rowuser= mysqli_fetch_array(mysqli_query($con, "select id, code, first, last from workers where code = '$row[requester]'"));
	$rowuser2 = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where code = '$row[nullifier]'"));

	$beneficiaryType = '';
	$beneficiaryCourse = 'na';
	$beneficiaryInt = 'na';
	if($row['btype'] == 1){ 
		$beneficiaryType = 'Proveedor';
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, name, course, international from providers where id = '$row[provider]'"));
		$beneficiary = $rowprovider['code']." | ".$rowprovider['name'];
		$beneficiaryCourse = $rowprovider['course'];
		if($rowprovider['international'] == 0){
			$int = 'Nacional';
		}else{
			$int = 'Internacional';
		}
		$beneficiaryInt = $int; 
	}
	elseif($row['btype'] == 2){
		$beneficiaryType = 'Colaborador';
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where id = '$row[collaborator]'"));
		$beneficiary = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
	elseif($row['btype'] == 3){
			$beneficiaryType = 'Pasante';
			$queryBen = "select * from interns where code = '$row[intern]'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			$beneficiary  = "$rowBen[code] | $rowBen[first] $rowBen[first2] $rowBen[last] $rowBen[last2]";
	}
	elseif($row['btype'] == 4){
		$beneficiaryType = 'Cliente';
		$queryBen = "select * from clients where code = '$row[client]'"; 
		$resultBen = mysqli_query($con, $queryBen);
		$rowBen=mysqli_fetch_array($resultBen);
		if($rowBen['type'] == 1){
			$beneficiary = "$rowBen[code] | $rowBen[first] $rowBen[last]";
		}elseif($row['type'] == 2){
			$beneficiary = "$rowBen[code] | $rowBen[name]"; 
		} 
	}
	
	$queryunit = "select code, name from units where (code = '$row[route]' or code2 = '$row[route]')"; 
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
	$unitname = $rowunit['code']." | ".$rowunit['name']; 
			
	$rtoday = date("d-m-Y", strtotime($row['ttoday']));
	$rtotime = date("H:i:s", strtotime($row['ttotime']));
	$treason = "Otro";
	$tcomment = $row['reason'];
	if(($row['reason2'] == 0) and (strlen($row['reason']) == 1)){
		$queryreason0 = "select name from reason where id = '$row[reason]'";
		$resultreason0 = mysqli_query($con, $queryreason0);		
		$rowreason0 = mysqli_fetch_array($resultreason0); 
		$treason = $rowreason0['name'];
		$tcomment = '';
	}if(($row['reason2'] > 0)){
		$queryreason0 = "select name from reason where id = '$row[reason2]'";
		$resultreason0 = mysqli_query($con, $queryreason0);
		$rowreason0 = mysqli_fetch_array($resultreason0); 
		$treason = $rowreason0['name'];
		$tcomment = $row['reason'];
	}

	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $row['id'])
            	->setCellValue('B'.$xlsRow, $rowuser['code']." | ".$rowuser['first']." ".$rowuser['last'])
				->setCellValue('C'.$xlsRow, $thisCompany[$row['company']])
				->setCellValue('D'.$xlsRow, $unitname)
				->setCellValue('E'.$xlsRow, $beneficiary)
				->setCellValue('F'.$xlsRow, $beneficiaryType)
				->setCellValue('G'.$xlsRow, $beneficiaryCourse)
				->setCellValue('H'.$xlsRow, $beneficiaryInt)
				->setCellValue('I'.$xlsRow, $row['payment'])
				->setCellValue('J'.$xlsRow, $thisCurrency[$row['currency']])
				->setCellValue('K'.$xlsRow, $rowuser2['code']." | ".$rowuser2['first']." ".$rowuser2['last'])
				->setCellValue('L'.$xlsRow, $thisStage[$row['stage']])
				->setCellValue('M'.$xlsRow, $treason)
				->setCellValue('N'.$xlsRow, $tcomment)
				->setCellValue('O'.$xlsRow, $rtoday)
				->setCellValue('P'.$xlsRow, $rtotime);   
	
	$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;

}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Regresos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Regresados.xlsx"');
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