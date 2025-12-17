<?php 

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require("session-files.php");

?> 
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<meta content="" name="description"/>

<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file1").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	if((file.type == 'application/pdf') || (file.type == 'application/kswps')){
		//  
	}else{ 
		//alert('El archivo debe de ser PDF. ('+file.type+')'); 
		//return; 
	}

	<? if($_SESSION['bigfiles'] == 'active'){ ?>
		//12 MB 
		if(file.size > '10077220'){
		// 8,061,776
		alert('El archivo debe de ser menor que 10 MB.');
		return;  
		}
	<? }else{ ?>
		//6MB
		if(file.size > '6046332'){
		// 8,061,776
		alert('El archivo debe de ser menor que 6 MB.');
		return;  
		}
	<? } ?> 
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "files-upload.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	_("upload_form").reset();
	var id = 1;
	$.post("reload-files.php", { variable: id }, function(data){
		
			_("myfiles").innerHTML = data;  
		
});		 
	
}
function errorHandler(event){
	_("status").innerHTML = "Carga de archivo fallida";
}
function abortHandler(event){
	_("status").innerHTML = "Carga de archivo cancelada";
}


</script>
</head> 

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content ">

<!-- BEGIN HEADER -->

<?php include("header.php"); ?>

<!-- END HEADER -->

<div class="clearfix">

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<?php include("side.php"); ?>
	
	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<div class="page-content-wrapper">  

		<div class="page-content">

		
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Archivos <?php //<small>Órdenes de pago</small>  ?>  

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Archivos</a> 

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row"> 

				<div class="col-md-12"><!-- Begin: life time stats --> 







<? /*if($_SESSION['email'] == 'jairovargasg@gmail.com'){ ?>
<a href="filesBackupDate.php"><button type="button" class="btn green"><i class="fa fa-cloud-upload"> </i> Respaldar</button></a><br><br>
<? } */ ?>
<form id="upload_form" name="ungrouped" enctype="multipart/form-data" method="post">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
								<div class="row">  
                             <h4 style="margin-left:15px;">Cargador de Archivos<br>
<span style="font-size:12px;">(Este debe de ser .PDF con un tamaño no mayor a <? if($_SESSION['bigfiles'] == 'active'){ echo '10'; }else{ echo '6'; } ?>MB.)</span></h4>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Archivo:</label>
											<input name="file1" type="file" class="form-control" id="file1" value=""><br>
											<progress id="progressBar" value="0" max="100" style="width:300px;"></progress><br>
										</div>
									</div>
                          
</div>                                        
                                            




                             
<div class="row">


						<div class="col-md-2">							
<button type="button" class="btn blue" onclick="uploadFile()"><i class="fa fa-file"> </i>  Subir Archivos</button>  
												
                 </div>                               
  
</div>
						
								</div>
                               
  <h3 id="status"></h3>
  <p id="loaded_n_total"></p>                               
                               
                                </form>



                                
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Mis archivos

							</div>

							

						</div>

						
                        
                        
                                
                        <div class="portlet-body">

							<div class="table-container">

								

							
<?php 

								
$tampagina = 50;
if(isset($_GET['page'])){
	$pagina = $_GET['page'];
	$inicio=($pagina-1)*$tampagina;
}else{
	$inicio = 0;
	$pagina = 1;
}
								
$query = "select id from filebox where user = '$_SESSION[userid]' order by id desc";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);				
								
$query1 = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
$previous = "";
$next = "";
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;								
				
 if(isset($_GET['echo'])){
     echo $query;
 }                               
                                
