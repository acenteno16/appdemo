<?

if(!isset($_SESSION)){ 
	session_start(); 
}
if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){

}else{
	exit();
}


$info = base64_decode($_GET['token']);
$infoArr = explode(',', $info);

$thefile = "../../files/followup/$infoArr[0]/$infoArr[1]";


header('Content-type: image/jpeg');
readfile($thefile);

?>