<? 

include('sessions.php');

$query = 'delete from tcDraft';
$result = mysqli_query($con,$query);

header('location: tc-import.php');

?>