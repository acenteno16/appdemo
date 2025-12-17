<div id="providers_categories"></div>
<? 


include("sessions.php"); 

$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

	 
$company = $_POST['type'];
$from = $_POST['from'];
$to = $_POST['to'];
$provider = $_POST['provider'];
$queryprovider = "select * from providers where id = '$provider'";
$resultprovider = mysqli_query($con, $queryprovider);
$rowprovider = mysqli_fetch_array($resultprovider);

echo '<br><strong>Proveedor:</strong> '.$rowprovider["name"].'<br>';

switch($company){
	case 0:
	echo "<strong>Compañía:</strong> Todas las compañías <br>
<strong>Moneda:</strong> (NIO) Córdobas";
	$sql1 = " and payments.currency = 1";
	break;
	case 1:
	echo "<strong>Compañía:</strong> Todas las compañías<br>
 <strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = 2";
	break;
	case 2:
	echo "<strong>Compañía:</strong> Todas las compañías <br>
 <strong>Moneda:</strong>(EUR)";
	$sql1 = " and payments.currency = 3";
	break;
	case 3:
	echo "<strong>Compañía:</strong> Todas las compañías <br>
 <strong>Moneda:</strong>(YEN)";
	$sql1 = " and payments.currency = 4";
	break;
	case 4:
	echo "<strong>Compañía:</strong> Casa Pellas <br>
 <strong>Moneda:</strong>(NIO)";
	$sql1 = " and payments.currency = 1 and units.company = 1";
	break;
	case 5:
	echo "<strong>Compañía:</strong> Casa Pellas <br>
 <strong>Moneda:</strong>(USD)";
	$sql1 = " and payments.currency = 2 and units.company = 1";
	break;
	case 6:
	echo "<strong>Compañía:</strong> Casa Pellas <br>
 <strong>Moneda:</strong>(EUR)";
	$sql1 = " and payments.currency = 3 and units.company = 1";
	break;
	case 7:
	echo "<strong>Compañía:</strong> Casa Pellas <br>
 <strong>Moneda:</strong>(YEN)";
	$sql1 = " and payments.currency = 4 and units.company = 1";
	break;
	case 8:
	echo "<strong>Compañía:</strong> Alpesa <br>
 <strong>Moneda:</strong>(NIO)";
	$sql1 = " and payments.currency = 1 and units.company = 2";
	break;
	case 9:
	echo "<strong>Compañía:</strong> Alpesa <br>
 <strong>Moneda:</strong>(USD)";
	$sql1 = " and payments.currency = 2 and units.company = 2";
	break;
	case 10:
	echo "<strong>Compañía:</strong> Alpesa <br>
 <strong>Moneda:</strong>(EUR)";
	$sql1 = " and payments.currency = 3 and units.company = 2";
	break;
	case 11:
	echo "<strong>Compañía:</strong> Alpesa <br>
 <strong>Moneda:</strong>(YEN)";
	$sql1 = " and payments.currency = 4 and units.company = 2";
	break;
	case 12:
	echo "<strong>Compañía:</strong> Velosa <br>
 <strong>Moneda:</strong>(NIO)";
	$sql1 = " and payments.currency = 1 and units.company = 3";
	break;
	case 13:
	echo "<strong>Compañía:</strong> Velosa <br>
 <strong>Moneda:</strong>(USD)";
	$sql1 = " and payments.currency = 2 and units.company = 3";
	break;
	case 14:
	echo "<strong>Compañía:</strong> Velosa <br>
 <strong>Moneda:</strong>(EUR)";
	$sql1 = " and payments.currency = 3 and units.company = 3";
	break;
	case 15:
	echo "<strong>Compañía:</strong> Velosa <br>
 <strong>Moneda:</strong>(YEN)";
	$sql1 = " and payments.currency = 4 and units.company = 3";
	break;
	case 16:
	echo "<strong>Compañía:</strong> Otras Compañías <br>
 <strong>Moneda:</strong>(NIO)";
	$sql1 = " and payments.currency = 1 and units.company > 3";
	break;
	case 17:
	echo "<strong>Compañía:</strong> Otras Compañías <br>
 <strong>Moneda:</strong>(USD)";
	$sql1 = " and payments.currency = 2 and units.company > 3";
	break;
	case 18:
	echo "<strong>Compañía:</strong> Otras Compañías <br>
 <strong>Moneda:</strong>(EUR)";
	$sql1 = " and payments.currency = 3 and units.company > 3";
	break;
	case 19:
	echo "<strong>Compañía:</strong> Otras Compañías <br>
 <strong>Moneda:</strong>(YEN)";
	$sql1 = " and payments.currency = 4 and units.company > 3";
	break; 
}

$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
}
$sql4 = "";
if($provider != ""){
	$sql4 = " and payments.provider = '$provider'";
}
$sql = $sql1.$sql2.$sql3.$sql4;


$query = "select payments.payment, payments.currency from payments inner join times on payments.id = times.payment inner join units on (payments.route = units.code or payments.route = units.code2) where payments.id > '0' and times.stage = '14'".$sql." group by times.payment order by payments.expiration asc";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($rowa = mysqli_fetch_array($result)){
	switch($rowa['currency']){
		//cordobas
		case 1:
		$cordobas+= $rowa["payment"];
		break;
		case 2:
		$dolares+= $rowa["payment"];
		break;
		case 3:
		$euros+= $rowa["payment"];
		break;
		case 4:
		$yenes+= $rowa["payment"];
		break;
	}
	
}

$query1 = "select payments.id, payments.payment, payments.currency, payments.description, times.today from payments inner join times on payments.id = times.payment inner join units on (payments.route = units.code or payments.route = units.code2) where payments.id > '0' and times.stage = '14'".$sql." group by times.payment order by payments.expiration asc limit ".$inicio.",".$tampagina;
$result1 = mysqli_query($con, $query1);
 
echo '<br><strong>Cantidad de solicitudes:</strong> '.$num;
if($cordobas > 0){ echo '<br><strong>Monto:</strong> C$'.number_format($cordobas,2); }
if($dolares > 0){ echo '<br><strong>Monto:</strong>  U$'.number_format($dolares,2); }
if($euros > 0){ echo '<br><strong>Monto:</strong> &euro;'.number_format($euros,2); }
if($yenes > 0){ echo '<br><strong>Monto:</strong> &yen;'.number_format($yenes,2); }   
echo '<br>
<br>
<a href="javascript:showCategories('.$provider.');">[Ver rubros de gastos]</a>';
?>
<br>&nbsp;<br>
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									
<th width="6%">Fecha cancelación</th>
									<th width="6%">Total Pagar</th>
                                    <th width="16%">Descripción</th>

									

									

									<th width="2%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                            <? 
							while($row=mysqli_fetch_array($result1)){ 
							$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
							?>
                            <tr>
                            <td><? echo $row['id']; ?></td>
                            <td><? echo date("d-m-Y", strtotime($row['today'])); ?></td>
                            <td><? if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); } ?></td>
                            <td><? echo $row['description']; ?></td>
                            <td> <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a></td>
                            </tr>
                            <? } ?>
                                   </tbody>

								</table>
                                
<script>
function showCategories(provider){
	var type = document.getElementById('providerstype').value;
	var from = document.getElementById('providersfrom').value;
	var to= document.getElementById('providersto').value;
	
	$.post("analytics-providers-categories.php", { type: type, from: from, to: to, provider: provider }, function(data){
		$("#providers_categories").html(data);	
});			
}
</script>                                