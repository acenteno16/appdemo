<? 

include('sessions.php');


echo '<br>'.$query_update = "update payments set globalpayment='131951.17' where child = '49308'";
$result_update = mysqli_query($con, $query_update); 
	

/*
include('sessions.php');

$codes = "49308,2139081,2139104,2154099,2182017,2237308,2252139,2254732,2266778,2276729,2276787,2276921,2293202,2310101,2310161,2310041,1736114,2335955,2336009,2336052,2336081,2337629,2358658,2358569,2358664,2358724,2358753,2358842,2358865,2359215,2358991,2359037,2358242,2359312,2358552,2348522";

$codes_arr = explode(',',$codes);

$inc = 0;

$query = "select * from payments where child = '49308' order by id asc";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){

	echo '<br>'.$query_update = "update bills set type='4', concept='176', concept2='0' where payment = '$row[id]'";
	$result_update = mysqli_query($con, $query_update);
	
	$inc++;

}

*/


/*
$codes = "2139081,2139104,2154099,2182017,2237308,2252139,2254732,2266778,2276729,2276787,2276921,2293202,2310101,2310161,2310041,1736114,2335955,2336009,2336052,2336081,2337629,2358658,2358569,2358664,2358724,2358753,2358842,2358865,2359215,2358991,2359037,2358242,2359312,2358552,2348522";

$codes_arr = explode(',',$codes);

$inc = 0;

$query = "select * from payments where child = '49308' order by id asc";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){

	$query_update = "update payments set intern='$codes_arr[$inc]' where id = '$row[id]'";
	$result_update = mysqli_query($con, $query_update); 
	
	$inc++;

}
*/


?>