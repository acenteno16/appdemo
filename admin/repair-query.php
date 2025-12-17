<? 

include('session-admin.php');

echo $query = "EXPLAIN select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.userid, payments.company, payments.route, payments.payment, payments.bank from payments".$join." where payments.status >= '14'".$sql.' group by payments.id order by payments.id desc'; 
$result = mysqli_query($con, $query);
echo "<br>NUM: ".$num = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

echo $str = implode(" ", $row);

?>