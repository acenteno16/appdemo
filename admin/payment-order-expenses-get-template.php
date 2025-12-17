<? 

include('session-request.php');

$valtemplate = $_POST['idt']; 
$showAmount = $_POST['showAmount'];

if(($valtemplate == '0') or ($valtemplate == "")){ 
?>
<div id="ddistribucion3">
Seleccione una plantilla o cree una nueva.</div>
<? }
elseif($valtemplate == 'new'){ 
?>
<div id="ddistribucion3"><br>
<div class="row">
<div class="col-md-6 ">
&nbsp;
</div>
                                                   
<div class="col-md-2 ">
</div>
<div class="col-md-2 ">
</div>
</div> 

						<div class="row">

 <?php $account = "";
 
 if($rowconcept2['account'] != ""){
		$account = $rowconcept2['account'];
	}else{
		if($rowconcept['account'] != ""){
			$account = $rowconcept['account'];
		}else{
			if($rowtype['account'] != ""){
				$account = $rowtype['account'];
			}
		}
	}
														?>
                                                        
<?php //Collaborator ?>
<div class="col-md-6 ">
													  <div class="form-group">
														<label>Colaborador:</label>
                                                       <select name="collaborator[]" class="form-control  select2me" id="collaborator[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
<?php $queryproviders = "select * from workers order by first, last";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['first']." ".$rowproviders['last']; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
													</div>
<?php //amount ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="collaborator_ammount[]" type="text" class="form-control" id="collaborator_ammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div> 
<?php //DELETE ?>
<div class="col-md-3 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>

<input type="hidden" name="did[]" id="did[]" value="0"> 
</div>
             
<div id="distributionwaiter">
</div>


<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>
       
	   <div class="row"></div>
                                               <div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Guardar Plantilla?</label>

															<select name="template_save" class="form-control" id="template_save" onchange="javascript:templateFn(this.value);">
															<option value="0" selected>No</option>
														<option value="1">Si</option>
															</select>

													  </div>

													</div>
													
													
                                                 <div class="col-md-4 ">
													  <div class="form-group">
														<label>Nombre de Plantilla:</label>
                                                        <input name="template_name" type="text" class="form-control" id="template_name" value="" readonly >                                                        
		
             </div>
													</div>
                                                 
												 </div>
<?
}
else{ 
$query_template_content = "select * from templatesexpensescontent where template = '$valtemplate'";
$result_template_content = mysqli_query($con, $query_template_content);

?>
<div id="ddistribucion3"><br>
<div class="row">
<div class="col-md-6 ">
&nbsp;
</div>
                                                   
<div class="col-md-2 ">
</div>
<div class="col-md-2 ">
</div>
</div> 
<? 
$tempinc = 0;
while($row_template_content=mysqli_fetch_array($result_template_content)){ ?>
<div class="row" id="distribution<? echo $tempinc; ?>">

 <?php $account = "";
 
 if($rowconcept2['account'] != ""){
		$account = $rowconcept2['account'];
	}else{
		if($rowconcept['account'] != ""){
			$account = $rowconcept['account'];
		}else{
			if($rowtype['account'] != ""){
				$account = $rowtype['account'];
			}
		}
	}
														?>
                                                        
<?php //Collaborator ?>
<div class="col-md-6 ">
													  <div class="form-group">
														<? if($tempinc == 0) echo "<label>Colaborador:</label>"; ?>
                                                       <select name="collaborator[]" class="form-control  select2me" id="collaborator[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
<?php $queryproviders = "select * from workers order by first, last";
$resultproviders = mysqli_query($con, $queryproviders); 
while($rowproviders=mysqli_fetch_array($resultproviders)){ 
?>
												<option value="<?php echo $rowproviders['id']; ?>"<?php if($row_template_content['userid'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['first']." ".$rowproviders['last']; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
													</div>
<?php //amount ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<? if($tempinc == 0) echo "<label>Monto:</label>"; ?>
                                                        <input name="collaborator_ammount[]" type="text" class="form-control" id="collaborator_ammount[]" value="<? if($showAmount == 1) echo $row_template_content['amount']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div> 
<?php //DELETE ?>
<div class="col-md-3 "> 
                                                    <div class="form-group">
                                                   		<? if($tempinc == 0) echo "<label>&nbsp;</label><br>"; ?>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(<? echo $tempinc; ?>);">-</button>  </div>
                                                        </div>

<input type="hidden" name="did[]" id="did[]" value="0"> 
</div></div>
<?
$tempinc++;
} ?>
             
<div id="distributionwaiter">
</div>


<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>
       
	   <div class="row"></div>
                                               <div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Guardar Plantilla?</label>

															<select name="template_save" class="form-control" id="template_save" onchange="javascript:templateFn(this.value);">
															<option value="0" selected>No</option>
														<option value="1">Si</option>
															</select>

													  </div>

													</div>
													
													
                                                 <div class="col-md-4 ">
													  <div class="form-group">
														<label>Nombre de Plantilla:</label>
                                                        <input name="template_name" type="text" class="form-control" id="template_name" value="" readonly >                                                        
		
             </div>
													</div>
                                                 
												 </div>
<?

} //end 

?>