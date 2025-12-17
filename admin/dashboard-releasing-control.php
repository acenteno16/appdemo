<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-eye"></i>

							<a href="dashboard.php">Control de liberadores </a>
                            
                            	

						</li>

					</ul>
<?php 

$thisyear = date("Y");
$thismonth = date("m");
$fmtoday = $thisyear."-".$thismonth."-1";

$queryAuto = "select payments.id from payments inner join times on payments.id = times.payment where (times.stage = '9') and times.today >= '$fmtoday' and times.userid = 'GETPAY' group by times.payment";
$resultAuto = mysqli_query($con, $queryAuto);
$numAuto = mysqli_num_rows($resultAuto);

//LIBERADAS ESTE MES
$queryprovisioned = "select payments.id from payments inner join times on payments.id = times.payment where times.stage = '9' and times.today >= '$fmtoday' and payments.parent = '0' group by times.payment";
$resultprovisioned = mysqli_query($con, $queryprovisioned);
$numprovisioned = mysqli_num_rows($resultprovisioned);
$numprovisioned_global = $numprovisioned-$numAuto; 

//PENDIENTES DE LIBERAR
$querypending = "select payments.id from payments where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' group by payments.id order by payments.expiration asc"; 
$resultpending = mysqli_query($con, $querypending);
$numpending = mysqli_num_rows($resultpending);

$numglobal = $numpending+$numprovisioned_global;

//Start new code
$global_inactive = 0;
$query_inactive = "select routes.worker from routes where type = '6' and aa = '1'";
$result_inactive = mysqli_query($con, $query_inactive);
while($row_inactive=mysqli_fetch_array($result_inactive)){

    //procesados (liberacion, rechazo en liberacion, envio a provision)
    $queryprovisioned2_inactive = "select payments.id from payments inner join times on payments.id = times.payment where ((times.stage = '7.02') or (times.stage = '9') or (times.stage = '11')) and times.today >= '$fmtoday' and times.userid = '$row_inactive[worker]' group by times.payment";
    $resultprovisioned2_inactive = mysqli_query($con, $queryprovisioned2_inactive);
    $global_inactive+= $numprovisioned2_inactive = mysqli_num_rows($resultprovisioned2_inactive);

}

$numprovisioned = $numprovisioned-$global_inactive;

$thisWorker = [];
$query = "select routes.worker, routes.percent from routes where type = '6' and ((percent > '0') or (aa = 1))";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){ 
	
	if($thisWorker[$row['worker']] == ''){
		$rowworker = mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[worker]'"));
		$apellido = explode(" ",$rowworker["last"]); 
		$thisWorker[$row['worker']] = $rowworker["first"][0].". ".$apellido[0]; 
	}
    
    //procesados (liberacion, rechazo en liberacion, envio a provision)
	$queryprovisioned2 = "select payments.id from payments inner join times on payments.id = times.payment where (times.stage = '9') and times.today >= '$fmtoday' and times.userid = '$row[worker]' group by times.payment";
    $resultprovisioned2 = mysqli_query($con, $queryprovisioned2);
    $numprovisioned2 = mysqli_num_rows($resultprovisioned2);
	
	
    //Porcentaje asignado
    $myassignedpercent = $row['percent']; 
    //Numero de solicitudes que debería de liberar
    $mygoal = $numglobal*($myassignedpercent/100);
	$liberations = $numprovisioned2;
    $mypercent = ($liberations*100)/$mygoal; 
	$pending = $mygoal-$liberations;
	
	
	#Numero de solicitudes liberadas
    #SP
    #$ndata2 = 100-$ndata;
    #$workercode = $rowworker['code'];
    #$ndata3 = ($ndata2*$mypercent2)/100;
    #$liberations2 = $mypercent2-$liberations;
    #$tliberations = ($liberations*100)/$mypercent2;

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
<?php echo str_replace('.00','',number_format($mypercent,2)); ?>%
							</div>

							<div class="desc">

									<?php  echo $thisWorker[$row['worker']]; ?><br>
                                                                                 <?php //echo $liberations2; 
echo $row['percent']."% ($mygoal)"; 

$pstart = "";
$pend = "";

if($pending <= 0){
	$pstart = "<span style='color:green;'>";
	$pend = "</span>";
}

#echo '<br>'.$tliberationsq;
#if($ndata3> 0){ $faltante = number_format($ndata3); } else { $faltante = "0"; }  
echo $liberations." sl / $pstart".$pending." sp$pend";
?>
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>

                                                           
<?php }

$querycount = "select payments.expiration from payments where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' group by payments.id"; 
$resultcount = mysqli_query($con, $querycount);
$pendientes = $numcount = mysqli_num_rows($resultcount); 

$corrientes=0;
$porvencer=0;
$vencidos=0;   
        
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
<?

?>

<div class="col-md-12"><p>
<strong>(sa) Solicitudes liberadas automáticas:</strong> <? echo number_format($numAuto,0); ?><br>
<strong>(sl) Solicitudes liberadas por usuarios:</strong> <? echo number_format($numprovisioned_global,0); ?><br>
<? echo '<strong>(sp) Solicitudes Pendientes:</strong> '.number_format($numcount,0); ?><br>
<strong>Global sl + sp:</strong> <? echo number_format($numglobal,0); ?><br>
</p> 
</div> 

<? /*
<p><strong>Solicitudes recibidas en liberación:</strong> <?php echo $numprovisioned_global; ?> <em>(Este mes)</em><br><strong style="font-size:14px;">Leyenda:</strong> <em><strong>sl:</strong> Solicitudes liberadas. | <strong>sp:</strong> Solicitudes pendientes.</em></p> */ ?>



<div class="row"></div> 