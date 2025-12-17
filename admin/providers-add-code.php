<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$code = $_POST['code'];
$ruc = $_POST['ruc'];

function sanitizeString($input) {
    $sanitized = preg_replace('/[^a-zA-Z0-9]/', '', $input);
    return $sanitized;
}

$sCode = sanitizeString($code);
$sRuc = sanitizeString($ruc);

$query = "select id, code, ruc from providers"; 
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
    
    $thisCode = sanitizeString($row['code']);
    $thisRuc = sanitizeString($row['ruc']);
    
    if(($sRuc == $thisRuc) or ($sCode == $thisCode)){
        exit("<script>alert('Se encontró coincidencia con el proveedor ID#$row[id]'); history.go(-1);</script>");
    }   
}
    
$query2 = "select * from workers where code = '$row[code]'";
$result2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($result2);
if($num2 > 0){
    
    $row2 = mysqli_fetch_array($result2);
    ?>
       <script>
        if(confirm('El codigo ingresado ya esta registrado con el colaborador <? echo $row2['first']." ".$row2['last']; ?>') == true){
            window.location = "providers-add-code-maker.php?code=<? echo $code; ?>";
        }else{
            window.location = "providers-add.php";  
        }
       </script>
    <?
        exit();
        
}
else{
    $query = "insert into providers (code, ruc, today) values ('$code', '$ruc', '$today')";
    $result = mysqli_query($con, $query);  
    $id = mysqli_insert_id($con);      
    header("location: providers-edit.php?id=".$id);
}

?>