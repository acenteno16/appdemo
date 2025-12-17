<? 

include("session-reception.php");

$collector = $_POST['collector'];
$theid = $_POST['theid'];
$name = $_POST['name'];
$nid = $_POST['nid'];

if(sizeof($theid) == 0){
	exit("<script>alert('Debe de seleccionar al menos un sobre.');history.go(-1);</script>");
}
if($collector == 0){
	exit("<script>alert('Debe de seleccionar un colector.');history.go(-1);</script>");
}
if($collector == 1){
    
    if($name == ""){
        exit("<script>alert('Debe de ingresar un nombre.');history.go(-1);</script>");
    }
    if($nid == ""){
        exit("<script>alert('Debe de ingresar un numero de cedula.');history.go(-1);</script>");
    }
    
}

$today = date('Y-m-d');
$now = date('H:i:s'); 

$query = "insert into retentionenveloperemission (today, now, userid, collector, status, name, nid) values ('$today', '$now', '$_SESSION[userid]', '$collector', '1', '$name', '$nid')"; 
$result = mysqli_query($con, $query); 
$id_remission = mysqli_insert_id($con); 

for($i=0;$i<sizeof($theid);$i++){
	echo '<br>'.$query_insert = "insert into retentionenveloperemissioncontent (enveloperemission, envelope) values ('$id_remission', '$theid[$i]')";  
	$result_insert = mysqli_query($con, $query_insert); 
    
    $queryeupdate = "update retentionenvelope set status = '3' where id = '$theid[$i]'"; 
    $resulteupdate = mysqli_query($con, $queryeupdate);
}

header('location: reception-retention-remission-delivery-log.php'); 

?>