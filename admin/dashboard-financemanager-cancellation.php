<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>



<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>


<!-- END THEME STYLES -->



<?php include("sessions.php"); 

$today = date('Y-m-d');
$thisweek = ">= CURDATE() - INTERVAL CASE WEEKDAY(CURDATE()) WHEN 6 THEN -1 ELSE WEEKDAY(CURDATE()) END + 1 DAY";
$thisyear = ">= MAKEDATE(YEAR(CURDATE()), 1)";

$from = $_POST['from'];
$to = $_POST['to'];
$company = $_POST['type'];
$sqldatea = 0;

$sqlfrom = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sqlfrom = " and times.today >= '$from'";
	$sqldatea = 1;
}
$sqlto = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sqlto = " and times.today <= '$to'";
	$sqldatea = 1;
}

if($sqldatea == 0){
	$sqldate = " and times.today >= MAKEDATE(YEAR(CURDATE()), 1)";
}else{
	$sqldate = $sqlfrom.$sqlto;
}

echo "<p style='font-size:14px;'>";

echo "</p><br>";
 
$today = date('Y-m-d');

?>
<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //PAGOS CANCELADOS

//Casa Pellas
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '1'";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 1";
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Casa Pellas

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 1 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 1 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 1 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 1 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>
                                
<?php //Velosa
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14'".$sqldate;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 3";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Velosa

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 3 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 3 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 3 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 3 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>

<?php //Alpesa
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14'".$sqldate;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 2";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Alpesa

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 2 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 2 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 2 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id = 2 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>
                                
<?php //Otras compañías
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14'".$sqldate."";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id > 3";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Otras Compañías

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id > 3 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id > 3 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id > 3 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate." and companies.id > 3 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

</div>
</div>
</div>

<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>

jQuery(document).ready(function() {    
Index.initMiniCharts();
});

</script>
