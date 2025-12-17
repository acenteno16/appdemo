<?php 

include("session-consultation.php");
/*
$id = intval($_GET['id']);

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$query2 = "select * from files where payment = '$id'";
$result2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($result2);
while($row2=mysqli_fetch_array($result2)){
	
	$key = $_GET['key'];
	$newkey = base64_decode($key);
	$newkey = parse_str($newkey);

	$queryfb = "select * from filebox where id = '$file'"; 
	$resultfb = mysqli_query($con, $queryfb);
	$rowfb = mysqli_fetch_array($resultfb); 

	$pdfstr.= "addPDF('files/folder_".$rowfb['user']."/".$row2['name'].".pdf', 'all')";
}
$pdfstr.=";"; 

//echo $pdfstr;
*/

include 'pdf-merge/PDFMerger.php';

$pdf = new PDFMerger;

$pdf->addPDF('files/folder_PCP0001/ZmlsZT0zNCZ1c2VyaWQ9UENQMDAwMQ==.pdf', 'all')
->addPDF('files/folder_PCP0001/ZmlsZT0yNSZ1c2VyaWQ9UENQMDAwMQ==.pdf', 'all')
->merge('download', 'test2.pdf');
	
	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
?>

	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.


?>