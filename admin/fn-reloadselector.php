<?

include('sessions.php');

$value = $_POST['myvariable']; 

if($value == 'providers'){
	$queryproviders = "select id, code, name from providers where code > '0' order by name";
	$resultproviders = mysqli_query($con, $queryproviders);
	while($rowproviders = mysqli_fetch_array($resultproviders)){
	?>
	<option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
	<? }
											
}
elseif($value == 'workers'){
	$queryproviders = "select id, code, first, last from workers order by first,last";
	$resultproviders = mysqli_query($con, $queryproviders);
	while($rowproviders = mysqli_fetch_array($resultproviders)){ ?>
    	<option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option> 
    <? }
						
}
elseif($value == 'requester'){
	$queryproviders = "select id, code, first, last from workers order by first,last";
	$resultproviders = mysqli_query($con, $queryproviders);
	while($rowproviders = mysqli_fetch_array($resultproviders)){ ?>
    	<option value="<?php echo $rowproviders["code"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
    <? }
						
}
elseif($value == 'routes'){
	$queryproviders = "select code, code2, name from units order by code";
	$resultproviders = mysqli_query($con, $queryproviders);
	while($rowproviders = mysqli_fetch_array($resultproviders)){ ?>
    	<option value="<?php if($rowproviders['code2'] != ""){ echo $rowproviders['code2']; }else{ echo $rowproviders["code"]; } ?>"><?php  echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option> 
        <?php }
											
} 
?>