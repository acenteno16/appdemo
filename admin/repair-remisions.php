<?

/*
include('sessions.php');

$id = array();
$id[] = '49254';
$id[] = '49255';

for($i=0;$i<sizeof($id);$i++){
	
	echo '<br><br>';
	
	$query= "select * from packagescontent where package = '$id[$i]'";
	$result = mysqli_query($con, $query);
	while($row=mysqli_fetch_array($result)){
		
		echo '<br>'.$queryUpdate = "update payments set sent = '0' where id = '$row[payment]'";
		$resultUpdate = mysqli_query($con,$queryUpdate);
		
	}
	
	echo '<br>'.$queryDelete = "delete from packages where id = '$id[$i]'";
	$resultDelete = mysqli_query($con,$queryDelete);
	
	echo '<br>'.$queryDelete2 = "delete from packagescontent where package = '$id[$i]'";
	$resultDelete2 = mysqli_query($con,$queryDelete2);
		
}

/*

- 230436
- 233497
- 233512
- 233544
- 233553
- 233555
- 233557
- 233564
- 233577
- 233596
- 233598
- 233617
- 233625
- 233626


- 233560
- 233627
- 233629
- 233630
- 233631
- 233633
- 233634
- 233635
- 233637
- 233639
- 233642
- 233643
- 233644
- 233645
- 233646
- 233647
- 233648
- 233663
- 233664
- 233665
- 233666
- 233667
- 233668
- 233671
- 233672
- 233673
- 234109
- 234111

*/

?>