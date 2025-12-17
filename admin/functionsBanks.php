<? 

$thisPlan = array();
$queryPlans = $con->prepare("select id, name from bankspaymentplans");
$queryPlans->execute();
$resultPlans = $queryPlans->get_result();
while ($rowPlans = $resultPlans->fetch_assoc()){
	$thisPlan[$rowPlans['id']] = $rowPlans['name'];
}

?>