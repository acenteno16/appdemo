<?php 

require('headers.php');
$allowedRoles = ['admin', 'providers'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];   

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
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">
		<div class="page-content">

		

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Clientes<?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="dashboard.php">Inicio</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Clientes</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
			</div>

	

<div class="row">

				<div class="col-md-12">

				

					<!-- Begin: life time stats -->
                    
                    
<?
					
							   
							   /*$code = $_GET['code'];
							   $name = $_GET['name'];
							   $international = $_GET['international'];
							   $course = $_GET['course'];	
									
							   $sql1 = "";
							   if($code != ""){
								   $sql1 = " and code like '%$code%'";
							   }
							   
							   $sql2 = "";
							   if($name != ""){
								   $sql2 = " and name like '%$name%'";
							   } 
							   $sql3 = "";
							   if($international != ""){
								   switch($international){
									   case 'nac':
										   $international_val = 0;
										   break;
									   case 'int': 
										   $international_val = 1;
										   break;
								   }
								   $sql3 = " and international = '$international_val'";
							   } 
							   $sql4 = "";
							   if($course != ""){
								   $sql4 = " and course like '%$course%'";
							   }
					
								$updated = $_GET['updated'];
								$sql5 = "";
							   if($updated != ""){
								   switch($updated){
									   case 'no':
										   $updated_val = 0;
										   break;
									   case 'yes': 
										   $updated_val = 1;
										   break; 
								   }
								   $sql5 = " and updated = '$updated_val'";
							   }
					
								$email = $_GET['email'];
								$sql6 = "";
							   if($email != ""){
								   $sql6 = " and email = '$email'";
							   }
							   $sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6; 
							   $query = "select * from clients where id > 0".$sql; 
							   */
					
					$pagesize = 50000000;
					$page = 1;
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}
					if($pagina == 1){
						$start = 0;
					}else{
						$start=($page-1)*$pagesize;
					}
							   
					$queryPag = "select * from clients where id > 0";  
					$resultPag = mysqli_query($con, $queryPag);
					$numPag = mysqli_num_rows($resultPag);
					$totpages = ceil($numPag / $pagesize);
					
					$query = "select * from clients where id > 0 limit ".$start.",".$pagesize;  
					$result = mysqli_query($con, $query);
					$num = mysqli_num_rows($result);
					
					
					
					?>
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-shopping-cart"></i><? echo $numPag; ?> Clientes</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

							
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">
								<thead>
								<tr role="row" class="heading">
									<th width="1%">Codigo</th>
									<th width="15%">Nombre</th>
									<th width="10%">Opciones</th>
								</tr>
								</thead>
								<tbody>
                               <? 
								if($_GET['echo'] == 1){ echo $query; }	
								while($row=mysqli_fetch_array($result)){
							   ?> 
                                <tr role="row" class="odd ">
									<td><?php echo $row['code']; ?></td>
									<td><?php 
									if($row['type'] == 1){ 
										echo $row['first']." ".$row['last']; 
									}else{ 
										echo $row['name']; 
									} ?></td>
									<td>
										<a href="clients-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> 
										<a href="clients-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Editar</a></td>
								</tr>
								<?php } ?>
								</tbody>
								</table>
							</div>
							
							<? /*<div>
                        <ul class="pagination pagination-lg">
                            <?php if($previous != ""){ ?>
                            <li> <a href="?page=<?php echo $previous; ?>"> <i class="fa fa-angle-left"></i> </a> </li>
                            <?php }  ?>
                            <?php
                            if ( $totpages > 1 ) {
                              for ( $i = 1; $i <= $totpages; $i++ ) {
                                if ( $page == $i ) { echo '<li class="active"><a href="#">'.$i.'</a></li>'; } 
								else {  echo '<li><a href="?page='.$i.'>'.$i.'</a></li>'; }
                              }
                            }
                            ?>
                            <?php if($next != ""){ ?>
                            <li> <a href="?page=<?php echo $next; ?>"> <i class="fa fa-angle-right"></i> </a> </li>
                            <?php } ?>
                          </ul>
                      </div>*/ ?>
							<div>
  <ul class="pagination pagination-lg">
    <?php
    // Calcular saltos
    $jump10Back  = max(1, $page - 10);
    $jump10Next  = min($totpages, $page + 10);
    $jump50Back  = max(1, $page - 50);
    $jump50Next  = min($totpages, $page + 50);

    if ($previous != "") {
        echo '<li><a href="?page=' . $previous . '"><i class="fa fa-angle-left"></i></a></li>';
    }

    // Mostrar primera página si estamos lejos de ella
    if ($page > 3) {
        echo '<li><a href="?page=1">1</a></li>';
        if ($page > 4) echo '<li><a href="#">...</a></li>';
    }

    // Saltos hacia atrás
    if ($page > 10) {
        echo '<li><a href="?page=' . $jump10Back . '">-' . 10 . '</a></li>';
    }
    if ($totpages > 100 && $page > 50) {
        echo '<li><a href="?page=' . $jump50Back . '">-' . 50 . '</a></li>';
    }

    // Páginas actuales +/-2
    $start = max(1, $page - 2);
    $end = min($totpages, $page + 2);
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $page) {
            echo '<li class="active"><a href="#">' . $i . '</a></li>';
        } else {
            echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Saltos hacia adelante
    if ($totpages - $page > 10) {
        echo '<li><a href="?page=' . $jump10Next . '">+' . 10 . '</a></li>';
    }
    if ($totpages > 100 && $totpages - $page > 50) {
        echo '<li><a href="?page=' . $jump50Next . '">+' . 50 . '</a></li>';
    }

    // Mostrar última página si estamos lejos de ella
    if ($page < $totpages - 2) {
        if ($page < $totpages - 3) echo '<li><a href="#">...</a></li>';
        echo '<li><a href="?page=' . $totpages . '">' . $totpages . '</a></li>';
    }

    if ($next != "") {
        echo '<li><a href="?page=' . $next . '"><i class="fa fa-angle-right"></i></a></li>';
    }
    ?>
  </ul>
</div>



							<div class="row"></div>
							
						
						</div>
						
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>

	</div>
	</div>
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