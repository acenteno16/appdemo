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
<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Proveedor: <a href="javascript:loadProviders('load');" id="providerCharge" >[Cargar Filtro]</a></label>
        <select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." disabled>
            <option value="">Todos los Proveedores</option>
            <? if($_GET['provider'] > 0){ $rowThisProvider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where id = '$_GET[provider]'")); ?>
            <option value="<? echo $_GET['provider']; ?>" selected><? echo $rowThisProvider['code'].' | '.$rowThisProvider['name']; ?></option>
            <? } ?>
        </select>
        <script>
            function loadProviders(value){
                if(value == 'load'){
                    $("#provider").select2('data', { id:"0", text: "Cargando Proveedores..."});
                    $("#providerCharge").css("display", "none");
                    $.post("reloadContent.php", { type: 'providersMenu' }, function(data){
                        document.getElementById("provider").innerHTML = data;
                        $("#provider").select2('data', { id:"", text: "Todos los Proveedores"});
                        $("#provider").prop('disabled', false);
                    });
                }
            }
        </script>
        <div title="Page 5"></div>
    </div>
</div>
                                                    
<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Colaborador: <a href="javascript:loadWorkers('load');" id="workerCharge" >[Cargar Filtro]</a></label>
        <select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar..." disabled>
            <option value="">Todos los Colaboradores</option>
            <? if($_GET['worker'] > 0){ $rowThisWorker = mysqli_fetch_array(mysqli_query($con, "select id, code, first, last from workers where id = '$_GET[worker]'")); ?>
            <option value="<? echo $_GET['worker']; ?>" selected><? echo $rowThisWorker['code'].' | '.$rowThisWorker['first'].' '.$rowThisWorker['last']; ?></option>
            <? } ?>
        </select>
        <div title="Page 5"></div>
    </div>
</div>
                                                    
<script>
    function loadWorkers(value){
        if(value == 'load'){
            $("#workerCharge").css("display", "none");
            $("#worker").select2('data', { id:"0", text: "Cargando Colaboradores..."});
            $.post("reloadContent.php", { type: 'workersMenu' }, function(data){
                document.getElementById("worker").innerHTML = data;
                $("#worker").select2('data', { id:"", text: "Todos los Colaboradores"});
                $("#worker").prop('disabled', false);
            });
        }
    }
</script>
    
<?php if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active")){ ?>                                                
<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Solicitante: <a href="javascript:loadRequester('load');" id="requesterCharge" >[Cargar Filtro]</a></label>
        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar..." disabled>
            <option value="">Todos los Colaboradores</option>
             <? if($_GET['requester'] > 0){ $rowThisWorker = mysqli_fetch_array(mysqli_query($con, "select id, code, first, last from workers where code = '$_GET[requester]'")); ?>
            <option value="<? echo $_GET['requester']; ?>" selected><? echo $rowThisWorker['code'].' | '.$rowThisWorker['first'].' '.$rowThisWorker['last']; ?></option>
            <? } ?>
        </select>
        <div title="Page 5"></div>
    </div>
</div>
<script>
    function loadRequester(value){
        if(value == 'load'){
            $("#requesterCharge").css("display", "none");
            $("#requester").select2('data', { id:"0", text: "Cargando Solicitantes..."});
            $.post("reloadContent.php", { type: 'requesterMenu' }, function(data){
                document.getElementById("requester").innerHTML = data;
                $("#requester").select2('data', { id:"", text: "Todos los Solicitantes"});
                $("#requester").prop('disabled', false);
            });
        }
    }
</script>
<?php } ?>    
                             
                                                    
                                        
