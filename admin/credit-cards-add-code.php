<?

include('sessions-cards.php');

$number = $_POST['number'];
$assigned = $_POST['assigned'];
$company = $_POST['company'];
$category = $_POST['category'];

$query = "insert into creditcards (number, assigned, company, category) values ('$number', '$assigned', '$company', '$category')";
$result = mysqli_query($con, $query);

header('location: credit-cards.php');

?>