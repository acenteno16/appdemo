<? 

include('session-approve-bt.php');

$id = $_GET['id'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$approve = $_GET['approve']; 
$reason = $_GET['reason'];
$reason2 = $_GET['reason2']; 

for($i=0;$i<sizeof($id);$i++){
	
	$id_int = $id[$i];  
	$chain_arr = explode(',', $chain);
	if(!in_array($id_int, $chain_arr)){
		
	
		if($approve[$i] == 2){
		
			//Reprobar pago
			$queryreject = "update letters set status = '3', approved='2' where id = '$id_int'";
			$resultreject = mysqli_query($con, $queryreject);
			$gcomments = $comments;	

			$gcomments = "La solicitud ha sido rechazado.";	
			$querytime = "insert into letterstimes (letter, today, now, now2, userid, stage, comment, reason, reason2) values ('$id_int', '$today', '$now', '$now2', '$_SESSION[userid]', '$newstatustime', '$gcomments', '$reason', '$reason2')";
			$resulttime = mysqli_query($con, $querytime);  
		
		}
		else{
	
			$queryapprove = "update letters set status='2', approved = '1' where id = '$id_int'";
			$resultapprove = mysqli_query($con, $queryapprove);
			$gcomments = "Enhorabuena, la solicitud ha sido aprobada.";
		
			$querytime = "insert into letterstimes (letter, today, now, now2, userid, stage, comment) values ('$id_int', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments')"; 
			$resulttime = mysqli_query($con, $querytime); 
		
		}
		
		$chain.= $id_int.","; 
	}
	
}

header('location: approve.php');

?>