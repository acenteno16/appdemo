<?php 

/*include("../connection.php");


echo $query = "select payments.* from payments inner join workers on payments.userid = workers.code inner join bills on payments.id = bills.payment where (payments.status = '2' or payments.status = '3' or payments.status = '4') and payments.approved = '1' and bills.exempt2 > 0 order by payments.expiration asc";
$result = mysqli_query($con, $query);
echo "<br>Payments: ".$num = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
echo "<br>ID: ".$row['id'];
}
*/

?>