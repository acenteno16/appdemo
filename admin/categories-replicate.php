<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");
require('includes.php');
$requiredFiles = ['general']; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from categories where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();
 
?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>
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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Categorias <small>Elementos de categorías</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						<?php /*<li class="btn-group">

							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">

							<span>Actions</span><i class="fa fa-angle-down"></i>

							</button>

							<ul class="dropdown-menu pull-right" role="menu">

								<li>

									<a href="#">Action</a>

								</li>

								<li>

									<a href="#">Another action</a>

								</li>

								<li>

									<a href="#">Something else here</a>

								</li>

								<li class="divider">

								</li>

								<li>

									<a href="#">Separated link</a>

								</li>

							</ul>

						</li>*/ ?>

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="categories.php">Categorias</a>
                            	<i class="fa fa-angle-right"></i>
                                </li>

						<li>Elementos de Categorias</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					

							

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

											<?php //Form Sample ?>

										</div>

										<?php /*<div class="tools">

											<a href="javascript:;" class="collapse">

											</a>

											<a href="#portlet-config" data-toggle="modal" class="config">

											</a>

											<a href="javascript:;" class="reload">

											</a>

											<a href="javascript:;" class="remove">

											</a>

										</div>*/ ?>

									</div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="categories-replicate-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

										  <div class="form-body">

												<h3 class="form-section">Agregar a la Categoría</h3>

												<div class="row">
													<div class="col-md-12 ">
													  
                                   
                                                        

                                                            <div class="form-group">
                                                              <label class="control-label">Leer:</label>
                                                              <select name="read" class="form-control" id="read">
                                                                <option value="0">Todas las categorías</option> 
                                                                <?php $query2 = "select * from categories where level > '0' and level < '3'";
$result2 = mysqli_query($con, $query2);
while($row2=mysqli_fetch_array($result2)){
?>
                                                                <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name'].' (Nivel '.$row2['level'].')';; ?></option>
                                                                <?php } ?>
                                                              </select>
                                                             
                                                            </div>
                                                            <div id="dcategories" >
        <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">	<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
  </th>

									<th width="5%">

										 ID</th>

									<th width="28%">

										 Nombre</th>

									<th width="25%">Cuenta</th>

								  </tr>

								</thead>

								<tbody>
                                <?php $query = "select * from categories";
								$result = mysqli_query($con, $query);
								while($row=mysqli_fetch_array($result)){
								if($row['id'] != 1){
								?>
                                
                                <tr role="row" class="odd">
									<td class="sorting_1"><input name="cid[]" type="checkbox" id="cid[]" value="<?php echo $row['id']; ?>"></td>
									<td><?php echo $row['id']; ?></td><td><?php echo $row['name']; ?></td><td><?php echo $row['account'];  ?></td></tr>
                                <?php } }
								
								?>
                                   </tbody>

								</table>                                                   </div>
                                                            <br><br>
                                                            <div class="form-group">
                                                              <label class="control-label">Escribir en:</label>
                                                              <select name="write" class="form-control" id="write">
                                                               <?php /*<option value="<?php echo $row['id']; ?>">Principal</option>*/ ?>
                                                                <?php $query2 = "select * from categories where level = '2'";
$result2 = mysqli_query($con, $query2);
while($row2=mysqli_fetch_array($result2)){
?>
                                                                <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name'].' (Nivel '.$row2['level'].')';; ?></option>
                                                                <?php } ?>
                                                              </select>
                                                            </div>
                                                      
                                                          <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                          <!--/row-->
                                                       
                                                        <div class="form-actions right">
                                                          
                                                          <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>
                                                          <input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
                                                        </div>
                                                   </div>
</div>
</div>


										    <!--/row-->
										</form>
                                        
                                        	

										<!-- END FORM-->
                                        	
						
                        			</div>  

								</div>

							</div> 

  

                               
					</div>

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>

	</div>

<?php include("sidebar.php"); ?>
</div>
<?php 
	include("footer.php"); 
	loadJS($requiredFiles, $nonce);
?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	 function readCategory(id){
		 $.post("reload-dcategories.php", { variable: id }, function(data){
			 $("#dcategories").html(data);
		});
	 }
	
	document.addEventListener("DOMContentLoaded", function () {
    const readSelect = document.getElementById("read");
    if (readSelect) {
        readSelect.addEventListener("change", function () {
            readCategory(this.value);
        });
    }
	});

    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('cid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
	
	document.addEventListener("DOMContentLoaded", function () {
    const checkAllBox = document.getElementById("checkall");
    if (checkAllBox) {
        checkAllBox.addEventListener("change", function () {
            checkAll(); 
        });
    }
});

</script>