if($num > 0){
?>
								<div class="table-scrollable">
<div id="myfiles">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="13%">

										 Archivo</th>

									<th width="17%">

										 Titulo</th>

									<th width="11%">Link</th>

									<th width="22%">

										Fecha

									</th>

									<th width="15%">

										Hora

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){ 
								
							
								
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
                                <td><?php echo $row['filename']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><a href="javascript:clipboard('<?php echo 'https://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'];  ?>');"><i class="fa fa-external-link"></i></a> <a href="<?php echo 'https://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'];  ?><?php //echo 'http://www.pagoscp.com/admin/visor.php?key='.$row['url'];  ?>" target="_blank"><?php echo 'https://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'];  ?></a></td>  
                                <td><?php echo $row['today']; ?></td>
                                <td><?php echo $row['now']; ?></td>
                                <td>
                          
                           
                            <a href="<?php echo 'visor.php?key='.$row['url'];  ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                             <a href="files-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Editar</a>
                            <?php /*
                             <a href="javascript:deletePayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
                                    <script>
									function deletePayment(id){
		if (confirm("Usted desea eliminar este pago\n- Si usted no desea eliminar este pago presione cancelar.")==true){
			window.location="payments-delete.php?id="+id;	
	} 
}

									</script>
                            */ ?>
                         
                            </td>
                            
                            </tr>
                                <?php }
								
								?>
                                   </tbody>

								</table> 
                                
<? /*<div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="files.php?page=<?php echo $previous; ?>">
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
		  echo '<li><a href="files.php?page='.$i.'">'.$i.'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="files.php?page=<?php echo $next; ?>">
										<i class="fa fa-angle-right"></i> 
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>*/ ?>
<div>
                    <? 
    
                 
    
    
    
    
    $totpagina;
    $pagTop = $pagina+10;
    $pagLow = $pagina-10;
                    
                    ?>
                    <ul class="pagination pagination-lg">
                      <?php if($pagina > 1){ ?>
                      <li> <a href="?page=<?php echo $pagina-1;?>&form=1"><i class="fa fa-angle-left"></i> </a> </li>
                      <?php } ?>
                      <?php
    
                      if($totpagina > 1){
                        for($i=1;$i<=$totpagina;$i++){
                            
                            if(($i < $pagTop) and ($i > $pagLow)){
                                #doNothing
                            }else{
                                $i = $i+9;
                                if(($pagina + 100) < $i){
                                    $i = $i+90;
                                }
                                if(($pagina - 100) > $i){
                                    $i = $i+90;
                                }
                            }
                            
                          if ( $pagina == $i ) { 
                            echo '<li class="active"><a href="#">' . $i . '</a></li>';
                          } else {
                              echo '<li><a href="?page='.$i.'&form=1">' . $i . '</a></li>';
                          }
                        }
                      }
    
                     
    

                      ?>
                        
                        
                        
                        
                      <?php 
            
             if($next != ""){ ?>
                     
                        <li> <a href="?page=<?php echo $pagina+1;?>"><i class="fa fa-angle-right"></i> </a> </li>
                      <?php } ?>
                    </ul>
                  </div>    
</div>
								</div>                
<?php }else{ ?>                           
<div class="note note-danger">
<p>Nota: No se encontro ningún archivo.</p>
</div>            
<?php } ?>                 
                                
                                

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>

	</div>

	<!-- END CONTENT --> 

	<!-- BEGIN QUICK SIDEBAR -->

    <?php include("sidebar.php"); ?>

<!-- END QUICK SIDEBAR -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<?php include("footer.php"); ?>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<? //<script src="../assets/admin/pages/scripts/components-pickers.js"></script> ?>

<script src="../assets/admin/pages/scripts/table-managed.js"></script>


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
<? #ComponentsPickers.init(); ?>
TableManaged.init();


        });



						</script>
                        
                    


<script>
function clipboard(text){
	window.prompt("Copiar al portapapeles: Ctrl+C en Windows o Command+c en Apple OSX", text);
}
	
function validateForm(){
	
	var filename = document.getElementById('myfile').value;
	if(filename == ""){
		alert('Debe de ingresar un archivo en el formulario.');
		return false;
	}else{
		var extension = (filename.substring(filename.lastIndexOf("."))).toLowerCase();
		if(extension != ".pdf"){
			alert('Favor proporcionar un archivo .PDF ||| FE: '+extension);
			return false;
		}else{
			return true;
		}
	}
}
		
		
</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>
