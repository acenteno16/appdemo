<? 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../connection.php'; 

$queryFiles = "select * from filebox where rloc3 = '0' and today >= '2018-01-01' and today < '2019-01-01' order by id limit 100";
$resultFiles = mysqli_query($con, $queryFiles);
echo $numFiles = mysqli_num_rows($resultFiles); 
$i=0;
$status = 0;
while($rowFiles=mysqli_fetch_array($resultFiles)){
	
	
	$file = "//home/getpaycp/files/folder_$rowFiles[user]/$rowFiles[name]";
	
	
	if(!file_exists($file)){
		$status = 2; 
		
		
	}else{
		$status = 1;
	}
	
	echo '<br>-'.$queryUpdate = "update filebox set rloc3 = '1', rloc3Status = '$status' where id = '$rowFiles[id]'";
	$resultUpdate = mysqli_query($con, $queryUpdate);
	
	
}



?>