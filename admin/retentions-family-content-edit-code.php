<? 

include('sessions.php'); 

$id = $_POST['id'];

$family = $_POST['family'];
$code = $_POST['code'];
$name = $_POST['name'];
$percentage = $_POST['percentage'];
$base = $_POST['base'];

$query = "update retfamilycontent set code='$code', name='$name', percentage='$percentage', base='$base' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: retentions-family-content.php?id='.$family);

?>