<?php include("sessions.php");


$userid = $_SESSION['userid'];
$today = date('Y-m-d');

$template = $_POST['template'];
$unit = $_POST['unit'];
$accounts = $_POST['accounts'];
$percent = $_POST['percent'];

$query1 = "delete from templatescontent where template = '$template'";
$result1 = mysqli_query($con, $query1); 

if($percent != ""){
    for($c = 0; $c < sizeof($percent); $c++){ 
	 $query1 = "insert into templatescontent (template, unit, account, percent) values ('$template', '$unit[$c]', '$accounts[$c]', '$percent[$c]')";
	 $result1 = mysqli_query($con, $query1);
	 
   }
}
     

header("location: templates-view.php?id=".$template);     

?>