<?

include_once("sessions.php");

$today = date('Y-m-d');
if(($today <= '2018-01-06')){

?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="../assets/fix.css"/> 
<style type="text/css" nonce="<?= $nonce ?>">
#logoImg{
	margin:0 !important;	
}
#dropDownUl{
	height: 250px;
}
.liWhite{
	background:#EF989A;
}
.badgeNew{
	background-color:#FC0000; color:#FFFFFF;
}				

<?  
$red = "#9f1c1f";
$green = "#5f7835";

$red = "#d31f25";
$green = "#23774a";

?>
<? if($mobile == 1){ ?>
	
	input[type='text'],
	input[type='number'],
	textarea {
  		font-size: 16px;
	}
	
<? } ?>

.dashboard-stat.blue{
	background:<? echo $red; ?>;
}
.page-header.navbar .top-menu .navbar-nav > li.dropdown-user .dropdown-toggle{
	background:<? echo $red; ?>;
	
	
}
.page-header.navbar{

/*background-color: #9f1c1f;
border-bottom: 2px solid #4FC7E6;
background:url(navidad/bg1.png) repeat 5%;*/
background:<? echo $green; ?>;


}
.page-content{ 
	background:url(navidad/border2.png) repeat-x;
	background-size: 200px;
	background-color:#FFFFFF;
}
.page-content-wrapper .page-content{
	padding: 60px 20px 10px 20px;
}
.page-header.navbar .top-menu .navbar-nav > li.dropdown .dropdown-toggle > i{
	color:#FFFFFF;
}
.page-header.navbar .top-menu .navbar-nav > li.dropdown-user .dropdown-toggle .username{
	color:#FFFFFF;
}
.note-regular{
	background:url(navidad/nacimiento.jpg) top left no-repeat;
	border:2px solid <? echo $red; ?>;
	color:#FFFFFF;
	
}
.page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a, .page-sidebar .page-sidebar-menu > li.active > a, .page-sidebar .page-sidebar-menu > li.active.open > a{
	background: <? echo $red; ?>; 
}
	
</style>    
    
<?
}
?>
<div class="page-header navbar navbar-fixed-top">

	<!-- BEGIN HEADER INNER -->

	<div class="page-header-inner">

		<!-- BEGIN LOGO -->

		<div class="page-logo">

			<a href="dashboard.php">

			
            <img src="<?php if($_SESSION['mobile'] == 'inactive'){ ?>../images/getpay-white-h.png<?php }else{ ?>../images/getpay-mobile.png<?php }?>" alt="logo" height="48" id="logoImg" />
				

			</a>

			<div class="menu-toggler sidebar-toggler hide">

				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->

			</div>

		</div>

		<!-- END LOGO -->

		<!-- BEGIN RESPONSIVE MENU TOGGLER -->

		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>

		<!-- END RESPONSIVE MENU TOGGLER -->

		<!-- BEGIN TOP NAVIGATION MENU -->

		<div class="top-menu">

			<ul class="nav navbar-nav pull-right">

				<!-- BEGIN NOTIFICATION DROPDOWN -->

				<?php 
				$querynotificationsa = "select * from notifications where userid='$_SESSION[userid]' and active = '1'";
				$resultnotificationsa = mysqli_query($con, $querynotificationsa); 
				$numnotificationsa = mysqli_num_rows($resultnotificationsa); 
				
				$querynotifications = "select * from notifications where userid='$_SESSION[userid]' order by id desc limit 10";
				$querynotifications = "select * from notifications where userid='$_SESSION[userid]'";
				$resultnotifications = mysqli_query($con, $querynotifications);
				$numnotifications = mysqli_num_rows($resultnotifications);
				 
				?>
                
                <? if($numnotifications > 0){ ?>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

					<i class="icon-bell"></i>

					<span class="badge badge-default">

					<?php echo $numnotificationsa; ?> </span>

					</a>

					<ul class="dropdown-menu">

						<li>

							<p>

								 Usted tiene <?php echo $numnotifications; ?> notificación</p>

						</li>

						<li>

							<ul class="dropdown-menu-list scroller" id="dropDownUl">
								
								<?php 
								if($numnotifications > 0){
								while($rownotifications=mysqli_fetch_array($resultnotifications)){
								?>
                                <li class="liWhite">
									

									<a href="notifications.php?id=<?php echo $rownotifications['id']; ?>">



									<?php echo $rownotifications['notification']; ?><span class="time"> </span>

									<?php if($rownotifications['active'] == 1){ ?><span class="badge badge-default bsdgeNew">

					Nueva </span> <?php }else{ ?>
                    
                    <span class="badge badge-default">

					Revisada </span>
                    <?php } ?></a>

								</li>
                                
                                <?php }} ?>
							</ul>

						</li>

						<li class="external">

							<a href="#">

							Ver totdas las notificaciones<i class="m-icon-swapright"></i>

							</a>

						</li>

					</ul>

				</li>
				<? } ?>

				<li class="dropdown dropdown-user">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

					<?php $filepicture = "profiles/".$_SESSION['userid']."/".$_SESSION['userid'].".jpg"; 
					
					if(file_exists($filepicture )){
						?>
                            <img alt="" class="img-circle" src="<?php echo $filepicture; ?>" height="29"/>
                            <?php }else{ 
					
					?>
                    <? //<img alt="" class="img-circle" src="../cp.png" height="29"/> ?>
                    
                    <?php } ?>
 
					<span class="username">

					<?php echo $_SESSION['firstname']; ?> </span>

					<i class="fa fa-angle-down"></i>

					</a>

					<ul class="dropdown-menu">

						<li>

							<a href="profile.php">

							<i class="icon-user"></i> Mi Perfíl</a>

						</li>

						
						<li>

							<a href="my-log.php">

							<i class="icon-rocket"></i> Mi LOG<span class="badge badge-success"></span>

							</a>

						</li>

						<li class="divider">

						</li> 

						<li>

							<a href="lock.php">

							<i class="icon-lock"></i> Bloquear Pantalla</a>

						</li>

						<li>

							<a href="logout.php">

							<i class="icon-key"></i> Cerrar Sesión</a>

						</li>

					</ul>

				</li>

				<li class="dropdown dropdown-quick-sidebar-toggler">

					<a href="javascript:;" class="dropdown-toggle">

					<i class="fa fa-life-ring"></i>

					</a>

				</li>
			</ul>
		</div>
	</div>
</div>