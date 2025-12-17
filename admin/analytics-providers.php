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
    
                    
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Proveedores más importantes

						  </div>

							<div class=" col-md-8 actions">

							<div class="col-md-6">
                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="providersfrom" value="<?php echo $today = date('1-n-Y'); ?>" id="providersfrom">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="providersto" value="<?php echo $today = date('j-n-Y'); ?>" id="providersto">
											</div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

												
															<select name="type" class="form-control" id="providerstype">
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
 							</div>
 							
 							<div class="col-md-2">
 							<div class="form-group" style="margin-top:-15px; margin-bottom:0px;">
 							<input name="Actualizar" type="button" id="Actualizar" onclick="javascript:reloadProvidersA();" value="Actualizar">
							</div>
							  </div>


	                            
                               <script>
     
	 
	 function reloadProvidersA(){	

	
	var type = document.getElementById('providerstype').value;
	var from = document.getElementById('providersfrom').value;
	var to= document.getElementById('providersto').value;
	
	$.post("analytics-providers-code.php", { type: type, from: from, to: to }, function(data){
		$("#analytics_providers").html(data); 
		$("#analytics_providers_table").html(""); 
		
});			
}

	</script>						

							</div>

						</div>
</div>

<div id="analytics_providers">
<?php

include_once("session-admin.php");
#$fday = date('Y-m-1');
#$today = date('Y-m-d');
#$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join times on payments.id = times.payment where times.stage = '14' and btype = '1' and payments.currency = '1' and times.today >= '$fday' and times.today <= '$today' group by payments.provider order by sum(payments.payment) desc limit 10";
#$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1); 
#echo 'NUM'.$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
#while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){

$fday  = date('Y-m-1');   // si prefieres exacto primer día usa: date('Y-m-01')
$today = date('Y-m-d');

$stage    = '14';
$btype    = '1';
$currency = '1';

$querypresidentprovider1 = "
    select sum(payments.payment) as payment, payments.provider as provider, payments.currency as currency from payments inner join times on payments.id = times.payment where times.stage = ? and btype = ? and payments.currency = ? and times.today >= ? and times.today <= ? group by payments.provider order by sum(payments.payment) desc limit 10
";

$stmtpresidentprovider1 = $con->prepare($querypresidentprovider1);
$stmtpresidentprovider1->bind_param("sssss", $stage, $btype, $currency, $fday, $today);
$stmtpresidentprovider1->execute();
$resultpresidentprovider1 = $stmtpresidentprovider1->get_result();

echo 'NUM' . ($numpresidentprovider1 = $resultpresidentprovider1->num_rows);
while ($rowpresidentprovider1 = $resultpresidentprovider1->fetch_assoc()) {
	
	
	
	
$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[provider]'";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);
$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[currency]";
$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3); 

$presidentproviders .= '["<a onClick='."'providersTable(".$rowpresidentprovider2['id'].");'".'>'.$rowpresidentprovider2['name'].'<br>'.str_replace('.00','',$rowpresidentprovider1['payment']).'</a>", '.str_replace('.00','',$rowpresidentprovider1['payment']).'],'; 

 
} 
 $presidentproviders = substr($presidentproviders, 0,-1);
?>
<script type="text/javascript">

	$(function() {

		var data = [ <?php echo $presidentproviders; ?> ];

		$.plot("#placeholder", [ data ], {
			series: {
				
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				},
				valueLabels: {
                    show: true,
                    showAsHtml: true,
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
	
	function providersTable(id){
		//alert('code: '+id);
		var type = document.getElementById('providerstype').value;
		var from = document.getElementById('providersfrom').value;
		var to= document.getElementById('providersto').value;
	
	$.post("analytics-providers-table.php", { type: type, from: from, to: to, provider: id }, function(data){ 
		$("#analytics_providers_table").html(data);  
		
});			
	}

	</script>
   <div class="demo-container">
   <div id="placeholder" class="demo-placeholder"></div>
   </div>
   


</div>

<div id="analytics_providers_table"></div> 
