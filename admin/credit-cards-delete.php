<? 

include('sessions-cards.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si la tarjeta ha sido utilizada
$queryCheck = "SELECT id FROM payments WHERE cc = ?";
$stmtCheck = $con->prepare($queryCheck);
$stmtCheck->bind_param("s", $id); // "s" porque cc podría ser un string alfanumérico
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();
$numCheck = $resultCheck->num_rows;

// Validar si se puede eliminar
if ($numCheck == 0) {
    // Eliminar la tarjeta de crédito
    $queryDelete = "DELETE FROM creditcards WHERE id = ?";
    $stmtDelete = $con->prepare($queryDelete);
    $stmtDelete->bind_param("s", $id); // "s" porque id podría ser un string alfanumérico
    $stmtDelete->execute();

    // Redirigir si la eliminación fue exitosa
    if ($stmtDelete->affected_rows > 0) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "<script>alert('No se pudo eliminar la tarjeta.');history.go(-1);</script>";
        exit();
    }
} else {
    // Mostrar mensaje si la tarjeta no se puede eliminar
    echo "<script>alert('No se puede eliminar una tarjeta que ha sido utilizada.');history.go(-1);</script>";
    exit();
}

// Cerrar los statements
$stmtCheck->close();
$stmtDelete->close();

?>