												
												<?php 

$queryuser = "select first, last, code, email, unit from workers where code = '$rowpconfirm[userid]'";
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
$queryunit = "select code, name from units where code = '$rowuser[unit]'";
$resultunit = mysqli_query($con, $queryunit);
$rowunit = mysqli_fetch_array($resultunit);

?>


<div class="col-md-12">
<p><strong>Nombre:</strong> <?php echo $rowuser['first']." ".$rowuser['last']; ?><br>
<strong>Código:</strong> <?php echo $rowuser['code']; ?><br>
<strong>Email:</strong> <?php echo $rowuser['email']; ?> <br>
<strong>Unidad de Negocio:</strong> <?php echo $rowuser['unit']; ?> | <?php echo $rowunit['name']; ?>
<?php 
if($rowpconfirm['notes'] != ""){ 
?>
<br>
<strong>Notas del solicitante:</strong> <?php echo $rowpconfirm['notes']; ?> 
<?php } ?>
</p>

												
												<h3  class="form-section">Información de la Transferencia</h3> 


                                                  
                                                  <div id="client-stage">

 <div class="row">
 <div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<?php echo $rowpconfirm['id']; ?>" readonly>  
								
															
													  </div>

													</div>                                                 
 <div class="col-md-4"> 

<div class="form-group">
<label class="control-label">Tipo de Transacción</label>
<input name="amount2" type="text" class="form-control" id="amount2" value="<? 
switch($rowpconfirm['transaction']){
		case 1:
		echo "Transferencia";
		break;
		case 2:
		echo "Cordobización";
		break;
		case 3:
		echo "Dolarización";
		break;
		case 4:
		echo "Prestamo";
		break;
		case 5:
		echo "Abonos/Cancelación";
		break;
}
?>" readonly>
</div>

													</div>
                                                                  
</div>
</div>
<div class="row"></div> 

<? //<h3  class="form-section">Motivo de Devolución</h3> ?>

      
        
											  <div class="row">
													
													

													

                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description" readonly><?php echo $rowpconfirm['description']; ?></textarea> 
<script>
/* 
function validateFirst(){
	var recipient = document.getElementById("dspayment").value;
	var provider = document.getElementById("provider").value;
	var collaborator = document.getElementById("collaborator").value;	
	if(recipient == 0){
	document.getElementById("dspayment").focus(); 
	alert('Usted debe de seleccionar el tipo de beneficiario.');
	}
	if((recipient == 1) && (provider == "")){
		document.getElementById("provider").focus(); 
		alert('Usted debe de seleccionar un Proveedor.');
		return false;
	}
	if((recipient == 2) && (collaborator == "")){
		document.getElementById("collaborator").focus(); 
		alert('Usted debe de seleccionar un Colaborador.');
		return false;
	}
}
*/
                    </script>	
                                                          
                 

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                    

 
 
       
   
          

                                                   
<?php //MONEDA ?>                                                      
<? /*<div class="col-md-12 ">   
<h3 class="form-section">Monto de la Devolución</h3></div>*/ ?>
        
													                                                  
<div class="col-md-6">

<div class="form-group">
<label class="control-label">Cuenta Origen</label>
<input name="amount3" type="text" class="form-control" id="amount3" value="<? 
$query_account1 = "select companies.name, banks.name, banksaccounts.account2, currency.name, currency.symbol from banksaccounts inner join banks on banksaccounts.bank = banks.id inner join currency on banksaccounts.currency = currency.id inner join companies on banksaccounts.company = companies.id where banksaccounts.id = '$rowpconfirm[account1]'";
$result_account1 = mysqli_query($con, $query_account1);
$row_account1 = mysqli_fetch_array($result_account1);
echo $row_account1[0]." | ".$row_account1[1]." - ".$row_account1[2]." (".$row_account1[3].')';
?>" readonly>
</div>

													</div>
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="<? if($rowpconfirm['amount'] > 0){ echo $row_account1[4].number_format($rowpconfirm['amount'],2)." ".$row_account1[3]; } ?>" readonly>
                                                        

                                                      <!--/row--></div>
													</div>			                                     
<div class="row"></div>				                                     
<div class="col-md-6"> 

