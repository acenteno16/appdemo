<?php

require '../connection.php';  

$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany = mysqli_fetch_array($resultCompany)){
	$thisCompany[$rowCompany['id']] = $rowCompany['name'];
}

	

$now = date('Y-m-d'); 

include('functions.php');

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

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



$xlsRow = 2;
$today = date('Y-m-d');

$sql = $sql1.$sql2.$sql3;

$xlsRow = 2;
$query = "select id, company, cnumber, df1, df2, df3 from payments where (df1 = '1' or df2 = '1' or df3 = '1') and payments.child='0'";    
$result = mysqli_query($con, $query);   

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'Comp')
			->setCellValue('C1', 'PK')
            ->setCellValue('D1', 'Solitud')
			->setCellValue('E1', 'Provision')
			->setCellValue('F1', 'Cancelacion');
          

while($row=mysqli_fetch_array($result)){

	
	$a1= '';
	$a2= '';
	$a3 = '';
	
	if($row['df1'] == 1){
		$a1 = 'x';
	}
	if($row['df2'] == 1){
		$a2 = 'x';
	}
	if($row['df3'] == 1){
		$a3 = 'x';
	}
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $thisCompany[$row['company']])
				->setCellValue('C'.$xlsRow, $row['cnumber'])
				->setCellValue('D'.$xlsRow, $a1)
				->setCellValue('E'.$xlsRow, $a2)
				->setCellValue('F'.$xlsRow, $a3); 
	
	
	$xlsRow++; 

}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteDeArchivos.xlsx"');
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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../connection.php'; 

/*$query = "select payments.id from payments inner join times on payments.id = times.payment where payments.status = '14' and times.stage = '14' and times.today >= '2018-01-01' and times.today < '2019-01-01'";
$result = mysqli_query($con, $query);
$inc = 0;
echo 'Pagos 2018: '.$num = mysqli_num_rows($result);


$query = "select payments.id from payments inner join times on payments.id = times.payment where payments.status = '14' and times.stage = '14' and times.today >= '2018-01-01' and times.today < '2019-01-01' and df1 = '1'";
$result = mysqli_query($con, $query);
$inc = 0;
echo '<br>Arcvhivos con error: '.$num = mysqli_num_rows($result);

while($row=mysqli_fetch_array($result)){
	
	echo '<br>	'.$row['id'];
	
}
*/


/*
#$queryDfiles2 = "update payments set df1 = '0', cf1='0'";
#$resultDfiles2 = mysqli_query($con, $queryDfiles2); 

$query = "select payments.id from payments inner join times on payments.id = times.payment where payments.status = '14' and times.stage = '14' and times.today >= '2018-01-01' and times.today < '2019-01-01' and cf1 = '0' limit 100";
$result = mysqli_query($con, $query);
$inc = 0;
echo 'Pagos cancelados en 2018: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	$queryFiles = "select link from files where payment = '$row[id]'";
	$resultFiles = mysqli_query($con, $queryFiles);
	$numFiles = mysqli_num_rows($resultFiles);
	while($rowFiles=mysqli_fetch_array($resultFiles)){
	
		
		$farray = explode('/',$rowFiles['link']);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('visor.php?key=','',$furl);
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$furl = base64_decode($furl);
		
		$furlArr = explode('&', $furl);
		$furl = $furlArr[0];
		$furl = str_replace('file=','',$furl);
		
		$queryFiles2 = "select * from filebox where id = '$furl'";
		$resultFiles2 = mysqli_query($con, $queryFiles2);;
		$rowFiles2=mysqli_fetch_array($resultFiles2);
	
		$file = "//home/getpaycp/files/folder_$rowFiles2[user]/$rowFiles2[name]";
		
		$fileErr = 0;
		if(!file_exists($file)){
			$fileErr = 1;
			if($rowFiles2['rloc'] == 1){
				$fileErr = 0;
			}
		}
			
			
		if($fileErr == 1){
			
			#echo '<br>IDS: '.$row['id'].' => '.$rowFiles2['id'].' ('.$rowFiles2['rloc'].')';
			
			$queryDfiles = "update payments set df1 = '1' where id = '$row[id]'";
			$resultDfiles = mysqli_query($con, $queryDfiles);
			$inc++;
			
			
		}
	
		
	}
	
	$queryDfiles2 = "update payments set cf1='1' where id = '$row[id]'";
	$resultDfiles2 = mysqli_query($con, $queryDfiles2); 
	
}

echo ' INC='.$inc;


?>
<script>
setTimeout(() => {
  document.location.reload();
}, 3000);

*/

/*
$query = "select payments.id, payments.clink from payments inner join times on payments.id = times.payment where payments.status = '14' and times.stage = '14' and times.today >= '2018-01-01' and times.today < '2019-01-01' and cf3 = '0' limit 200";
$result = mysqli_query($con, $query);
$inc = 0;
echo 'Pagos cancelados en 2018: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	
		
		$farray = explode('/',$row['clink']);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('visor.php?key=','',$furl);
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$furl = base64_decode($furl);
		
		$furlArr = explode('&', $furl);
		$furl = $furlArr[0];
		$furl = str_replace('file=','',$furl);
		
		$queryFiles2 = "select * from filebox where id = '$furl'";
		$resultFiles2 = mysqli_query($con, $queryFiles2);;
		$rowFiles2=mysqli_fetch_array($resultFiles2);
	
		$file = "//home/getpaycp/files/folder_$rowFiles2[user]/$rowFiles2[name]";
		
		$fileErr = 0;
		if(!file_exists($file)){
			$fileErr = 1;
			if($rowFiles2['rloc'] == 1){
				$fileErr = 0;
			}
		}
			
			
		if($fileErr == 1){
			
			#echo '<br>IDS: '.$row['id'].' => '.$rowFiles2['id'].' ('.$rowFiles2['rloc'].')';
			
			echo '<br>-'.$queryDfiles = "update payments set df3 = '1' where id = '$row[id]'";
			$resultDfiles = mysqli_query($con, $queryDfiles);
			$inc++;
			
			
		}
	
		
	
	
	$queryDfiles2 = "update payments set cf3='1' where id = '$row[id]'";
	$resultDfiles2 = mysqli_query($con, $queryDfiles2); 
	
}

echo ' INC='.$inc;


?>
<script>
setTimeout(() => {
  document.location.reload();
}, 1000);
</script>