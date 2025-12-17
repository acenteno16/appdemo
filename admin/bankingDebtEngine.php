<? 

include('session-bankingDebt.php'); 
include('functions.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$type = isset($_POST['type']) ? sanitizeInput($_POST['type'], $con) : '';
$today = isset($_POST['today']) ? sanitizeInput($_POST['today'], $con) : '';

if($type == 1){
	
	$query = $con->prepare("select * from bankingDebtContracts where id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	
	echo str_replace(' ','',$row['type']);
	
}
elseif($type == 2){
	
	$queryBalance = $con->prepare("select balance from bankingDebtContractBalance where bankingDebtContract = ? order by id desc limit 1");
	$queryBalance->bind_param("i", $id);
	$queryBalance->execute();
	$resultBalance  = $queryBalance->get_result();
	$rowBalance = $resultBalance->fetch_assoc();
	
	echo $rowBalance['balance'];
	
}
elseif($type == 3){
	
	include_once('sessions.php');
	
	$query = $con->prepare("select date2 from bankingDebtContracts where id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	
	if($today != ''){
		$today = date("Y-m-d", strtotime($today));
	}
	
	if($today > $row['date2']){
		echo $str.'0';
	}else{
		echo $str.'1';
	}
}

?>