
<h3 class="form-section">Información de Pago Multiple</h3>
											
											<div class="row">
											<div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción General: </label>
                                                        <p>
                                                          <textarea name="description2" rows="2" readonly class="form-control" id="description"><?php echo $row['zdescription']; ?></textarea>
                                                        </p>
                                                          
                       

                       
                                                      <!--/row--></div>
													</div>
													
											<div class="col-md-12 table-container">
											<div class="table-scrollable" id="templatewaiter" name="templatewaiter">
											<table class="table table-striped table-bordered table-hover" id="datatable_orders">

	<thead>

	<tr role="row" class="heading">
   
    <th width="2%">IDS</th>
    <th width="68%">Colaborador</th>
    <th width="30%">Monto</th>
	
	</tr>

	</thead>

	<tbody>

<?php  
	if($row['child'] > 0){
		$query_parentchilds = "select * from payments where id = '$row[child]' or child = '$row[child]' order by id asc";
	}						
	else{
		$query_parentchilds = "select * from payments where id = '$_GET[id]' or child = '$_GET[id]' order by id asc";
	}	
	$result_parentchilds = mysqli_query($con, $query_parentchilds);
	while($row_parentchilds=mysqli_fetch_array($result_parentchilds)){
	
	//Collaborator
	$row_bencollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row_parentchilds[collaborator]'"));
	$ben_name = $row_bencollaborator['code'].' | '.$row_bencollaborator['first'].' '.$row_bencollaborator['last'];	
	
	//Currency
	$querycurrency = "select * from currency where id = '$row_parentchilds[currency]'"; 
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency =mysqli_fetch_array($resultcurrency);
	$ben_currency = $rowcurrency['pre'].' '.$rowcurrency['symbol'];
	
	//Amount
	$ben_ammount = $row_parentchilds['payment'];
	
	$class_parentchild = "";
	if($_GET['id'] == $row_parentchilds['id']){
		$class_parentchild = "success";
	}
?>							

	<tr role="row" class="odd <? echo $class_parentchild; ?>">
                                
    <td class="sorting_1"><?
	//echo '<a href="payment-order-view.php?id='.$row_parentchilds['id'].'">'.$row_parentchilds['id'].'</a>'; 
	echo $row_parentchilds['id']; 
	?></td> 	
    <td><? echo $ben_name; ?></td>
    <td><? echo $ben_currency.number_format($ben_ammount,2); ?></td>
    
    </tr>
                                                            
<?php 

} ?>  
                                
	</tbody> 

	</table>
											</div>
											</div>
											</div> 

<? 
$route_xls = 'paymentstemplates/'.$row['id'].'/'.$row['id'].'.xls';
?>
<a href="<? echo $route_xls; ?>"> <i class="fa fa-download"></i> Descargar Excel</iframe>


