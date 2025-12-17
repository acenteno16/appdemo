<? 

include('sessions.php');

$query = "select * from filebox where rloc3Status = '2'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	#nos conectamos al servidor de respaldo
	$ftp_server = 'ftp.nicaraguashuttle.com';
	$ftp_user_name = 'newfiles@nicaraguashuttle.com ';
	$ftp_user_pass = 'm5ejgaWqwcIVgo8';
	$ftp = ftp_connect($ftp_server);
	$login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);

	$local_file = "//home/getpaycp/files/folder_$row[user]/$row[name]";
	
	$remote_folder = '/folder_'.$row['user'].'';
	$remote_file = "$remote_folder/$row[name]";
		
	if(ftp_get($ftp, $local_file, $remote_file, FTP_BINARY)) {
		echo '<br>'.$row['id'].' - Si '.$local_file;
	}else{
		echo '<br>'.$row['id'].' - No';
	}
				
	
}
?>