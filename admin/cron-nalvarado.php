<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$today = date('Y-m-d'); 
$today_day = date('N');
if($today_day == 1){
	$yesterday = strtotime ( '-2 day' , strtotime ( $today ) ) ;
}else{
	$yesterday = strtotime ( '-1 day' , strtotime ( $today ) ) ;
}

$yesterday = date ( 'Y-m-d' , $yesterday );

include '../connection.php'; 
require '../assets/PHPMailer/PHPMailerAutoload.php'; 
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost); 

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

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ingreso a Banco')
            ->setCellValue('B1', 'GID')
			->setCellValue('C1', 'WID')
			->setCellValue('D1', 'IDS')
            ->setCellValue('E1', 'Beneficiario')
			->setCellValue('F1', 'Monto')
			->setCellValue('G1', 'Moneda')
			->setCellValue('H1', 'Edo. Provision')
			->setCellValue('I1', 'Compañia');


$xlsRow = 2;
$query = "select payments.*, times.today as thisToday from payments inner join times on payments.id = times.payment where times.stage = '13' and times.today = '$yesterday'";    
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$ben_name = "";
	$ben_type = "";
		
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select currency.pre from currency where id = '$row[currency]'"));
	$international = "No";
	switch($row['btype']){
		case 1:
		$queryprovider = "select code, name, international from providers where id = '$row[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		if($rowprovider['international'] == 1){
			$international = "Si";
		}
		$ben_name = $rowprovider['code']." | ".$rowprovider['name'];
		$ben_type = "Proveedor";
		break;
		case 2:
		$queryprovider = "select code, first, last from workers where id = '$row[collaborator]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Colaborador";
		break;
		case 3:
		$queryprovider = "select code, first, last from interns where id = '$row[intern]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Pasante";
		break;
		case 4:
		$queryprovider = "select type, code, first, last, name from clients where code = '$row[client]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider); 
		if($rowprovider['type'] == 1){
			$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		}else{
			$ben_name = $rowprovider['code']." | ".$rowprovider['name'];
		}
		
		$ben_type = "Cliente";
		break;
	}
	

	
	$queryschedule = "select schedule.* from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'";
	$resultschedule = mysqli_query($con, $queryschedule);
	$rowschedule = mysqli_fetch_array($resultschedule);
	
	
	$querybills = "select type, concept, concept2 from bills where payment = '$row[id]' limit 1";
	$resultbills = mysqli_query($con, $querybills);
	$rowbills = mysqli_fetch_array($resultbills);
	
	if($row['ppe1'] == 0){
		$thisProvision = 'Normal';
	}elseif($row['ppe1'] == 1){
		$thisProvision = 'Pendiente E1';
	}elseif($row['ppe1'] == 2){
		$thisProvision = 'Completo E1';
	}
	
	
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	$company = $rowcompany['name'];
	
	$thisDay =  date('d-m-Y',strtotime($row['thisToday']));
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $thisDay)
				->setCellValue('B'.$xlsRow, $rowschedule['id'])
				->setCellValue('C'.$xlsRow, $rowschedule['code'])
				->setCellValue('D'.$xlsRow, $row['id'])
				->setCellValue('E'.$xlsRow, $ben_name)
				->setCellValue('F'.$xlsRow, $row['payment'])
				->setCellValue('G'.$xlsRow, $rowcurrency['pre'])
				->setCellValue('H'.$xlsRow, $thisProvision)
				->setCellValue('I'.$xlsRow, $company); 
	
	$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;
	
}

$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace(__FILE__,'../../emailFiles/IngresoABanco'.date('d-m-Y', strtotime($yesterday))
.'.xlsx',__FILE__)); 

error_reporting(E_ALL); 
ini_set('display_errors', 1);

$message = '<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
			<style>body{ border:0px; background: #f6f6f6; }</style>
			<body bgcolor="#f6f6f6">
			<p>Apreciable proveedor,</p>
			<p>Agradecemos su valiosa colaboraci&oacute;n y el tiempo a disponer en atender comunicaci&oacute;n adjunta. </p>
			<p>Atentamente<br>
			Tesorer&iacute;a<br>
			Grupo Casa Pellas</p>
			<br><br><br> 
			</body>
			</html>';
	
$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
if($rowHost['mailTLS'] == 1){
		$mail->SMTPSecure = "tls";
	}elseif($rowHost['mailTLS'] == 2){
		$mail->SMTPSecure = "ssl";
	}
$mail->Port = $rowHost['mailPort'];
$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers 
$mail->Username = $rowHost['mailUsername'];                 // SMTP username
$mail->Password = $rowHost['mailPassword'];                           // SMTP password
$mail->IsHTML(true);
$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);                               // TCP port to connect 


// Add a recipient
$mail->addAddress('nalvarado@casapellas.com'); 
$mail->addAddress('jairovargasg@gmail.com'); 


$mail->addAttachment('../../emailFiles/IngresoABanco-'.date('d-m-Y', strtotime($yesterday)).'.xlsx');

$yesterday2 = date('d-m-Y', strtotime($yesterday));
$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Ingreso a banco del dia $yesterday2") . "?="); 
$mail->Subject = $asunto;  
$mail->Body    = "&nbsp;";

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else {
    echo "<br>Message has been sent to (".date('d-m-Y').' @'.date('H:i:s').')';  
}

?> 