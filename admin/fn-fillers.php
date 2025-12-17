<? 

include_once('sessions.php');

$type = $_POST['type'];

if($type == 1){

	$queryproviders = "select * from providers where code != '' and name != '' order by name";
	$resultproviders = mysqli_query($con, $queryproviders);
	while($rowproviders = mysqli_fetch_array($resultproviders)){ 
		?><option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $filter_provider) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option><? 
	} 
}

?>