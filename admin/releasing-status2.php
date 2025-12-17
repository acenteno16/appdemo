<?php 

#include('sessions.php');

$thisyear = date("Y");
$thismonth = date("m");
$fmtoday = $thisyear."-".$thismonth."-1";

//todos los pagos provisionados este mes
//$queryprovisioned = "select payments.id from payments inner join times on payments.id = times.payment where (times.stage = '8') and times.today >= '$fmtoday' and payments.approved = '1' and payments.aprovision = '1' group by times.payment";
//$resultprovisioned = mysqli_query($con, $queryprovisioned);
//$numprovisioned = mysqli_num_rows($resultprovisioned);
//$numprovisioned_global = $numprovisioned;

//


$querypending = "select payments.id from payments where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' group by payments.id order by payments.expiration asc";
$resultpending = mysqli_query($con, $querypending);
$numpending = mysqli_num_rows($resultpending);

$queryreleased = "select payments.id from payments inner join times on payments.id = times.payment where (times.stage = '9') and times.today >= '$fmtoday' group by times.payment";
$resultreleased = mysqli_query($con, $queryreleased);
$numreleased = mysqli_num_rows($resultreleased);


//Otros procesos por liberadores
$queryreleased2 = "select payments.id from payments inner join times on payments.id = times.payment where ((times.stage = '7.02') or (times.stage = '9') or (times.stage = '11')) and times.today >= '$fmtoday' group by times.payment";
$resultreleased2 = mysqli_query($con, $queryreleased2);
$numreleased2 = mysqli_num_rows($resultreleased2);

$globalreleased = $numreleased+$numreleased2+$numpending; 

//Solicitudes pendientes

//End New code
$query = "select routes.* from routes where type = '6' and ((percent > '0') or (aa = 1))";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
    $rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'"));

    //procesados (liberacion, rechazo en liberacion, envio a provision)
    $querythisreleased = "select payments.* from payments inner join times on payments.id = times.payment where ((times.stage = '7.02') or (times.stage = '9') or (times.stage = '11')) and times.today >= '$fmtoday' and times.userid = '$row[worker]' group by times.payment";
    $resultthisreleased = mysqli_query($con, $querythisreleased);
    $numthisreleased = mysqli_num_rows($resultthisreleased);

    //Porcentaje asignado
    $mypercent = $row['percent']; 
    //Numero de solicitudes que debería de liberar
    $mypercent2 = $globalreleased*($mypercent/100); 
    //Numero de solicitudes liberadas
    $liberations = $numthisreleased;
    //SP
    $pending = $mypercent2-$liberations;
    $ndata = ($liberations*100)/$mypercent2; 
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

$pstart = "";
$pend = "";

if($pending <= 0){
	$pstart = "<span style='color:green;'>";
	$pend = "</span>";
}

echo '<br>'.$tliberationsq;
if($ndata3> 0){ $faltante = number_format($ndata3); } else { $faltante = "0"; }  
echo $liberations." sl / $pstart".intval($pending)." sp$pend";
?>
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>

                                                           
<?php }

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
<? //Corrientes ?>
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
<? //Por Vencerse ?>				
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
<? //Vencidos ?>				
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

<? /*
<p><strong>Solicitudes recibidas en liberación:</strong> <?php echo $numprovisioned_global; ?> <em>(Este mes)</em><br><strong style="font-size:14px;">Leyenda:</strong> <em><strong>sl:</strong> Solicitudes liberadas. | <strong>sp:</strong> Solicitudes pendientes.</em></p> */ ?>
