<?php include("sessions.php");

$mayorstage = $_POST['variable'];

?>
<option value="0">Ningún consolidado en específico</option>                                                 
<?php $querypackage = "select mayorcontent.* from mayorcontent inner join payments on mayorcontent.payment = payments.id where payments.mayorstage = '$mayorstage' group by mayorcontent.package order by mayorcontent.id desc limit 18";
$resultpackage = mysqli_query($con, $querypackage);
while($rowpackage=mysqli_fetch_array($resultpackage)){
?>
<option value="<?php echo $rowpackage['package']; ?>" <?php if($rowpackage['package'] == $_GET['mayorpackage']) echo 'selected'; ?>><?php echo 'Consolidado No. '.$rowpackage['package'].' orden de pago No. '.$rowpackage['payment2']; ?></option>
<?php } ?>	