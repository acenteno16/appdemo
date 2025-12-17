<?php include("sessions.php"); 

$id = $_SESSION['userid'];

$query = "select * from workers where code = '$id'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 

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

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

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

					Usuarios <small>Editor de Usuarios</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="users.php">Usuarios</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Editor de Usuarios

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row profile">

				<div class="col-md-12">

					<!--BEGIN TABS-->

					<div class="tabbable tabbable-custom tabbable-full-width">

						<ul class="nav nav-tabs">

							<li class="active">

								<a href="#tab_1_1" data-toggle="tab">

								Resumen </a>

							</li>

							<li>

								<a href="#tab_1_3" data-toggle="tab">

								Cuenta </a>

							</li>

						

						

						</ul>

						<div class="tab-content">

							<div class="tab-pane active" id="tab_1_1">

								<div class="row">

									<div class="col-md-3">

										<ul class="list-unstyled profile-nav">

											<li>

												<?php 
                                                
                                                $queryimg = "select * from workers where code = '$id'";
$resultimg = mysqli_query($con, $queryimg);
$rowimg = mysqli_fetch_array($resultimg);

					
					echo $filepicture = "/profiles/".$rowimg['code']."/".$rowimg['code'].".jpg"; 
					
					if(file_exists($filepicture )){
						?>
                            <img alt="" src="<?php echo $filepicture; ?>" width="226"/> 
                            <?php }else{
					
					?>
                   <img src="../images/cp_big.jpg" class="img-responsive" alt=""/>

                    
                    <?php } ?>
                  
												

											</li>

										

										<?php /*	<li>

												<a href="#">

												Settings </a>

											</li>*/ ?>

										</ul>

									</div>

									<div class="col-md-9">

										<div class="row">

											<div class="col-md-8 profile-info">

											  <h1><?php echo $row['first']." ".$row['last']; ?></h1>
                                              <p>ID GetPay: <? echo $row['id']; ?><br>
                                              Código CP: <? echo $row['code']; ?><br>
