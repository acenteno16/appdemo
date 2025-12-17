<?php 

include("session-admin.php");

$today = date("Y-m-d");
$hall = $_POST["hall"];
$serial = $_POST['serial'];
$retention1 = $_POST['retention1'];
$retention2 = $_POST['retention2'];
$userid = $_SESSION['userid'];

if($hall == 0){
	?>
    <script>
	alert('Debe de seleccionar una alcaldía.');
	history.go(-1);
	</script>
    <?php exit();
}
if($retention1 > $retention2){
	?>
    <script>
	alert('El numero inicial no puede ser mayor que el final.');
	history.go(-1);
	</script>
    <?php exit();
}
if($serial == ""){
	?>
    <script>
	alert('El numero no puede estar en blanco.');
	history.go(-1);
	</script>
    <?php exit();
}

$querymain = "insert into hallsbook (today, userid, hall, serial, start, end) values ('$today', '$userid', '$hall', '$serial', '$retention1', '$retention2')"; 
$resultmain = mysqli_query($con, $querymain);
$idbook = mysqli_insert_id($con);

for($i=$retention1;$i<=$retention2;$i++){
	$query = "insert into hallsretention (serial, number, hall, userid, today, book) values ('$serial', '$i', '$hall', '$userid', '$today', '$idbook')"; 
	$result = mysqli_query($con, $query);
} 

header('location: '.$_SERVER['HTTP_REFERER']);

?>