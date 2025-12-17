<?php include("session-financemanager.php"); 

$vprovider = $_POST['vprovider'];
$vfrom = $_POST['vfrom'];
$vto = $_POST['vto'];
$page = $_POST['page'];

$sql1 = "";
if($vprovider != ""){
	$sql1 = " and provider = '$vprovider'";
}
$sql2 = "";
if($vfrom != ""){
	$vfrom = date("Y-m-d", strtotime($vfrom));
	$sql2 = " and today >= '$vfrom'";
}
$sql3 = "";
if($vto != ""){
	$vto = date("Y-m-d", strtotime($vto));
	$sql3 = " and today <= '$vto'";
}
$sql = $sql1.$sql2.$sql3;

?>
<div class="portlet-body">

								<div id="paymenthistory">

								

<?php $today = date('Y-m-d'); 
$tampagina = 25;
$pagina = $page;
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}
	 
$query = "select * from payments where status = '14'".$sql;
$result = mysqli_query($con, $query);  
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

$query1 = "select * from payments where status = '14'".$sql." limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							
								
if($numdev > 0){ 
							
?>
                                
                             <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="17%">

										 Nombre</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="14%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                 
                                      <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="javascript:fmphistory(<?php echo $previous; ?>);">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="javascript:fmphistory('.$i .');">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="javascript:fmphistory(<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                            
                            
                            
                            
                            
                            
                            
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay registros.</div>
<?php } ?>
                                   

						</div>

					</div>