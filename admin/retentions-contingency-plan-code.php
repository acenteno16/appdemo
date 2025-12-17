<? 

include("session-retentions.php"); 

//Here the code from payment order (INSERT)

$modrettype = $_POST['modrettype'];
$modrettoday = $_POST['modrettoday'];
$modretno = $_POST['modretno'];
$modretprovider = $_POST['modretprovider'];
$modretaddress = $_POST['modretaddress'];
$modretruc = $_POST['modretruc'];
$modretnid = $_POST['modretnid'];
$modretphone = $_POST['modretphone'];
$modretconcept = $_POST['modretconcept'];
$modretbills = $_POST['modretbills'];
$modrettotalbill = $_POST['modrettotalbill'];
$modretpercent = $_POST['modretpercent'];
$modrettotalretention = $_POST['modrettotalretention'];
$modretelaborator = $_POST['modretelaborator'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

for($c = 0; $c < sizeof($modrettype); $c++){
		
		$thetoday[$c] = date("Y-m-d", strtotime($modrettoday[$c]));  
		
		$queryrets = "insert into manualretentions (payment, type, today, number, provider, address, ruc, nid, phone, concept, bills, totalbill, percent, totalretention, elaborator, contingency) values ('$id', '$modrettype[$c]', '$thetoday[$c]', '$modretno[$c]', '$modretprovider[$c]', '$modretaddress[$c]', '$modretruc[$c]', '$modretnid[$c]', '$modretphone[$c]', '$modretconcept[$c]', '$modretbills[$c]', '$modrettotalbill[$c]', '$modretpercent[$c]', '$modrettotalretention[$c]', '$modretelaborator[$c]', '1')";  
		$resultrets = mysqli_query($con, $queryrets);   
		
}

header('location: retentions-home.php');

?>