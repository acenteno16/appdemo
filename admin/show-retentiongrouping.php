<? 

include('sessions.php');

echo $querymain = "select payments.provider from irretention inner join payments on irretention.payment = payments.id where irretention.remissionstatus = '1' and irretention.number > '0' group by payments.provider order by irretention.id asc"; 
//and ungrouped = '0'"; 
$resultmain = mysqli_query($con, $querymain);
echo '<br>Num: '.$nummain = mysqli_num_rows($resultmain);
$totpagina = ceil($nummain / $tampagina);

while($rowmain=mysqli_fetch_array($resultmain)){
	
	echo '<br>'.$provider['id'] = $rowmain['provider'];
	
}


?>