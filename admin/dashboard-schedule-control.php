<ul class="page-breadcrumb breadcrumb" id="#testTest2">

						<li>

							<i class="fa fa-eye"></i>

							<a href="dashboard.php">Control de Programación </a>
                            
                            	

						</li>

					</ul>
<?               

include_once("sessions.php");
 
$corrientes = 0;
$porvencer = 0;
$vencidos = 0;

$tbl1 = 0;
$tbl2 = 0;
$tbl3 = 0;
$tbl4 = 0;
$tbl5 = 0;
$tbl6 = 0;

$querycount = "select payments.expiration from payments where ((payments.status = '9') or (payments.status = '13.02') or (payments.status = '13.03')) and ((payments.sent_approve = '1') or (payments.immediate = '1')) group by payments.id order by payments.expiration asc";
   
$resultcount = mysqli_query($con, $querycount);
$global = $numcount = mysqli_num_rows($resultcount); 
while($rowcount=mysqli_fetch_array($resultcount)){
	
	$date1 = date("Y-m-d");
	$date2 = date('d-m-Y',strtotime($rowcount['expiration']));
							
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -10){
		$corrientes++;
	}
	if(($dias < 0) and ($dias >= -10)){
		$porvencer++;
	}
	elseif($dias >= 0){
		$vencidos++;
	}
	
	if($dias <= -10){
		$tbl1++;
	}
	if(($dias < 0) and ($dias >= -10)){
		$tbl2++;
	}
	if(($dias < 30) and ($dias >= 0)){
		$tbl3++;
	}
	if(($dias < 60) and ($dias >= 31)){
		$tbl4++;
	}
	if(($dias < 90) and ($dias >= 61)){
		$tbl5++;
	}
	if(($dias >= 90)){ 
		$tbl6++;
	}
	
	

	
}

?>
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
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="16%">

										 &infin; | -11</th>

									<th width="16%">

										 -10 | 1</th>

									<th width="16%">0 - 30</th>

									<th width="16%">

										 31 | 60

									</th>

									<th width="16%">

										 61 | 90

									</th>

									<th width="16%">

								  90 | &infin;</th> 

								</tr>

								</thead>

								<tbody>
                              
                                <tr role="row" class="odd"><td class="sorting_1"><? echo $tbl1; ?></td><td><? echo $tbl2; ?></td><td><? echo $tbl3; ?></td>
                                <td><? echo $tbl4; ?></td><td><? echo $tbl5; ?></td><td><? echo $tbl6; ?></td></tr>
                              
                                   </tbody>

								</table>

<div class="row"></div>