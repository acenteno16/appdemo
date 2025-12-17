<?

#http://www.fpdf.org/makefont/

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include("session-envelope.php");

$line1 = $_POST['line1'];
$line2 = $_POST['line2'];
$line3 = $_POST['line3'];
$line4 = $_POST['line4'];

require('fpdf-mctable.php');
ob_start();
//require('fpdf.php');
$pdf=new FPDF();
//$pdf=new PDF_MC_Table('P','mm',array(180,130));   
 
$pdf->AddPage();
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false); 

$pdf->Image('../images/grupo-casa-pellas.jpg',10,15,60,7,'','');

define('FPDF_FONTPATH','font/'); 
$font = $_POST['font'];
//Use http://www.fpdf.org/makefont/ to make a font
switch($font){
		case 0:
		$pdf->SetFont('Arial','',18);
		break;
		case 1:
		$pdf->AddFont('The-Blacklist','','The-Blacklist.php');
		$pdf->SetFont('The-Blacklist','',18);
		break;
		case 2:
		$pdf->AddFont('Signature-of-the-Ancient','','Signature-of-the Ancient.php'); 
		$pdf->SetFont('Signature-of-the-Ancient','',18);
		break;
		case 3:
		$pdf->AddFont('bernadette','','bernadette.php'); 
		$pdf->SetFont('bernadette','',18);
		break;
}
 
$px = 120;
$y = 60;
$pdf->SetTextColor(0,0,0);

$pdf->SetXY($px,$y);
$pdf->Write(3,utf8_decode($line1));
$y = $y+6;
$pdf->SetXY($px,$y);
$pdf->Write(3,utf8_decode($line2)); 
$y = $y+6;
$pdf->SetXY($px,$y);
$pdf->Write(3,utf8_decode($line3)); 
$y = $y+6;
$pdf->SetXY($px,$y); 
$pdf->Write(3,utf8_decode($line4)); 


  
$newfilename='sobre-'.str_replace(' ','-',$line2).'.pdf';
$pdf->Output($newfilename, 'D'); 
//$filename="tosend/".$id.".pdf"; 
//$pdf->Output($filename,'F'); 
ob_end_flush();

?>