<?php //Hasta aqui ?>                           
</div>  
<div class="row">
    
    <div class="col-md-4 ">
        <div class="form-group">
            <label>No. de Solicitud:</label>
            <input name="request" type="text" class="form-control" id="request" value="<? echo $_GET['request']; ?>">
        </div>
    </div>
    
    <div class="col-md-4 ">
        <div class="form-group">
            <label> No. de Factura:</label>
            <input name="bill" type="text" class="form-control" id="bill" value="<? echo $_GET['bill']; ?>">
        </div>
    </div>
    
    <div class="col-md-4 ">
        <div class="form-group">
            <label> No. de Retencion:</label>
            <input name="retentionno" type="text" class="form-control" id="retentionno" value="<? echo $_GET['retentionno']; ?>">
        </div>
    </div>
    
    </div>
    
    
    <div class="row">
        
        <div class="col-md-4 ">
            <div class="form-group">
                <label> Estado:</label>
                <select name="status" class="form-control" id="status">
                    <option value="" selected>Todas</option>
                    <option value="1" <?php if((isset($_GET['status'])) and ($_GET['status'] == 1)) echo 'selected'; ?>>Pendientes</option>
                    <option value="2" <?php if($_GET['status'] == 2) echo 'selected'; ?>>Impresas</option> 
                    </select>  
            </div>
        </div>
        
        <div class="col-md-4">
            <label class="control-label">Rango de Fechas: (Retención)</label>
            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                <input type="text" class="form-control" name="from" placeholder="desde" value="<? echo $_GET['from']; ?>" readonly style="width: 100%">
                <span class="input-group-addon">
                    <i class="fa fa-angle-double-right"></i></span>
                <input type="text" class="form-control" name="to" placeholder="hasta" value="<? echo $_GET['to']; ?>" readonly>
            </div>
        </div>
                                        
                                      <? if(($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-imi-global.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-ir-global.php')){  ?>  
                                       <div class="col-md-4 ">  <div class="form-group">
									 <label>Compañía:</label>
                                     <select name="thecompany" class="form-control" id="thecompany">
                                      <option value="" selected>Seleccionar</option>
                                     <?
									 
									 
									 if($global_company == 1){
										$foreach_company2 = "";
										$querycompanys = "select * from companies";
										if($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-ir-global.php'){
											$querycompanys = "select * from companies where iractive = '1'";
										} 
									 	
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
									 while($rowcompanys=mysqli_fetch_array($resultcompanys)){  
									 ?>
                                     <option value="<? echo $rowcompanys[0]; ?>" <? if($_GET['thecompany'] == $rowcompanys['id']) echo "selected"; ?>><? echo $rowcompanys['name']; ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>
                                       
                                       <div class="col-md-4 ">  <div class="form-group">
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
                                        
                                        </div>
                                        
                                        <? } ?> 
                                        <div class="col-md-2 " >
								   <div class="form-group">
									 <label> No de resultados:</label>
                                     <select name="pagination" class="form-control" id="pagination">
                                      <option value="100000" selected>Todas</option> 
                                      <option value="50" <?php if($_GET['pagination'] == 50) echo 'selected'; ?>>50</option>
                                     <option value="100" <?php if($_GET['pagination'] == 100) echo 'selected'; ?>>100</option>
                                     <option value="500" <?php if($_GET['pagination'] == 500) echo 'selected'; ?>>500</option>
                                    
                                     </select>
                                             
                  

                       <!--/row-->
                                       <!--/row-->
                                       <!--/row-->
                                                     
                                     <!--/row--></div>
													</div>
                                       
                                        <div class="col-md-2 " >
								   <div class="form-group">
									 <label> Remisión:</label>
                                     <select name="remission" class="form-control" id="remission">
                                      <option value="" selected>Todas</option> 
                                      <option value="no" <?php if($_GET['remission'] == 'no') echo 'selected'; ?>>No Remisionadas</option>
                                     <option value="yes" <?php if($_GET['remission'] == 'yes') echo 'selected'; ?>>Remisionadas</option> 
                                    
                                    
                                     </select>
                                             
                  

                       <!--/row-->
                                       <!--/row-->
                                       <!--/row-->
                                                     
                                     <!--/row--></div>
													</div>
                                        </div>
                                        
                                        <div class="row"></div>
<?php /*
if($_SESSION['admin'] == "active"){ ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Buscar como administrador:</label>
                                                    <input name="asadmin" type="checkbox" id="asadmin" value="1"> 
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
<?php } 
*/ ?>





                             
    <div class="row">
        <br><br>
        <div class="col-md-6">
            <input type="hidden" id="form" name="form" value="1">
            <button type="button" class="btn red" onClick="removeFilter();"><i class="fa fa-times"></i> Eliminar Filtro</button>
            <button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>
        </div>                               
    </div>
</div>

<script>
function removeFilter(){
    window.location = "?hall=<? echo $_GET['hall']; ?>";
}
</script>                                            