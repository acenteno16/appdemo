<?php $today = date("Y-m-d"); 

?><br><br>


                            
   





   
    

        
        
        
            

                        
                        <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos Programados vs Pagos Cancelados
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

//

$querymcancellation2b = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and payments.status < 14 and units.company = 1";
$resultmcancellation2b = mysqli_query($con, $querymcancellation2b);
while($rowmcancellation2b = mysqli_fetch_array($resultmcancellation2b)){
	if($rowmcancellation2b['currency'] == 1){
		$ammountnio += $rowmcancellation2b['ammount'];
	}
	if($rowmcancellation2b['currency'] == 2){
		$ammountusd += $rowmcancellation2b['ammount'];
	}
	if($rowmcancellation2b['currency'] == 3){
		$ammounteur += $rowmcancellation2b['ammount'];
	}
	if($rowmcancellation2b['currency'] == 4){
		$ammountyen += $rowmcancellation2b['ammount'];
	}
}

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
Cancelados: <?php echo $nummcancellation2; ?><br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">Monto por cancelar </td>
    </tr>
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"> <?php echo number_format($ammountnio, 2);?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"> <?php echo number_format($ammountusd, 2);?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"> <?php echo number_format($ammounteur, 2);?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"> <?php echo number_format($ammountyen, 2);?></td>
  </tr>
</table>
<br>
<br>
<br>
<br>
									</div>

								</div>
<?php //Dolares
$querymcancellation3 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and units.company = 2";
$resultmcancellation3 = mysqli_query($con, $querymcancellation3);
$rowmcancellation3 = mysqli_fetch_array($resultmcancellation3);
$nummcancellation3 = mysqli_num_rows($resultmcancellation3);

$querymcancellation4 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 2";
$resultmcancellation4 = mysqli_query($con, $querymcancellation4);
/*while($rowmcancellation4 = mysqli_fetch_array($resultmcancellation4)){
	$ammountusd += $rowmcancellation4['ammount'];
}*/
$nummcancellation4 = mysqli_num_rows($resultmcancellation4);

$ammountnio = 0;
$ammountusd = 0;
$ammounteur = 0;
$ammountyen = 0;

