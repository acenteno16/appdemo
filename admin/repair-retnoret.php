<? 

include('sessions.php');

$querypre = "select payments.id, bills.number from bills inner join payments on bills.payment = payments.id where (payments.ret1 = '0' or payments.ret1a = '0') and (bills.ret1 > '0' or bills.ret1a > '0') group by bills.payment";
$resultpre = mysqli_query($con, $querypre);
$numpre = mysqli_num_rows($resultpre);

$query = "select payments.id, bills.number from bills inner join payments on bills.payment = payments.id where (payments.ret1 = '0' or payments.ret1a = '0') and (bills.ret1 > '0' or bills.ret1a > '0')";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);	 
?>
<h1><? echo $num; ?> Facturas encontradas en <? echo $numpre; ?> Solicitudes</h1>

<table width="200" border="1">
  <tbody>
    <tr>
      <td>IDS</td>
      <td>Documento</td>
    </tr>
    <tr>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <? 

while($row=mysqli_fetch_array($result)){
	?>
     <tr>
      <td><? echo $row['id']; ?></td>
      <td><? echo $row['number']; ?></td>
    </tr>
    <? } ?>
  </tbody>
</table>