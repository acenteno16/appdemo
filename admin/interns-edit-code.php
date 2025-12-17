<?

include("session-providers.php"); 

$id = $_POST['id'];

//intern
$code = $_POST['code'];
$company = $_POST['company'];
$unit = $_POST['unit'];
$first = $_POST['first'];
$first2 = $_POST['first2'];
$last = $_POST['last'];
$last2 = $_POST['last2'];
$address = $_POST['address'];
$nid = $_POST['nid'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$active = $_POST['active'];

//Stages
$gcomments = "El pasante ha sido actualizado.";

if($id == "new"){
    $queryinsert = "insert into interns (code) values ('00000')"; 
    $resultinsert = mysqli_query($con, $queryinsert);
    $id = mysqli_insert_id($con); 
    
    //Stages
    $gcomments = "El pasante ha sido creado.";
}


$queryUpdate = "update interns set code='$code', first='$first', first2='$first2', last='$last', last2='$last2', company='$company', phone='$phone', address='$address', nid='$nid', email='$email', unit='$unit', active='$active' where id = '$id'"; 
$resultUpdate = mysqli_query($con, $queryUpdate); 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];



$querytime = "insert into internstimes (intern, today, now, now2, userid, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$gcomments')";   
$resulttime = mysqli_query($con, $querytime);

header('location: interns.php');

?>