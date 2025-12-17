<?php session_start(); ?>

<?

if(($_SESSION['email'] == "jairovargasg@gmail.com") or (1 == 1)){
?>
<style type="text/css">

<?  
$red = "#9f1c1f";
$green = "#5f7835";
?>

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
	background:url(navidad/top.png) repeat-x;
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
	background:url(navidad/event_left_bg.jpg) top left no-repeat;
	border:2px solid <? echo $red; ?>;
	
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

			
            <img src="<?php if($_SESSION['mobile'] == 0){ ?>../images/getpay-white-h.png<?php }else{ ?>../images/getpay-mobile.png<?php }?>" alt="logo" class="logo-default" height="48" style="margin:0;" />

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

		

		<!-- END TOP NAVIGATION MENU -->

	</div>

	<!-- END HEADER INNER -->

</div>