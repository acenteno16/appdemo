<? 

$thedate = $_POST['thedate'];
if($thedate != ""){
	$thedate = date("Y-m-d", strtotime($thedate)); 
}

$today = date('Y-m-d');

if($thedate > $today){
	echo '1'; 
}


?>