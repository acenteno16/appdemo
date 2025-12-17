<? 

include('sessions.php');

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = $_GET['id'];
$company = $_GET['company'];
$bank = $_GET['bank'];
$currency = $_GET['currency'];

$queryFunds = "select * from funds where id = '$id'";
$resultFunds = mysqli_query($con, $queryFunds);
$rowFunds = mysqli_fetch_array($resultFunds);

$thisCompany = array();
$queryCompaies = "select * from companies order by name";
$resultCompaies = mysqli_query( $con, $queryCompaies );
while ( $rowCompaies = mysqli_fetch_array( $resultCompaies ) ) {
	$thisCompany[$rowCompaies['id']] = $rowCompaies['name']; 
}

$thisBank = array();
$querybanks = "select * from banks order by name";
$resultbanks = mysqli_query( $con, $querybanks );
while ( $rowbanks = mysqli_fetch_array( $resultbanks ) ) {
	$thisBank[$rowbanks['id']] = $rowbanks['name'];
}

$thisCurrency = array();
$querycurrency = "select id, name from currency limit 2";
$resultcurrency = mysqli_query( $con, $querycurrency );
while ( $rowcurrency = mysqli_fetch_array( $resultcurrency ) ) {
	$thisCurrency[$rowcurrency['id']] = $rowcurrency['name'];
}

$oldCompany = $thisCompany[$rowFunds['company']];
$newCompany = $thisCompany[$company];
$oldBank = $thisBank[$rowFunds['bank']];
$newBank = $thisBank[$bank];
$oldCurrency = $thisCurrency[$rowFunds['currency']];
$newCurrency = $thisCurrency[$currency];

$reason = "Compañia: de $oldCompany a $newCompany, Banco: de $oldBank a $newBank, Moneda: de $oldCurrency a $newCurrency";

$querySave = "update funds set company = '$company', bank='$bank', currency='$currency' where id = '$id'";

$resultSave = mysqli_query($con, $querySave);
		
$queryFtimes = "insert into fundstimes (fund, today, now, now2, userid, stage, reason, color) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1.50', '$reason', 'blue')";
$resultFtimes = mysqli_query($con, $queryFtimes);

header('location: funds-confirmation-approve-view.php?id='.$id);

?>