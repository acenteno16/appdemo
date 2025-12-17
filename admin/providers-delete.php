<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "providers"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
} 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("update providers set deleted = '1' where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

header("location: providers.php"); 

?>