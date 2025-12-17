<? 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 

exit("<script>alert('Debe contactar a un usuario Super Administrador.');history.go(-1);</script>");

?>