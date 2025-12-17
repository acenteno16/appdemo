<?php

$now = date('Y-m-d'); 
session_start();
if(($_SESSION["payments_report"] == "active") or ($_SESSION['admin'] == 'active')){ 
	include("../connection.php"); 
}else{
	session_destroy();
	header("location: ../?err=noPaymentsReport");  	 
}	

$from = $_POST[ 'from' ];
$to = $_POST[ 'to' ];
$provider = $_POST[ 'provider' ];
$request = $_POST[ 'request' ];
$bill = $_POST[ 'bill' ];
$paymenten = $_POST[ 'paymenten' ];
$company = $_POST[ 'company' ];
$immediate = $_POST[ 'immediate' ];
$type = $_POST[ 'type' ];
$concept = $_POST[ 'concept' ];
$category = $_POST[ 'category' ];

if(($from == '') and ($request == '')){
	$err++;
	$errStr.= '-Debe de seleccionar una fecha de inicio.\n';
}
if(($to == '') and ($request == '')){
	$err++;
	$errStr.= '-Debe de seleccionar una fecha de finalización.\n';
}
if(($from != '') and ($to != '')){
	$from = date("Y-m-d", strtotime($from));
	$to = date("Y-m-d", strtotime($to));
	
	$fecha = date($from);
	$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	if($nuevafecha <= $to){ 
		$errStr.='Periodo maximo de 1 mes';
		$err++;
	}
}

if($err > 0){
	exit('<script>alert("Err.\n'.$errStr.'"); window.location = "report-payments.php";</script>');
}

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

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
			->setCellValue('E1', 'Proveedor_Colaborador')
			->setCellValue('F1', 'Monto')
			->setCellValue('G1', 'Moneda')
			->setCellValue('H1', 'Fecha_de_Cancelación')
            ->setCellValue('I1', 'Banco')
            ->setCellValue('J1', 'PK')
			->setCellValue('K1', 'GID')
			->setCellValue('L1', 'WID');

$xlsRow = 2;

$join = $_POST['join'];
$sql = $_POST['sql'];

#banks
$querybanks = "select id, name from banks";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
  $thebank[$rowbanks['id']] = $rowbanks['name']; 
}
#currency
$querycurrency = "select id, name from currency";
$resultcurrency = mysqli_query($con, $querycurrency);
while($rowcurrency=mysqli_fetch_array($resultcurrency)){
    $theCurrency[$rowcurrency['id']] = $rowcurrency['name'];
}

#companies
$querycompany = "select id, name from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany = mysqli_fetch_array($resultcompany)){
    $theCompany[$rowcompany['id']] = $rowcompany['name'];
}  
$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.userid, payments.company, payments.route, payments.payment, payments.bank, payments.cnumber from payments".$join." where payments.status >= '14'".$sql.' group by payments.id order by payments.id desc';

$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	

	
	$beneficiary = '';
	if($row['btype'] == 1){
		#providers
		if($thisProvider[$row['provider']] != ""){
			$beneficiary = $thisProvider[$row['provider']];
		}
		else{
			$queryProvider = "select code, name from providers where id = '$row[provider]'";
    		$resultProvider = mysqli_query($con, $queryProvider);
			$rowProvider = mysqli_fetch_array($resultProvider);
			$beneficiary = $rowProvider['code'].' | '.$rowProvider['name']; 
			$thisProvider[$row['provider']] = $beneficiary;
		}
	}
	elseif($row['btype'] == 2){
		#workers
		if($thisRequester[$row['collaborator']] != ""){
			$beneficiary = $thisRequester[$row['collaborator']];
		}else{
			$queryUser = "select code, first, last from workers where id = '$row[collaborator]'";
    		$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$beneficiary = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; 
			$thisRequester[$row['collaborator']] = $beneficiary;
		}
	}
	elseif($row['btype'] == 3){
		#interns
		if($thisIntern[$row['intern']] != ""){
			$beneficiary = $thisIntern[$row['intern']];
		}else{
			$queryUser = "select code, first, first2, last, last2 from interns where code = '$row[intern]'";
    		$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$beneficiary = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['first2'].' '.$rowUser['last'].' '.$rowUser['last2']; 
			$thisIntern[$row['intern']] = $beneficiary;
		}
	}
	elseif($row['btype'] == 4){
		#clients
		if($thisClient[$row['client']] != ""){
			$beneficiary = $thisClient[$row['client']];
		}else{
			$queryUser = "select type, code, first, last, name from clients where code = '$row[client]'";
    		$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			if($rowUser['type'] == 1){
				$beneficiary = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; 
			}else{
				$beneficiary = $rowUser['code'].' | '.$rowUser['name']; 
			}
			
			$thisClientr[$row['client']] = $beneficiary;
		}
	}

    if($theUser[$row['userid']] == ""){
        $rowuser= mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[userid]'"));
        $username = $rowuser['first']." ".$rowuser['last'];
        $theUser[$row['userid']] = $username;
    }else{
        $username = $theUser[$row['userid']];
    }
	
	//Fecha de Cancelación						
	$query2 = "select today from times where payment = $row[id] and stage = '14' order by id desc limit 1"; 
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
    $row2=mysqli_fetch_array($result2);
    
    if($unitName[$row['route']] == ""){
	   $queryunit = "select code, name from units where (code = '$row[route]' or code2 = '$row[route]')"; 
	   $resultunit = mysqli_query($con, $queryunit);
	   $rowunit = mysqli_fetch_array($resultunit);
	   $unitname = $rowunit['code']." | ".$rowunit['name']; 
       $unitName[$row['route']] = $unitname;
    }else{
        $unitname = $unitName[$row['route']];
    } 
    
     $queryGid = "select schedulecontent.schedule, schedule.code from schedulecontent inner join schedule on schedulecontent.schedule = schedule.id where schedulecontent.payment = '$row[id]'"; 
	 $resultGid = mysqli_query($con, $queryGid);
	 $rowGid = mysqli_fetch_array($resultGid); 
    
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $row['id'])
            	->setCellValue('B'.$xlsRow, $username)
				->setCellValue('C'.$xlsRow, $theCompany[$row['company']])
				->setCellValue('D'.$xlsRow, $unitname)
				->setCellValue('E'.$xlsRow, $beneficiary)
				->setCellValue('F'.$xlsRow, $row['payment'])
				->setCellValue('G'.$xlsRow, $theCurrency[$row['currency']])
				->setCellValue('H'.$xlsRow, $row2['today'])
                ->setCellValue('I'.$xlsRow, $thebank[$row['bank']])
                ->setCellValue('J'.$xlsRow, $row['cnumber'])
				->setCellValue('K'.$xlsRow, $rowGid['schedule'])
				->setCellValue('L'.$xlsRow, $rowGid['code']);  
    
    
	
	$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;

}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-pagos.xlsx"');
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