<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");

$ok = 1;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id == 1){
	$ok = 0;
}

$query1 = "SELECT * FROM categories WHERE parentcat = ?";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param("s", $id); // Asume que $id es un string, ajusta a "i" si es un entero
$stmt1->execute();
$result1 = $stmt1->get_result();
$num1 = $result1->num_rows;
if ($num1 > 0) {
    $ok = 0;
} else {
    $ok = 1; // Agregado para manejar el caso contrario
}
$row = $result1->fetch_assoc();
 
if($ok == 1){
	$query = "DELETE FROM categories WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("i", $id); // "i" para indicar que $id es un entero
	$stmt->execute();
}
if(!$result){ ?>
<script nonce="<?= $nonce ?>">
alert('No se pudo borrar la categoria, asegurese de haber borrado previamente las subcategorias de este elemento.');
history.go(-1); 
</script>	
<?php }else{ header('location: '.$_SERVER['HTTP_REFERER']); } ?>