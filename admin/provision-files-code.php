<? 


require ('session-provision.php');

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$userid = $_SESSION['userid'];
$id = $_POST['id']; 

// Validar si $id es un array
if (is_array($id)) {
    for ($c = 0; $c < count($id); $c++) {
        // Sanitizar el ID actual
        $currentId = intval($id[$c]); // Asegurarse de que sea un entero

        // Actualizar la tabla payments
        $queryfprovision = "UPDATE payments SET fprovision = '1' WHERE id = ?";
        $stmtfprovision = $con->prepare($queryfprovision);
        $stmtfprovision->bind_param("i", $currentId);
        $stmtfprovision->execute();

        // Insertar en la tabla provisionfilestimes
        $querytime = "INSERT INTO provisionfilestimes (payment, today, now, now2, userid, stage, comment) 
                      VALUES (?, ?, ?, ?, ?, '1', 'Archivos recibidos')";
        $stmttime = $con->prepare($querytime);
        $stmttime->bind_param("issss", $currentId, $today, $now, $now2, $userid);
        $stmttime->execute();
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>
