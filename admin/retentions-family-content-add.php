<? 

include('sessions.php'); 

$family = $_POST['family'];
$code = $_POST['code'];
$name = $_POST['name'];
$percentage = $_POST['percentage'];
$base = $_POST['base'];

$today = date('Y-m-d');

$query = "insert into retfamilycontent (family, code, name, percentage, base, today, userid) values ('$family', '$code', '$name', '$percentage', '$base', '$today', '$_SESSION[userid]')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con);

header('location: retentions-family-content.php?id='.$family); 

?>