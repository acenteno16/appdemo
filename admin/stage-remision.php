<h3 class="form-section"><a id="status"></a>Remisión</h3>
                                              
<?php

$querypackage = "select * from packagescontent where payment = '$row[id]' limit 1";
$resultpackage = mysqli_query($con, $querypackage);
$numpackage = mysqli_num_rows($resultpackage);

$querystatus = "select * from provisionfilestimes where payment = '$row[id]' order by id asc";  
$resultstatus = mysqli_query($con, $querystatus);
$numstatus = mysqli_num_rows($resultstatus);

if(($numpackage > 0) or ($numstatus > 0)){
$rowpackage = mysqli_fetch_array($resultpackage);
echo 'ID de Remisión: '.$rowpackage['package'];
							    

?>                                             
                                             
                                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 TID</th>

									<th width="12%">

										 Fecha</th>

									<th width="12%">

										 Hora</th>

									<th width="26%">Acción</th>

									<th width="19%">

										 Por Usuario

									</th>

							
								  </tr>

								</thead>

								<tbody>
                               <?php  
							   
							    
							 	$i=0;
								while($rowstatus=mysqli_fetch_array($resultstatus)){
								
											
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo '>'.$rowstatus['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
								<td><a href="#" class="btn blue">Recibido en Provisión</a></td>
                                <td><?php 
								$queryuser = "select * from workers where code = '$rowstatus[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $theuser =$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                          
                          <?php $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  $note = $rowstage['note'];
						  //$thereason = $rowstatus['reason'];
						  ?>
                                                        
                                <?php }  ?>
                                
                                 
                                  
                                   
                                     <?php 
							   
							    $querystatus = "select * from packagestimes where package = '$rowpackage[package]' order by id asc";  
							    $resultstatus = mysqli_query($con, $querystatus);
							 	$i=0;
								while($rowstatus=mysqli_fetch_array($resultstatus)){
								if($i == 0){
									$day1 = $rowstatus['today'];
								}
								$i++;
											
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo '#'.$rowstatus['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                <td><?php 
								$querystage = "select * from packagesstages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['name'];
								 ?></td>
                                <td><?php $queryuser = "select * from workers where code = '$rowstatus[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $theuser =$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                          
                          <?php $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  #$note = $rowstatus['note'];
						  //$thereason = $rowstatus['reason'];
						  ?>
                                                        
                                <?php }  ?>
                                
                                <?php
                                
								 /*
									
								 if($row['sent'] == 3){
									 //echo 'No revisado';
								 } 
								 elseif($row['sent_complete'] == 1){
									 //echo "Revisado y encontrado completo.";
								?>
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo '*'.$rowscheduleid['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowscheduleid['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowscheduleid['now2'])); ?></td>
                                <td>Revisado (Completo)</td>
                                <td><?php 
								
								$queryuser = "select * from workers where code = '$rowscheduleid[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $theuser =$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                                <?php
								 }
								 elseif(($row['sent'] == '4') and ($row['sent_complete'] == '0')){
									 //echo "Revisado y encontrado incompleto.";
									 ?>
                                     <tr role="row" class="odd"><td class="sorting_1"><?php echo '*'.$rowscheduleid['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowscheduleid['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowscheduleid['now2'])); ?></td>
                                <td>Revisado (Incompleto)</td> 
                                <td><?php 
								
								$queryuser = "select * from workers where code = '$rowscheduleid[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $theuser =$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                                     <?php
								 }
								
								 */
									 
								
								?>
                                
                                <?php 
								
								$queryscheduletid = "select * from schedulecontent where payment = '$row[id]'";
								$resultscheduletid = mysqli_query($con, $queryscheduletid);
								$numscheduletid = mysqli_num_rows($resultscheduletid);
								$rowscheduletid=mysqli_fetch_array($resultscheduletid); 
	
	
								if($rowscheduletid['schedule'] > 0){
								$queryscheduleid = "select * from scheduletimes where schedule = '$rowscheduletid[schedule]' and ((stage = '1') or (stage = '7'))";
								$resultscheduleid = mysqli_query($con, $queryscheduleid);
	
								if($_GET['echo'] == 1){
									echo "<br>$queryscheduletid<br>$queryscheduleid";
									
								}
								while($rowscheduleid=$rowscheduleid=mysqli_fetch_array($resultscheduleid)){ 
									
								?>
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo '*'.$rowscheduleid['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowscheduleid['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowscheduleid['now2'])); ?></td>
                                <td><?php 
								$querystage = "select * from schedulestages where id = '$rowscheduleid[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['name'];
								 ?></td>
                                <td><?php 
								
								$queryuser = "select * from workers where code = '$rowscheduleid[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $theuser =$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                                <?php } } ?>
                               
                                </tbody>

								</table>
                                
                                <?php 
							
							if($row['sent'] >= 3){
								?>
                               <?php
                                
								
									
								 if($row['sent'] == 3){
									 echo 'No revisado';
								 }elseif($row['sent_complete'] == 1){
									 echo "Revisado y encontrado completo.";
								
								 }elseif(($row['sent'] == '4') and ($row['sent_complete'] == '0')){
									 echo "Revisado y encontrado incompleto.";
								
								 }
								
								
									 
								
								?>
                                <?php } }else{ ?>
                                
                                <div class="note note-danger">La solicitud de pago no ha sido remisionada.</div>
                                <?php } ?>
                             