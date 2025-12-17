<? 

include('sessions.php');

$today= date('Y-m-d');
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$collaborator = $_POST['collaborator'];
$url = $_POST['url'];
$title = $_POST['title'];

$query = "insert into hcfiles (today, now, now2, collaborator, url, userid, title) values ('$today', '$now', '$now2', '$collaborator', '$url', '$_SESSION[userid]', '$title')";
$result = mysqli_query($con, $query); 

header('location: payment-hc-docs.php');

?>