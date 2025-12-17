<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-bankingDebt.php");  
include("functions.php"); 

$table = $_POST['table'];
$pagina = $_POST['i'];

if($table == 2){

	$today = date('Y-m-d'); 
	$tampagina = 25;
	
	if(!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio=($pagina-1)*$tampagina;
	}

	$query = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.status2 = '2' order by id desc";
	$result = mysqli_query($con, $query);
	$numdev = mysqli_num_rows($result);
	$totpagina = ceil($numdev / $tampagina);
	
	$query1 = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.status2 = '2' order by id desc limit ".$inicio.",".$tampagina;  
	$result1 = mysqli_query($con, $query1); 
	if($pagina < $totpagina) $next = $pagina+1;
	if($pagina > 1) $previous = $pagina-1;	
	
?>
<table class="table table-striped table-bordered table-hover" id="datatable">
	<thead>
		<tr role="row" class="heading">
			<th width="1%">ID</th>
			<th width="8%">Fecha</th>
			<th width="16%">Compañía</th>
			<th width="16%">Banco</th>
			<th width="16%">No. Prestamo</th>
			<th width="16%">Movimiento</th>
			<th width="5%">Principal</th>
			<th width="5%">Interes</th>
			<th width="12%">Opciones</th>
		</tr>
	</thead>
	<tbody>
		
		<?php while($row=mysqli_fetch_array($result1)){
					
					$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
					$resultContract = mysqli_query($con, $queryContract);
					$rowContract = mysqli_fetch_array($resultContract);
					
					if ( $row[ 'currency' ] == 1 ) {
        				$thisCurrency = 'Córdobas';
						$pre = 'C$';
      				} elseif ( $row[ 'currency' ] == 2 ) {
        				$thisCurrency = 'Dólares';
		  				$pre = 'U$';
      				}
                    
  					$queryTransaction = "select * from bankingDebtTransactions where bankingDebt = '$row[id]' order by id desc limit 1";
					$resultTransaction = mysqli_query( $con, $queryTransaction );
					$numTransaction  = mysqli_num_rows($resultTransaction);
					$rowTransaction = mysqli_fetch_array( $resultTransaction );
					
					switch($rowTransaction['type']){
	  					case 0:
	  					$ttype = 'Desembolso';
						break;
						case 1:
							$ttype ='Abono';
							break;
						case 2:
							$ttype ='Pago de interés';
							break;
						case 3:
							$ttype ='Cancelación';
							break;
						case 4:
							$ttype ='Abono + Intereses';
							break;
						case 5:
							$ttype ='Cancelación + Intereses';
							break;
					} 
		?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><a href="bankingDebtView.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
								<td><?php echo date("d-m-Y", strtotime($row['today']));; ?></td>
                                <td><? echo $globalCompany[$row['company']]; ?></td>
                                <td><? echo $globalBank[$row['bank']]; ?></td>
                                <td><? echo $row['number']; $rowContract['title']; ?></td>
                                <td><? echo $ttype; ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['interest'],2)); ?></td>
								<td>
									<a href="bankingDebtView.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            	</td></tr>
                                <?php } ?>
    </tbody>

								</table>	

<div>
									<ul class="pagination pagination-lg">
									<?php if($previous != ""){ ?>
									<li><a href="javascript:reloadTable(2,<?php echo $previous; ?>,'');"><i class="fa fa-angle-left"></i></a></li>
                  					<?php }
									if ($totpagina > 1){

  									for ($i=1;$i<=$totpagina;$i++){ 
										 if ($pagina == $i){
											echo '<li class="active"><a href="#">'.$i .'</a></li>';  
									}else{ ?>
		  							<li><a href="javascript:reloadTable(2,<?php echo $i; ?>,'');"><?php echo $i; ?></a></li>
									<? } } } if($next != ""){ ?>
										<li>
											<a href="javascript:reloadTable(2,<?php echo $next; ?>,'');">
											<i class="fa fa-angle-right"></i>
											</a>
										</li>
                  					<?php } ?>
									</ul>
									</div>
<? } ?>