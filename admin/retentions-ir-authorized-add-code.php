<? 

include('session-admin.php');

$today = date('Y-m-d');
$totime = date("H:i:s");
$authorized = $_POST['authorized'];
$today2 = $_POST['today2'];
$company = $_POST['company'];
$comments = $_POST['comments'];

if($authorized == ""){
    exit("<script>alert('Favor ingrese un autorizado.');history.go(-1);</script>");
}
if($today2 == ""){
    exit("<script>alert('Favor ingrese una fecha.');history.go(-1);</script>");
}else{
    $today2 =  date("Y-m-d", strtotime($today2));
    
    if($today2 < date('Y-m-d')){
       #exit("<script>alert('No se permiten fechas del pasado.');history.go(-1);</script>"); 
    }
}
if($company == 0){
    exit("<script>alert('Favor seleccione una compañia.');history.go(-1);</script>");
}

$query = "insert into authorized (authorized, today, company, comments) values ('$authorized', '$today2', '$company', '$comments')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con); 

$querytimes = "insert into authorizedtimes (authorized, today, totime, userid, stage, comments) values ('$id', '$today', '$totime', '$_SESSION[userid]', '1', 'Autorizado ingresado')";
$resulttimes = mysqli_query($con, $querytimes);

header('location: retentions-ir-authorized.php?company='.$company); 

?>