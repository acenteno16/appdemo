<?php /*<body onLoad="refreshTimer();">
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('session-admin.php');
	
if($_SESSION['email'] != 'jairovargasg@gmail.com'){
	exit();
}	
	
$ftp_server = 'ftp.nicaraguashuttle.com';
$ftp_user_name = 'files@nicaraguashuttle.com';

$ftp_server = 'ftp.herramientascp.com';
$ftp_user_name = 'files@herramientascp.com';

$ftp_user_pass = 'MTSmart123#';

$ftp = ftp_connect($ftp_server);

if($ftp){
$login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);
$today = date('Y-m-d');
$totime = date('h:i:s');
	
$query = "SELECT dateBackup from config where id = '1'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);	



$queryFiles = "select * from filebox where rloc2 = '0' and today >= '2019-01-01' and today < '$row[dateBackup]' order by id limit 50";  
$resultFiles = mysqli_query($con, $queryFiles);
$numFiles = mysqli_num_rows($resultFiles);
if($numFiles > 0){
	echo $numFiles;
while($rowFiles=mysqli_fetch_array($resultFiles)){
	
	$file = "//home/getpaycp/files/folder_$rowFiles[user]/$rowFiles[name]";
	$remote_file = "$rowFiles[name]";
	
	ftp_chdir($ftp, '/');
		
	$year = date('Y', strtotime($rowFiles['today']));
	if(!@ftp_chdir($ftp, $year)){
         ftp_mkdir($ftp, $year);
         ftp_chdir($ftp, $year);
    }
		
	$folder = "folder_$rowFiles[user]";
	if(!@ftp_chdir($ftp, $folder)){
         ftp_mkdir($ftp, $folder);
         ftp_chdir($ftp, $folder);
    }
	
	if(file_exists($file)){
		
		$rloc = 1;
		if(ftp_size($ftp, $file) == -1){
			if(ftp_put($ftp, $remote_file, $file, FTP_BINARY)){
				$rloc = 2;
				unlink($file);
			}else{
				$rloc = 4;
			}
			
		}
		
		echo '<br>+'.$queryUpdate = "update filebox set rloc2 = '$rloc', rloc4='1' where id = '$rowFiles[id]'";
		$resultUpdate = mysqli_query($con, $queryUpdate);
		
		$totime = date('h:i:s'); 
		
		$queryLog = "insert into ftplogs (today, totime, fileid, status) values ('$today', '$totime', '$rowFiles[id]', '1')";
		$resultLog = mysqli_query($con, $queryLog);
			
		echo "<br>---------> + $year == $folder == $file";
		
	}else{
		
		echo '<br>-'.$queryUpdate = "update filebox set rloc2 = '3' where id = '$rowFiles[id]'";
		$resultUpdate = mysqli_query($con, $queryUpdate);
		
		$queryLog = "insert into ftplogs (today, totime, fileid, status) values ('$today', '$totime', '$rowFiles[id]', '2')";
		$resultLog = mysqli_query($con, $queryLog);
		echo "<br>---------> - $year == $folder == $file";
		
	}
	
}

ftp_close($ftp); 

if($numFiles == 0){
	$queryReset = "update filebox set rloc2 = '0'";
	######$resultReset = mysqli_query($con, $queryReset);
}
?>
<script>
function refreshTimer(){
setTimeout("location.reload(true);", 4000);
}
</script> 
<?
}else{ ?>
<script>
window.location = 'filesBackupDate.php';
</script> 	
<? }

?>
</body>
<? }else{
echo "Connection ERR NOFTP";
}
?>
*/ ?>