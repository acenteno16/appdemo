<?

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include("session-admin.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id > 0){
	echo "<script>if(confirm('Esta seguro de eliminar esta cuenta?') == true){ window.location='banksEditAccountsDelete.php?id2=$id';}else{window.location='banks-edit.php?id=$id';}</script>";
	exit();
}else{

	$id2 = isset($_GET['id2']) ? intval($_GET['id2']) : 0;
	if($id2 > 0){
		
		$query = $con->prepare("select bank from banksaccounts where id = ?");
		$query->bind_param("i", $id2);
		$query->execute();
		$result = $query->get_result();
		$row = $result->fetch_assoc();
		
		$queryDelete = $con->prepare("delete from banksaccounts where id = ?");
		$queryDelete->bind_param("i", $id2);
		$queryDelete->execute();
		
		header('location: banks-edit.php?id='.$row['bank']);
	}else{
		header('location: banks.php');
	}
		
	
	
}





?>