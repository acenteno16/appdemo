<? 

include('session-admin.php');

if($_SESSION['email'] != "jairovargasg@gmail.com"){
    header('dashboard.php'); 
    exit;
}

$id = $_GET['id'];
$approved = $_GET['approved'];

$query = "select payment from times where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$querydelete = "delete from times where id = '$id'";
$resultdelete = mysqli_query($con, $querydelete);

$querylasttime = "select * from times where payment = '$row[payment]' order by id desc limit 1";
$resultlasttime = mysqli_query($con, $querylasttime);
$rowlasttime = mysqli_fetch_array($resultlasttime);

$queryupdate = "update payments set approved = '$approved', status='$rowlasttime[stage]' where id = '$row[payment]'";
$resultupdate = mysqli_query($con, $queryupdate); 

header('location: '.$_SERVER['HTTP_REFERER']); 


?>