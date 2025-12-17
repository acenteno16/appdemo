<? 

include("sessions.php");
$global_company = 0; 
$global_hall = 0;

$queryaccess = "select * from routes where type = '23' and worker = '$_SESSION[userid]'";
$resultaccess = mysqli_query($con, $queryaccess);
while($rowaccess = mysqli_fetch_array($resultaccess)){
	if($rowaccess['company'] == "999999999"){
		$global_company = 1;
	}
	if($rowaccess['unit'] == "999999999"){
		$global_hall = 1;
	}
	
	$companies[] = $rowaccess['company'];
	$halls[] = $rowaccess['unit']; 
	
}


?>
<div class="note note-regular">


<div class="row">
    <h4 style="margin-left:15px;">Filtro:</h4><br>
    <?php //desde aqui ?>
    <div class="col-md-3">
        <label class="control-label">Proveedor:</label>
        <select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select id, code, name from providers where code > 0 order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($rowproviders["id"] == $_GET['provider']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>
    </div>
    <div class="col-md-3">
        <label class="control-label">Colaborador:</label>
        <select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select id, code, first, last from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($rowproviders["id"] == $_GET['worker']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>
    </div>                                         
    <div class="col-md-3">
        <label>No. de Solicitud:</label>
        <input name="request" type="text" class="form-control" id="request" value="<? echo $_GET['request']; ?>">
    </div>
    <div class="col-md-3">
        <label> No. de Factura:</label>
        <input name="bill" type="text" class="form-control" id="bill" value="<? echo $_GET['bill']; ?>">
    </div>
    <div class="row"></div>
    <div class="col-md-3 ">
        <label> No. de Retencion:</label>
        <input name="retentionno" type="text" class="form-control" id="retentionno" value="<? echo $_GET['retentionno']; ?>">
    </div>
    <div class="col-md-3">
        <label> Estado:</label>
        <select name="status" class="form-control" id="status">
            <option value="" selected>Todas</option>
            <option value="1" <?php if((isset($_GET['status'])) and ($_GET['status'] == 1)) echo 'selected'; ?>>Pendientes</option>
            <option value="2" <?php if($_GET['status'] == 2) echo 'selected'; ?>>Impresas</option> 
        </select>
    </div>
    <div class="col-md-3">
        <label>Rango de Fechas: (Retención)</label>
        <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="width: 100% !important; "> 

												<input type="text" class="form-control" name="from" placeholder="desde" readonly>

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" readonly>

											</div>
    </div>
    <? if(($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-imi-global.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-ir-global.php')){  ?>  
    <div class="col-md-3">
        <label>Compañía:</label>
        <select name="thecompany" class="form-control" id="thecompany">
            <option value="" selected>Seleccionar</option>
            <?
            if($global_company == 1){
                $foreach_company2 = "";
                $querycompanys = "select * from companies where active = '1'";
            }else{
                for($c=0;$c<sizeof($companies);$c++){
                    $company_pre = "";
                    if($c > 0){
                        $company_pre = " or ";
					}
                    $foreach_company.= $company_pre."(id = '$companies[$c]')";  
				}
                $foreach_company = " and (".$foreach_company.")";
				$foreach_company2 = str_replace('id','company',$foreach_company); 
										 
				$querycompanys = "select * from companies where active = '1'".$foreach_company;
            }
    $resultcompanys = mysqli_query($con, $querycompanys);
	while($rowcompanys=mysqli_fetch_array($resultcompanys)){ ?>
            <option value="<? echo $rowcompanys[0]; ?>" <? if($_GET['thecompany'] == $rowcompanys['id']) echo "selected"; ?>><? echo $rowcompanys['name']; ?></option>  
    <? } ?>
        </select>
    </div>
    
    <div class="col-md-3 ">
        <label>Sucursal:</label>
        <select name="thehall" class="form-control" id="thehall">
                                      
                                      <option value="" selected>Seleccionar</option>
                                     <? 
									 if($global_hall == 1){
									 	$queryhallss = "select * from halls where active = '1'".$foreach_company2." order by company, name";
									 }else{
										  for($c=0;$c<sizeof($halls);$c++){
											 $halls_pre = "";
											 if($c > 0){
												 $halls_pre = " or ";
											 }
											 $foreach_halls.= $halls_pre."(id = '$halls[$c]')";   
										 }
										 $foreach_halls = " and (".$foreach_halls.")";
										 
										 
										 echo $queryhallss = "select * from halls where active = '1'".$foreach_company2.$foreach_halls." order by company, name";  
									 }
										 
									 $resulthallss = mysqli_query($con, $queryhallss);
									 while($rowhallss=mysqli_fetch_array($resulthallss)){ 
									 ?>
                                     <option value="<? echo $rowhallss[0]; ?>" <? if($_GET['thehall'] == $rowhallss['id']) echo "selected"; ?>><? echo $rowhallss['name']; ?></option>  
                                     <? } ?>
                                     </select>
    </div>
    <? } ?> 
    <div class="col-md-3">
        <label> No de resultados:</label>
        <select name="pagination" class="form-control" id="pagination">
                                     <option value="50" selected>50</option>
                                     <option value="100" <?php if($_GET['pagination'] == 100) echo 'selected'; ?>>100</option>
                                     <option value="500" <?php if($_GET['pagination'] == 500) echo 'selected'; ?>>500</option>
                                    
                                     </select>
    </div>
    
    <div class="col-md-3">
        <label> Remisión:</label>
        <select name="remission" class="form-control" id="remission">
            <option value="" selected>Todas</option>
            <option value="no" <?php if($_GET['remission'] == 'no') echo 'selected'; ?>>No Remisionadas</option>
            <option value="yes" <?php if($_GET['remission'] == 'yes') echo 'selected'; ?>>Remisionadas</option> 
        </select>
    </div>
    
    </div>
                                        
                                        <div class="row"></div>





                             
<div class="row">

<br><br>
						<div class="col-md-6">							

						    <input type="hidden" id="form" name="form" value="1"> 
                            <input type="hidden" id="form" name="echo" value="<? echo $_GET['echo']; ?>"> 
                            <button type="button" class="btn red" onClick="removeFilter();"><i class="fa fa-times"></i> Eliminar Filtro</button>  
                            <button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>
				<script>
				function removeFilter(){
					window.location = "<?php echo $_SERVER['PHP_SELF']; ?>";
				}
				</script>								
                 </div>                               
  
</div>
						
</div>
                                            