$querymcancellation4b = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and payments.status < 14 and units.company = 2";
$resultmcancellation4b = mysqli_query($con, $querymcancellation4b);
while($rowmcancellation4b = mysqli_fetch_array($resultmcancellation4b)){
	if($rowmcancellation4b['currency'] == 1){
		$ammountnio += $rowmcancellation4b['ammount'];
	}
	if($rowmcancellation4b['currency'] == 2){
		$ammountusd += $rowmcancellation4b['ammount'];
	}
	if($rowmcancellation4b['currency'] == 3){
		$ammounteur += $rowmcancellation4b['ammount'];
	}
	if($rowmcancellation4b['currency'] == 4){
		$ammountyen += $rowmcancellation4b['ammount'];
	}
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
Cancelados: <?php echo $nummcancellation4; ?>   <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">Monto por cancelar</td>
    </tr>
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo number_format($ammountnio, 2);?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo number_format($ammountusd, 2);?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo number_format($ammounteur, 2);?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo number_format($ammountyen, 2);?></td>
  </tr>
</table>
									</div>

							  </div>
<?php //Euros
$querymcancellation5 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status >= 12 and units.company = 3";
$resultmcancellation5 = mysqli_query($con, $querymcancellation5);
$rowmcancellation5 = mysqli_fetch_array($resultmcancellation5);
$nummcancellation5 = mysqli_num_rows($resultmcancellation5);

$querymcancellation6 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 3";
$resultmcancellation6 = mysqli_query($con, $querymcancellation6);
/*while($rowmcancellation6 = mysqli_fetch_array($resultmcancellation6)){
	$ammounteur += $rowmcancellation6['ammount'];
}*/
$nummcancellation6 = mysqli_num_rows($resultmcancellation6);

$ammountnio = 0;
$ammountusd = 0;
$ammounteur = 0;
$ammountyen = 0;

$querymcancellation6b = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 3";
$resultmcancellation6b = mysqli_query($con, $querymcancellation6b);
while($rowmcancellation6b = mysqli_fetch_array($resultmcancellation6b)){
	if($rowmcancellation6b['currency'] == 1){
		$ammountnio += $rowmcancellation6b['ammount'];
	}
	if($rowmcancellation6b['currency'] == 2){
		$ammountusd += $rowmcancellation6b['ammount'];
	}
	if($rowmcancellation6b['currency'] == 3){
		$ammounteur += $rowmcancellation6b['ammount'];
	}
	if($rowmcancellation6b['currency'] == 4){
		$ammountyen += $rowmcancellation6b['ammount'];
	}

}

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
Cancelados: <?php echo $nummcancellation6; ?> <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">Monto por cancelar </td>
    </tr>
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo number_format($ammountnio, 2);?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo number_format($ammountusd, 2);?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo number_format($ammounteur, 2);?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo number_format($ammountyen, 2);?></td>
  </tr>
</table>

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

$ammountnio = 0;
$ammountusd = 0;
$ammounteur = 0;
$ammountyen = 0;

$querymcancellation8b = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.status = 14 and units.company = 3";
$resultmcancellation8b = mysqli_query($con, $querymcancellation8b);
while($rowmcancellation8b = mysqli_fetch_array($resultmcancellation8b)){
	if($rowmcancellation8b['currency'] == 1){
		$ammountnio += $rowmcancellation8b['ammount'];
	}
	if($rowmcancellation8b['currency'] == 2){
		$ammountusd += $rowmcancellation8b['ammount'];
	}
	if($rowmcancellation8b['currency'] == 3){
		$ammounteur += $rowmcancellation8b['ammount'];
	}
	if($rowmcancellation8b['currency'] == 4){
		$ammountyen += $rowmcancellation8b['ammount'];
	}

}


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
Cancelados: <?php echo $nummcancellation8; ?>  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">Monto por cancelar </td>
    </tr>
  <tr>
    <td width="50%" align="right">C$ &nbsp; </td>
    <td width="50%" align="left"><?php echo number_format($ammountnio, 2);?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp; </td>
    <td align="left"><?php echo number_format($ammountusd, 2);?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo number_format($ammounteur, 2);?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo number_format($ammountyen, 2);?></td>
  </tr>
</table>
<br>
<br>
<br>
<br>
									</div>

							  </div>
                             

								

  </div>

								

								

								
                                
                                

</div>
          
          
          
           
<br><br><br>
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Proveedores más importantes 

						  </div>

							<div class="actions">

								<?php ?>
                             
													  <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

													
															<select name="type" class="form-control" id="type" onchange="javascript:reloadProviders(this.value);">
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

												
                                <?php //end?> 
                                
                              <?php /*  <a href="javascript:reloadProviders(0);" class="btn default blue-stripe">
								Todas </a> 
                                	 <a href="javascript:reloadProviders(1);" class="btn default blue-stripe">
								Casa Pellas </a> <a href="javascript:reloadProviders(2);" class="btn default blue-stripe">
								Alpesa </a> <a href="javascript:reloadProviders(3);" class="btn default blue-stripe">
								Velosa </a> <a href="javascript:reloadProviders(4);" class="btn default blue-stripe">
								Otras </a>*/ ?>
                                
                               <script>
                                function reloadProviders(id){	

	$.post("dashboard-president-providers.php", { company: id }, function(data){
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
$querypresidentprovider1 = "select sum(payment), provider, currency from payments where status = '14' and currency = '1' and YEAR('$today') group by provider order by sum(payment) desc limit 10";
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
			grid:
			{
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
   
        
        
   <?php /*     
            
<div class="portlet-title">

							<div class="caption">

								<h4>Pagos Programados pendientes de cancelar</h4>

							</div>

							

						</div><br><br>

            

<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //Cordobas

$querymcancellation0 = "select * from payments where status >= '12' and status < '14' and currency = '1'";
// and WEEK('$today')
$resultmcancellation0 = mysqli_query($con, $querymcancellation0);
while($rowmcancellation0=mysqli_fetch_array($resultmcancellation0)){
	$ammountnio += $rowmcancellation0['payment'];
}

$querymcancellation1 = "select * from payments where status >= '12' and currency = '1' and WEEK('$today')";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select * from payments where status = '14' and currency = '1' and WEEK('$today')";
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

//$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = (($nummcancellation1*100)/$nummcancellation2);
if($mcancellationnio != 0){ $mcancellationnio = $mcancellationnio-100; }
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);

?>
								<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Cordobas

										<div class="number <?php if($mcancellationnio < 61) echo "visits";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "bounce";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

										C$<?php echo str_replace('.00','',number_format($ammountnio,2)); ?>
                                    <br>
Programado: <?php echo $nummcancellation1; ?><br>
Cancelados: <?php echo $nummcancellation2; ?>  
				
									</div>

								</div>
<?php //Dolares
$querymcancellation0 = "select * from payments where status >= '12' and status < '14' and currency = '2'";
// and WEEK('$today')
$resultmcancellation0 = mysqli_query($con, $querymcancellation0);
while($rowmcancellation0=mysqli_fetch_array($resultmcancellation0)){
	$ammountusd += $rowmcancellation0['payment'];
}


$querymcancellation3 = "select * from payments where status >= '12' and currency = '2' and WEEK('$today')";
$resultmcancellation3 = mysqli_query($con, $querymcancellation3);
$rowmcancellation3 = mysqli_fetch_array($resultmcancellation3);
$nummcancellation3 = mysqli_num_rows($resultmcancellation3);

$querymcancellation4 = "select * from payments where status = '14' and currency = '2' and WEEK('$today')";
$resultmcancellation4 = mysqli_query($con, $querymcancellation4);
$nummcancellation4 = mysqli_num_rows($resultmcancellation4);

//$mcancellationusd = ($nummcancellation4*100)/$nummcancellation3;
$mcancellationusd = (($nummcancellation4*100)/$nummcancellation3);
if($mcancellationusd != 0){ $mcancellationusd = $mcancellationusd-100; }
$mcancellationusd = number_format($mcancellationusd, 2);
$mcancellationusd = str_replace('.00','',$mcancellationusd);
?>
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                    Dolares

										<div class="number <?php if($mcancellationusd < 61) echo "visits";
										if(($mcancellationusd > 60) and ($mcancellationusd <= 86)) echo "transactions";
										if($mcancellationusd > 86) echo "bounce";
									 
										?>" data-percent="<?php echo $mcancellationusd."%"; ?>">

											<span>

											<?php echo $mcancellationusd; ?>%</span>


										</div>

						<br>

										$<?php echo str_replace('.00','',number_format($ammountusd,2)); ?>
                                    <br>
Programado: <?php echo $nummcancellation3; ?><br>
Cancelados: <?php echo $nummcancellation4; ?>  
				
									</div>

								</div>
<?php //Euros
$querymcancellation0 = "select * from payments where status >= '12' and status < '14' and currency = '3'";
// and WEEK('$today')
$resultmcancellation0 = mysqli_query($con, $querymcancellation0);
while($rowmcancellation0=mysqli_fetch_array($resultmcancellation0)){
	$ammounteur += $rowmcancellation0['payment'];
}

$querymcancellation5 = "select * from payments where status >= '12' and currency = '3' and WEEK('$today')";
$resultmcancellation5 = mysqli_query($con, $querymcancellation5);
$rowmcancellation5 = mysqli_fetch_array($resultmcancellation5);
$nummcancellation5 = mysqli_num_rows($resultmcancellation5);

$querymcancellation6 = "select * from payments where status = '14' and currency = '3' and WEEK('$today')";
$resultmcancellation6 = mysqli_query($con, $querymcancellation6);
$nummcancellation6 = mysqli_num_rows($resultmcancellation6);

//$mcancellationeur = ($nummcancellation6*100)/$nummcancellation5;
$mcancellationeur = (($nummcancellation6*100)/$nummcancellation5);
if($mcancellationeur != 0){ $mcancellationeur = $mcancellationeur-100; }
$mcancellationeur = number_format($mcancellationeur, 2);
$mcancellationeur = str_replace('.00','',$mcancellationeur);
?>
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                    Euros

										<div class="number <?php if($mcancellationeur < 61) echo "visits";
										if(($mcancellationeur > 60) and ($mcancellationeur <= 86)) echo "transactions";
										if($mcancellationeur > 86) echo "bounce";
									 
										?>" data-percent="<?php echo $mcancellationeur."%"; ?>">

											<span>

											<?php echo $mcancellationeur; ?>%</span>


										</div>

						<br>

										 &euro;<?php echo str_replace('.00','',number_format($ammounteur,2)); ?>
                                    <br>
Programado: <?php echo $nummcancellation5; ?><br>
Cancelados: <?php echo $nummcancellation6; ?>  
				
									</div>

								</div>
<?php //Yenes
$querymcancellation0 = "select * from payments where status >= '12' and status < '14' and currency = '4'";
// and WEEK('$today')
$resultmcancellation0 = mysqli_query($con, $querymcancellation0);
while($rowmcancellation0=mysqli_fetch_array($resultmcancellation0)){
	$ammountyen += $rowmcancellation0['payment'];
}
$querymcancellation7 = "select * from payments where status >= '12' and currency = '4' and WEEK('$today')";
$resultmcancellation7 = mysqli_query($con, $querymcancellation7);
$rowmcancellation7 = mysqli_fetch_array($resultmcancellation7);
$nummcancellation7 = mysqli_num_rows($resultmcancellation7);

$querymcancellation8 = "select * from payments where status = '14' and currency = '4' and WEEK('$today')";
$resultmcancellation8 = mysqli_query($con, $querymcancellation8);
$nummcancellation8 = mysqli_num_rows($resultmcancellation8);

//$mcancellationyen = ($nummcancellation8*100)/$nummcancellation7;
//$mcancellationyen = (($nummcancellation8*100)/$nummcancellation7)-100;
$mcancellationyen = (($nummcancellation8*100)/$nummcancellation7);
if($mcancellationyen != 0){ $mcancellationyen = $mcancellationyen-100; }
$mcancellationyen = number_format($mcancellationyen, 2);
$mcancellationyen = str_replace('.00','',$mcancellationyen);
?>  
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                   Yenes

										<div class="number <?php if($mcancellationyen < 61) echo "visits";
										if(($mcancellationyen > 60) and ($mcancellationyen <= 86)) echo "transactions";
										if($mcancellationyen > 86) echo "bounce";
									 
										?>" data-percent="<?php echo $mcancellationyen."%"; ?>">

											<span>

											<?php echo $mcancellationyen; ?>%</span>


										</div>

						<br>

									 &yen;<?php echo str_replace('.00','',number_format($ammountyen,2)); ?>
                                    <br>
Programado: <?php echo $nummcancellation7; ?><br>
Cancelados: <?php echo $nummcancellation8; ?>  
				
									</div>

								</div>
                             

								

								</div>

								
   

							</div>
                            <br><br><br>
                            
   */ ?>                         
                            
                            <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Tiempo Solicitud/Cancelación
						  </div>

							

						</div>
</div>
<?php //tiempos de compañias
$globalctime1 = 0.01;
$globalctime2 = 0.01;
$globalctime3 = 0.01;
$globalctime4 = 0.01;

$querygctime = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.status = 14 and companies.id = 1";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime1 =  $alldays/$numgctime;
 
 
 $querygctime = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.status = 14 and companies.id = 2";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime2 =  $alldays/$numgctime;
 
 $querygctime = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.status = 14 and companies.id = 3";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime3 =  $alldays/$numgctime;
 
 $querygctime = "select payments.* from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.status = 14 and companies.id > 3";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime4 =  $alldays/$numgctime;
?>
<script type="text/javascript">
	$(function() {

		var data = [ ['Casa Pellas',<?php echo $globalctime1+0.01; ?>], ['Velosa', <?php echo $globalctime3+0.01; ?>], ['Alpesa',<?php echo $globalctime2+0.01; ?>], ['Otras compañias', <?php echo $globalctime4+0.01; ?>] ];

	
	
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
				tickLength: 0,
				xaxisLabel: "Sin(x)",
			}, grid: {
				borderColor: "#FFFFFF"
			}
			
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script>
   <div class="col-md-6"><div class="demo-container">
			<div id="concepts2" class="demo-placeholder"></div>
</div></div>
<div class="col-md-6">
<?php //Dias por etapa ?>
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0; 
		$stage = array();
		$today = date('Y-m-d');
		$m = date('m');
		$query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and times.stage='14'"; 
		//$query = "select * from payments where status = '14'"; 
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from times where payment = $row[id] order by stage asc";
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			while($row2=mysqli_fetch_array($result2)){	
				$stage[$row[0]][$row2['stage']] = $row2['today'];
			}
			
			//Approve1 Times
			$datea = $stage[$row['id']][1]; //Request date
			$dateb = $stage[$row['id']][2]; //Approve1 date
			$dias = (strtotime($datea)-strtotime($dateb))/86400;
			$dias = abs($dias); $dias = floor($dias);
			$tapprove1 += $dias; 
			
			//Approve2
			
			if(isset($stage[$row['id']][3])){
				$datea = $stage[$row['id']][2]; //Approve1 date
				$dateb = $stage[$row['id']][3]; //Approve2 date
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove2 += $dias;
				$approve2 = 1;
			}
			//Approve3
			//If approve3 isset
			if(isset($stage[$row['id']][4])){
				$datea = $stage[$row['id']][3]; //Aprobado2
				$dateb = $stage[$row['id']][4]; //Aprpbado3
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove3 += $dias; 
				$approve3 = 1;
			}
			//Provision
			if(isset($stage[$row['id']][8])){
				if(isset($stage[$row['id']][4])){
					//dateb == approve3
					$dateb = $stage[$row['id']][4]; //Aprpbado3
				}elseif(isset($stage[$row['id']][3])){
					//dateb = apprve2
					$dateb = $stage[$row['id']][3]; //Aprpbado3
				}else{
					//dateb = approve1
					$dateb = $stage[$row['id']][2]; //Aprpbado3
				}
				$datea = $stage[$row['id']][8]; //Provision
				//Load dateb
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tprovission += $dias; 
				
			}
			//
			//Releasing
			if(isset($stage[$row['id']][9])){
				$datea = $stage[$row['id']][8]; //Provision date
				$dateb = $stage[$row['id']][9]; //releasing date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$treleasing += $dias;
				
			}
			//Schedule
			if(isset($stage[$row['id']][12])){
				$datea = $stage[$row['id']][9]; //Releasing
				$dateb = $stage[$row['id']][12]; //Schedule
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedule += $dias;
				
			}
			
			//Schedule Approve
			if(isset($stage[$row['id']][13])){
				$datea = $stage[$row['id']][12]; //Schedule
				$dateb = $stage[$row['id']][13]; //Schedule Approve
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedulea += $dias;
				
			}
			
			//Cancellation
			if(isset($stage[$row['id']][14])){
				$datea = $stage[$row['id']][13]; //Schedule Approve
				$dateb = $stage[$row['id']][14]; //Cancellation
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tcancellation += $dias;
				
			}
				 
			//SUM Stage
			/*$stage = $row['status']; 
			switch($stage){ 
				case 8:
				$stage = 9;
				break;
				case 9:
				$stage = 12;
				break;
				case 12:
				$stage = 13;
				break;	
			}
			//$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
			*/
			
		?>
		<?php } 
		
		?> 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado1 - <?php echo number_format($tapprove1/$num, 2); ?> dias",
				data: <?php echo $tapprove1/$num; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado2 - <?php echo number_format($tapprove2/$num, 2); ?> dias",
				data: <?php echo $tapprove2/$num; ?>,
			} 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado3 - <?php echo number_format($tapprove3/$num, 2); ?> dias",
				data: <?php echo $tapprove3/$num; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Provision - <?php echo number_format($tprovission/$num, 2); ?> dias",
				data: <?php echo $tprovission/$num; ?>,
			} 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Liberacion - <?php echo number_format($treleasing/$num, 2); ?> dias",
				data: <?php echo $treleasing/$num; ?>,
			} 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Programacion - <?php echo number_format($tschedule/$num, 2); ?> dias",
				data: <?php echo $tschedule/$num; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado Prog. - <?php echo number_format($tschedulea/$num, 2); ?> dias",
				data: <?php echo $tschedulea/$num; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Cancelacion - <?php echo number_format($tcancellation/$num,2); ?> dias",
				data: <?php echo $tcancellation/$num; ?>,
			} 

		var placeholder = $("#fmdpe1");

		
			placeholder.unbind();

			$.plot(placeholder, data, {
				series: {
					 pie: {
			 innerRadius: 0.3,
            show: true,
            radius: 1,
            label: {
                show: true,
                radius: 1,
                formatter: function(label, series) {
                    return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                },
                background: {
                    opacity: 0.8,
                    color: '#444'
                }
            }
        }
    },
				
				legend: {
					show: false
				}
			});

			
		
	});

	// A custom label formatter used by several of the plots

	

	//
</script>
<div class="demo-container">
			<div id="fmdpe1" class="demo-placeholder"></div>
		 
	</div>
</div>
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




<div class="col-md-12">
<br><br><br>
<?php include("test-005.php"); ?> 
</div>