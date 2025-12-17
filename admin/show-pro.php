<?php include("session-schedule.php"); ?> 
										<?php  
											$querypp = "select * from routes where type = '7' group by worker";
									   		$resultpp = mysqli_query($con, $querypp);
									   		
											while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryproviders = "select * from workers where code = '$rowpp[worker]'";
											$resultproviders = mysqli_query($con, $queryproviders); 
											$rowproviders = mysqli_fetch_array($resultproviders);
											?>
                                            <?php echo $rowproviders["email"].','; ?>
                                            <?php  } 
											?> 