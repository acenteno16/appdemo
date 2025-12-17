<?php $today = date("Y-m-d");
$thisweek = ">= CURDATE() - INTERVAL CASE WEEKDAY(CURDATE()) WHEN 6 THEN -1 ELSE WEEKDAY(CURDATE()) END + 1 DAY";
$thisyear = ">= MAKEDATE(YEAR(CURDATE()), 1)";

?>

                    

            
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos Cancelados

						  </div>
                          

							

						</div>
                     
                        </div><br><br>

<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //PAGOS CANCELADOS

//Casa Pellas
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);
$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1";

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

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 1 and currency = 1 and times.today ".$thisweek));

$firstday = date('Y')."-11-1";
$lastday = date('Y-m-d');

$querynio = "select sum(ammount) from payments inner join units on payments.where units.company = 1 and payments.currency = 1 and times.today >= '$firstday' and times.today <= '$lastday'"; 
$rownio=mysqli_fetch_array(mysqli_query($con, $querynio));
$ammountnio = $rownio[0]; 

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 1 and currency = 2 and times.today ".$thisweek));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 1 and currency = 3 and times.today ".$thisweek));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.status = '14' and companies.id = 1 and currency = 4 and times.today ".$thisweek));
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
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 3 and times.today ".$thisweek;
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

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 3 and currency = 1 and times.today ".$thisweek));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 3 and currency = 2 and times.today ".$thisweek));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 3 and currency = 3 and times.today ".$thisweek));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 3 and currency = 4 and times.today ".$thisweek));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">$ &nbsp;</td>
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
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 2 and times.today ".$thisweek;
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

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 2 and currency = 1 and times.today ".$thisweek));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 2 and currency = 2 and times.today ".$thisweek));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 2 and currency = 3 and times.today ".$thisweek));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id = 2 and currency = 4 and times.today ".$thisweek));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">$ &nbsp;</td>
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
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id > 3 and times.today ".$thisweek;
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

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id > 3 and currency = 1 and times.today ".$thisweek));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id > 3 and currency = 2 and times.today ".$thisweek));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id > 3 and currency = 3 and times.today ".$thisweek));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and companies.id > 3 and currency = 4 and times.today ".$thisweek));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">$ &nbsp;</td>
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
                            
                        <br>
<br><br><br>
<style type="text/css"> 
	
	.demo-placeholder {
	width: 100%;
	height: 100%;
	font-size: 14px;
	line-height: 1.2em;
	}
	.demo-container {
		position: relative;
		height: 280px;
	}
	
	
	#description {
		margin: 15px 10px 20px 10px;
	}
	</style>                 
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->


<div class="portlet">

					
</div>

<br><br><br>
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Proveedores más importantes 

						  </div>

							<div class="actions">

								<?php ?>
                             
													  
                                            
                                            	<div style="float:left"">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="from" value="1-<?php echo date("m"); ?>-<?php echo date("Y"); ?>" id="providersfrom" onchange="javascript:reloadProviders();">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="to" value="<?php echo $today = date('j-n-Y'); ?>" id="providersto" onchange="javascript:reloadProviders();">
											</div></div>
                                            <div style="float:right"><div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

												
															<select name="type" class="form-control" id="providerstype" onchange="javascript:reloadProviders();">
														<option value="0">Todas las compañias (NIO)</option>
														<option value="1">Todas las compañias (USD)</option>
														<option value="2">Todas las compañias (EUR)</option>
														<option value="3">Todas las compañias (YEN)</option>
                                                  <option value="4">Casa Pellas (NIO)</option>
														<option value="5">Casa Pellas (USD)</option>
														<option value="6">Casa Pellas (EUR)</option>
														<option value="7">Casa Pellas (YEN)</option>
                                                  <option value="8">Alpesa (NIO)</option>
														<option value="9">Alpesa (USD)</option>
														<option value="10">Alpesa (EUR)</option>
														<option value="11">Alpesa (YEN)</option>
                                                  <option value="12">Velosa (NIO)</option>
														<option value="13">Velosa (USD)</option>
														<option value="14">Velosa (EUR)</option>
														<option value="15">Velosa (YEN)</option>
                                                  <option value="16">Otras compañias (NIO)</option>
														<option value="17">Otras compañias (USD)</option>
														<option value="18">Otras compañias (EUR)</option>
														<option value="19">Otras compañiad (YEN)</option>
													
	 														</select>

													  </div></div>

												
                                <?php //end?> 
                                
                              <?php /*  <a href="javascript:reloadProviders(0);" class="btn default blue-stripe">
								Todas </a> 
                                	 <a href="javascript:reloadProviders(1);" class="btn default blue-stripe">
								Casa Pellas </a> <a href="javascript:reloadProviders(2);" class="btn default blue-stripe">
								Alpesa </a> <a href="javascript:reloadProviders(3);" class="btn default blue-stripe">
								Velosa </a> <a href="javascript:reloadProviders(4);" class="btn default blue-stripe">
								Otras </a>*/ ?>
                                
                               <script>
                                function reloadProviders(){	

	
	var type = document.getElementById('providerstype').value;
	var from = document.getElementById('providersfrom').value;
	var to= document.getElementById('providersto').value;
	
	$.post("dashboard-president-providers.php", { type: type, from: from, to: to }, function(data){
		$("#rproviders").html(data); 
		
});			
}

	</script>						

							</div>

						</div>
