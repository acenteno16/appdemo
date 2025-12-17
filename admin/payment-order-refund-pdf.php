<?

//exit();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if(!isset($_SESSION)){ 
	session_start(); 
}

if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	include("../connection.php"); 
}else{
	if(isset($_SESSION)){ 
		session_destroy();
	}
	header("location: ../?err=nosession_sessions");	  
} 
require('sanitize.php');

#$devtype = $_GET['devtype'];
#$description = $_GET['description'];
#$totalbill = $_GET['totalbill'];
#$currency = $_GET['currency'];
#$theroute = explode(',',$_GET['theroute']); 

#$ccode = $_GET['ccode'];
#$cfirst = $_GET['cfirst'];
#$clast = $_GET['clast'];
#$caddress = $_GET['caddress'];
#$cnid = $_GET['cnid'];
#$ccity = $_GET['ccity'];
#$cemail = $_GET['cemail'];
#$cphone = $_GET['cphone'];

//Documents info
#$roctype = $_GET['roctype'];
#$rocnumber = $_GET['rocnumber'];
#$roctoday = $_GET['roctoday'];
#$rocamount = $_GET['rocamount'];
#$roccurrency = $_GET['roccurrency'];


$devtype = isset($_GET['devtype']) ? sanitizeInput($_GET['devtype'], $con) : '';
$description = isset($_GET['description']) ? sanitizeInput($_GET['description'], $con) : '';
$totalbill = isset($_GET['totalbill']) ? sanitizeInput($_GET['totalbill'], $con) : '';
$currency = isset($_GET['currency']) ? sanitizeInput($_GET['currency'], $con) : '';
$theroute = isset($_GET['theroute']) ? explode(',', sanitizeInput($_GET['theroute'], $con)) : [];

// Client info 
$ccode = isset($_GET['ccode']) ? sanitizeInput($_GET['ccode'], $con) : '';
$cfirst = isset($_GET['cfirst']) ? sanitizeInput($_GET['cfirst'], $con) : '';
$clast = isset($_GET['clast']) ? sanitizeInput($_GET['clast'], $con) : '';
$caddress = isset($_GET['caddress']) ? sanitizeInput($_GET['caddress'], $con) : '';
$cnid = isset($_GET['cnid']) ? sanitizeInput($_GET['cnid'], $con) : '';
$ccity = isset($_GET['ccity']) ? sanitizeInput($_GET['ccity'], $con) : '';
$cemail = isset($_GET['cemail']) ? sanitizeInput($_GET['cemail'], $con) : '';
$cphone = isset($_GET['cphone']) ? sanitizeInput($_GET['cphone'], $con) : '';

// Documents info
$roctype = isset($_GET['roctype']) ? sanitizeInput($_GET['roctype'], $con) : '';
$rocnumber = isset($_GET['rocnumber']) ? sanitizeInput($_GET['rocnumber'], $con) : '';
$roctoday = isset($_GET['roctoday']) ? sanitizeInput($_GET['roctoday'], $con) : '';
$rocamount = isset($_GET['rocamount']) ? sanitizeInput($_GET['rocamount'], $con) : '';
$roccurrency = isset($_GET['roccurrency']) ? sanitizeInput($_GET['roccurrency'], $con) : '';


$roctype_array = explode('|||', $roctype);
$rocnumber_array = explode('|||', $rocnumber);
$roctoday_array = explode('|||', $roctoday);
$rocamount_array = explode('|||', $rocamount);
$roccurrency_array = explode('|||', $roccurrency); 

$rarray = sizeof($roctype);

$querycompany = "select company from units where code = '$theroute[0]' or code2='$theroute[0]'"; 
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);
$company = $rowcompany['company'];

$querycompanyname = "select name from companies where id = '$company'";
$resultcompanyname = mysqli_query($con, $querycompanyname);
$rowcompanyname = mysqli_fetch_array($resultcompanyname);

$companyname = $rowcompanyname['name'];

$x = 10;
$y = 50;
$font_size = 12;

//Generar Mes
switch(date('m')){ 
		case 1:
		$this_month = "Enero";
		break;
		case 2:
		$this_month = "Febrero";
		break;
		case 3:
		$this_month = "Marzo";
		break;
		case 4:
		$this_month = "Abril";
		break;
		case 5:
		$this_month = "Mayo";
		break;
		case 6:
		$this_month = "Junio";
		break;
		case 7:
		$this_month = "Julio";
		break;
		case 8:
		$this_month = "Agosto";
		break;
		case 9:
		$this_month = "Septiembre";
		break;
		case 10:
		$this_month = "Octubre";
		break;
		case 11:
		$this_month = "Noviembre";
		break;
		case 12:
		$this_month = "Diciembre";
		break;
}

