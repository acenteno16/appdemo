<?php

$today = date('Y-m-d'); 
$yesterday = strtotime ( '-1 day' , strtotime ( $today ) ) ;
$yesterday = date ( 'Y-m-d' , $yesterday );

include '/var/www/html/connection.php'; 

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');


include dirname(__FILE__) . '/var/www/html/admin/PHPExcel/Classes/PHPExcel.php';


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
            ->setCellValue('A1', 'IDS')
            ->setCellValue('B1', 'Tipo')
			->setCellValue('C1', 'Beneficiario')
			->setCellValue('D1', 'Internacional')
            ->setCellValue('E1', 'Tipo')
			->setCellValue('F1', 'Concepto')
			->setCellValue('G1', 'Categoria')
			->setCellValue('H1', 'Moneda')
			->setCellValue('I1', 'Monto')
			->setCellValue('J1', 'Banco');


$xlsRow = 2;

$query = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '13' and times.today = '$yesterday'";    
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$ben_name = "";
	$ben_type = "";
		
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select pre from currency where id = '$row[currency]'"));
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
		$queryprovider = "select code, first, last from cliets where id = '$row[client]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Cliente";
		break;
	}
	
	$querybank = "select name from banks where id = '$row[bank]'";
	$resultbank = mysqli_query($con, $querybank);
	$rowbank = mysqli_fetch_array($resultbank);
	$bank = $rowbank['name'];
	
	/*$queryschedule = "select banks.name from banks inner join schedule on banks.id = schedule.bank inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'";
	$resultschedule = mysqli_query($con, $queryschedule);
	$rowschedule = mysqli_fetch_array($resultschedule);
	$schedulebank = $rowschedule['name'];*/
	
	$querybills = "select type, concept, concept2 from bills where payment = '$row[id]' limit 1";
	$resultbills = mysqli_query($con, $querybills);
	$rowbills = mysqli_fetch_array($resultbills);
	
	$querybills1 = "select name from categories where id = '$rowbills[type]'";
	$resultbills1 = mysqli_query($con, $querybills1);
	$rowbills1 = mysqli_fetch_array($resultbills1);
	
	$querybills2 = "select name from categories where id = '$rowbills[concept]'";
	$resultbills2 = mysqli_query($con, $querybills2);
	$rowbills2 = mysqli_fetch_array($resultbills2);
	
	$querybills3 = "select name from categories where id = '$rowbills[concept2]'";
	$resultbills3 = mysqli_query($con, $querybills3);
	$rowbills3 = mysqli_fetch_array($resultbills3);
	
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $ben_type)
				->setCellValue('C'.$xlsRow, $ben_name)
				->setCellValue('D'.$xlsRow, $international)
				->setCellValue('E'.$xlsRow, $rowbills1['name'])
				->setCellValue('F'.$xlsRow, $rowbills2['name'])
				->setCellValue('G'.$xlsRow, $rowbills3['name'])
				->setCellValue('H'.$xlsRow, $rowcurrency[pre])
				->setCellValue('I'.$xlsRow, $row[payment])
				->setCellValue('J'.$xlsRow, $bank); 
	
	$objPHPExcel->getActiveSheet()->getStyle('I'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;
	
}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//Redirect output to a client's web browser (Excel2007)
/*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ingreso-a-banco-'.date('d-m-Y', strtotime($yesterday)).'.xlsx"');
header('Cache-Control: max-age=0'); 
//If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');*/

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save('php://output');

//$name = 'email-files/Ingreso-a-banco-'.date('d-m-Y', strtotime($yesterday)).'.xlsx';
//$objWriter->save($name);
$objWriter->save(str_replace(__FILE__,'/var/www/html/admin/email-files/Ingreso-a-banco-'.date('d-m-Y', strtotime($yesterday))
.'.xlsx',__FILE__)); 


?><?php

$today = date('Y-m-d'); 
$yesterday = strtotime ( '-1 day' , strtotime ( $today ) ) ;
$yesterday = date ( 'Y-m-d' , $yesterday );


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
	
//$mail->Password = "MTV-rC25"; // Contraseña


require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.casapellas.com.ni';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'getpay@casapellas.com.ni';                 // SMTP username
$mail->Password = 'MTV-rC25';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect 

$mail->setFrom('getpay@casapellas.com.ni', 'GetPay | Grupo Casa Pellas');
// Add a recipient
//$mail->addAddress('enavarro@casapellas.com');
$mail->addAddress('jairovargasg@gmail.com'); 
// Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('enavarro@casapellas.com');
//$mail->addBCC('jairovargasg@gmail.com');
$mail->addBCC('ablandon@casapellas.com'); 

$mail->addAttachment('email-files/Ingreso-a-banco-'.date('d-m-Y', strtotime($yesterday))
.'.xlsx');        // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$yesterday2 = date('d-m-Y', strtotime($yesterday));
$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Ingreso a banco del dia $yesterday2") . "?="); 
$mail->Subject = $asunto;  

//$mail->Body    = "";
$mail->Body    = "&nbsp;"; 
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

/*if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else {
    echo "<br>Message has been sent to (".date('d-m-Y').' @'.date('H:i:s').')';  
}*/


/*

OUTPUT:

This example should only be run from a web browser

*/

?> 