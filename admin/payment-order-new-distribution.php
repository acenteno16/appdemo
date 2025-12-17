<? $billId = 0; ?>
<div id="BillId<? echo $billId; ?>">
<div class="row"></div>	
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Distribución:</label>
<select name="bdistribution[]" class="form-control" id="bdistribution<?php echo $typeinc; ?>" onChange="javascript:bDistributable<? echo $billId; ?>(this.value);">
<option value="0" selected>Automatica</option>
<option value="1">Manual</option>
</select>
</div>
</div>
<div class="row"></div>		
	
<div id="billDistribution_<? echo $billId; ?>" style="display: none;">
<script>
function changePertot<? echo $billId; ?>(onoff){
	i=0; 
		for (var obj in document.getElementsByName('percent[]')){
 		if (i<document.getElementsByName('percent[]').length){
			
	if(onoff == 2){
	
		document.getElementsByName('percent[]')[i].readOnly = true;
		document.getElementsByName('total[]')[i].readOnly = false;
	}
	if(onoff == 1){
		
		document.getElementsByName('total[]')[i].readOnly = true;
		document.getElementsByName('percent[]')[i].readOnly = false;
	}
		}
		i++;
		}
}

function bDistributable<? echo $billId; ?>(dvalue){
	if(dvalue == 1){
		document.getElementById('billDistribution_0').style.display = 'block';
	}else{
		document.getElementById('billDistribution_0').style.display = 'none';
	}
}
	
function addDistribution<? echo $billId; ?>(){
	
	//var account = document.getElementsByName('accounts[]')[0].value;
	var selectoR =  document.getElementsByName('pertot');
	
	for (var i = 0, length = selectoR.length; i < length; i++) {
	
	if (selectoR[i].checked) {

		if(selectoR[i].value == 1){
			var readOnly1 = "";
			var readOnly2 = "readonly";
		}else{
			var readOnly1 = "readonly";
			var readOnly2 = "";
		}
}
	
	
}   	 

var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-6 "><select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."><option value=""></option><?php $queryproviders = "select * from units";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?><option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option><?php } ?></select></div><div class="col-md-2 "><div class="form-group"><input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value=""  onKeyUp="javascript:calculateTheTotal<? echo $billId; ?>(1);" '+readOnly1+'></div></div> <div class="col-md-2 "><div class="form-group"><input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" '+readOnly2+' onKeyUp="javascript:calculateTheTotal<? echo $billId; ?>(2);" onkeypress="return justNumbers(event);"></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     distributioni++; 
	 $("#distributionwaiter<? echo $billId; ?>").append(distributionboxadd);  
	 
	 Metronic.init(); 
	 
	 //init metronic core components
	
  
}	
	
function calculateTheTotal<? echo $billId; ?>(mySelector,myOutput){ 
	
	
	var mytotalstotal = numberFormat(document.getElementById('stotalbill').value);		

	if(mySelector == 1){
		i=0;
		for (var obj in document.getElementsByName('dpercent[]')){
			if (i<document.getElementsByName('dpercent[]').length){
				thepercent = document.getElementsByName('dpercent[]')[i].value;
				thetotal1 = thepercent/100;
				var thetotal = parseFloat(mytotalstotal)*parseFloat(thetotal1);
				document.getElementsByName('dtotal[]')[i].value = thetotal.toFixed(2); 
				document.getElementsByName('dtotal[]')[i].value = thetotal;   
			} 
			i++;
		    var thetotalpercent = parseFloat(thetotalpercent)+parseFloat(thepercent);	
		}
		if(thetotalpercent > 100){
			alert('La distribucion no puede ser mayor a 100%.');
		}
	}
		
	if(mySelector == 2){
		i=0;
		for (var obj in document.getElementsByName('dpercent[]')){
			if (i<document.getElementsByName('dpercent[]').length){
				theammount = document.getElementsByName('dtotal[]')[i].value;
				
				var thepercent1 = theammount*100;
				var thepercent = thepercent1/mytotalstotal;
				var thepercentround = Math.round(thepercent * 100) / 100; 
				document.getElementsByName('dpercent[]')[i].value = thepercentround;
			}
  			i++;
		}
}
			
}
</script>

