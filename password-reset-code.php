<?php
 
include("connection.php");  

$token = isset($_POST['token']) ? $_POST['token'] : '';
$password1 = isset($_POST['password1']) ? trim($_POST['password1']) : '';
$password2 = isset($_POST['password2']) ? trim($_POST['password2']) : '';

if ($password1 === '') {
    header('Location: password-reset.php?token=' . urlencode($token) . '&error=blank');
    exit();
}

if ($password1 !== $password2) {
    header('Location: password-reset.php?token=' . urlencode($token) . '&error=notmatch');
    exit();
}

if (strlen($password1) < 8) {
    header('Location: password-reset.php?token=' . urlencode($token) . '&error=tooshort');
    exit();
}

if (strlen($password1) > 25) {
    header('Location: password-reset.php?token=' . urlencode($token) . '&error=toolong');
    exit();
}

// Si todo está bien
$password = md5($password1);
$query = "UPDATE workers SET password = ?, token = '' WHERE token = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ss", $password, $token);
$stmt->execute();

header('Location: password-changed.php?success=1');
exit();

?>