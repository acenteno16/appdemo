<?php 

include('sessions.php');



$query = "select * from payments where hall = 5";
$result = mysqli_query($con, $query);
echo 'Num: '.$num = mysqli_num_rows($result); 
while($row=mysqli_fetch_array($result)){
	echo '<br>ID: '.$row['id']."/ Route:".$row['route'];
}


//$query = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '5' order by hallsretention.id asc limit 1"; 

?>