<? 

include('sessions.php');

$type = $_POST['thetype'];
$code = $_POST['thecode']; 

$query = "select * from clients where code = '$code'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($num == 0){
	//El cliente no existe
	switch($type){
		case 1:
		$client_type = 1;
		$style_natural = 'style="display: block;"';
		$style_business = 'style="display: none;"';
		break;
		case 2:
		$client_type = 2;
		$style_natural = 'style="display: none;"';
		$style_business = 'style="display: block;"';
		break;
	}
	
}

else if($row['type'] == 1){
	//El cliente es persona natural
	$client_type = 1;
	$style_natural = 'style="display: block;"';
	$style_business = 'style="display: none;"';
	
}
else if($row['type'] == 2){
	//El cliente es persona Juridica
	$client_type = 2;
	$style_natural = 'style="display: none;"';
	$style_business = 'style="display: block;"';
}

?>
<div class="row">
                                                   
<div class="col-md-4">

<div class="form-group">
<label class="control-label">Tipo de cliente</label>
<select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($client_type == 1) echo "selected"; ?>>Persona Natural</option> 
<option value="2" <? if($client_type == 2) echo "selected"; ?>>Persona Jurídica</option> 
</select>
                                                            

													  </div>

													</div>                                                                     
<div class="row"></div>                                                  
<div id="ct_personal" <? echo $style_natural; ?>>
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode" type="text" class="form-control" id="ccode" value="<? echo $code; ?>" readonly>
<span class="input-group-addon">
<a href="javascript:benType2(1);"><i class="fa fa-times"></i></a>
											</span> </div>
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Nombres:</label>
<input name="cfirst" type="text" class="form-control" id="cfirst" value="<? echo $row['first']; ?>" <? if($num > 0) echo "readonly"; ?> > 
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="clast" type="text" class="form-control" id="clast" value="<? echo $row['last']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress" type="text" class="form-control" id="caddress" value="<? echo $row['address']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity" type="text" class="form-control" id="ccity" value="<? echo $row['city']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="cnid" type="text" class="form-control" id="cnid" value="<? echo $row['nid']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail" type="text" class="form-control" id="cemail" value="<? echo $row['email']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone" type="text" class="form-control" id="cphone" value="<? echo $row['phone']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
</div>
<div id="ct_business" <? echo $style_business; ?>>
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode2" type="text" class="form-control" id="ccode2" value="<? echo $code; ?>" readonly>
<span class="input-group-addon">
<a href="javascript:benType2(1);"><i class="fa fa-undo"></i></a>
											</span> </div>
 
</div>
</div>
<div class="col-md-10 ">
<div class="form-group">
<label>Nombre de la Empresa:</label>
<input name="cname" type="text" class="form-control" id="cname" value="<? echo $row['name']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>No. RUC:</label>
<input name="cruc" type="text" class="form-control" id="cruc" value="<? echo $row['ruc']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail2" type="text" class="form-control" id="cemail2" value="<? echo $row['email']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>

<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone2" type="text" class="form-control" id="cphone2" value="<? echo $row['phone']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>

<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress2" type="text" class="form-control" id="caddress2" value="<? echo $row['address']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity2" type="text" class="form-control" id="ccity2" value="<? echo $row['city']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>


<div class="col-md-12"><h4>Información del Representante Legal</h4></div>

<div class="col-md-6 ">
<div class="form-group">
<label>Nombres:</label>
<input name="crfirst" type="text" class="form-control" id="crfirst" value="<? echo $row['rfirst']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-6 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="crlast" type="text" class="form-control" id="crlast" value="<? echo $row['rlast']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="crnid" type="text" class="form-control" id="crnid" value="<? echo $row['rnid']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cremail" type="text" class="form-control" id="cremail" value="<? echo $row['remail']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="crphone" type="text" class="form-control" id="crphone" value="<? echo $row['rphone']; ?>" <? if($num > 0) echo "readonly"; ?>> 
</div>
</div>

</div>
<br>
</div>