//Generar tipo de devolución
switch($devtype){
		case 1:
		$devtype = "SOLICITUD DE DEVOLUCIÓN POR PRIMAS";
		$devtype_min = " la devolución";
		break;
		case 2:
		$devtype = "SOLICITUD DE DEVOLUCIÓN POR RESERVAS";
		$devtype_min = " la devolución";
		break;
		case 3:
		$devtype = "SOLICITUD DE DEVOLUCIÓN POR EXCEDENTES";
		$devtype_min = " la devolución";
		break;
		case 4:
		$devtype = "SOLICITUD DE REINTEGRO POR SEGUROS";
		$devtype_min = " el reintegro";
		break;
		case 5:
		$devtype = "SOLICITUD DE DEVOLUCIÓN POR PRODUCTOS";
		$devtype_min = " la devolución";
		break;
}

$today = date('d')." de ".$this_month." del ".date("Y");


require('fpdf-mctable.php'); 
$pdf=new PDF_MC_Table();

$pdf->AddPage();
$pdf->SetMargins(10,10,10); 
$pdf->SetAutoPageBreak(false); 



$pdf->SetXY(143, $y);
$pdf->SetFont('Arial','',$font_size); 
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,$today);

$y = $y+20;


$pdf->SetXY(10, $y);
$pdf->SetFont('Arial','',$font_size); 
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode($devtype));

$y = $y+10;


$pdf->SetXY(10, $y);
$pdf->SetFont('Arial','B',$font_size); 
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode(ucwords($companyname)));

$y = $y+10;

$pdf->SetXY(10, $y);
$pdf->SetFont('Arial','',$font_size); 
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode("Estimados señores"));

$y = $y+10;

$pdf->SetXY(10, $y);
$pdf->SetFont('Arial','',$font_size); 
$pdf->SetTextColor(0,0,0);
$pdf-> MultiCell(0,4.5,"Por medio de la presente, yo $cfirst $clast, con los siguientes datos personales:",0);  


if($cnid){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Identificación: $cnid"));
}

if($caddress){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Dirección: $caddress"));
}

if($cphone){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Teléfono: $cphone"));
}

if($cemail){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Email: $cemail"));
}

$y = $pdf->getY();
$y = $y+8;
$pdf->SetXY($x, $y);

switch($currency){ 
		case 1:
		$totalbill_currency = "Córdobas";
		$totalbill_currency_pre = "C$";
		break;
		case 2:
		$totalbill_currency = "Dólares";
		$totalbill_currency_pre = "U$"; 
		break;
}


$pdf-> MultiCell(0,4.5,utf8_decode("Les solicito $devtype_min de $totalbill_currency_pre $totalbill $totalbill_currency por el siguiente motivo: $description"),0); 

$y = $pdf->getY();
$y = $y+10;
$pdf->SetXY($x, $y);
$pdf->Write(3,utf8_decode("Documentos:"));


for($r=0;$r<sizeof($roctype_array)-1;$r++){

switch($roctype_array[$r]){
		case 1:
		$doctype = "Recibo de Caja";
		break;
		case 2:
		$doctype = "Factura"; 
		break;
}

switch($roccurrency_array[$r]){
		case 1:
		$currencyname = "Córdobas";
		$currencypre = "C$";
		break;
		case 2:
		$currencyname = "Dólares";
		$currencypre = "U$";
		break;
}

$theday = date('d-m-Y', strtotime($roctoday_array[$r]));

	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Tipo: $doctype Fecha: $theday Número: $rocnumber_array[$r]  Monto: $currencypre$rocamount_array[$r] $currencyname"));
}

$y = $pdf->getY();
$y = $y+8;
$pdf->SetXY($x, $y);

//$pdf-> MultiCell(0,4.5,utf8_decode(""),0);

$y = $pdf->getY();
$y = $y+10;
$pdf->SetXY($x, $y);
$pdf->Write(3,utf8_decode("Atentamente,"));

$y = $pdf->getY();
$y = $y+100;
$pdf->SetXY($x, $y);
$pdf->Write(3,utf8_decode("_____________________________"));
$y = $pdf->getY();
$y = $y+5;
$pdf->SetXY($x, $y); 
$pdf->Write(3,utf8_decode("$cfirst $clast")); 

$lettername = str_replace(' ','-',$cfirst."-".$clast);
 
$newfilename="$lettername.pdf";
$pdf->Output($newfilename, 'D');
//ob_end_flush();

////////////
////////////