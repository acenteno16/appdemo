<?php include("sessions.php");

$irstage = $_POST['variable'];

?>
<option value="<?php echo $rowpackage['package']; ?>" <?php if($rowpackage['package'] == $_GET['irpackage']) echo 'selected'; ?>>Ningún consolidado en específico</option>
<?php $querypackage = "select ircontent.* from ircontent inner join payments on ircontent.payment = payments.id where payments.irstage = '$irstage' group by ircontent.package order by id desc limit 18";
$resultpackage = mysqli_query($con, $querypackage);
while($rowpackage=mysqli_fetch_array($resultpackage)){ 

?>
<option value="<?php echo $rowpackage['package']; ?>" <?php if($rowpackage['package'] == $_GET['irpackage']) echo 'selected'; ?>><?php echo 'Consolidado No. '.$rowpackage['package'].' orden de pago No. '.$rowpackage['payment2']; ?></option>
<?php } ?>