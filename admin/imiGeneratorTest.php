<table width="500px;" border="1">
	<tr>
	<td>SID</td>
	<td>Anulada</td>
	<td>Monto</td>
	</tr>
	
<? 

include('sessions.php'); 

$query = "select payments.id, payments.ret1void, payments.ret1a, payments.ret1id from payments inner join times on payments.id = times.payment where payments.approved = '1' and payments.ret1a > '0' and payments.hall = '22' and times.stage = '13' and times.today >= '2022-12-01'";
$result = mysqli_query($con, $query);
echo $num = mysqli_num_rows($result);
echo '<br>';
while($row=mysqli_fetch_array($result)){ 
	
	echo "<tr><td>$row[id]</td> <td>$row[ret1void]</td><td>$row[ret1a]</td></tr>";
	
	###$queryUpdate = mysqli_query("update payments set ret1void = '0' where id = '$row[id]'"); 
		
}

?>
	
	</table>