<? 

include('sessions.php');

$today = date('Y-m-d');
$userid = $_POST['worker'];
$company = $_POST['company'];

$query = "insert into hallsbooknotifications (today, userid, company, addby) values ('$today', '$userid', '$company', '$_SESSION[userid]')";
$result = mysqli_query($con, $query);

header('location: halls-retention-notifications.php');

?>