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
		cursor:wait;
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

													
															<select name="categoriescompany" class="form-control" id="categoriescompany">
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
	
	$("#rubros").html("Creando gráficos...");
	$("#rubros_table").html("");
	
	$.post("analytics-categories-code.php", { company: company, from: from, to: to }, function(data){
		$("#rubros").html(data);
		
		
});			
}
</script>						
</div>
                   
                   <div class="col-md-2">
                   <div class="form-group" style="margin-top:-15px; margin-bottom:0px;">
                   <input name="Actualizar" type="button" id="Actualizar" onchange="javascript:reloadKhoom();" value="Actualizar">
         
				   </div> </div> 
                   
                   </div></div></div>    
                    
<div id="rubros">

<p style='font-size:14px;'>Todas las compañías (NIO)</p><br> 
<?php 
$fday = date('Y-m-1');
$today = date('Y-m-d');


$querypresidentconcepts1 = "select sum(ammount), concept from bills inner join times on bills.payment = times.payment where times.today >= '$fday' and times.today <= '$today' and times.stage = '14.00' and bills.currency='1' group by bills.concept order by sum(ammount) desc limit 10";    
$resultpresidentconcepts1 = mysqli_query($con, $querypresidentconcepts1);  
$numpresidentconcepts1 = mysqli_num_rows($resultpresidentconcepts1);
while($rowpresidentconcepts1=mysqli_fetch_array($resultpresidentconcepts1)){
									
$querypresidentconcepts2 = "select * from categories where id = '$rowpresidentconcepts1[1]'";
$resultpresidentconcepts2 = mysqli_query($con, $querypresidentconcepts2);
$rowpresidentconcepts2 = mysqli_fetch_array($resultpresidentconcepts2);

$presidentconceptss .= '["<a onClick='."'categoriesTable(".$rowpresidentconcepts1[1].");'".'>'.$rowpresidentconcepts2['name'].'</a>", '.str_replace('.00','',$rowpresidentconcepts1[0]).'],';

 
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
			}
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script> 
   <br><br>
   
<div class="demo-container">
<div id="placeholder" class="demo-placeholder"></div>
</div>
<? //END RUBROS ?>
</div>
<script>
function categoriesTable(id){
	var company = document.getElementById('categoriescompany').value;
	var from = document.getElementById('categoriesfrom').value;
	var to = document.getElementById('categoriesto').value;
	
	$("#rubros_table").html("Cargando información...");
	
	$.post("analytics-categories-table.php", { category: id, company: company, from: from, to: to }, function(data){
		$("#rubros_table").html(data);
		
});			
}
</script>

<div id="rubros_table"></div>