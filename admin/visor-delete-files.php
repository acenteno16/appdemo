<?php 

#ini_set('display_errors', 1); 
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require("session-admin.php"); 
require('functions.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select user, name, url from filebox where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();

$allPayments = array();
$payments = array();

if ($num == 1) {
  
    $sanitizedUrl = sanitizeInput($row['url'], $con);
    $stmtFile = $con->prepare("SELECT payment FROM files WHERE link LIKE ?");
    $likeUrl = '%' . $sanitizedUrl . '%'; // Agregar % para LIKE
    $stmtFile->bind_param("s", $likeUrl);
    $stmtFile->execute();
    $resultFile = $stmtFile->get_result();

    if ($resultFile->num_rows > 0) {
        while ($rowFile = $resultFile->fetch_assoc()) {
            $paymentId = sanitizeInput($rowFile['payment'], $con);

            // Consulta preparada para verificar el estado del pago
            $stmtPaymentCheck = $con->prepare("SELECT id, approved FROM payments WHERE id = ?");
            $stmtPaymentCheck->bind_param("i", $paymentId);
            $stmtPaymentCheck->execute();
            $resultPaymentCheck = $stmtPaymentCheck->get_result();

            if ($resultPaymentCheck->num_rows > 0) {
                $rowPaymentCheck = $resultPaymentCheck->fetch_assoc();

                // Clasificar los pagos según el estado de aprobación
                if ($rowPaymentCheck['approved'] == 2) {
                    $allPayments[] = $rowPaymentCheck['id'];
                } else {
                    $payments[] = $rowPaymentCheck['id'];
                }
            }

            $stmtPaymentCheck->close();
        }
    }

    $stmtFile->close();
}

if(sizeof($payments) > 0){
	exit('<script>alert("No se puede eliminar el archivo ya que esta siendo utilizado en una solicitud de pago."); history.go(-1);"</script>');
}
else{
	
	$directory = "/home/files/folder_".$row['user']."/".$row['name'];
	if(file_exists($directory)){ unlink($directory); }

		$queryDelete = $con->prepare("delete from filebox where id = ?");
		$queryDelete->bind_param("i", $id);
		$queryDelete->execute();
 
		header('location: files.php');
	}



exit('<script>alert("No se encontro el archivo."); history.go(-1);"</script>');

?>