<div class="form-group">
<label class="control-label">Cuenta Destino</label>
<input name="amount4" type="text" class="form-control" id="amount4" value="<? 
$query_account2 = "select companies.name, banks.name, banksaccounts.account2, currency.name, currency.symbol from banksaccounts inner join banks on banksaccounts.bank = banks.id inner join currency on banksaccounts.currency = currency.id inner join companies on banksaccounts.company = companies.id where banksaccounts.id = '$rowpconfirm[account2]'";
$result_account2 = mysqli_query($con, $query_account2);
$row_account2 = mysqli_fetch_array($result_account2);
echo $row_account2[0]." | ".$row_account2[1]." - ".$row_account2[2]." (".$row_account2[3].')';
?>" readonly>
<?                                                           
/*
<select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);">
<option value="0" selected>Seleccionar</option>
<?
$query_banks = "select * from banks order by name";
$result_banks = mysqli_query($con, $query_banks);
while($row_banks=mysqli_fetch_array($result_banks)){
	$query_ac = "select * from currency where id = '$row_accounts[currency]'";
	$result_ac = mysqli_query($con, $query_ac);
	$row_ac = mysqli_fetch_array($result_ac);
		
	$acurrency = $row_ac['name'];
?>
<optgroup label="<? echo $row_banks['name']; ?>">
<? 
$query_accounts = "select * from banksaccounts where bank = '$row_banks[id]'";
$result_accounts = mysqli_query($con, $query_accounts); 
while($row_accounts=mysqli_fetch_array($result_accounts)){ ?>
	<option value="<? echo $row_accounts['id']; ?>" <? if($rowclient['type'] == 1) echo "selected"; ?>><? echo $row_accounts['account2']." ($acurrency)"; ?></option> 
<? } ?>
</optgroup>
<? } ?> 
</select>
*/
?>
													  </div>

													</div>
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="<? if($rowpconfirm['amount'] > 0){ echo $row_account2[4].number_format($rowpconfirm['amount'],2)." ".$row_account2[3]; } ?>" readonly>
                                                        
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
					
											  
											  <? 
											  
											  $display = "none";
											  if(($rowpconfirm['transaction'] == 2) or (($rowpconfirm['transaction'] == 3))){
											  	$display = "block";
											  }
											  
											  ?>
											
												  <div class="col-md-4 " style="display: <? echo $display; ?>;" id="thetc">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="tc" type="text" class="form-control" id="tc" value="<? if($rowpconfirm['tc'] > 0){ echo $rowpconfirm['tc']; } ?>" readonly>
														<input name="floattotalbill" type="hidden" id="floattotalbill" value="">

                                                       
                                                      <!--/row--></div>
													</div>


 </div>    
 	
        
                                               
                                                       
                                                    <? /*   
                                                       
                                                       <h3 class="form-section"><a id="files"></a>Archivos</h3>
                                                       
													 
                                                  <div class="row">
                                                  <!--/span--> 
                                                  
                                                  <div id="emails">
                                                    <?php 
													
	$queryfile2 = "select * from lettersfiles where letter = '$_GET[id]' order by id asc";  
	$resultfile2 = mysqli_query($con, $queryfile2);
	$inc_files = 0;
	$filecount = 0;
	while($rowfile2 = mysqli_fetch_array($resultfile2)){
	$filecount++;
	if($filecount > 0){
		
	?>
                                                     <div class="col-md-10 ">
													  <div class="form-group">
	<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfile2['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>   
                                            
</div></div> 
                                                        
<?php 
//End while
$inc_files++;
}
//End if
}
 
?>
             <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
             <div id="fid_<? echo $inc_files; ?>"><div class="col-md-10 ">
													  <div class="form-group">
													    <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

</select><div class="row"></div></div></div>
             <div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile(<? echo $inc_files; ?>);">-</button></div>
             </div> 
                                                      
                                                    </div>
                                                    <div class="row"></div>
             
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
             <? $inc_files++; ?>                      
                                                     
<script type="text/javascript">
var tfile = <? echo $inc_files; ?>;
function agregar(){ 
	setTimeout(reloadTemplate, 1500);
	$.post("payment-order-refund-reload-files.php", { variable: tfile }, function(data){ 
		$("#emails").append(data);
	});
	
	tfile++;
	 
	
}

function reloadTemplate(){
	Metronic.init();
}
function eliminarFile(fid){
	 $('#fid_'+fid).remove(); 
}
</script>
                                              </div>
                                              
                                              
                                         */ ?>
                                            
                                              
<? /*<div id="dbeneficiarie"> 
   <div class="row"></div>                                             
  <h3 class="form-section"><a id="beneficiaries"></a>Beneficiarios</h3>
  
  <div class="row">
  <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Lista de Beneficiarios:</label>

															<select name="beneficiarie" class="form-control" id="beneficiarie">
<option value="0" selected>Seleccionar</option>
															</select>

													  </div>

													</div>
                                                    </div>
</div>*/ ?> 

<div class="row"></div>
		
		<div class="row"></div>









                                                       										<!--/row--><!--/row--></div>