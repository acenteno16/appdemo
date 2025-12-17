<? 

include('sessions.php');

$bdid = $_POST['bdid'];
$ltransaction = $_POST['ltransaction'];

$query = "select * from filebox where user = '$_SESSION[userid]' and bdid = '$bdid' and bdstage = '$ltransaction' order by id desc limit 1";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

echo 'http://getpaycp.com/admin/visor.php?key='.$row['url']; 

?>