Email: <? echo $row['email']; ?></p>
												<?php /*<ul class="list-inline">

													<li>

														<i class="fa fa-map-marker"></i> Spain

												  </li>

													<li>

														<i class="fa fa-calendar"></i> 18 Jan 1982

													</li>

													<li>

														<i class="fa fa-briefcase"></i> Design

													</li>

													<li>

														<i class="fa fa-star"></i> Top Seller

													</li>

													<li>

														<i class="fa fa-heart"></i> BASE Jumping

													</li>

											  </ul>*/ ?>

											</div>

											<!--end col-md-8-->

										<?php /*	<div class="col-md-4">

												<div class="portlet sale-summary">

													<div class="portlet-title">

														<div class="caption">

															 Solicitudes de pagos

														</div>

														

													</div>

													<div class="portlet-body">

														<ul class="list-unstyled">

															<li>

																<span class="sale-info">

																Hoy<i class="fa fa-img-up"></i>

																</span>

																<span class="sale-num">

																0 </span>

															</li>

															<li>

																<span class="sale-info">

																Esta semana<i class="fa fa-img-down"></i>

																</span>

																<span class="sale-num">

																0</span>

															</li>

															<li>

																<span class="sale-info">Total</span>

																<span class="sale-num">

																0 </span>

															</li>

															<li>

																<span class="sale-info">

																EARNS </span>

																<span class="sale-num">

																$0.00 </span>

															</li>

														</ul>

													</div>

												</div>

											</div> */ ?>

											<!--end col-md-4-->

										</div>

										<!--end row-->

									<?php /*	<div class="tabbable tabbable-custom tabbable-custom-profile">

											<ul class="nav nav-tabs">

												<li class="active">

													<a href="#tab_1_11" data-toggle="tab">

													Latest Customers </a>

												</li>

												<li>

													<a href="#tab_1_22" data-toggle="tab">

													Feeds </a>

												</li>

											</ul>

											<div class="tab-content">

												<div class="tab-pane active" id="tab_1_11">

													<div class="portlet-body">

														<table class="table table-striped table-bordered table-advance table-hover">

														<thead>

														<tr>

															<th>

																<i class="fa fa-briefcase"></i> Company

															</th>

															<th class="hidden-xs">

																<i class="fa fa-question"></i> Descrition

															</th>

															<th>

																<i class="fa fa-bookmark"></i> Amount

															</th>

															<th>

															</th>

														</tr>

														</thead>

														<tbody>

														<tr>

															<td>

																<a href="#">

																Pixel Ltd </a>

															</td>

															<td class="hidden-xs">

																 Server hardware purchase

															</td>

															<td>

																 52560.10$ <span class="label label-success label-sm">

																Paid </span>

															</td>

															<td>

																<a class="btn default btn-xs green-stripe" href="#">

																View </a>

															</td>

														</tr>

														<tr>

															<td>

																<a href="#">

																Smart House </a>

															</td>

															<td class="hidden-xs">

																 Office furniture purchase

															</td>

															<td>

																 5760.00$ <span class="label label-warning label-sm">

																Pending </span>

															</td>

															<td>

																<a class="btn default btn-xs blue-stripe" href="#">

																View </a>

															</td>

														</tr>

														<tr>

															<td>

																<a href="#">

																FoodMaster Ltd </a>

															</td>

															<td class="hidden-xs">

																 Company Anual Dinner Catering

															</td>

															<td>

																 12400.00$ <span class="label label-success label-sm">

																Paid </span>

															</td>

															<td>

																<a class="btn default btn-xs blue-stripe" href="#">

																View </a>

															</td>

														</tr>

														<tr>

															<td>

																<a href="#">

																WaterPure Ltd </a>

															</td>

															<td class="hidden-xs">

																 Payment for Jan 2013

															</td>

															<td>

																 610.50$ <span class="label label-danger label-sm">

																Overdue </span>

															</td>

															<td>

																<a class="btn default btn-xs red-stripe" href="#">

																View </a>

															</td>

														</tr>

														<tr>

															<td>

																<a href="#">

																Pixel Ltd </a>

															</td>

															<td class="hidden-xs">

																 Server hardware purchase

															</td>

															<td>

																 52560.10$ <span class="label label-success label-sm">

																Paid </span>

															</td>

															<td>

																<a class="btn default btn-xs green-stripe" href="#">

																View </a>

															</td>

														</tr>

														<tr>

															<td>

																<a href="#">

																Smart House </a>

															</td>

															<td class="hidden-xs">

																 Office furniture purchase

															</td>

															<td>

																 5760.00$ <span class="label label-warning label-sm">

																Pending </span>

															</td>

															<td>

																<a class="btn default btn-xs blue-stripe" href="#">

																View </a>

															</td>

														</tr>

														<tr>

															<td>

																<a href="#">

																FoodMaster Ltd </a>

															</td>

															<td class="hidden-xs">

																 Company Anual Dinner Catering

															</td>

															<td>

																 12400.00$ <span class="label label-success label-sm">

																Paid </span>

															</td>

															<td>

																<a class="btn default btn-xs blue-stripe" href="#">

																View </a>

															</td>

														</tr>

														</tbody>

														</table>

													</div>

												</div>

												<!--tab-pane-->

												<div class="tab-pane" id="tab_1_22">

													<div class="tab-pane active" id="tab_1_1_1">

														<div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">

															<ul class="feeds">

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success">

																					<i class="fa fa-bell-o"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 You have 4 pending tasks. <span class="label label-danger label-sm">

																					Take action <i class="fa fa-share"></i>

																					</span>

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 Just now

																		</div>

																	</div>

																</li>

																<li>

																	<a href="#">

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success">

																					<i class="fa fa-bell-o"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New version v1.4 just lunched!

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 20 mins

																		</div>

																	</div>

																	</a>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-danger">

																					<i class="fa fa-bolt"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 Database server #12 overloaded. Please fix the issue.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 24 mins

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 30 mins

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 40 mins

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-warning">

																					<i class="fa fa-plus"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New user registered.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 1.5 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success">

																					<i class="fa fa-bell-o"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 Web server hardware needs to be upgraded. <span class="label label-inverse label-sm">

																					Overdue </span>

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 2 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-default">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 3 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-warning">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 5 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 18 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-default">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 21 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 22 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-default">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 21 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 22 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-default">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 21 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 22 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-default">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 21 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">

																					<i class="fa fa-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					 New order received. Please take care of it.

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			 22 hours

																		</div>

																	</div>

																</li>

															</ul>

														</div>

													</div>

												</div>

												<!--tab-pane-->

											</div>

										</div> */ ?>

									</div>

								</div>

							</div>

							<!--tab_1_2-->

							<div class="tab-pane" id="tab_1_3">

								<div class="row profile-account">

									<div class="col-md-3">

										<ul class="ver-inline-menu tabbable margin-bottom-10">

											

											<li class="active">

												<a data-toggle="tab" href="#tab_2-2">

												<i class="fa fa-picture-o"></i> Imagen </a>

											</li>

										<li>

												<a data-toggle="tab" href="#tab_3-3">

												<i class="fa fa-lock"></i> Cambio de Contraseña </a>

											</li>
                                            

											

										</ul>

									</div>

									<div class="col-md-9">

										<div class="tab-content">

											

											<div id="tab_2-2" class="tab-pane active">

												<p>

													 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.

												</p>

												<form action="profile-edit-image-upload.php" method="post" enctype="multipart/form-data">

													<div class="form-group">

														<div class="fileinput fileinput-new" data-provides="fileinput">

															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

															  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>

															</div>

															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">

															</div>

															<div>

																<span class="btn default btn-file">

																<span class="fileinput-new">

																Select image </span>

																<span class="fileinput-exists">

																Change </span>

																<input name="myfile" type="file" id="myfile"> 

																</span>

																<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">

																Remove </a>

															</div>

														</div>

														<div class="clearfix margin-top-10">

															<?php /*<span class="label label-danger">

															NOTE! </span>

															<span>

															Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>*/ ?>

													      <input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>"> 
														</div>

													</div>

													<div class="margin-top-10">

														
                                                        		<input type="submit" class="btn green">

														<a href="#" class="btn default">

														Cancel </a>

													</div>

												</form>

											</div>

										<div id="tab_3-3" class="tab-pane">

												<form action="profile-password-edit.php" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo $row['id']; ?>">
													<?php /*<div class="form-group">

														<label class="control-label">Contraseña Actual</label>

														<input type="text" class="form-control" value="<?php echo $row['password']; ?>" name="password"/>

													</div>*/ ?> 

													<div class="form-group">

													  <label class="control-label">Contraseña actual</label>

														<input name="password" type="password" class="form-control" id="password"/>

													</div>
                                                    
                                                    <div class="form-group">

														<label class="control-label">Nueva Contraseña</label>

														<input type="password" class="form-control" name="password1"/>

													</div>

													<div class="form-group">

														<label class="control-label">Confirme Nueva Contraseña</label>

														<input type="password" class="form-control" name="password2"/>

													</div>

													<div class="margin-top-10">

	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Actualizar</button>

													</div>

												</form>

											</div>
                                            
                                           

											

										</div>

									</div>

									<!--end col-md-9-->

								</div>

							</div>

							<!--end tab-pane-->

							

							<!--end tab-pane-->

							

							<!--end tab-pane-->

						</div>

					</div>

					<!--END TABS-->

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

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script> 

jQuery(document).ready(function() {       
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar

});

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>