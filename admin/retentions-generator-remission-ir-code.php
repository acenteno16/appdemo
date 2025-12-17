<? 

include("session-retentions.php"); 

$id = $_POST['theid'];  
$hall = $_POST['hall'];

$userid = $_SESSION['userid'];
$today = date('Y-m-d');
$totime = date('H:i:s');

$querymain = "insert into irremission (userid, today, totime, status) values ('$userid', '$today', '$totime', '1')";
$resultmain = mysqli_query($con, $querymain);
$idmain = mysqli_insert_id($con); 
 
  for($c=0;$c<sizeof($id);$c++){
	  
	  $queryinsert = "insert into irremissioncontent (irremission, irretention) values ('$idmain', '$id[$c]')";
	  $resultinsert = mysqli_query($con, $queryinsert);
	  
	  $queryupdate = "update irretention set remissionstatus='1', delivery='1' where id = '$id[$c]'"; 
	  $resultupdate = mysqli_query($con, $queryupdate);
	  
  }

header('location: retentions-generator-remission-ir-groups.php?hall='.$hall.'&id='.$idmain);  

?>