<style>
.table {
    width: 500px;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
    font-size: 14px;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: middle;
    border: 1px solid #dee2e6;
}

.table thead th {
    background-color: #f8f9fa;
    font-weight: bold;
    text-align: left;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tbody tr:hover {
    background-color: #e9ecef;
    transition: background-color .2s;
}

.table-bordered {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    overflow: hidden;
}

/* Opcional: hacer la tabla responsive */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}
</style>
<? 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if(!isset($_SESSION)){ session_start(); }

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active"))){
	$gp_server2 = "localhost";
	$gp_username2 = "cp_getpay";
	$gp_password2 = "9gwfxCpxFL8T60m";
	$gp_database2 = "cp_getpay_damage"; 

	$con = mysqli_connect($gp_server2, $gp_username2, $gp_password2, $gp_database2); 
	mysqli_set_charset($con, "utf8mb4"); 
}
else{
	if(isset($_SESSION)){ session_destroy(); }
	header("location: ../?err=nosession_sessions");	  
} 

/*
$queryStages = "select * from stages";
$resultStages = mysqli_query($con, $queryStages);
while($rowStages=mysqli_fetch_array($resultStages)){

?>
<a href="?type=<? echo $rowStages['id']; ?>"><? echo $rowStages['name']; ?></a><br>
<? 
}
*/

$thisCurrency = array();
$thisCurrency[1] = 'Córdobas';
$thisCurrency[2] = 'Dólares';

$today = date('2025-11-13');

$query = "select * from schedule where today = '$today'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$queryWorker = "select first, last, email from workers where code = '$row[userid]'";
	$resultWorker = mysqli_query($con, $queryWorker);
	$rowWorker = mysqli_fetch_array($resultWorker); 
	$thisUser = "$rowWorker[first] $rowWorker[last]";
	
	$amount = number_format($row['ammount'], 2);
	$currency = $thisCurrency[$row['currency']];
	
	echo "<br><br>
	Hora: $row[now2]<br>
	Usuario: $thisUser<br>
	Monto: $amount<br>
	Moneda: $currency<br>
	Progragramado para: $row[schedule]<br>
	Pagos: ";
	$queryContent = "select * from schedulecontent where schedule = '$row[id]'";
	$resultContent = mysqli_query($con, $queryContent);
	while($rowContent = mysqli_fetch_array($resultContent)){
		echo $rowContent['payment'].', ';
	}
	
	
 } 

?>