<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-routes.php"); 

$id = $_POST['id'];
$percent = $_POST['percent']; 
#$company = isset($_POST['company']) ? sanitizeInput(intval($_POST['company']), $con) : [];
$aa = isset($_POST['aa']) ? sanitizeInput(intval($_POST['aa']), $con) : [];
$thecompany = array();

/*
for($a=0;$a<sizeof($company);$a++){ 
	
	$cinfo0 = $company[$a];
	$cinfo = explode(',', $cinfo0); 
	$aroute = $cinfo[0];
	$acompany = $cinfo[1]; 
	$thecompany[$aroute][] = $acompany; 

}
*/

for($m=0;$m<sizeof($aa);$m++){ 
	
	$active_arr = explode(',', $aa[$m]); 
	$active_id = $active_arr[0];
	$active_value = $active_arr[1]; 
	$aactive[$active_id] = $active_value;

}


for($c=0;$c<sizeof($id);$c++){
	
	/*
	$str = "";
	//echo '<br>Sizeof: '.sizeof($thecompany[$id[$c]]);
	for($b=0;$b<sizeof($thecompany[$id[$c]]);$b++){ 
		$str.= $thecompany[$id[$c]][$b].",";   
	}
	for($d=0;$d<sizeof($theaa[$id[$c]]);$d++){ 
		$str2= $theaa[$id[$c]][$d];   
	}
	*/
	
	$theid = $id[$c];
	
	#$query = "update routes set aa='$aactive[$theid]', percent = '$percent[$c]', companies='$str' where id = '$id[$c]'";
	$query = "update routes set aa='$aactive[$theid]', percent = '$percent[$c]' where id = '$id[$c]'";
	$result = mysqli_query($con, $query);  

} 


header("location: ".$_SERVER['HTTP_REFERER']); 

?>