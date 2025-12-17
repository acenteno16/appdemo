<div class="row">
<div class="col-md-12">
<br>
</div>
</div>
<br>
<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-dashboard"></i>

							<a href="dashboard.php">Pagos por etapa (UN)</a>
                            
                            	

						</li>

					</ul>
                    
<style type="text/css"> 
	
	.demo-placeholder {
	width: 100%;
	height: 100%;
	font-size: 14px;
	line-height: 1.2em;
	}
	.demo-container {
		position: relative;
		height: 380px;
	}
	
	
	#description {
		margin: 15px 10px 20px 10px;
	}
	</style>                 
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->



<div class="row">
<?php 
include_once('sessions.php');
$sqlu = "";
								$numu = 0;
								$queryu = "select * from routes where worker = '$_SESSION[userid]' and ((type = '2') or (type = '3') or (type = '4'))";
								$resultu = mysqli_query($con, $queryu);
								$numu = mysqli_num_rows($resultu);
								
								
									$firstu = 1;
									while($rowu=mysqli_fetch_array($resultu)){
										if($firstu == 1){ //First
											$sqlu = " and (((payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
											$firstu++;
										}
									}
									
									
$query = "select * from payments where approved = '1' and status < '14'";
$query = "select * from payments where status < '14'".$sqlu; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
?>
<div class="col-md-6">

<?php //Casa Pellas ?>


<div class="demo-container">
<div id="fmppc1-gl" class="demo-placeholder"></div>
</div>
</div>

<?php /*
<?php //Alpesa ?>
<div class="col-md-3">
Velosa
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id = 3";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']." (".$numsub.")"; ?>",
				data: <?php echo $numsub; ?>,
				data2: <?php echo $numsub; ?>, 
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id = 3 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id = 3 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
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
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']." (".$num2.")"; ?>",
				data: <?php echo $num2; ?>,
			
			} 
		<?php } 
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc2");

		
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
                    return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br>'+Math.round(series.percent)+'%</div>';
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
	  <div id="fmppc2" class="demo-placeholder"></div>
		 <?php $rowppcfmnio = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%" align="left"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td align="left"><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
    
</div>

</div>
<?php //Velosa ?>
<div class="col-md-3">
Alpesa
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id = 2";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $numsub; ?>,
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id = 2 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id = 2 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
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
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $num2; ?>,
			} 
		<?php }
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc3");

		
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
			<div id="fmppc3" class="demo-placeholder"></div>
		 <?php $rowppcfmnio = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
      <br>
      <br>
      <br>
</div>

</div>
<?php //Otras compañias ?>
<div class="col-md-3">
Otras compañías
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id > 3";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $numsub; ?>,
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id > 3 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id > 3 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
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
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $num2; ?>,
			} 
		<?php }
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc4");

		
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
	  <div id="fmppc4" class="demo-placeholder"></div>
		 <?php $rowppcfmnio = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen= 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%" align="left"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td align="left"><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
      <br>
      <br>
      <br>
</div>

</div>
</div>
*/ ?>