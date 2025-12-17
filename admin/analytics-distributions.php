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

								Distribuciones (Gastos Aplicados) 

						  </div>
					 
                          </div>
                          
                          <div class="row"></div>	<br><br>
                            <div class="row">
                            <form action="analytics-distribution-excel.php" enctype="multipart/form-data" method="post">  
						    <div class="col-md-4">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="categoriesfrom" value="1-<?php echo date("m"); ?>-<?php echo date("Y"); ?>" id="categoriesfrom">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="categoriesto" value="<?php echo $today = date('j-n-Y'); ?>" id="categoriesto">
											</div></div> 
							<div class="col-md-3">
											  <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

													
															<select name="categoriescompany" class="form-control" id="categoriescompany" >
														<option value="0">UN</option>
														<? 
														
														$queryunits = "select * from units order by code asc";
														$resultunits = mysqli_query($con, $queryunits);
														while($rowunits=mysqli_fetch_array($resultunits)){
														
														?>
														<option value="<? echo $rowunits['code']; ?>"><? echo $rowunits['code']." | ".$rowunits['name']; ?></option>
														<? } ?> 
	 														</select>

											  </div>
                                                      
                                                        
						
</div> 
                 			
                 			<div class="col-md-2">
							<div class="form-group" style="margin-top:-15px; margin-bottom:0px;">
							
							<input name="Exportar" type="submit" id="Exportar" value="Exportar">
         
							</div>
							</div>
                            </form> 
                            </div>
                          
                          </div>    
                    
