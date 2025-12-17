<?php 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require("session-request.php"); 
require('functions.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$id_parent = $id;

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$querymain = $con->prepare("select * from payments where id = ?");
$querymain->bind_param("i", $id);
$querymain->execute();
$resultmain = $querymain->get_result();
$rowmain = $resultmain->fetch_assoc();

if($rowmain['status'] != 0){
	header('location: dashboard.php');
	exit();
}

$template_id = $_POST['template_id'];
$template_err = $_POST['template_err'];
if($template_err == 1){
	echo "<script>alert('Verifique el error en la plantilla.'); history.go(-1);</script>";
	exit();
}
$template_isset = $_POST['template_isset']; 
if($template_isset == 0){
	echo "<script>alert('Cargar la plantilla.'); history.go(-1);</script>";
	exit();
}

$user = $_SESSION['userid'];
$theroute = explode(',',$_POST['theroute']); 
$route = isset($theroute[0]) ? sanitizeInput(intval($theroute[0]), $con) : 0;
$headship = isset($theroute[1]) ? sanitizeInput(intval($theroute[1]), $con) : 0;
$notes = addslashes($_POST['notes']); 
$file = $_POST['file'];
$currency = $_POST['currency'];
$gpayment = $_POST['floattotalbill'];
if($gpayment > 0){
	//DO NOTHING;
}else{ 
	echo "<script>alert('No se calcul\u00F3 el pago global.'); history.go(-1);</script>";
	exit();
}
$zdescription = $_POST['description'];
if($zdescription == ""){
	echo "<script>alert('Ingrese la descripcion.'); history.go(-1);</script>";
	exit();
}
$template_beneficiary = $_POST['template_ben_int'];
if(($template_beneficiary == "") or ($template_beneficiary == "")){
	echo "<script>alert('No se reconoce el tipo de beneficiario.'); history.go(-1);</script>";
	exit();
}
$zdescription = $_POST['description'];
if($zdescription == ""){
	echo "<script>alert('Ingrese la descripcion.'); history.go(-1);</script>";
	exit();
}
if($route == 0){
	echo "<script>alert('Ingrese la ruta.'); history.go(-1);</script>";
	exit();
}
if(($teplate_beneficiary = 3) and ($currency == 2)){
	echo "<script>alert('No se pueden realizar solicitudes en dolares a pasantes.'); history.go(-1);</script>";
	exit();
}

//Get the Company (Route based)
$querycompany = "select companies.id from companies inner join units on companies.code = units.companyCode where units.id = '$route'"; 
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);
$company = $rowcompany['id'];
		
$destino = "/home/paymentstemplates/".$id."/".$id.".xlsx"; 

if(file_exists($destino)){ 
	
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
	
    $objReader = new PHPExcel_Reader_Excel2007();
    $objPHPExcel = $objReader->load($destino);
    $objFecha = new PHPExcel_Shared_Date();
    $objPHPExcel->setActiveSheetIndex(0);
	$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
	
	$payments_inc = 0;
	$user = $_SESSION['userid'];
	
	for($i=2;$i<$lastRow;$i++){ 
	
	$t_type = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
	
	if(($t_type == "C") or ($t_type == "c")){
	
	
	$intern = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
	$description = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
	$ammount = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
	$wallet = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
	
	$str_child = "";
	if(($payments_inc > 0) and ($ammount > 0)){ 
	
		$query = "insert into payments (status, userid, child) values ('0', '$user', '$id_parent')";
		$result = mysqli_query($con, $query);  
		$id = mysqli_insert_id($con);
		
		$str_child = "child='$id_parent', ";
	
	}
	
		switch($template_beneficiary){
			case 2:
			$querycol = "select id from workers where code = '$intern'";
			$resultcol = mysqli_query($con, $querycol);
			$rowcol = mysqli_fetch_array($resultcol);
			$str_ben = "btype='2', provider='0', collaborator='$rowcol[id]', intern='0', ";
			$type = 4;
			$concept = 183;
			break;
			case 3:
			$str_ben = "btype='3', provider='0', collaborator='0', intern='$intern', ";
			$type = 4;
			$concept = 176; 
			break; 
		}
		
		$thebillc = date('d-m-y').'-'.$wallet;
		
		$tc = '1.0000'; 
		$ammount_int = str_replace(',','',$ammount);
		
		$enletras = toLetters($ammount_int);
		
		//INSER BILL
		$query_bill = "insert into bills (payment, number, ammount, stotal2, type, concept, concept2, billdate, billdate2, currency, tc, nioammount, niobillpayment, cut, dtype, letters) values ('$id', '$thebillc', '$ammount', '$ammount', '$type', '$concept', '$concept2', '$today', '$today', '$currency', '$tc', '$ammount', '$ammount', '$billcut', '2', '$enletras')";
		$result_bill = mysqli_query($con, $query_bill);
		
		$fecha = date('Y-m-d'); 
		$nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		$expiration = $nuevafecha; 
		
		//INSER PAYMENT
		$query = "update payments set today='$today', ".$str_child.$str_ben."description='$description', ammount='$floatstotal', ammount2='$floattotal', currency='$currency', payment='$ammount', paymentnio='$ammount', userid='$_SESSION[userid]', routeid='$route', headship='$headship', headship2='$headship', notes='$notes', distribution='1', distributable='1', stotal='$ammount', cut='$cut', company='$company', zdescription='$zdescription', expiration='$expiration', sent='1', ncatalog='1' where id = '$id'";
		$result = mysqli_query($con, $query);
		
		
		
		$queryroute = "select * from routes where unitid = '$route' and headship = '$headship' and type = '20'";
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);

		$arequest = 1;
		$arequest2 = "";

		if(($numroute > 0) and ($headship > 0)){
		$arequest = 0; 
		$arequest2 = " En espera de aprobado.";
		} 
	
		$query1 = "update payments set status = '1', arequest='$arequest', templateid='$template_id', globalpayment='$gpayment', mgmp='$currency' where id = '$id'";
		$result1 = mysqli_query($con, $query1);
		
		//INSERT TIMES	
		$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Pago Ingresado')";
		$result2 = mysqli_query($con, $query2); 
		
		for($c=0;$c<sizeof($file);$c++){
			
			if($file[$c] != ""){
				$query_files = "insert into files (payment, link, deletefile) values ('$id', '$file[$c]', '0')";
				$result_files = mysqli_query($con, $query_files); 
			}
		} 
		
		$payments_inc++;
           

}

}


//DISTRIBUTION

$destino = "paymentstemplates/".$id_parent."/".$id_parent.".xls"; 

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
		
		$queryaa2 = "select id from units where newCode = '$aa'";
		$resultaa2 = mysqli_query($con, $queryaa2);
		$rowaa2 = mysqli_fetch_array($resultaa2);
		$aa2 = $rowaa2['id']; 
		
		$query_distribution = "insert into distribution (payment, unit, unitid, percent, total, ddelete) values ('$id_parent', '$aa', '$aa2'. '$this_percent', '$this_ammount', '0')";
		$result_distribution = mysqli_query($con, $query_distribution);
		
	}
	
	

}


//END DISTRIBUTION

header('location: payment-order-view.php?id='.$id_parent);

}
else{
	echo "<script>alert('No puede leer el archivo.'); history.go(-1);</script>";
	exit();
}

?>