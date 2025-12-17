<? 

include_once('sessions.php');

$today = date('Y-m-d');
$dateCurrent = date("Y-m-d", strtotime($today."+ 90 days"));

$cBalance = 0;
$vBalance = 0;
$cBalance2 = 0;
$vBalance2 = 0;

$query = "select * from bankingDebtContracts where id > '0' and parent = '0' and date2 >= '$dateCurrent'$sql";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$queryBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$row[id]' order by id desc limit 1";
	$resultBalance = mysqli_query($con, $queryBalance);
	$rowBalance = mysqli_fetch_array($resultBalance); 	
	
	if($row['currency'] == 1){
		$cBalance+=$rowBalance['balance'];
	}elseif($row['currency'] == 2){
		$vBalance+=$rowBalance['balance'];
	}
	
	
	
}

$query = "select * from bankingDebtContracts where id > '0' and parent = '0' and date2 < '$dateCurrent'$sql";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$queryBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$row[id]' order by id desc limit 1";
	$resultBalance = mysqli_query($con, $queryBalance);
	$rowBalance = mysqli_fetch_array($resultBalance); 				
	
	if($row['currency'] == 1){
		$cBalance2+=$rowBalance['balance'];
	}elseif($row['currency'] == 2){
		$vBalance2+=$rowBalance['balance'];
	}
	
}
	
?>
<? /*
<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-eye"></i>

							<a href="#">Disponible</a>
                            
                            	

						</li>

					</ul>
*/ ?>

<? //Cordobas ?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat blue" style="height:130px;">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">
								NIO C$<?php echo str_replace('.00','',number_format($cBalance,2)); ?>
							</div>

							<div class="desc">

									
									+ NIO C$<?php echo str_replace('.00','',number_format($cBalance2,2)); ?> (&lt;90 días)
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
<? //Dólares ?>			
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat blue" style="height:130px;">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">
								USD $<?php echo str_replace('.00','',number_format($vBalance,2)); ?>
							</div>

							<div class="desc">

									
									+ USD $<?php echo str_replace('.00','',number_format($vBalance2,2)); ?> (&lt;90+ días)
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>

<div class="row"></div> 