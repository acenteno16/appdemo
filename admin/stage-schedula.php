
<? /*
<h3 class="form-section"><a id="provision"></a>Programación</h3>
<h4 class="block" style="font-weight:400;">Distribución del Pago:</h4>
<?php $querydistribution = "select * from distribution where payment = '$_GET[id]' and preturn = '$row[preturn]'";
$resultdistribution = mysqli_query($con, $querydistribution);
$numdistribution = mysqli_num_rows($resultdistribution);      if($numdistribution > 0){
?>
                                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										Unidad</th>

									<th width="12%">

										Cuenta</th>

									<th width="12%">

										 Porcentaje</th>
<th width="12%">

										 Total</th>
				

								  </tr>

								</thead>

								<tbody>
                            <?php while($rowdistribution=mysqli_fetch_array($resultdistribution)){
								?>                               
                                <tr role="row" class="odd">
                                <td><?php echo $rowdistribution['unit']; ?></td>
                                <td><?php echo $rowdistribution['account']; ?></td>
                                <td><?php echo str_replace('.00','',$rowdistribution['percent']).'%'; ?></td>
                                <td><?php $total = $row['payment']*($rowdistribution['percent']/100);
								echo number_format($total, 2); ?></td>
                                </tr> 
                                <?php } ?>
                                </tbody></table>
<?php } else { ?>
<p>No se encontró ninguna distribución</p>
<?php } ?>*/ ?>
      