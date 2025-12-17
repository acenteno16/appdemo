<? 

include('session-admin.php');

$name = $_POST['name'];
if($name == ""){
    exit('<script>alert("Debe de ingresar un nombre.");history.go(-1);</script>');
}
$code = $_POST['code'];
if($code == ""){
    exit('<script>alert("Debe de ingresar un codigo.");history.go(-1);</script>');
}
$company = $_POST['company'];
if($company == ""){
    exit('<script>alert("Debe de seleccionar una compania.");history.go(-1);</script>');
}

$query = "insert into units (name, code, company, managua) values ('$name', '$code', '$company', '1')";
$result = mysqli_query($con, $query); 

header('location: routes-managua.php');

?>