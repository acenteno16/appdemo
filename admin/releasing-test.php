<?

include('sessions.php');

$thisyear = date("Y");
$thismonth = date("m");
$fmtoday = $thisyear."-".$thismonth."-1";

$queryprovisioned2 = "select payments.*, times.userid as uid from payments inner join times on payments.id = times.payment where (times.stage = '9') and times.today >= '$fmtoday' group by times.payment";
$resultprovisioned2 = mysqli_query($con, $queryprovisioned2);
$numprovisioned2 = mysqli_num_rows($resultprovisioned2);
while($row=mysqli_fetch_array($resultprovisioned2)){
	echo '-'.$row['id'].'('.$row['uid'].')';;
	echo "<br>";
}

?>