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

$allowedRoles = ["admin", "providers", "providers_report"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
} 

function sanitizeInput($val, $con) {
    if (is_array($val)) {
        foreach ($val as &$value) {
            $value = mysqli_real_escape_string($con, $value);
        }
    } else {
        $val = mysqli_real_escape_string($con, $val);
    }
    return $val;
}

$id = isset($_POST['id']) ? sanitizeInput($_POST['id'], $con) : 0;
$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : '';
$expirationReq = isset($_POST['expirationReq']) ? sanitizeInput($_POST['expirationReq'], $con) : 0;

if($id > 0){
	$query = "update providersDocsTypes set name = '$name', expirationReq='$expirationReq' where id = '$id'";
}else{
	$query = "insert into providersDocsTypes (name, expirationReq) values ('$name', '$expirationReq')";
}
$result = mysqli_query($con, $query);

header('location: providersDocs.php?id=0');

?>