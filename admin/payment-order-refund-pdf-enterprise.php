<?

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

require('fpdf-mctable.php'); 
$pdf=new PDF_MC_Table();

$pdf->AddPage();
$pdf->SetMargins(10,10,10); 
$pdf->SetAutoPageBreak(false); 

$devtype = $_GET['devtype'];
$description = $_GET['description'];
$totalbill = $_GET['totalbill'];
$currency = $_GET['currency'];
$theroute = explode(',',$_GET['theroute']); 

//Informacion de la compania
$ccode2 = $_GET['ccode2'];
$cname = $_GET['cname'];
$cruc = $_GET['cruc'];
$cemail2 = $_GET['cemail2'];
$cphone2 = $_GET['cphone2'];
$caddress2 = $_GET['caddress2'];
$ccity2 = $_GET['ccity2'];
//Representante Legal
$crfirst = $_GET['crfirst'];
$crlast = $_GET['crlast'];
$crnid = $_GET['crnid'];
$cremail = $_GET['cremail'];
$crphone = $_GET['crphone']; 

//Documents info
$roctype = $_GET['roctype'];
$rocnumber = $_GET['rocnumber'];
$roctoday = $_GET['roctoday'];
$rocamount = $_GET['rocamount'];
$roccurrency = $_GET['roccurrency'];

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
$pdf-> MultiCell(0,4.5,"Por medio de la presente, yo $crfirst $crlast, representante legal de $cname con los siguientes datos personales:",0);  


if($crnid){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Identificación: $crnid"));
}

if($craddress){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Dirección: $craddress"));
}

if($crphone){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Teléfono: $crphone"));
}

if($cremail){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Email: $cremail"));
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

$totalbill_formated = number_format($totalbill,2);
$pdf-> MultiCell(0,4.5,utf8_decode("Les solicito $devtype_min de $totalbill_currency_pre $totalbill_formated $totalbill_currency por el siguiente motivo: $description"),0); 

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
$y = $y+20;
$pdf->SetXY($x, $y);
$pdf->Write(3,utf8_decode("_____________________________"));
$y = $pdf->getY();
$y = $y+5;
$pdf->SetXY($x, $y); 
$pdf->Write(3,utf8_decode("$crfirst $crlast"));
$y = $pdf->getY();
$y = $y+5;
$pdf->SetXY($x, $y); 
$pdf->Write(3,utf8_decode("Representante Legal"));
$y = $y+5;
$pdf->SetXY($x, $y); 
$pdf->Write(3,utf8_decode("$cname")); 

$lettername = str_replace(' ','-',$cname);
 
$newfilename="$lettername.pdf";
$pdf->Output($newfilename, 'D');
//ob_end_flush();

////////////
////////////