<div class="row">
<div class="col-md-6 ">&nbsp;</div>                                             
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="1" checked="" onChange="changePertot(this.value);">
</div>
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="2" onChange="changePertot(this.value);">
</div>
</div>
<?php //UNIT ?>
<div class="col-md-6 ">
	<div class="form-group">
		<label>Unidad:</label>
		<select name="dunit[][]" class="form-control  select2me" id="dunit[][]" data-placeholder="Seleccionar...">
			<option value=""></option>
			<?php $queryproviders = "select * from units";
			$resultproviders = mysqli_query($con, $queryproviders);
			while($rowproviders=mysqli_fetch_array($resultproviders)){
			?>
			<option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php //PERCENT ?>
<div class="col-md-2 ">
	<div class="form-group">
		<label>Porcentaje:</label>
		<input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal<? echo $billId; ?>(1);">
	</div>
</div> 
<?php //TOTAL ?>
<div class="col-md-2 ">
	<div class="form-group">
		<label>Total:</label>
		<input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal<? echo $billId; ?>(2)">
	</div>
</div> 
<?php //DELETE ?>                                                   
<div class="col-md-2 "> 
<div class="form-group">
	<label>&nbsp;</label><br>
	<button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>
</div>
</div>
<input type="hidden" name="did[]" id="did[]" value="0"> 
<div class="col-md-12" id="distributionwaiter<? echo $billId; ?>">
</div>
<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addDistribution<? echo $billId; ?>();">+</button>
<br>&nbsp;
</div>  
</div>
</div>

                                     
        
		

<? /*


<div id="ddistribucion3" <?php if($rowpconfirm['distributable'] == 0){ ?>style="display:none;" <?php } ?>><br>
<div class="row">
<div class="col-md-6 ">
&nbsp;
</div>
                                                   
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="1" checked="" onChange="changePertot(this.value);">
</div>
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="2" onChange="changePertot(this.value);">
</div>
</div> 
<?php 

$querydistributable0 = "select * from distribution where payment = '$_GET[id]'";
$resultdistributable0 = mysqli_query($con, $querydistributable0);
$numdistributable0=mysqli_num_rows($resultdistributable0);
	
if(($rowpconfirm['distributable'] == 1) and ($numdistributable0 > 0)){  ?>
<div class="row" id="distribution<?php echo $distributioni; ?>">

<div class="col-md-6 ">
						    <div class="form-group">
														<label>Unidad:</label>
                                                       
						
           </div>
													</div>                                         
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                                                                                
				
             </div>
													</div> 
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                   
						
                                                          
               </div>
													</div> 
<div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                         </div>
                                                        </div>
                                                  
</div>
<?php

$querydistributable = "select * from distribution where payment = '$_GET[id]'";
$resultdistributable = mysqli_query($con, $querydistributable);
$distributioni = 1;
while($rowdistributable=mysqli_fetch_array($resultdistributable)){

?>
	<div class="row" id="distribution<?php echo $distributioni; ?>">
	<?php //UNIT ?>
	<div class="col-md-6 ">
		<div class="form-group">
			<select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar...">
				<option value=""></option>
				<?php 
				$queryproviders = "select * from units";
				$resultproviders = mysqli_query($con, $queryproviders);
				while($rowproviders=mysqli_fetch_array($resultproviders)){ ?>
				<option value="<?php echo $rowproviders['code']; ?>"<?php if($rowdistributable['unit'] == $rowproviders['code']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                <?php } ?>
			</select>
		</div>
	</div>
	<?php //PERCENT ?>
	<div class="col-md-2 ">
			<div class="form-group">
				<input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="<?php echo $rowdistributable['percent']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(1);"> 
             </div>
		</div> 
	<?php //Total ?>
	<div class="col-md-2 ">
		<div class="form-group">
			<input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="<?php echo $rowdistributable['total']; ?>"readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(2);">
		</div>
	</div> 
	<?php //Delete Distribution ?>
	<div class="col-md-2 ">
		<div class="form-group">
			<label>&nbsp;</label>
			<button type="button" class="btn red" onClick="javascript:deleteRow(<?php echo $distributioni; ?>);">-</button>  
		</div>
    </div>
                                                        
	<input type="hidden" name="did[]" id="did[]" value="<?php echo $rowdistributable['id']; ?>">      
                                                  
</div>

<?php $distributioni++; } ?>

<?php }else{ ?>
<div class="row">
<script>
function changePertot(onoff){
	i=0; 
		for (var obj in document.getElementsByName('percent[]')){
 		if (i<document.getElementsByName('percent[]').length){
			
	if(onoff == 2){
	
		document.getElementsByName('percent[]')[i].readOnly = true;
		document.getElementsByName('total[]')[i].readOnly = false;
	}
	if(onoff == 1){
		
		document.getElementsByName('total[]')[i].readOnly = true;
		document.getElementsByName('percent[]')[i].readOnly = false;
	}
		}
		i++;
		}
}
</script>
<?php $account = ""; 
if($rowconcept2['account'] != ""){
		$account = $rowconcept2['account'];
	}
else{
	if($rowconcept['account'] != ""){
			$account = $rowconcept['account'];
		}else{
			if($rowtype['account'] != ""){
				$account = $rowtype['account'];
			}
		}
	}
			
?>
                                                        
<?php //UNIT ?>
<div class="col-md-6 ">
													  <div class="form-group">
														<label>Unidad:</label>
                                                       <select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
<?php $queryproviders = "select * from units";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
													</div>
<?php //PERCENT ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(1);">                                                        
		
             </div>
													</div> 
<?php //TOTAL ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(2)"> 
						
                                                          
               </div>
													</div> 
<?php //DELETE ?>                                                   <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>

<input type="hidden" name="did[]" id="did[]" value="0"> 
</div>
<?php } ?>               
                                                    <div id="distributionwaiter">
                                                    </div>
<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>                                          
        </div>
		
		*/ ?>