<br>
<div class="row"></div>
<? /*<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-dashboard"></i>

							<a href="dashboard.php">Pagos por etapa (Especiales)</a>
                            
                            	

						</li>

					</ul>*/ ?>
                    
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



<div class="row"></div><br>
<br>
<div class="row">
<?php //Casa Pellas 
#((status = 8) or (staatus = 9) or (staatus = 11)  or (staatus = 12) or (staatus = 13) or (staatus = 8.01)  or (staatus = 8.02) or (staatus = 12.01) or (staatus = 13.02) or (staatus = 13.03) or (staatus = 11.01) or (staatus = 8.03) or (staatus = 11.02) or (staatus = 9) or (staatus = 9.02) or (staatus = 8.04)) and 
$query = "select * from payments where approved = '1' and status < '14' and d_approve = '1'";
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
?>
<div class="col-md-6">

<?php //Casa Pellas ?>
<script type="text/javascript">

	$(function() {

		var dataSpecial = [];
		var paymentsSpecial = [];
		
	<?php 
unset($thestage);
while($row=mysqli_fetch_array($result)){
	
		
	//Provision
	if($row['status'] == 4){
		if($row['approved'] == 1){
			//if the payment is approved
			//Provisionado
			$thestage[4][0] = 8; 
			$thestage[4][1]++;
			#$thestage[4][3]= 'show-payments-special.php?status=4';
            $thestage[4][3]= '#';
		}
			
	}
		
	//Liberado
	if(($row['status'] == 8) and ($row['aprovision'] == 1) and ($row['approved'] == 1)){
		$thestage[5][0] = 9;
		$thestage[5][1]++;
		#$thestage[5][3]= 'show-payments-special.php?status=8';
        $thestage[5][3]= '#';
	}
		
	//Control de calidad
	if(($row['sent'] == '3') and ($row['status'] != '2')){	
		  
		$thestage3[0][0] = 8.03;
		$thestage3[0][1]++;
		#$thestage3[0][3]= 'show-payments-special.php?status=8.03';
        $thestage3[0][3]= '#';
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
		
	} 
	
	//Programado
	if(($row['status'] == '9') and ($row['d_approve'] == 1)){	
		  
		$thestage3[1][0] = 12;
		$thestage3[1][1]++;
		#$thestage3[1][3]= 'show-payments-special.php?status=9';
        $thestage3[1][3]= '#';
		
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
			
			
		
	}
	
	if(($row['status'] == '13.02') and($row['d_approve'] == 1)){	
		  
		$thestage3[1][0] = 12;
		$thestage3[1][1]++;
		#$thestage3[1][3]= 'show-payments-special.php?status=9';
        $thestage3[1][3]= '#';
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
		
	}
	
	if(($row['status'] == '13.03') and ($row['d_approve'] == 1)){	
		  
		$thestage3[1][0] = 12;
		$thestage3[1][1]++;
		$thestage3[1][3]= '#';
        #$thestage3[1][3]= 'show-payments-special.php?status=9';
			
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
            $thestage3[2][3]= '#';
			#$thestage3[2][3]= 'show-payments-special.php?status=12.01'; 
				
		}else{
			$thestage3[3][0] = 13;
			$thestage3[3][1]++;
			$thestage3[3][3]= '#';
            #$thestage3[3][3]= 'show-payments-special.php?status=13';
			
		}
			
			$thestage2[7][0] = "Tesorería";
			$thestage2[7][1]++;
			$thestage2[7][3]= '#tesoreria';
			
		
	}
	
	
		//Cancelacion
	if($row['status'] == 13){
		$thestage3[4][0] = 14;
		$thestage3[4][1]++;
		$thestage3[4][3]= '#';
        #$thestage3[4][3]= 'show-payments-cancellation.php';
			
			
		$thestage2[7][0] = "Tesorería";
		$thestage2[7][1]++;
		$thestage2[7][3]= '#tesoreria';
	}
	
	
		
}
	$table_rows_special = "";
	//for($i=0;$i<sizeof($thestage);$i++){
	$i = 0;
	asort($thestage);
	//
	foreach($thestage as &$arr){	
		$therstage = $arr[0];
		$querystage = "select * from stages where id = '$therstage'";
		$rowstage = mysqli_fetch_array(mysqli_query($con, $querystage));
		
		
		$table_rows_special.= ' <tr role="row" class="odd">
                                <td class="sorting_1"><a href="'.$arr[3].'">'.$rowstage['name2'].'</a></td>
                                <td><a href="'.$arr[3].'">'.$arr[1].'</a></td>
                                </tr>';
			$table_rows_special_total+=$arr[1];
		
		?>
		dataSpecial[<?php echo $i; ?>] = {
				label: "<?php echo $rowstage['name2'].' ('.$arr[1].')'; ?>",
				data: <?php echo intval($arr[1]); ?>,
				paymentsSpecial: <?php echo intval($arr[1]); 
				?>,
			} 
			
		<?php 

		
		
	$i++;
	}
        
    foreach($thestage3 as &$arr3){
		$therstage3 = $arr3[0];
		$querystage3 = "select * from stages where id = '$therstage3'";
		$rowstage3 = mysqli_fetch_array(mysqli_query($con, $querystage3));
		$table_rows_special.= '<tr role="row" class="odd">
                        <td class="sorting_1"><a href="'.$arr3[3].'">'.$rowstage3['name2'].'</a></td>
                        <td><a href="'.$arr3[3].'">'.$arr3[1].'</a></td>
                        </tr>';
		$table_rows_special_total+= $arr3[1];
		?>
		dataSpecial[<?php echo $i; ?>] = {
				label: "<?php echo $rowstage3['name2'].' ('.$arr3[1].')'; ?>",
				data: <?php echo intval($arr3[1]); ?>,
				paymentsSpecial: <?php echo intval($arr3[1]); 
				?>,
			} 
			
		<?php 

	$i++;	
	}
		
	
		//Tesorería
		/*$table_rows_special.= ' <tr role="row" class="odd" >
                                <td class="sorting_1"><a href="'.$thestage2[7][3].'">'.$thestage2[7][0].'</a></td>
                                <td><a href="'.$thestage2[7][3].'">'.$thestage2[7][1].'</a></td> 
                                </tr>';
		$table_rows_special_total+=$thestage2[7][1];
		?>
		dataSpecial[<?php echo $i; ?>] = {
				label: "<? echo $thestage2[7][0]; ?>",
				data: <?php echo intval($thestage2[7][1]); ?>,
				paymentsSpecial: <?php echo intval($thestage2[7][1]); ?>,
			}  
			
		<?php 

		*/
	
		
	
		if(($num == 0) and ($num2 == 0)){ ?>
			dataSpecial[0] = {
				label: "Sin Movimientos",
				data: 100,
				payments: 0,
				color: '#44a75a'
				
			} 
		<?php } ?>

		var placeholder = $("#specialPaymentsPie");

		
			placeholder.unbind();

			$.plot(placeholder, dataSpecial, {
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
<div id="specialPaymentsPie" class="demo-placeholder"></div>
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
                              
                                
                               <? echo $table_rows_special; ?>
                            
                               
                        <tr role="row" class="odd">
                        <td class="sorting_1">Total</td>
                        <td><? echo $table_rows_special_total; ?></td>
                        </tr>
                                
                                   </tbody>

								</table>
    <a href="show-payments-special.php" class="btn blue"><i class="fa fa-file-excel-o"></i> Exportar</a>  
     <a href="show-payments-special.php?cats=1" class="btn blue"><i class="fa fa-file-excel-o"></i> Exportar (Categorías)</a>
									
</div>
</div>


<div class="row"></div>

