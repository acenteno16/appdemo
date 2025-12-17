<?php include("session-reception.php");

$id = $_POST['id'];

if($id[0] != "e"){
	echo "<script>alert('No se reconoce el ID.'); history.go(-1);</script>";
	exit();
}
$id = str_replace('e','',$id);
$comments = $_POST['comments'];

if($comments == ""){
	echo "<script>alert('Debe de ingresar un comentario de devolucion.'); history.go(-1);</script>";
	exit();
}
if(strlen($comments) < 10){
	echo "<script>alert('El comentario de devolucion debe de contener un minimo de 10 caracteres..'); history.go(-1);</script>";
	exit();
}

$queryenvelope = "select * from retentionenvelope where id = '$id'";
$resultenvelope = mysqli_query($con, $queryenvelope);
$rowenvelope=mysqli_fetch_array($resultenvelope);

$queryenvelopecontent = "select * from retentionenvelopecontent where envelope = '$rowenvelope[id]'";
$resultenvelopecontent = mysqli_query($con, $queryenvelopecontent);
while($rowenvelopecontent=mysqli_fetch_array($resultenvelopecontent)){
	//IMI
	if($rowenvelopecontent['type'] == 1){
		$queryupdateimi = "update irretention set delivery = '1' where id = '$rowenvelopecontent[retention]'";
		$resultupdateimi = mysqli_query($con, $queryupdateimi);
	}
	//IR
	if($rowenvelopecontent['type'] == 2){
		$queryupdateir = "update hallsretention set delivery = '1' where id = '$rowenvelopecontent[retention]'";
		$resultupdateir = mysqli_query($con, $queryupdateir);
	}

}

$queryupdate = "update retentionenvelope set status = '1' where id = '$id'";
$resultupdate = mysqli_query($con, $queryupdate);

$today = date('Y-m-d');
$now = date('H:i:s');

//Stages
//1- Creado
//2- Inclusion de Retenciones
//3-Remisionado
//4 Regresado

$stage = 4;

$gp_comments = "Enhorabuena, el sobre ha sido regresado.";

$querytimes = "insert into retentionenvelopetimes (envelope, today, now, userid, stage, comment, reason) values ('$id', '$today', '$now', '$userid', '$stage', '$gp_comments', '$comments')"; 
$resulttimes = mysqli_query($con, $querytimes);

header('location: reception-retention-envelope-return.php');

?>