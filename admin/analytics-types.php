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
	.flot-tick-label{
		z-index:9999;
		cursor: pointer; cursor: hand;
	}
	.tickLabel{
		z-index:9999;
	}
	</style>        
                    
                   <div class="portlet"> <div class="portlet-title"> 

							<div class="caption">

								Rubros más importantes 

						  </div>
                          <div class="col-md-8 actions">

								
                             
						    <div class="col-md-6">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="categoriesfrom" value="1-<?php echo date("m"); ?>-<?php echo date("Y"); ?>" id="categoriesfrom">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="categoriesto" value="<?php echo $today = date('j-n-Y'); ?>" id="categoriesto">
											</div></div> 
                                            
                                            
                                            <div class="col-md-4">
											  <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

													
															<select name="categoriescompany" class="form-control" id="categoriescompany" >
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
                                                      
                                                        
<script>
function reloadKhoom(){
	var company = document.getElementById('categoriescompany').value;
	var from = document.getElementById('categoriesfrom').value;
	var to = document.getElementById('categoriesto').value;
	
	$("#rubros").html("Generando reportes...");
	$("#rubros_concept").html("");
	$("#rubros_concept2").html("");
	
	$.post("analytics-types-code.php", { company: company, from: from, to: to }, function(data){
		$("#rubros").html(data); 
		
		
});			
}
</script>						
</div>
                  
                  <div class="col-md-2">
							<div class="form-group" style="margin-top:-15px; margin-bottom:0px;">
							
							<input name="Actualizar" type="button" id="Actualizar" onclick="javascript:reloadKhoom();" value="Actualizar">
         
							</div>
							</div>
                   
                   
                   </div></div></div>    
                    
<div id="rubros">

<p style='font-size:14px;'>Todas las compañías (NIO)</p><br> 
<?php 
$fday = date('Y-m-1');
$today = date('Y-m-d');


$querytype = "select bills.ammount, bills.type, payments.currency, bills.currency, bills.nioammount, bills.tc from bills inner join times on bills.payment = times.payment inner join payments on bills.payment = payments.id inner join categories on categories.id = bills.type where times.today >= '$fday' and times.today <= '$today' and times.stage = '14.00' and payments.currency='1' and  categories.parentcat = '1' group by bills.id";      
$resulttype = mysqli_query($con, $querytype);   
$numtype = mysqli_num_rows($resulttype);
while($rowtype=mysqli_fetch_array($resulttype)){
									
	//Si el pago esta en NIO
	if($rowtype[2] == 1){
		//Si la factura esta en NIO
		if($rowtype[3] == 1){
			$billammount[$rowtype[1]]+=$rowtype[0];
		}
		//Si no esta en NIO convertimos a la taza de cambio
		else{
			$billammount[$rowtype[1]]+=$rowtype[0]*$rowtype[5]; 
		} 
	}
 
} 


arsort($billammount);
$presidentconceptss = "";
foreach ($billammount as $container => $value){
	// echo "$indice = $valor<br>"; 
		
	$queryname = "select * from categories where id = '$container'";
	$resultname = mysqli_query($con, $queryname);
	$rowname = mysqli_fetch_array($resultname); 
	
	$thevalue = str_replace('.00','',$value);
	$thevalue2 = str_replace('.00','',number_format($value,2));
		
    $presidentconceptss.= '["<a onClick='."'showCategories(".$container.");'".'>'.$rowname['name'].'<br>C$'.$thevalue2.'</a>", '.$thevalue.'],'; 

 
} 
$presidentconceptss = substr($presidentconceptss, 0,-1);


?>
    <script type="text/javascript">
	$(function() {

		var data = [ <?php echo $presidentconceptss; ?> ];

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
			grid: {
				borderColor: "#FFFFFF"
			},
			colors: ["#26afe4"],
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script> 
   <br><h3>Tipos:</h3>  <br> 
   
<div class="demo-container">
<div id="placeholder" class="demo-placeholder"></div>
</div>
<? //END RUBROS ?>
</div>

<script>
function showCategories(id){
	var company = document.getElementById('categoriescompany').value;
	var from = document.getElementById('categoriesfrom').value;
	var to = document.getElementById('categoriesto').value;
	
	$("#rubros_concept").html("Cargando información...");
	$("#rubros_concept2").html(""); 
	
	$.post("analytics-types-concept.php", { type: id, company: company, from: from, to: to }, function(data){
		$("#rubros_concept").html(data);
		
});			
}
</script>
<br><br>
<div id="rubros_concept"></div>
<br><br>
<div id="rubros_concept2"></div>