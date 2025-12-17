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
