<? 

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}


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
$xlsRow = 2;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'SUC')
			->setCellValue('B1', 'IDS')
            ->setCellValue('C1', 'SUC SEL')
			->setCellValue('D1', 'RET')
			->setCellValue('E1', 'FECHA')
			->setCellValue('F1', 'MONTO')
			->setCellValue('G1', '');

$thisHall = array();
$queryThisHall = "select * from halls";
$resultThisHall =mysqli_query($con, $queryThisHall);
while($rowThisHall=mysqli_fetch_array($resultThisHall)){
	$thisHall[$rowThisHall['id']] = $rowThisHall['name'];
}

$queryHalls = "select * from halls";
$resultHalls = mysqli_query($con, $queryHalls);
while($rowHalls=mysqli_fetch_array($resultHalls)){

	#echo '<br><br>';
	#echo $rowHalls['name'].'<br>';
	$str = '';
	$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where halls.id = '$rowHalls[id]' and status > '0' order by id desc limit 3000";
	$resultgretention = mysqli_query($con, $querygretention);
	while($rowgretention = mysqli_fetch_array($resultgretention)){
		
		$queryPayments = "select hall from payments where id = '$rowgretention[payment]'";
		$resultPayments = mysqli_query($con, $queryPayments);
		$rowPaymets=mysqli_fetch_array($resultPayments);
		
		
	 #echo '<br>-'.$rowgretention['payment'].' > '.$thisHall[$rowPaymets[hall]].' > '.$rowgretention['serial'].'-'.$rowgretention['number'].' on'.$rowgretention['created'];
		
	if($rowPaymets[hall] != $rowHalls['id']){	
		
			// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $rowHalls['name'])
				->setCellValue('B'.$xlsRow, $rowgretention['payment'])
				->setCellValue('C'.$xlsRow, $thisHall[$rowPaymets[hall]])
				->setCellValue('D'.$xlsRow, $rowgretention['serial'].'-'.$rowgretention['number'])
				->setCellValue('E'.$xlsRow, $rowgretention['created'])
				->setCellValue('F'.$xlsRow, $rowgretention['amount'])
				->setCellValue('G'.$xlsRow, ''); 
		
		$xlsRow++; 
	}
		
	}


}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteRetenciones.xlsx"');
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
	

/*
$queryCompany = "select * from companies";
$resultCompany =mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
	$thisCompany[$rowCompany['id']] = $rowCompany['name'];
}


$queryH = "select * from units where managua='0' order by id asc";
$resultH = mysqli_query($con, $queryH);
while($rowH=mysqli_fetch_array($resultH)){

	echo "<br><br>$rowH[name]<br>"; 

echo $queryPayments = "select payments.id, payments.ret1id, times.today, payments.hall from payments inner join times on payments.id = times.payment where payments.route = '$rowH[code2]' and times.stage = '13' and payments.ret1a > '0' and times.today >= '2022-9-1' group by payments.id";
$resultPayments = mysqli_query($con, $queryPayments);
while($rowPaymets=mysqli_fetch_array($resultPayments)){
	
	$str = ''; 
	
	$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status != '0' and hallsretention.id = '$rowPaymets[ret1id]' order by hallsretention.id desc";
	$resultgretention = mysqli_query($con, $querygretention);
	while($rowgretention = mysqli_fetch_array($resultgretention)){
	 $str.=$rowgretention['serial'].'-'.$rowgretention['number'].',';
	}
	
	$queryHall = "select * from halls where id = '$rowPaymets[hall]'";
	$resultHall = mysqli_query($con, $queryHall);
	$rowHall=mysqli_fetch_array($resultHall);
	
	$okay = '';
	if($rowHall['id'] == $rowPaymets['hall']){
		$okay = '(OKAY)='.$rowHall['id'].'X'.$rowPaymets['hall'];
	}
	
	echo '<br>'.$rowPaymets['id'].' > '.$rowHall['name'].' > '.$str.' on '.$rowPaymets['today'].' '.$okay; 
}
}

*/

