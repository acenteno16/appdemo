<?php include("session-provision.php");

$id = $_POST['variable'];
$payment = $_POST['variable2'];

$query = "select * from templatescontent where template = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
?>
 <p>Distribucion de la plantilla: </p>
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
                            <?php while($row=mysqli_fetch_array($result)){
								?>                               
                                <tr role="row" class="odd">
                                <td><span class="form-group">
                                  <input name="unit[]" type="text" class="form-control" id="unit[]" value="<?php echo $row['unit']; ?>" readonly>
                                </span></td>
                                <td> <input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php echo $row['unit'].'.'.$row['account']; ?>" readonly></td> 
                                <td><input name="percent[]" type="text" class="form-control" id="percent[]" value="<?php echo $row['percent'].'%'; ?> " onKeyUp="javascript:calculateTotal1();" onkeypress="return justNumbers(event);" readonly></td>
                                <td> <input name="total[]" type="text" class="form-control" id="total[]" value="<?php $total = $payment*($row['percent']/100);
								echo number_format($total, 2); ?>" readonly></td>
                                </tr> 
                                <?php } ?>
                                </tbody></table>