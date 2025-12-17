<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

require("session-schedule.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$file = $id.'.pdf';
$thefile = "/home/tosend/".$file;

if(!file_exists($thefile)){
	include('pdf-ir-single.php'); 
	makeRetention($id,0,$con);
}
if(!file_exists($thefile)){
	$thefile = "/home/files/nofile.pdf";
}

header('Content-type: application/pdf');
readfile($thefile);

?>