</div>
<div id="rproviders">
<p style='font-size:14px;'>Todas las compañías (NIO)</p>
<?php $today = date('Y-m-d');
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join times on payments.id = times.payment where times.stage = '14' and payments.currency = '1' and times.today ".$thisyear."group by payments.provider order by sum(payments.payment) desc limit 10";  
$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1);  
$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){
									
$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[1]'";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);
$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[2]";
$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3);

$presidentproviders .= '["'.$rowpresidentprovider2['name'].'", '.str_replace('.00','',$rowpresidentprovider1[0]).'],';

 
} 
 $presidentproviders = substr($presidentproviders, 0,-1);
?>
<script type="text/javascript">

	$(function() {

		var data = [ <?php echo $presidentproviders; ?> ];

		$.plot("#placeholder", [ data ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			grid: {
				borderColor: "#FFFFFF"
			}
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});

	</script>
   <div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
</div>
</div>
    <br><br><br>
   
   
    
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Rubros más importantes 

						  </div>
                          <div class="actions">

								<?php ?>
                             
													 <div style="float:left"">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="ifrom" value="1-<?php echo date("m"); ?>-<?php echo date("Y"); ?>" id="ifrom" onchange="javascript:reloadKhoom();">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="ito" value="<?php echo $today = date('j-n-Y'); ?>" id="ito" onchange="javascript:reloadKhoom();">
											</div></div> <div style="float:right">
											  <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

													
															<select name="icompany" class="form-control" id="icompany" onchange="javascript:reloadKhoom();">
														<option value="0">Todas las compañias (NIO)</option>
														<option value="1">Todas las compañias (USD)</option>
														<option value="2">Todas las compañias (EUR)</option>
														<option value="3">Todas las compañias (YEN)</option>
                                                  <option value="4">Casa Pellas (NIO)</option>
														<option value="5">Casa Pellas (USD)</option>
														<option value="6">Casa Pellas (EUR)</option>
														<option value="7">Casa Pellas (YEN)</option>
                                                  <option value="8">Alpesa (NIO)</option>
														<option value="9">Alpesa (USD)</option>
														<option value="10">Alpesa (EUR)</option>
														<option value="11">Alpesa (YEN)</option>
                                                  <option value="12">Velosa (NIO)</option>
														<option value="13">Velosa (USD)</option>
														<option value="14">Velosa (EUR)</option>
														<option value="15">Velosa (YEN)</option>
                                                  <option value="16">Otras compañias (NIO)</option>
														<option value="17">Otras compañias (USD)</option>
														<option value="18">Otras compañias (EUR)</option>
														<option value="19">Otras compañiad (YEN)</option>
													
	 														</select>

											  </div>
                                                      
                                                        
                               <script>
                   function reloadKhoom(){
					var company = document.getElementById('icompany').value;
					var from = document.getElementById('ifrom').value;
					var to = document.getElementById('ito').value;
										

	$.post("dashboard-president-khoom.php", { company: company, from: from, to: to }, function(data){
		$("#khoom").html(data);
		
});			
}

	</script>						

												
                               
                            
							</div>
                          
                              

							</div>

							

						</div>
                     
                    
                        <div id="khoom">

<p style='font-size:14px;'>Todas las compañías (NIO)</p><br> 
<?php $today = date('Y-m-d');
$querypresidentconcepts1 = "select sum(payments.payment), payments.concept2 from payments inner join times on payments.id = times.payment where payments.concept = 27 and times.stage = '14' and payments.currency = '1' and times.today ".$thisweek." group by payments.concept2 order by sum(payments.payment) desc limit 10";
$firstday = date("Y-m");
$firstday = $firstday."-1";
$lastday = $today;

$querypresidentconcepts1 = "select sum(ammount), concept2 from bills inner join times on bills.payment = times.payment where times.today >= '$firstday' and times.today <= '$lastday' group by concept2 order by sum(ammount) desc limit 10";   
$resultpresidentconcepts1 = mysqli_query($con, $querypresidentconcepts1);  
$numpresidentconcepts1 = mysqli_num_rows($resultpresidentconcepts1);
while($rowpresidentconcepts1=mysqli_fetch_array($resultpresidentconcepts1)){
									
$querypresidentconcepts2 = "select * from categories where id = '$rowpresidentconcepts1[1]'";
$resultpresidentconcepts2 = mysqli_query($con, $querypresidentconcepts2);
$rowpresidentconcepts2 = mysqli_fetch_array($resultpresidentconcepts2);

$presidentconceptss .= '["'.$rowpresidentconcepts2['name'].'", '.str_replace('.00','',$rowpresidentconcepts1[0]).'],';

 
} 
 $presidentconceptss = substr($presidentconceptss, 0,-1);
?>
    <script type="text/javascript">
	$(function() {

		var data = [ <?php echo $presidentconceptss; ?> ];

		$.plot("#concepts2", [ data ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			grid: {
				borderColor: "#FFFFFF"
			}
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script>
   <div class="demo-container">
			<div id="concepts2" class="demo-placeholder"></div>
		</div>
        </div>
        
        
        <br><br><br>
        
        
        
        
            
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos Programados vs. Pagos Cancelados

						  </div>
                          

							

						</div>
                     
                        </div><br><br>

<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //Casa Pellas
$querymcancellation1 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and units.company = 1";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 1";
//"select * from payments where status = '14' and currency = '1' and WEEK('$today')";
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
/*while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}*/ 
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
Programados: <?php echo $nummcancellation1; ?><br>
Cancelados: <?php echo $nummcancellation2; ?>  
				
									</div>

								</div>
<?php //Dolares
$querymcancellation3 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and units.company = 2";
$resultmcancellation3 = mysqli_query($con, $querymcancellation3);
$rowmcancellation3 = mysqli_fetch_array($resultmcancellation3);
$nummcancellation3 = mysqli_num_rows($resultmcancellation3);

$querymcancellation4 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 2";
$resultmcancellation4 = mysqli_query($con, $querymcancellation4);
while($rowmcancellation4 = mysqli_fetch_array($resultmcancellation4)){
	$ammountusd += $rowmcancellation4['ammount'];
}
$nummcancellation4 = mysqli_num_rows($resultmcancellation4);

$mcancellationusd = ($nummcancellation4*100)/$nummcancellation3;
$mcancellationusd = number_format($mcancellationusd, 2);
$mcancellationusd = str_replace('.00','',$mcancellationusd);
?>
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                    Velosa
										<div class="number <?php if($mcancellationusd < 61) echo "bounce";
										if(($mcancellationusd > 60) and ($mcancellationusd <= 86)) echo "transactions";
										if($mcancellationusd > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationusd."%"; ?>">

											<span>

											<?php echo $mcancellationusd; ?>%</span>


										</div>

					
                                    <br>
                                    Programados: <?php echo $nummcancellation3; ?><br>
Cancelados: <?php echo $nummcancellation4; ?>  
				
									</div>

								</div>
<?php //Euros
$querymcancellation5 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and units.company = 3";
$resultmcancellation5 = mysqli_query($con, $querymcancellation5);
$rowmcancellation5 = mysqli_fetch_array($resultmcancellation5);
$nummcancellation5 = mysqli_num_rows($resultmcancellation5);

$querymcancellation6 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 3";
$resultmcancellation6 = mysqli_query($con, $querymcancellation6);
while($rowmcancellation6 = mysqli_fetch_array($resultmcancellation6)){
	$ammounteur += $rowmcancellation6['ammount'];
}
$nummcancellation6 = mysqli_num_rows($resultmcancellation6);

$mcancellationeur = ($nummcancellation6*100)/$nummcancellation5;
$mcancellationeur = number_format($mcancellationeur, 2);
$mcancellationeur = str_replace('.00','',$mcancellationeur);
?>
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                    Alpesa

										<div class="number <?php if($mcancellationeur < 61) echo "bounce";
										if(($mcancellationeur > 60) and ($mcancellationeur <= 86)) echo "transactions";
										if($mcancellationeur > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationeur."%"; ?>">

											<span>

											<?php echo $mcancellationeur; ?>%</span>


										</div>

						
                                    <br>
                                    Programados: <?php echo $nummcancellation5; ?><br>
Cancelados: <?php echo $nummcancellation6; ?>  
				
									</div>

								</div>
<?php //Yenes
$querymcancellation7 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and units.company > 3";
$resultmcancellation7 = mysqli_query($con, $querymcancellation7);
$rowmcancellation7 = mysqli_fetch_array($resultmcancellation7);
$nummcancellation7 = mysqli_num_rows($resultmcancellation7);

$querymcancellation8 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company > 3";
$resultmcancellation8 = mysqli_query($con, $querymcancellation8);
while($rowmcancellation8 = mysqli_fetch_array($resultmcancellation8)){
	$ammountyen += $rowmcancellation8['ammount'];
}
$nummcancellation8 = mysqli_num_rows($resultmcancellation8);

$mcancellationyen = ($nummcancellation8*100)/$nummcancellation7;
$mcancellationyen = number_format($mcancellationyen, 2);
$mcancellationyen = str_replace('.00','',$mcancellationyen);
?>  
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                   Otras

										<div class="number <?php if($mcancellationyen < 61) echo "bounce";
										if(($mcancellationyen > 60) and ($mcancellationyen <= 86)) echo "transactions";
										if($mcancellationyen > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationyen."%"; ?>">

											<span>

											<?php echo $mcancellationyen; ?>%</span>


										</div>

					
								
                                    <br>
                                    Programados: <?php echo $nummcancellation7; ?><br>
Cancelados: <?php echo $nummcancellation8; ?>  
				
									</div>

								</div>
                             

								

								</div>

								

								

								
                                
                                

							</div>
          <br><br>