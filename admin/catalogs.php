<? 

$thisCurrency = array();
$queryCurrency = "select * from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
$numCurrency = mysqli_num_rows($resultCurrency);
while($rowCurrency=mysqli_fetch_array($resultCurrency)){
	$thisCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}
$thisDocType = array();
$queryDocType = "select * from followupLogDc";
$resultDocType = mysqli_query($con, $queryDocType);
while($rowDocType=mysqli_fetch_array($resultDocType)){
	$thisDocType[$rowDocType['id']] = $rowDocType['name'];
}

$thisType = array();
$queryType = "select * from followupLogType";
$resultType = mysqli_query($con, $queryType);
$numType = mysqli_num_rows($resultType);
while($rowType=mysqli_fetch_array($resultType)){
	$thisType[$rowType['id']] = $rowType['name'];
}

$thisAccount = array();
$queryAccount = "select * from followupLogAccounts";
$resultAccount = mysqli_query($con, $queryAccount);
while($rowAccount=mysqli_fetch_array($resultAccount)){
	$thisAccount[$rowAccount['id']] = $rowAccount['account'];
}
$thisAccount2 = array();
$queryAccount2 = "select * from followupLogAccounts2";
$resultAccount2 = mysqli_query($con, $queryAccount2);
while($rowAccount2=mysqli_fetch_array($resultAccount2)){
	$thisAccount2[$rowAccount2['id']] = $rowAccount2['account'];
}

$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
	$thisCompany[$rowCompany['id']] = $rowCompany['name']; 
}

$thisBank = array();
$queryBank = "select id, name from banks";
$resultBank = mysqli_query($con, $queryBank);
while($rowBank=mysqli_fetch_array($resultBank)){
	$thisBank[$rowBank['id']] = $rowBank['name']; 
}
?>