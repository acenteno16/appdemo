<?php 

include_once('sessions.php');
$thepaymentcurrency = $_POST['pcurrency'];
							
								
$queryrbills = "select * from bills where payment = '$_POST[payment]'";
$resultrbills = mysqli_query($con, $queryrbills);
$numrbills = mysqli_num_rows($resultrbills);
echo "<strong>Moneda a mostrar:</strong> ";
switch($_POST['currency']){
	case 1:
	echo "Córdobas";
	$pre = "C$";
	break;
	case 2:
	echo "Dólares";
	$pre = "U$";
	break;
}
?>
<div class="table-container">
                            <div class="table-scrollable">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="30%">Factura*</th>
                                    <th width="30%">Fecha de Factura</th>
									<th width="13%">Monto graba IVA</th>
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
								
								
								
								while($rowrbills=mysqli_fetch_array($resultrbills)){
									
									
									$currency = $_POST['currency'];
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
                                        #echo "********$rowrbills[tax] --- $rowrbills[tc]";
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
									$rthe2rgstotal = $rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
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
									$rthe2rpayment = $rthe2rgstotal-$rthe2ret2a-$rthe2ret1a;
									$rthe2rpaymentglobal += $rthe2rpayment;
										
									} 
							
								
									
								
?>							
                                <tr role="row" class="odd">
                                
                                  <td class="sorting_1"><?php echo $rowrbills["number"]; ?></td>
                                   <td><?php 
								   
														echo date('d-m-Y', strtotime($rowrbills['billdate'])); 
								    ?></td>
                                  
                                  
                                  <td><?php if($rthe2rstotal > 0){
									  echo $pre.number_format($rthe2rstotal,2);
									 
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2rstotal2 > 0){
									  echo $pre.number_format($rthe2rstotal2,2);
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2rtax > 0){
									  echo $pre.number_format($rthe2rtax,2);
									  $thertaxglobal += $thertax;
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2rintur > 0){
									  echo $pre.number_format($rthe2rintur,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2rgstotal > 0){
									  echo $pre.number_format($rthe2rgstotal,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2exempt2 > 0){
									  echo $pre.number_format($rthe2exempt2,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
								  if($rthe2exempt > 0){
									  echo $pre.number_format($rthe2exempt,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php 
							
								  if($retentionbase > 0){
									  echo $pre.number_format($retentionbase,2);
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td style="color:#B90003;"><?php 
								  if($rthe2ret2a > 0){
									  echo $pre.number_format($rthe2ret2a,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td style="color:#B90003;"><?php 
								  if($rthe2ret1a > 0){
									  echo $pre.number_format($rthe2ret1a,2);
									 
								  }else{
									  echo "NA";
								  }
								  ?></td>
                                  <td><?php
								  
							
								  //payment
								  echo $pre.number_format($rthe2rpayment,2); 
								  
								  
								  ?></td> 
                               
                                
                                  
                                </tr>
                                
                                
                                
                                
                                 
                                
                                <?php }
								?>
                                <tr role="row" class="heading">

                                
                                  <td class="sorting_1"><strong>NA</strong></td>
                            
								  <td><strong>NA</strong></td>
                                  
                                  
                                  <td><strong>
                                  <?php if($rthe2rstotalglobal > 0){
									  echo $pre.number_format($rthe2rstotalglobal,2);
									 
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
								  if($rthe2rstotal2global > 0){
									  echo $pre.number_format($rthe2rstotal2global,2);
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
								  if($rthe2rtaxglobal > 0){
									  echo $pre.number_format($rthe2rtaxglobal,2);
									  $thertaxglobal += $thertax;
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
								  if($rthe2rinturglobal > 0){
									  echo $pre.number_format($rthe2rinturglobal,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
								  if($rthe2rgstotalglobal > 0){
									  echo $pre.number_format($rthe2rgstotalglobal,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
								  if($rthe2exempt2global > 0){
									  echo $pre.number_format($rthe2exempt2global,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
								  if($rthe2exemptglobal > 0){
									  echo $pre.number_format($rthe2exemptglobal,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php 
							
								  if($retentionbaseglobal > 0){
									  echo $pre.number_format($retentionbaseglobal,2);
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td style="color:#B90003;"><strong>
                                  <?php 
								  if($rthe2ret2aglobal > 0){
									  echo $pre.number_format($rthe2ret2aglobal,2);
									  
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td style="color:#B90003;"><strong>
                                  <?php 
								  if($rthe2ret1aglobal > 0){
									  echo $pre.number_format($rthe2ret1aglobal,2);
									 
								  }else{
									  echo "NA";
								  }
								  ?>
                                  </strong></td>
                                  <td><strong>
                                  <?php
								  
							
								  //payment
								  echo $pre.number_format($rthe2rpaymentglobal,2); 
								  
								  
								  ?>
                                  </strong></td> 
                               
                                
                                  
                                </tr>
                                </tbody>

								</table>
                                </div></div>