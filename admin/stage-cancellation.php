<?php 

include_once('sessions.php');
$querybank = "select * from banks where id = '$row[bank]'";
$resultbank = mysqli_query($con, $querybank);
$rowbank=mysqli_fetch_array($resultbank);

?>

<h3 class="form-section">Cancelación</h3>
<div class="row"><!--/span-->
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Link:</label>

						
										
											  <input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $row['clink']; ?>" readonly>
								
															   
														      </div>
													    </div>
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">No. de transacción: (CKPK)</label>

						
										
											  <input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $row['cnumber']; ?>" readonly>
								
															   
														      </div>
													    </div>
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Referencia:</label>

						
										
											  <input name="bill5" type="text" class="form-control" id="bill5" value="<?php if($row['reference'] == ""){ echo "N/A"; } else{ echo $row['reference']; } ?>" readonly>
								
															   
														      </div>
													    </div>
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
										
											  <input name="bill5" type="text" class="form-control" id="bill5" value="<?php if($rowbank == 0){ echo 'N/A'; }else{ echo $rowbank['name']; } ?>" readonly>
								
															   
														      </div>
													    </div>
                                                        </div>
                                                     <div class="row">   
                                                     <div class="col-md-2 ">
                             <a href="<?php  
							 $thisClink = str_replace('www.','',$row['clink']);
									  $thisClinkArr = explode('key=', $thisClink);
									  echo 'visor.php?key='.$thisClinkArr[1];
							 ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a> 
                                                                                                      </div>
	</div>
                                                        

                                                        
                                                        
                                                        
                                                        
                                                        
<? 

$queryscheduleid = "select * from schedulecontent where payment = '$row[id]'";
$resultscheduleid = mysqli_query($con, $queryscheduleid);
$rowscheduleid = mysqli_fetch_array($resultscheduleid);

?>                                        
                                                        
                                                        

<h3 class="form-section">Remisión Archivo</h3>
<div class="row"><!--/span-->
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">IDR:</label> 

						
										
											  <input name="scheduleid" type="text" class="form-control" id="scheduleid" value="<?php echo $rowscheduleid['schedule']; ?>" readonly>
								
															   
														      </div>
													    </div>

                                                        </div>
                                                    
                                                          
                                                        
                                                        
                                                        
                                                        
                                                        

										