<?php include("sessions.php");

$id = $_POST['id'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$action = 0;

//$queryc = "select * from workers where id = '$id'";
//$resultc = mysqli_query($con, $queryc);
//$rowc = mysqli_fetch_array($resultc);

//$passwordc = $rowc['password'];



if($password != $passwordc){
	//$action = 4;
}
if($password1 == ""){
	$action = 3;
}
if(strlen($password1) < 6){
	$action = 1;
}
if($password1 != $password2){
	$action = 2;
}




switch($action){
	case 0:
	$password1 = md5($password1);
	$query = "update workers set password = '$password1' where id = '$id'";
	$result = mysqli_query($con, $query); 
	header("location: ".$_SERVER['HTTP_REFERER']); 
	break;
	case 1:
	?>
    <script>
    alert('La contraseña no puede ser menor a 6 caracteres.');
	history.go(-1);
    </script>
    <?php break;
	case 2: ?>
    <script>
    alert('Las contrasenas no coinciden.');
	history.go(-1);
    </script>
    <?php break;
	case 3: ?>
    <script>
    alert('La contrasena no puede estar en blanco.');
	history.go(-1);
    </script>
    <?php break;
	case 4: ?>
    <script>
    alert('La contrasena anterior no coincide.');
	history.go(-1);
    </script>
    <?php break;
	
}
?>