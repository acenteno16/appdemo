<?

if(!isset($_SESSION)){ 
	session_start(); 
}

if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	
}else{
	exit();
}

include('online.php');

$thefile = $_GET['key'];
$thefile = base64_decode($thefile);

$thefile = '//home/getpaycp/funds/'.$thefile.'.jpg';

header('Content-type: image/jpeg');
readfile($thefile);

?>