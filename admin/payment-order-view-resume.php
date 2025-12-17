<div class="row"></div>
<br>
<?php $the2paymentcurrency = $row['currency']; ?>

<h3 class="form-section">Resumen de documentos</h3>

<?php 

$queryBC = "select * from bills where payment = '$row[id]'"; 
$resultBC = mysqli_query($con, $queryBC);
$rowBC=mysqli_fetch_array($resultBC); 

if($rowBC['currency'] == 2){ ?>
	<a onClick="javascript:loadDocumentTable(<?php echo $row['id'];  ?>,1,<?php echo $the2paymentcurrency; ?>);"><button type="button" class="btn blue">Córdobas</button></a>
    <a onClick="javascript:loadDocumentTable(<?php echo $row['id'];  ?>,2,<?php echo $the2paymentcurrency; ?>);"><button type="button" class="btn blue">Dólares</button></a>
<br>
<br>
<?php } ?>

<div id="thetablereload">

<?php

echo "<strong>Moneda a mostrar: </strong> ";
switch($rowBC['currency']){
	case 1:
	echo "Córdobas";
	$rpre = "C$";
	break;
	case 2:
	echo "Dólares";
	$rpre = "U$"; 
	break;
}
?>
<div class="table-container">
                            <div class="table-scrollable">
							
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="30%">#</th>
									<th width="30%">Factura</th>
                                    <th width="30%">Fecha de Factura</th>
                                    <th width="25%">Monto graba IVA</th>
                                    <th width="13%">Monto exento de IVA</th>
                                    <th width="13%">IVA</th>
                                    <th width="13%">INTUR</th>
                                    <th width="13%">Sub Total</th>
                                    <th width="13%">Exento IMI</th>
                                    <th width="13%">Exento IR</th>
                                    <th width="13%">Base para retención</th>
                                    <th width="13%">Retenciones IR</th>
                                    <th width="13%">Retenciones IMI</th>
                                    <th width="13%">Monto a pagar</th>
                                    
								  </tr>

								</thead>

								<tbody>

                                <?php  
								$rthe2rstotalglobal = 0;
								$rthe2rstotal2global = 0;
								$rthe2rtaxglobal = 0;
								$rthe2rinturglobal = 0;
								$rthe2exempt2global = 0;
								$rthe2exemptglobal = 0;
								$rthe2rgstotalgloba = 0;
								$retentionbaseglobal = 0;
								$rthe2ret2aglobal = 0;
								$rthe2ret1aglobal = 0;
								$rthe2rpaymentglobal = 0;
								$rthe2rgstotalglobal = 0;
								$tInc = 1;
								
								$query2rbills = "select * from bills where payment = '$row[id]'";
								$result2rbills = mysqli_query($con, $query2rbills);
								while($rowrbills=mysqli_fetch_array($result2rbills)){
									
									//$rbillcurrency = $rowrbills['currency'];
									
									$currency = $row['currency']; 
									$billcurrency = $rowrbills['currency'];
									
									
									if((($billcurrency == 1) and ($currency == 1)) or (($billcurrency == 2) and ($currency == 2))){
									//STOTAL IVA
									$rthe2rstotal = $rowrbills['stotal']; 
									$rthe2rstotalglobal+=$rthe2rstotal;
									
									//STOTAL (NO IVA)
									$rthe2rstotal2 = $rowrbills['stotal2'];
									$rthe2rstotal2global += $rthe2rstotal2;
									 
									//TAX
									$rthe2rtax = $rowrbills['tax'];
									$rthe2rtaxglobal += $rthe2rtax;
								
									//INTUR
									$rthe2rintur = $rowrbills['inturammount'];
									$rthe2rinturglobal += $rthe2rintur;
									
									//EXCENTO IMI
									$rthe2exempt2 = $rowrbills['exempt2'];
									$rthe2exempt2global += $rthe2exempt2;
									
									//EXCENTO IR
									$rthe2exempt = $rowrbills['exempt'];
									$rthe2exemptglobal += $rthe2exempt;
									
									//STOTAL
									$rthe2rgstotal = $rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
									$rthe2rgstotalglobal += $rthe2rgstotal;
									
									//RET BASE
									//$retentionbase = $rthe2rstotal-$rthe2exempt2-$rthe2exempt;
								    $retentionbase = $rthe2rstotal+$rthe2rstotal2;
									$retentionbaseglobal += $retentionbase;
									
									//RET IR
									
									if(($billcurrency == 1) and ($currency == 1)){
										$rthe2ret2a = $rowrbills['ret2a'];
										$rthe2ret2aglobal += $rthe2ret2a; 
									}
									if(($billcurrency == 2) and ($currency == 2)){
										$rthe2ret2a = $rowrbills['ret2a']/$rowrbills['tc'];
										$rthe2ret2aglobal += $rthe2ret2a;
									}
									
									//RET IMI
									
									if(($billcurrency == 1) and ($currency == 1)){
										$rthe2ret1a = $rowrbills['ret1a'];
										$rthe2ret1aglobal += $rthe2ret1a ;
									}
									if(($billcurrency == 2) and ($currency == 2)){
										$rthe2ret1a = $rowrbills['ret1a']/$rowrbills['tc'];
										$rthe2ret1aglobal += $rthe2ret1a ;
									}
									
									//PAYMENT
									$rthe2rpayment = $rthe2rgstotal-$rthe2ret2a-$rthe2ret1a;
									$rthe2rpaymentglobal += $rthe2rpayment;
									}
									elseif(($billcurrency == 1) and ($currency == 2)){		
									//STOTAL IVA
									$rthe2rstotal = $rowrbills['stotal']/$rowrbills['tc']; 
                                    if($_SESSION['email'] == 'jairovargasg@gmail.com'){
                                        echo '<script>alert("'.$rowrbills['stotal'].' - '.$rowrbills['tc'].'");</script>';
                                    }    
									$rthe2rstotalglobal+=$rthe2rstotal;
									
									//STOTAL (NO IVA)
									$rthe2rstotal2 = $rowrbills['stotal2']/$rowrbills['tc'];
									$rthe2rstotal2global += $rthe2rstotal2;
									 
									//TAX
									$rthe2rtax = $rowrbills['tax']/$rowrbills['tc'];
									$rthe2rtaxglobal += $rthe2rtax;
								
									//INTUR
									$rthe2rintur = $rowrbills['inturammount']/$rowrbills['tc'];
									$rthe2rinturglobal += $rthe2rintur;
									
									//EXCENTO IMI
									$rthe2exempt2 = $rowrbills['exempt2']/$rowrbills['tc'];
									$rthe2exempt2global += $rthe2exempt2;
									
									//EXCENTO IR
									$rthe2exempt = $rowrbills['exempt']/$rowrbills['tc'];
									$rthe2exemptglobal += $rthe2exempt;
									
									//STOTAL
									$rthe2rgstotal = $rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
									$rthe2rgstotalglobal += $rthe2rgstotal;
									
									//RET BASE
									//$retentionbase = $rthe2rstotal-$rthe2exempt2-$rthe2exempt;
									$retentionbase = $rthe2rstotal+$rthe2rstotal2;
								    $retentionbaseglobal += $retentionbase;
									
									//RET IR
									
									$rthe2ret2a = $rowrbills['ret2a']/$rowrbills['tc'];;
									$rthe2ret2aglobal += $rthe2ret2a; 
									
									//RET IMI
									$rthe2ret1a = $rowrbills['ret1a']/$rowrbills['tc'];;
									$rthe2ret1aglobal += $rthe2ret1a ; 
									
									//PAYMENT
									$rthe2rpayment = $rthe2rgstotal-$rthe2ret2a-$rthe2ret1a;
									$rthe2rpaymentglobal += $rthe2rpayment;
										
									} 
									elseif(($billcurrency == 2) and ($currency == 1)){		
									//STOTAL IVA
									$rthe2rstotal = $rowrbills['stotal']*$rowrbills['tc']; 
									$rthe2rstotalglobal+=$rthe2rstotal;
									
									//STOTAL (NO IVA)
									$rthe2rstotal2 = $rowrbills['stotal2']*$rowrbills['tc'];
									$rthe2rstotal2global += $rthe2rstotal2;
									 
									//TAX
									$rthe2rtax = $rowrbills['tax']*$rowrbills['tc'];
									$rthe2rtaxglobal += $rthe2rtax;
								
									//INTUR
									$rthe2rintur = $rowrbills['inturammount']*$rowrbills['tc'];
									$rthe2rinturglobal += $rthe2rintur;
									
									//EXCENTO IMI
									$rthe2exempt2 = $rowrbills['exempt2']*$rowrbills['tc'];
									$rthe2exempt2global += $rthe2exempt2;
									
									//EXCENTO IR
									$rthe2exempt = $rowrbills['exempt']*$rowrbills['tc'];
									$rthe2exemptglobal += $rthe2exempt;
									
									//STOTAL
									$rthe2rgstotal = 0;
										if($rthe2rstotal > 0){
											$rthe2rgstotal = $rthe2rgstotal+$rthe2rstotal;
										}
										if($rthe2rstotal2 > 0){
											$rthe2rgstotal = $rthe2rgstotal+$rthe2rstotal2;
										}
										if($rthe2rtax > 0){
											$rthe2rgstotal = $rthe2rgstotal+$rthe2rtax;
										}
										if($rthe2rintur > 0){
											$rthe2rgstotal = $rthe2rgstotal+$rthe2rintur;
										}
										
										
										#$rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
									$rthe2rgstotalglobal += $rthe2rgstotal;
									
									//RET BASE
									//$retentionbase = $rthe2rstotal-$rthe2exempt2-$rthe2exempt;
									$retentionbase = $rthe2rstotal+$rthe2rstotal2;
								    $retentionbaseglobal += $retentionbase;
									
									//RET IR
									
									$rthe2ret2a = $rowrbills['ret2a'];
									$rthe2ret2aglobal += $rthe2ret2a; 
									
									//RET IMI
									$rthe2ret1a = $rowrbills['ret1a'];
									$rthe2ret1aglobal += $rthe2ret1a ; 
									
									//PAYMENT
									$rthe2rpayment = $rthe2rgstotal;
									if($rthe2ret2a > 0){
										$rthe2rpayment = $rthe2rpayment-$rthe2ret2a;
									}	
									if($rthe2ret1a > 0){
										$rthe2rpayment = $rthe2rpayment-$rthe2ret1a;
									}	
										
									$rthe2rpaymentglobal += $rthe2rpayment;
										
									} 
							
									
					?>							
                                <tr role="row" class="odd">
                                
									<td class="sorting_1"><? echo $tInc++; ?></td>
									<td><?php echo $rowrbills["number"]; ?></td>
                                   <td><?php 
								   
														echo date('d-m-Y', strtotime($rowrbills['billdate'])); 
								    ?></td>
                                  
                                  <td><?php if($rthe2rstotal > 0){ 
								  	echo $rpre.number_format($rthe2rstotal,2);
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td><?php if($rthe2rstotal2 > 0){
									  echo $rpre.number_format($rthe2rstotal2,2);
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td><?php if($rthe2rtax > 0){
									  echo $rpre.number_format($rthe2rtax,2);
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td><?php if($rthe2rintur > 0){
									  echo $rpre.$rthe2rintur; 
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2rgstotal > 0){
									  echo $rpre.number_format($rthe2rgstotal,2);
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2exempt2 > 0){
									  echo $rpre.number_format($rthe2exempt2,2);
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2exempt > 0){
									  echo $rpre.number_format($rthe2exempt,2);
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td>
                                  <?php 
								  
								  if($retentionbase > 0){ 
									  echo $rpre.number_format($retentionbase,2);
								  }else{
									  echo "-";
								  }
								  ?>
                                  </td>
                                  <td style="color:#B90003;"><?php 
								  if($rthe2ret2a > 0){
									 
										
										 echo 'C$'.number_format($rthe2ret2a,2);
									 
								  }else{
									  echo "-";
								  }
								  ?></td>
                                  <td style="color:#B90003;"><?php 
								  if($rthe2ret1a > 0){
									 echo "C$".number_format($rthe2ret1a,2);
									 
								  }else{
									  echo "-";
								  }
								  ?>
                                 </td>
                                 <td><?php
								
								 echo $rpre.number_format($rthe2rpayment,2);   
								 
								 ?></td> 
                               
                                
                                  
                                </tr>
                                
                                
                                
                                
                                
                                
                                <?php }
								?>
                                
                                <tr role="row" class="heading">

									

									<th>-</th>
                                    <th>-</th>
									<th>-</th>
									
									<?php
                                    /*<th>NA</th>
									<th>NA</th>  
                                    */ ?><th><?php if($rthe2rstotalglobal > 0){
										echo $rpre.number_format($rthe2rstotalglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th><?php 
									if($rthe2rstotal2global > 0){
										echo $rpre.number_format($rthe2rstotal2global,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th><?php 
									if($rthe2rstotalglobal > 0){
										echo $rpre.number_format($rthe2rtaxglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th><?php 
									if($rthe2rinturglobal > 0){
										echo $rpre.number_format($rthe2rinturglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th><?php 
									if($rthe2rgstotalglobal > 0){
										echo $rpre.number_format($rthe2rgstotalglobal,2);
									}else{
										echo "-";
									}
									
									?></th>
                                    <th><?php 
									if($rthe2exempt2global > 0){
										echo $rpre.number_format($rthe2exempt2global,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th><?php 
									if($rthe2exemptglobal > 0){
										echo $rpre.number_format($rthe2exemptglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th>
                                    <?php
										if($retentionbaseglobal > 0){
											echo $rpre.number_format($retentionbaseglobal,2);
										}else{
											echo "-";
										}
									?>
                                    </th>
                                    <th style="color:#B90003;"><?php 
									if($rthe2ret2aglobal > 0){
										echo "C$".number_format($rthe2ret2aglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th style="color:#B90003;"><?php 
									if($rthe2ret1aglobal > 0){
										echo "C$".number_format($rthe2ret1aglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    <th><?php 
									if($rthe2rpaymentglobal > 0){
										
										echo $rpre.number_format($rthe2rpaymentglobal,2);
									}else{
										echo "-";
									}
									?></th>
                                    
								  </tr>
                                
                                </tbody>

								</table>
                                </div></div>
</div>
                                
                       
                                
                                
                                
<script>
function loadDocumentTable(payment,show,pcurrency){
	$.post("reload-payment-resume.php", { payment: payment, currency: show, pcurrency: pcurrency, }, function(data){
		$("#thetablereload").html(data); 
		
});		
}
</script>