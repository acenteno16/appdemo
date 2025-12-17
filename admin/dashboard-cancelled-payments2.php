<? 

#ini_set('display_errors', '1');
##ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

?><br>
<div class="row"></div>
<ul class="page-breadcrumb breadcrumb"> 

						<li>

							<i class="fa fa-dashboard"></i>

							<a href="dashboard.php">Pagos por etapa (Global)</a>
                            
                            	

						</li>

					</ul>
                    
<style type="text/css"> 
	
	.demo-placeholder {
	width: 100%;
	height: 100%;
	font-size: 14px;
	line-height: 1.2em;
	}
	.demo-placeholder_treasury {
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
<?php //Casa Pellas 
include_once('sessions.php');
	
	$not = "5,6,7,7.01,7.02,7.03,7.04,7.05,7.06,7.07,7.08,7.09,7.10,7.11,7.12,7.13"; 
$notArr = explode(',',$not);
$notConditions = '';
foreach ($notArr as &$value) {
    $notConditions.= " and status != '$value'";
}
	
	
$query = "select * from payments where status > 0 and approved != '2' and approved != '3' and status < '14'$notConditions";
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
?>
<div class="col-md-6">

<?php //Casa Pellas ?>
<script type="text/javascript">

	$(function() {

		var data = [];
		var payments = [];
		
	<?php 
unset($thestage);


 /*       
$thestage[0] = array();
$thestage[0][1] = 0;
 
$thestage[1] = array();        
$thestage[1][1] = 0; 
        
$thestage[2] = array(); 
        $thestage[2][1] = 0; 
$thestage[3] = array(); 
        $thestage[3][1] = 0; 
$thestage[4] = array(); 
        $thestage[4][1] = 0; 
$thestage[5] = array(); 
        $thestage[5][1] = 0; 
$thestage[6] = array(); 
        $thestage[6][1] = 0; 
$thestage[7] = array(); 
        $thestage[7][1] = 0; 
$thestage2[0] = array(); 
        $thestage2[0][1] = 0; 
$thestage2[1] = array(); 
        $thestage2[1][1] = 0; 
$thestage2[2] = array();
        $thestage2[2][1] = 0; 
$thestage2[3] = array();
        $thestage2[3][1] = 0; 
$thestage2[4] = array(); 
        $thestage2[4][1] = 0; 
$thestage2[5] = array(); 
        $thestage2[5][1] = 0; 
$thestage2[6] = array(); 
        $thestage2[6][1] = 0; 
$thestage2[7] = array();
        $thestage2[7][1] = 0;  
$therstage3[0] = array(); 
        $therstage3[0][1] = 0; 
$thestage3[1] = array();
        $thestage3[1][1] = 0; 
$thestage3[2] = array(); 
        $thestage3[2][1] = 0; 
$thestage3[3] = array();
        $thestage3[3][1] = 0; 
$thestage3[4] = array(); 
        $thestage3[4][1] = 0; 
$thestage3[5] = array(); 
        $thestage3[5][1] = 0; 
$thestage3[6] = array(); 
        $thestage3[6][1] = 0; 
$thestage3[7] = array(); 
        $thestage3[7][1] = 0; 
        */
        
$thestage = array();
$thestage2 = array();
$thestage3 = array();
        
while($row=mysqli_fetch_array($result)){
	
	//Si esta ingresado
	//Visto Bueno
	if(($row['status'] == 1) and ($row['arequest'] == 0) and ($row['approved'] != 3)){
			//Lo ponemos en Visto bueno
			$thestage[0][0] = 1.01;
			$thestage[0][1]++;
			$thestage[0][3]= 'show-payments-vobo.php'; 
			
	}
	
	//Aprobado 1
	if($row['status'] == 1){
			
			if(($row['approved'] == 0) and ($row['arequest'] ==1)){
				//Aprobado 1 (Listo)
				$thestage[1][0] = 2;
				$thestage[1][1]++;
				$thestage[1][3]= 'show-payments-approve1.php';
			}
	}
	
	//Aprobado 2
	if($row['status'] == 2){
			if($row['approved'] == 1){
				//if the payment is approved
				//Provisionado
				$thestage[4][0] = 8;
				$thestage[4][1]++;
				$thestage[4][3]= 'show-payments-provision-unit.php';
			}elseif($row['approved'] == 0){
				//Aprobado 1 (Listo)
				//Aprobado2 (Pendiente)
				$thestage[2][0] = 3;
				$thestage[2][1]++;
				$thestage[2][3]= 'show-payments-approve2.php';
			}
		}
		
	//aprobado3
	if($row['status'] == 3){
			if($row['approved'] == 1){
				//if the payment is approved
				//Provisionado
				$thestage[4][0] = 8; 
				$thestage[4][1]++;
				$thestage[4][3]= 'show-payments-provision-unit.php';
				
			}else{
				$thestage[3][0] = 4; 
				$thestage[3][1]++;
				$thestage[3][3]= 'show-payments-approve3.php';
			}
	}
		
	//Provision
	if($row['status'] == 4){
		if($row['approved'] == 1){
			//if the payment is approved
			//Provisionado
			$thestage[4][0] = 8; 
			$thestage[4][1]++;
			$thestage[4][3]= 'show-payments-provision-unit.php';
		}
			
	}
		
	//Liberado
	if(($row['status'] == 8) and ($row['aprovision'] == 1) and ($row['approved'] == 1)){
		$thestage[5][0] = 9;
		$thestage[5][1]++;
		$thestage[5][3]= 'show-payments-releasing.php';
	}
		
	//Control de calidad
	if(($row['sent'] == '3') and ($row['status'] != '2')){	
		  
		$thestage3[0][0] = 8.03;
		$thestage3[0][1]++;
		$thestage3[0][3]= 'show-payments-cc.php'; 
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
		
	} 
	
	//Programado
	if(($row['status'] == '9') and (($row['sent_approve'] == 1) or ($row['d_approve'] == 1))){	
		  
		$thestage3[1][0] = 12;
		$thestage3[1][1]++;
		$thestage3[1][3]= 'show-payments-schedule.php';
		
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
			
			
		
	}
	
	if(($row['status'] == '13.02') and (($row['sent_approve'] == 1) or ($row['d_approve'] == 1))){	
		  
		$thestage3[1][0] = 12;
		$thestage3[1][1]++;
		$thestage3[1][3]= 'show-payments-schedule.php';
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
		
	}
	
	if(($row['status'] == '13.03') and (($row['sent_approve'] == 1) or ($row['d_approve'] == 1))){	
		  
		$thestage3[1][0] = 12;
		$thestage3[1][1]++;
		$thestage3[1][3]= 'show-payments-schedule.php';
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
		
	}
	
		//Subir a banco
	if(($row['status'] == '12')){	
		  
		$query_group = "select * from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'"; 
		$result_group = mysqli_query($con, $query_group);
		$row_group = mysqli_fetch_array($result_group);
			
		if($row_group['vo'] == 0){
			$thestage3[2][0] = 12.01; 
			$thestage3[2][1]++; 
			$thestage3[2][3]= 'show-payments-vobo2.php'; 
				
		}else{
			$thestage3[3][0] = 13;
			$thestage3[3][1]++;
			$thestage3[3][3]= 'show-payments-schedule-approve.php';
			
		}
			
			$thestage2[7][0] = "Tesorería";
			$thestage2[7][1]++;
			$thestage2[7][3]= '#tesoreria';
			
		
	}
	
	
		//Cancelacion
	if($row['status'] == 13){
		$thestage3[4][0] = 14;
		$thestage3[4][1]++;
		$thestage3[4][3]= 'show-payments-cancellation.php';
			
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
	}
	
	
		
}
	$table_rows = "";
	//for($i=0;$i<sizeof($thestage);$i++){
	$i = 0;
	asort($thestage);
	//
	foreach($thestage as &$arr){	
		$therstage = $arr[0];
		$querystage = "select * from stages where id = '$therstage'";
		$rowstage = mysqli_fetch_array(mysqli_query($con, $querystage));
		
		
		$table_rows.= ' <tr role="row" class="odd">
                                <td class="sorting_1"><a href="'.$arr[3].'">'.$rowstage['name2'].'</a></td>
                                <td><a href="'.$arr[3].'">'.$arr[1].'</a></td>
                                </tr>';
			$table_rows_total+=$arr[1];
		
		?>
		data[<?php echo $i; ?>] = {
				label: "<?php echo $rowstage['name2'].' ('.$arr[1].')'; ?>",
				data: <?php echo intval($arr[1]); ?>,
				payments: <?php echo intval($arr[1]); 
				?>,
			} 
			
		<?php 

		
		
	$i++;
	}
		
	
		//Tesorería
		$table_rows.= ' <tr role="row" class="odd" >
                                <td class="sorting_1"><a href="'.$thestage2[7][3].'">'.$thestage2[7][0].'</a></td>
                                <td><a href="'.$thestage2[7][3].'">'.$thestage2[7][1].'</a></td> 
                                </tr>';
		$table_rows_total+=$thestage2[7][1];
		?>
		data[<?php echo $i; ?>] = {
				label: "<? echo $thestage2[7][0]; ?>",
				data: <?php echo intval($thestage2[7][1]); ?>,
				payments: <?php echo intval($thestage2[7][1]); ?>,
			}  
			
		<?php 

		
	
		
	
		if(($num == 0) and ($num2 == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				payments: 0,
				color: '#44a75a'
				
			} 
		<?php } ?>

		var placeholder = $("#fmppc111");

		
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
                    return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/> '+Math.round(series.percent)+'%</div>';
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
<div id="fmppc111" class="demo-placeholder"></div>
</div>
</div>
<div class="col-md-6">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="50%"> 

										 Etapa</th>

									<th width="50%">

										 Solicitudes</th>

								</tr>

								</thead>

								<tbody>
                              
                                
                               <? echo $table_rows; ?>
                            
                               
                               <tr role="row" class="odd">
                        <td class="sorting_1">Total</td>
                        <td><? echo $table_rows_total; ?></td>
                        </tr>
                                
                                   </tbody>

								</table>
    <a href="show-payments-general.php" class="btn blue">Reporte general</a>
									
</div>
</div>


<div class="row"></div>
<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-dashboard"></i>

							<a name="tesoreria">Pagos por etapa (Tesorería) <? if(date('Y-m-d') <= "2018-09-29") echo "[En Pruba - Favor reportar problemas]"; ?></a>
                            
                            	

						</li>

					</ul>

<div class="row">

<div class="col-md-6">

<?php //Casa Pellas ?>
<script type="text/javascript">

	$(function() {

		var data = [];
		var payments = [];
		
	<?php 
	$i3 = 0;
    asort($thestage3);  
	//for($i=0;$i<sizeof($thestage3);$i++){
	foreach($thestage3 as &$arr3){
		$therstage3 = $arr3[0];
		$querystage3 = "select * from stages where id = '$therstage3'";
		$rowstage3 = mysqli_fetch_array(mysqli_query($con, $querystage3));
		$table_rows3.= '<tr role="row" class="odd">
                        <td class="sorting_1"><a href="'.$arr3[3].'">'.$rowstage3['name2'].'</a></td>
                        <td><a href="'.$arr3[3].'">'.$arr3[1].'</a></td>
                        </tr>';
		$table_rows3_total+= $arr3[1];
		?>
		data[<?php echo $i3; ?>] = {
				label: "<?php echo $rowstage3['name2'].' ('.$arr3[1].')'; ?>",
				data: <?php echo intval($arr3[1]); ?>,
				payments: <?php echo intval($arr3[1]); 
				?>,
			} 
			
		<?php 

	$i3++;	
	}
		
	
		if(($num == 0) and ($num2 == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				payments: 0,
				color: '#44a75a'
				
			} 
		<?php } ?>

		var placeholder = $("#fmppct");

		
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
                    return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/> '+Math.round(series.percent)+'%</div>';
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
<div id="fmppct" class="demo-placeholder_treasury"></div>
</div>
</div>
<div class="col-md-6">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="50%"> 

										 Etapa</th>

									<th width="50%">

										 Solicitudes</th>

								</tr>

								</thead>

								<tbody>
                              
                                
                               <? echo $table_rows3; ?>
                               
                               <tr role="row" class="odd">
                        <td class="sorting_1">Total</td>
                        <td><? echo $table_rows3_total; ?></td>
                        </tr>
                                
                                   </tbody>

								</table>	
</div>
</div>