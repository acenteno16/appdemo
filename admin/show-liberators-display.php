<?php 

$end = date("Y-m-d", strtotime($_GET['cut']));
$start_arr = explode("-", $end); 
$start = "$start_arr[0]-$start_arr[1]-1"; 

//todos los pagos provisionados 
//Aca debemos de cambiar a los pagos que no habian sido provisiconados a la fecha de corte
$queryprovisioned = "select payments.* from payments inner join times on payments.id = times.payment where (times.stage = '8') and times.today >= '$start' and times.today <= '$end' and payments.approved = '1' and payments.aprovision = '1' group by times.payment";
$resultprovisioned = mysqli_query($con, $queryprovisioned);
$numprovisioned = mysqli_num_rows($resultprovisioned); 

$query = "select routes.* from routes where type = '6' and percent > 0";
$result = mysqli_query($con, $query);  

while($row=mysqli_fetch_array($result)){
	
$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'"));

//procesados (liberacion, rechazo en liberacion, envio a provision)
$queryprovisioned2 = "select payments.* from payments inner join times on payments.id = times.payment where ((times.stage = '7.02') or (times.stage = '9') or (times.stage = '11')) and times.today >= '$start' and times.today <= '$end' and times.userid = '$row[worker]' group by times.payment";
$resultprovisioned2 = mysqli_query($con, $queryprovisioned2);
$numprovisioned2 = mysqli_num_rows($resultprovisioned2);

//Porcentaje asignado
$mypercent = $row['percent']; //=10
//Numero de solicitudes que debería de liberar
$mypercent2 = $numprovisioned*($mypercent/100); //=2.3


//Numero de solicitudes liberadas
$liberations = $numprovisioned2; //=1
$pending = $mypercent2-$liberations;

$ndata = ($liberations*100)/$mypercent2; //=43.47 
$ndata2 = 100-$ndata;
$workercode = $rowworker['code'];
$ndata3 = ($ndata2*$mypercent2)/100;



$liberations2 = $mypercent2-$liberations;

$tliberations = ($liberations*100)/$mypercent2;





?>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat <?php if($tliberations < 33){
	echo 'blue';
}elseif($tliberations < 66){
	echo 'blue'; 
}else{
	echo 'blue';
}

?>" style="height:130px;">

						<div class="visual">

							<i class="glyphicon glyphicon-signal"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($ndata,2)); ?>%
							</div>

							<div class="desc">

									<?php $apellido = explode(" ",$rowworker["last"]); 
																echo $rowworker["first"][0].". ".$apellido[0]; ?><br>
                                                                                 <?php //echo $liberations2; 
echo $row['percent']."% del global"; 



echo '<br>'.$tliberationsq;
if($ndata3> 0){ $faltante = number_format($ndata3); } else { $faltante = "0"; }  
echo $liberations." sl / ".intval($pending)." sp";
?>
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>

                                                           
<?php }


/*
$querycount = "select payments.expiration from payments where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' group by payments.id"; 
   
$resultcount = mysqli_query($con, $querycount);
$global = $numcount = mysqli_num_rows($resultcount); 
while($rowcount=mysqli_fetch_array($resultcount)){
	
	$date1 = date("Y-m-d");
	$date2 = date('d-m-Y',strtotime($rowcount['expiration']));
							
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -10){
		$corrientes++;
	}
	if(($dias < 0) and ($dias >= -9)){
		$porvencer++;
	}
	elseif($dias >= 0){
		$vencidos++;
	} 
	

	
}

?>
<div class="row"></div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat green" style="height:130px;">

						<div class="visual">

							<i class="fa fa-smile-o"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($corrientes,2)); ?>
							</div>

							<div class="desc">

									Corriente
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat yellow" style="height:130px;">

						<div class="visual">

							<i class="fa fa-meh-o"></i>

						</div>

						<div class="details">

							<div class="number">
                            <? echo $porvencer; ?>
							</div>

							<div class="desc">

									Por Vencer
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat red" style="height:130px;">

						<div class="visual">

							<i class="fa fa-frown-o"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($vencidos,2)); ?>
							</div>

							<div class="desc">

									Vencidos
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
                

<div class="col-md-12"><? echo '<strong>Global:</strong> '.$global; ?></div>
*/ ?>
