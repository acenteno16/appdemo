<?php 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION['imivoid'] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noAdminOrVoidRetention");
}

$id = $_POST['id'];
$comments = $_POST['comments'];
if($comments == ""){
	?>
    <script>
	alert('Usted debe de ingresar un comentario.');
	history.go(-1);
	</script>
    <?
	exit();
}
$thehall = $_POST['thehall'];
 if($thehall== 0){
	?>
    <script>
	alert('Usted debe de seleccionar una alcaldia.');
	history.go(-1);
	</script>
    <?
	exit();
}
$today = date('Y-m-d'); 

$query = "select * from hallsretention where id = '$id'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 

$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '$thehall' order by hallsretention.id asc limit 1";
$resultgretention = mysqli_query($con, $querygretention);
$numgretention = mysqli_num_rows($resultgretention);
$rowgretention = mysqli_fetch_array($resultgretention); 

$idgretention =  $rowgretention['id'];	
$querygretention2 = "update hallsretention set status = '1', payment='$row[payment]', created='$today' where id = '$idgretention'";
$resultgretention2 = mysqli_query($con, $querygretention2);

$comments.= ". Solicitud id ".$row['payment']." id de la nueva retencion ".$idgretention; 

$query1 = "update hallsretention set void='1', voidcomments='$comments', voiduserid='$_SESSION[userid]', voidtoday='$today' where id = '$id'";
$result1 = mysqli_query($con, $query1);   

$query2 = "update payments set ret1id = '$idgretention', hall='$thehall' where id = '$row[payment]'";
$result2 = mysqli_query($con, $query2);
	
header('location: retentions-generator-imi-global.php');
	 
?>