<h3 class="form-section"><a id="status"></a>Remsión</h3>
                                              
                                             
                                             
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
							   
							   $querypackage = "select * from packagescontent where payment = '$_GET[id]' limit 1";
							   $resultpackage = mysqli_query($con, $querypackage);
							   $rowpackage = mysqli_fetch_array($resultpackage);
							   echo 'Package: '.$rowpackage['package'];
							   
							   
							   $querystatus = "select * from packagestimes where package = '$rowpackage[package]' order by id asc";  
											  $resultstatus = mysqli_query($con, $querystatus);
											  $i=0;
											  while($rowstatus=mysqli_fetch_array($resultstatus)){
											if($i == 0){
												$day1 = $rowstatus['today'];
											}
											$i++;
											
											
											  ?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowstatus['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                <td><?php 
								$querystage = "select * from packagesstages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['name'];
								 ?></td>
                                <td><?php $queryuser = "select * from workers where code = '$rowstatus[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo  $theuser =$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                          
                          <?php $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  $note = $rowstage['note'];
						  $thereason = $rowstatus['reason'];
						  ?>
                                                        
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
                             