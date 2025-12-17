<? 

include('sessions.php');

$code = $_GET['code'];

$query = "select * from workers where code = '$code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$name = $row['first']." ".$row['last']; 

$query = "insert into providers (code, name, term, ruc, country) values ('$code', '$name', '30', '$row[nid]', 'Nicaragua')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con);

header('location: providers-edit.php?id='.$id);

?>