/*
$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status != '0' and halls.id = '4' order by hallsretention.id desc";
$resultgretention = mysqli_query($con, $querygretention);
echo $numgretention = mysqli_num_rows($resultgretention);
while($rowgretention = mysqli_fetch_array($resultgretention)){
	
	$queryPayment = "select ret1id from payments where id = '$rowgretention[payment]'";
	$resultPayment = mysqli_query($con, $queryPayment);
	$rowPayment = mysqli_fetch_array($resultPayment);
	
	$var = 'No';
	if($rowgretention['id'] == $rowPayment['ret1id']){
		$var = 'Si';
	}

	echo '<br>'.$rowgretention['id'].' > '.$rowgretention['payment'].' ? '.$rowPayment['ret1id'].' = '.$var;
}



echo createIMIRetention('229939', 0, 999999999);

function createIMIRetention($id, $dateType, $hallId) {
	
	
	include('sessions.php');
	
	$queryPayment = "select approved, route, hall, status from payments where id = '$id'";
	$resultPayment = mysqli_query($con, $queryPayment);
	$rowPayment = mysqli_fetch_array($resultPayment);
	
	
	if(($rowPayment['approved'] == 1) and ($rowPayment['status'] >= 13)){
	
	$today = date('Y-m-d');

	$queryVoid = "update hallsretention set void = '1', voidcomments='Anulada por getPay para generar una nueva.', voidtoday='$today', voiduserid='999999999' where payment = '$id' and void = '0'";
	$resultVoid = mysqli_query($con, $queryVoid);
	
	
    if($dateType == 1){
		$querytoday = "select today from times where payment = '$id' and stage = '13' order by id desc limit 1";
        $resulttoday = mysqli_query($con, $querytoday);
        $rowtoday = mysqli_fetch_array($resulttoday);
           
        $today = $rowtoday['today']; 
    }
		
	
	$billChainNumber = array();
  	$billChainId = array();
  	$billChainAmount = array();

  	$binc = 0;
	$globalBillChainSize = 0;
	
  	$query_bills = "select id, number, ret1a from bills where payment = '$id' and ret1a > '0'";
  	$result_bills = mysqli_query($con, $query_bills);
  	while($row_bills = mysqli_fetch_array($result_bills)){
		
	  	$billChainSize = strlen($row_bills['number'].', ');
	  	if($globalBillChainSize+$billChainSize <= 40){
			$globalBillChainSize += $billChainSize;
		}else{
			$binc++;
			$globalBillChainSize = $billChainSize;
		}
		$billChainNumber[$binc].= $row_bills['number'].',';
		$billChainId[$binc].= $row_bills['id'].',';
		$billChainAmount[$binc]+= $row_bills['ret1a'];
		
	}
		
		
	
  	for($ib=0;$ib<sizeof($billChainNumber);$ib++){

    	$thisChainNumber = $billChainNumber[$ib];
    	$thisChainNumber = substr($thisChainNumber,0,-1); 
    	$thisChainId = $billChainId[$ib];
    	$thisChainId = substr($thisChainId,0,-1); 
		$thisChainAmount = $billChainAmount[$ib];

    	if($hallId == 999999999){
			
			$queryRtype =  "select * from units where code = '$rowPayment[route]' or code2 = '$rowPayment[route]'";
			$resultRtype = mysqli_query($con, $queryRtype);
			$numRtype = mysqli_num_rows($resultRtype);
			$r=0;
			while($rowRtype = mysqli_fetch_array($resultRtype)){
				
				if($rowRtype['managua'] == 0){
					if($r==0){
					$strRoutes.= " and (FIND_IN_SET('$rowRtype[code]',halls.units) > 0";
					}else{
					$strRoutes.= " or FIND_IN_SET('$rowRtype[code]',halls.units) > 0";
					}
					$r++;
					if($r == $numRtype){
					$strRoutes.= ")";
					}
				}else{
					$strRoutes = " and halls.units like '%$rowPayment[route]%'";
				}
			}
		
			$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0'$strRoutes order by hallsretention.id asc limit 1";
			$resultgretention = mysqli_query($con, $querygretention);
    		$numgretention = mysqli_num_rows($resultgretention);
		}
		elseif($hallId == 0){
			$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '$rowPayment[hall]' order by hallsretention.id asc limit 1";
			$resultgretention = mysqli_query($con, $querygretention);
    		$numgretention = mysqli_num_rows($resultgretention);
		}
		elseif($hallId > 0){
			$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '$hallId' order by hallsretention.id asc limit 1";
			$resultgretention = mysqli_query($con, $querygretention);
    		$numgretention = mysqli_num_rows($resultgretention);
		}
		
		
	
    	if($numgretention > 0){
			
			$rowgretention = mysqli_fetch_array($resultgretention);
			
			return $rowgretention['serial'].'  > '.$querygretention;
			
			$idgretention = $rowgretention['id'];
			$querygretention2 = "update hallsretention set status = '1', payment='$id', created='$today', billsno='$thisChainNumber', billsid='$thisChainId', amount='$thisChainAmount' where id = '$idgretention'";
			#$resultgretention2 = mysqli_query($con, $querygretention2);
			
			$pre = '';
			$queryRead = "select ret1id from payments where id = '$id'";
			$resultRead = mysqli_query($con, $queryRead);
			$rowRead = mysqli_fetch_array($resultRead);
			if($rowRead['ret1id'] != ''){
				$pre = $rowRead['ret1id'].',';
			}
			
			$preIdgretention = $pre.$idgretention;	
			
			$query_update = "update payments set ret1id = '$preIdgretention', mayorstage = '1' where id = '$id'";
			#$result_update = mysqli_query($con, $query_update);

    	}

  	}
		
	}
	else{
		
		$query_update = "update payments set ret1void = '1' where id = '$id'";
		#$result_update = mysqli_query($con, $query_update);
		
	}

}
*/ 

