<? 

include('sessions-cards.php');

$id = $_POST['id'];
$number = $_POST['number'];
$assigned = $_POST['assigned'];
$company = $_POST['company'];
$category = $_POST['category'];

$query = "update creditcards set number='$number', assigned='$assigned', company='$company', category='$category' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: credit-cards.php');

?>