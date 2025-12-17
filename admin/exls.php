<?
include('sessions.php');
require 'functions.php';

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;
$sqlu = '';

if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active") or ($_SESSION["releasing_special"] == "active") or ($_SESSION["provision_global"] == "active") or ($_SESSION["auditor_report"] == "active")){
	$permission = 1;
}
else{

	$numu = 0;
	$queryu = "select * from routes where worker = '$_SESSION[userid]' and ((type = '1') or (type = '2') or (type = '3') or (type = '4') or (type = '5') or (type = '19') or (type = '20') or (type = '35'))";
	$resultu = mysqli_query($con, $queryu);
	$numu = mysqli_num_rows($resultu);
	
	if($numu > 0){
		$firstu = 1;
		while($rowu=mysqli_fetch_array($resultu)){
			
           if(($rowu['type'] == '35') or ($rowu['type'] == '5') or ($rowu['type'] == '19')){ 
                $sqluSec = "";
                
            }else{
                $sqluSec = " and (times.userid= '$_SESSION[userid]')";
            }
            
            if($firstu == 1){ //First
				$sqlu = " and (((payments.routeid = '$rowu[unitid]')".$sqluSec.")";
				if($numu == 1){
					$sqlu .= ")";
				}
				$firstu++;
			}elseif($firstu == $numu){ //Last
				$sqlu .= " or ((payments.routeid = '$rowu[unitid]')".$sqluSec."))";
				$firstu++;
			}else{ //Middle
				$sqlu .= " or ((payments.routeid = '$rowu[unitid]')".$sqluSec.")";
				$firstu++;
			}
		}
		
		if(($credit == 1) and (($_SESSION["credit"] == "active") or ($_SESSION['admin'] == "active"))){
			$sqlu.= " and payments.type = '4'";
		}					
	}
	else{ 
		$sqlu = "and (payments.route = 'NONE')"; 
		if(($credit == 1) and (($_SESSION["credit"] == "active") or ($_SESSION['admin'] == 'active')) ){
			$sqlu= " and payments.type = '4'";
		}
	}
} 

$query = "select payments.id from payments where payments.id = ? $sqlu";
$query = $con->prepare($query);
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;

if($num > 0){
	
	$file_path = '/home/paymentstemplates/'.$id.'/'.$id.'.xlsx'; 

	if (!file_exists($file_path)) {
		
		$file_path = '/home/paymentstemplates/'.$id.'/'.$id.'.xls';  
		if (!file_exists($file_path)) {
			die('El archivo no existe.');
		}
	}
	if (ob_get_level()) {
		ob_end_clean();
	}

	header('Content-Description: File Transfer');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file_path));

	readfile($file_path);
	exit;
	
}

?>