?>
<?php 

/*

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

$now = date('Y-m-d'); 

include('functions.php');

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



$xlsRow = 2;
$today = date('Y-m-d');
$xlsRow = 2; 

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ruta')
			->setCellValue('B1', 'IDS')
            ->setCellValue('C1', 'Alcaldía')
			->setCellValue('D1', 'Retencion')
			->setCellValue('E1', 'Fecha retencieón')
			->setCellValue('F1', '')
			->setCellValue('G1', '');
          
$queryH = "select * from units where managua='0'";
$resultH = mysqli_query($con, $queryH);
while($rowH=mysqli_fetch_array($resultH)){

$queryPayments = "select payments.id, payments.ret1id, times.today, payments.hall from payments inner join times on payments.id = times.payment where payments.route = '$rowH[code2]' and times.stage = '13' and payments.ret1a > 0 and times.today >= '2022-9-1' group by payments.id";
$resultPayments = mysqli_query($con, $queryPayments);
while($rowPaymets=mysqli_fetch_array($resultPayments)){
	
	$str = ''; 
	
	$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status != '0' and hallsretention.id = '$rowPaymets[ret1id]' order by hallsretention.id desc";
	$resultgretention = mysqli_query($con, $querygretention);
	while($rowgretention = mysqli_fetch_array($resultgretention)){
	 $str.=$rowgretention['serial'].'-'.$rowgretention['number'].',';
	}
	
	$queryHall = "select * from halls where id = '$rowPaymets[hall]'";
	$resultHall = mysqli_query($con, $queryHall);
	$rowHall=mysqli_fetch_array($resultHall);
	
	
		// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $rowH['name'])
				->setCellValue('B'.$xlsRow, $rowPaymets['id'])
				->setCellValue('C'.$xlsRow, $rowHall['name'])
				->setCellValue('D'.$xlsRow, $str)
				->setCellValue('E'.$xlsRow, $rowPaymets['today'])
				->setCellValue('F'.$xlsRow, '')
				->setCellValue('G'.$xlsRow, ''); 
	
	$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 
}
}



	


//}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-aprobado1.xlsx"');
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
