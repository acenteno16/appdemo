<?php 

include("session-request.php");  

// Verificar permisos de sesión
if ($_SESSION['request-7'] === 'active' || $_SESSION['admin'] === 'active') {
    # doNothing
} else {
    exit('<script>alert("Error de permisos. Contactar al administrador."); window.location = "dashboard.php";</script>');
}

// Obtener y sanitizar datos
$id = isset($_POST['id']) ? sanitizeInput($_POST['id'], $con) : null;
$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : null;
$type = isset($_POST['type']) ? sanitizeInput($_POST['type'], $con) : null;
$bid = isset($_POST['bid']) && is_array($_POST['bid']) ? sanitizeInput($_POST['bid'], $con) : [];

// Validar datos requeridos
if (!$id || !$name || !$type) {
    exit('<script>alert("Datos incompletos."); window.location = "dashboard.php";</script>');
}

// Actualizar `hcTemplates`
$queryUpdate = "UPDATE hcTemplates SET name = ?, type = ? WHERE id = ?";
$stmtUpdate = $con->prepare($queryUpdate);
$stmtUpdate->bind_param("ssi", $name, $type, $id);
$stmtUpdate->execute();
$stmtUpdate->close();

// Eliminar contenidos antiguos
$queryDelete = "DELETE FROM hcTemplatesContent WHERE template = ?";
$stmtDelete = $con->prepare($queryDelete);
$stmtDelete->bind_param("i", $id);
$stmtDelete->execute();
$stmtDelete->close();

// Insertar nuevos contenidos
$queryInsert = "INSERT INTO hcTemplatesContent (ben, template) VALUES (?, ?)";
$stmtInsert = $con->prepare($queryInsert);

foreach ($bid as $ben) {
    $ben = sanitizeInput($ben, $con); // Sanitizar cada elemento de $bid
    $stmtInsert->bind_param("ii", $ben, $id);
    $stmtInsert->execute();
}

$stmtInsert->close();

// Redirigir al usuario
header('Location: payment-hc-templates.php'); 
exit;

?>