<?php include("session-financemanager.php"); 

$currency = $_POST['variable'];
								$today = date('Y-m-d');
								$querypresidentprovider1 = "select sum(payment), provider, currency from payments where status = '14' and currency = '$currency' and WEEK('$today') group by provider order by sum(payment) desc limit 10";
								//$querypresidentprovider1 = "select sum(payment), provider, currency from payments where currency = '$currency' and WEEK('$today') group by provider order by sum(payment) desc limit 10";
								$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1);  
								$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
								if($numpresidentprovider1 > 0){ 
								
								
								
								?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 Código</th>

									<th width="20%">

										 Nombre</th>

									<th width="7%">

										 Monto</th>

									

									
									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){
									$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[1]'";
									$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
									$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);
									
									$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[2]";
									$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
									$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3);
									
								
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowpresidentprovider2['code']; ?></td>
                                <td><?php echo $rowpresidentprovider2['name']; ?></td>
                                <td><?php echo $rowpresidentprovider3['pre'].' '.$rowpresidentprovider3['symbol'].$rowpresidentprovider1[0]; ?></td>
                            		<td><a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td>
                            </tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay registros.</div>
<?php } ?>