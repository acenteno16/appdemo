<? 

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include('session-admin.php');

$id = intval($_GET['id']); 

$query = "select * from interns where id = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
if($num > 0){
    $row = mysqli_fetch_array($result);
    $querycheck = "select * from users where email = '$row[email]' or code = '$row[code]'";
    $resultcheck = mysqli_query($con, $querycheck); 
    $numcheck = mysqli_num_rows($resultcheck);
	
    if($numcheck > 0){
        $a = inactivateIntern($id);
        echo '<script>alert("El correo electronico del pasante ya es utilizado por un colaborador activo."); history.go(-1);</script>'; 
		exit();
    }else{
        $first = $row['first']." ".$row['first2'];
        $last = $row['last']." ".$row['last2'];
        $email = $row['email'];
        $y = date('Y');
        $part = "@";
        $strings = strpos ($email, $part);
		$password = substr ($email, 0,$strings);
		$password = md5('cp'.$password.$y); 
		$password = strtolower($password);
        inactivateIntern($id);   
        $queryinsert = "insert into workers (first, last, code, unit, company, email, nid, password) values ('$first', '$last', '$row[code]', '$unit', '$row[company]', '$row[email]', '$row[nid]', '$password')";
        $resultinsert = mysqli_query($con, $queryinsert);
    }
	
    header('location: interns.php'); 
    
}else{
    exit('<script>alert("No se encontro el pasante."); history.go(-1);</script>');
}

function inactivateIntern($val, $con){
    $queryinactivate = "update interns set inactive = '1' where id = '$val'";
    $resultinactivate = mysqli_query($con, $queryinactivate);
    return true;  
}

?>