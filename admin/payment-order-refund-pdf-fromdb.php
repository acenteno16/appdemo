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

$id = $_GET['id'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$queryrefund = "select * from clientsrefund where payment = '$row[id]'";
$resultrefund = mysqli_query($con, $queryrefund);
$rowrefund = mysqli_fetch_array($resultrefund); 

$queryclient = "select * from clients where code = '$row[client]'";
$rowclient = mysqli_fetch_array(mysqli_query($con, $queryclient)); 
$clientname = $rowclient['code']." | ".$rowclient['first']." ".$rowclient['last'];

$querycompany = "select name from companies where id = '$row[company]'";
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);

$companyname = $rowcompany['name'];

$x = 10;
$y = 50;
$font_size = 12;

$today = $row['today'];

$todayArr = explode('-', $today);

//Generar Mes
switch($todayArr[1]){ 
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
switch($rowrefund['devtype']){
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

$today = $todayArr[2]." de ".$this_month." del ".$todayArr[0];

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
//$pdf->Write(3,utf8_decode("Por medio de la presente, yo $rowclient[first] $rowclient[last], con dirección $rowclient[address], número de letefono $row[phone], email $rowclient[email]. Solicito formalmente la devolución de efectivo por el motivo: $row[description]"));

/*$pdf-> MultiCell(0,4.5,utf8_decode("Por medio de la presente, yo $rowclient[first] $rowclient[last], con los siguientes datos personales: ",0));
con número de identificación $rowclient[nid], con dirección $rowclient[address], número de teléfono $rowclient[phone], email $rowclient[email]. Solicito formalmente la devolución de efectivo por el motivo: $row[description]"),0);  *?


$y = $y+10;

$pdf->SetXY(10, $y);
$pdf->Write(3,utf8_decode("Nombre: $rowclient[first] $rowclient[last]"));
*/

$pdf-> MultiCell(0,4.5,"Por medio de la presente, yo $rowclient[first] $rowclient[last], con los siguientes datos personales:",0);  


if($rowclient['nid']){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Identificación: $rowclient[nid]"));
}

if($rowclient['address']){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Dirección: $rowclient[address]"));
}

if($rowclient['phone']){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Teléfono: $rowclient[phone]"));
}

if($rowclient['email']){
	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Email: $rowclient[email]"));
}

$y = $pdf->getY();
$y = $y+8;
$pdf->SetXY($x, $y);

$pdf-> MultiCell(0,4.5,utf8_decode("Les solicito $devtype_min de $row[payment] por el siguiente motivo: $row[description]"),0);


$querydocuments = "select * from clientsdocuments where payment = '$row[id]'";
$resultdocuments = mysqli_query($con, $querydocuments);
while($rowdocuments = mysqli_fetch_array($resultdocuments)){

switch($rowdocuments['type']){
		case 1:
		$doctype = "del Recibo de Caja";
		break;
		case 2:
		$doctype = "de la Factura";
		break;
}

switch($rowdocuments['currency']){
		case 1:
		$currencyname = "Córdobas";
		$currencypre = "C$";
		break;
		case 2:
		$currencyname = "Dólares";
		$currencypre = "U$";
		break;
}

$theday = date('d-m-Y', strtotime($rowdocuments['today']));

	$y = $pdf->getY();
	$y = $y+5;
	$pdf->SetXY($x, $y);
	$pdf->Write(3,utf8_decode("Fecha $doctype: $theday #$rowdocuments[number]  $currencypre$rowdocuments[amount] $currencyname"));


}


$y = $pdf->getY();
$y = $y+8;
$pdf->SetXY($x, $y);

$pdf-> MultiCell(0,4.5,utf8_decode(""),0);

$y = $pdf->getY();
$y = $y+10;
$pdf->SetXY($x, $y);
$pdf->Write(3,utf8_decode("Atentamente,"));

$y = $pdf->getY();
$y = $y+8;
$pdf->SetXY($x, $y);
$pdf->Write(3,utf8_decode("_____________________________"));
$y = $pdf->getY();
$y = $y+5;
$pdf->SetXY($x, $y); 
$pdf->Write(3,utf8_decode("$rowclient[first] $rowclient[last]"));


$newfilename='devolucion-'.$id.'.pdf';
$pdf->Output($newfilename, 'D');
//ob_end_flush();

////////////
////////////