<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-reception.php");
require('functions.php');

//Get vars from form
$id = $_POST['id_envelope'];
$irid = $_POST['irid'];
$imiid = $_POST['hallsid'];

$id = isset($_POST['id']) ? sanitizeInput(intval($_POST['id']), $con) : 0; 
$irid = isset($_POST['irid']) ? sanitizeInput($_POST['irid'], $con) : [];
$imiid = isset($_POST['hallsid']) ? sanitizeInput($_POST['hallsid'], $con) : [];

//Declare couters to zero
$rets_ir = 0;
$rets_imi = 0;

$lastdate = date('Y-m-d');

//IMI
for($i=0;$i<sizeof($imiid);$i++){
	
	$thisImiId = intval($imiid[$i]);
	
	$query_insert = "insert into retentionenvelopecontent (envelope, retention, type) values ('$id', '$thisImiId', '1')";
	$result_insert = mysqli_query($con, $query_insert);
	
	$query_updateimi = "update hallsretention set delivery = '3' where id = '$thisImiId'";
	$result_updateimi = mysqli_query($con, $query_updateimi);
	
	$query_imi = "select created, serial, number from hallsretention where id = '$thisImiId'"; 
	$result_imi = mysqli_query($con, $query_imi);
	$row_imi = mysqli_fetch_array($result_imi);
	if($row_imi['created'] < $lastdate){
		$lastdate = $row_imi['created'];
	} 
	
	$rets_imi++;
	$rets_str.= "IMI(".$row_imi['serial'].' '.$row_imi['number'].'), ';
}

//IR
for($i=0;$i<sizeof($irid);$i++){
	
	$thisIrId = intval($irid[$i]);
	
	$query_insert = "insert into retentionenvelopecontent (envelope, retention, type) values ('$id', '$thisIrId', '2')";
	$result_insert = mysqli_query($con, $query_insert); 
	
	$query_updateir = "update irretention set delivery = '3' where id = '$thisIrId'"; 
	$result_updateir = mysqli_query($con, $query_updateir); 
	
	$query_ir = "select today, number from irretention where id = '$thisIrId'"; 
	$result_ir = mysqli_query($con, $query_ir);
	$row_ir = mysqli_fetch_array($result_ir);
	if($row_ir['today'] < $lastdate){
		$lastdate = $row_ir['today'];
	}
	
	$rets_ir++;
	$rets_str.= "IR(".$row_ir['number']."), ";
    
}

if(($rets_imi > 0) or ($rets_ir > 0)){

	$query_location = "select * from retentionenvelope where id = '$id'";
	$result_location = mysqli_query($con, $query_location);
	$row_location = mysqli_fetch_array($result_location);
	if($row_location['type'] == 1){
		$query_locationdetail = "select location from providers where id = '$row_location[provider]'";
	}else{
		$query_locationdetail = "select location from workers where code = '$row_location[provider]'";
	}
	
	$result_locationdetail = mysqli_query($con, $query_locationdetail);
	$row_locationdetail = mysqli_fetch_array($result_locationdetail);
	
	$location = $row_locationdetail['location'];
	
	$query_updateenvelope = "update retentionenvelope set status = '2', lastdate='$lastdate', location='$location' where id = '$id'";
	$result_updateenvelope = mysqli_query($con, $query_updateenvelope);
    
	
	$stage = 2;
	$rets_str = substr($rets_str,0,-2);
	$gp_comments = "Enhorabuena, se ha completado la inclusion de las retenciones ".$rets_str.".";

    $querytimes = "insert into retentionenvelopetimes (envelope, today, now, userid, stage, comment, reason) values ('$id', '$today', '$now', '$userid', '$stage', '$gp_comments', '$comments')"; 
	$resulttimes = mysqli_query($con, $querytimes);
}

header('location: reception-retention-envelope.php'); 

?>