<?  

include('configuration.php');

$show_session_options = 0;    
$show_session_routes = 0;
if(isset($_SESSION['routes'])){
	if($_SESSION['routes'] == "active"){ $show_session_options = 1; $show_session_routes = 1; }
}
$show_session_provider = 0;
if(isset($_SESSION['providers'])){
	if($_SESSION['providersinfo'] == "active"){ $show_session_options = 1; $show_session_provider = 1; }
}
$show_session_providerInfo = 0;
if(isset($_SESSION['providersinfo'])){
	if($_SESSION['providersinfo'] == "active"){ $show_session_providerInfo = 1; }
}
$show_session_financemanager = 0;
if(isset($_SESSION['financemanager'])){
	if($_SESSION['financemanager'] == "active"){ $show_session_financemanager = 1; }
}
$show_session_financemanager2 = 0;
if(isset($_SESSION['financemanager2'])){
	if($_SESSION['financemanager2'] == "active"){ $show_session_financemanager2 = 1; }
}
$show_session_consultation = 0;
if(isset($_SESSION['consultation'])){
	if($_SESSION['consultation'] == "active"){ $show_session_consultation = 1; }
}
$show_session_file = 0;
if(isset($_SESSION['file'])){
	if($_SESSION['file'] == "active"){ $show_session_file = 1; }
}
$show_session_request = 0;
if(isset($_SESSION['request'])){
	if($_SESSION['request'] == "active"){ $show_session_request = 1; }
}
$show_session_request2 = 0;
if(isset($_SESSION['request2'])){
	if($_SESSION['request2'] == "active"){ $show_session_request2 = 1; }
}
$show_session_spellas = 0;
if(isset($_SESSION["spellas"])){
	if($_SESSION["spellas"] == "active"){ $show_session_spellas = 1; $show_session_dch_spellas = 1; }
}
$show_session_approve1 = 0;
if(isset($_SESSION['approve1'])){
	if($_SESSION['approve1'] == "active"){ $show_session_approve1 = 1; }
}
$show_session_approve2 = 0;
if(isset($_SESSION['approve2'])){
	if($_SESSION['approve2'] == "active"){ $show_session_approve2 = 1; }
}
$show_session_approve3 = 0;
if(isset($_SESSION['approve3'])){
	if($_SESSION['approve3'] == "active"){ $show_session_approve3 = 1; }
}
$show_session_dch = 0;
if(isset($_SESSION["dch"])){
	if($_SESSION["dch"] == "active"){ $show_session_dch = 1; $show_session_dch_spellas = 1; }
}

$show_session_credit = 0;
if(isset($_SESSION['credit'])){
	if($_SESSION['credit'] == "active"){ $show_session_credit = 1; }
}
$show_session_provision = 0;
if(isset($_SESSION['provision'])){
	if($_SESSION['provision'] == "active"){ $show_session_provision = 1; }
}
$show_session_provision2 = 0;
if(isset($_SESSION['provision2'])){
	if($_SESSION['provision2'] == "active"){ $show_session_provision2 = 1; }
}
$show_session_releasing = 0;
if(isset($_SESSION['releasing'])){
	if($_SESSION['releasing'] == "active"){ $show_session_releasing = 1; }
}
$show_session_releasing2 = 0;
if(isset($_SESSION['releasing2'])){
	if($_SESSION['releasing2'] == "active"){ $show_session_releasing2 = 1; }
}
$show_session_paymentschedule = 0;
if(isset($_SESSION['paymentschedule'])){
	if($_SESSION['paymentschedule'] == "active"){ $show_session_paymentschedule = 1; }
}
$show_session_treasury = 0;
if(isset($_SESSION['treasury'])){
	if($_SESSION['treasury'] == "active"){ $show_session_treasury = 1; }
}
$show_session_payer = 0;
if(isset($_SESSION['payer'])){
	if($_SESSION['payer'] == "active"){ $show_session_payer = 1; }
}
$show_session_filereception = 0;
if(isset($_SESSION['filereception'])){
	if($_SESSION['filereception'] == "active"){ $show_session_filereception = 1; }
}
$show_session_filereview = 0;
if(isset($_SESSION['filereview'])){
	if($_SESSION['filereview'] == "active"){ $show_session_filereview = 1; }
}
$show_session_filestorage = 0;
if(isset($_SESSION['filestorage'])){
	if($_SESSION['filestorage'] == "active"){ $show_session_filestorage = 1; }
}
$show_session_retimi = 0;
if(isset($_SESSION['retimi'])){
	if($_SESSION['retimi'] == "active"){ $show_session_retimi = 1; } 
}
$show_session_retentions = 0;
if(isset($_SESSION['retentions'])){
	if($_SESSION['retentions'] == "active"){ $show_session_retentions = 1; }
}
$show_session_scholarships = 0;
if(isset($_SESSION['scholarships'])){
	if($_SESSION['scholarships'] == "active"){ $show_session_scholarships = 1; }
}
$show_session_envelopemaker = 0;
if(isset($_SESSION['envelopemaker'])){
	if($_SESSION['envelopemaker'] == "active"){ $show_session_envelopemaker = 1; }
}
$show_session_envelopemaker = 0;
if(isset($_SESSION['envelopemaker'])){
	if($_SESSION['envelopemaker'] == "active"){ $show_session_envelopemaker = 1; }
}
$show_session_request_bt = 0;
if(isset($_SESSION['request_bt'])){
	if($_SESSION['request_bt'] == "active"){ $show_session_request_bt = 1; }
}
$show_session_approve_bt = 0;
if(isset($_SESSION['approve_bt'])){
	if($_SESSION['approve_bt'] == "active"){ $show_session_approve_bt = 1; }
}
$show_session_provision_bt = 0;
if(isset($_SESSION['provision_bt'])){
	if($_SESSION['provision_bt'] == "active"){ $show_session_provision_bt = 1; }
} 
$show_session_insurers_report = 0;
if(isset($_SESSION['insurers_report'])){
	if($_SESSION['insurers_report'] == "active"){ $show_session_insurers_report = 1; }
} 
$show_session_exchange = 0;
if(isset($_SESSION['exchange'])){
	if($_SESSION['exchange'] == "active"){ $show_session_options = 1; $show_session_exchange = 1; }
}$show_session_cards = 0;
if(isset($_SESSION['cards'])){
	if($_SESSION['cards'] == "active"){ $show_session_options = 1; $show_session_cards = 1; }
}

$show_session_payments_report = 0;
if(isset($_SESSION['payments_report'])){
	if($_SESSION['payments_report'] == "active"){ $show_session_payments_report = 1; }
} 

$show_session_provision_global = 0;
if($_SESSION['provision_global'] == "active"){
	$show_session_provision_global = 1; 
} 

$show_session_releasing_special = 0;
if($_SESSION['releasing_special'] == "active"){
	$show_session_releasing_special = 1;  
} 

$show_session_special_payments_report = 0; 
if(isset($_SESSION['special_payments_report'])){
	if($_SESSION['special_payments_report'] == "active"){ $show_session_special_payments_report = 1; }
} 

$show_session_user_profiles_report = 0; 
if(isset($_SESSION['user_report'])){
	if($_SESSION['user_report'] == "active"){ $show_session_user_profiles_report = 1; }
} 

$show_session_auditor_report = 0; 
if(isset($_SESSION['auditor_report'])){
	if($_SESSION['auditor_report'] == "active"){ $show_session_auditor_report = 1; }
}
$show_session_globaltimes_report = 0; 
if(isset($_SESSION['globaltimes_report'])){
	if($_SESSION['globaltimes_report'] == "active"){ $show_session_globaltimes_report = 1; }
}
$show_session_refund_report = 0; 
if(isset($_SESSION['refund_report'])){
	if($_SESSION['refund_report'] == "active"){ $show_session_refund_report = 1; }
}
$show_session_providers_report = 0; 
if(isset($_SESSION['providers_report'])){
	if($_SESSION['providers_report'] == "active"){ $show_session_providers_report = 1; }
}
$show_session_provisionE1 = 0; 
if(isset($_SESSION['ppe1'])){
	if($_SESSION['ppe1'] == "active"){ $show_session_provisionE1 = 1; }
}
$show_session_iva = 0; 
if(isset($_SESSION['iva'])){
	if($_SESSION['iva'] == "active"){ $show_session_iva = 1; }
}
$show_session_frequest = 0; 
if(isset($_SESSION['frequest'])){
	if($_SESSION['frequest'] == "active"){ $show_session_frequest = 1; }
}
$show_session_fapprove = 0; 
if(isset($_SESSION['fapprove'])){
	if($_SESSION['fapprove'] == "active"){ $show_session_fapprove = 1; }
}
$show_session_fapprove2 = 0; 
if(isset($_SESSION['fapprove2'])){
	if($_SESSION['fapprove2'] == "active"){ $show_session_fapprove2 = 1; }
}
$show_session_followupAdmin = 0; 
if(isset($_SESSION['followupAdmin'])){
	if($_SESSION['followupAdmin'] == "active"){ $show_session_followupAdmin = 1; }
}
$show_session_followupUser = 0; 
if(isset($_SESSION['followupUser'])){
	if($_SESSION['followupUser'] == "active"){ $show_session_followupUser = 1; }
}
$show_session_banks = 0; 
$show_sessions_bankingDebt = 0;
if(isset($_SESSION['bankingDebt'])){
	if($_SESSION['bankingDebt'] == "active"){ $show_session_banks = 1; $show_session_options = 1; $show_sessions_bankingDebt = 1; }
}
$show_sessions_bankingDebtAccountant = 0;
if(isset($_SESSION['bankingDebtAccountant'])){
	if($_SESSION['bankingDebtAccountant'] == "active"){ $show_sessions_bankingDebtAccountant = 1; }
}
$show_electronic_payment_report = 0; 
if(isset($_SESSION['reportElectronicPayments'])){
	if($_SESSION['reportElectronicPayments'] == "active"){ $show_electronic_payment_report = 1; }
}
if($_SESSION['admin'] == "active"){ $show_electronic_payment_report = 1; }


$show_pip_report = 0; 
if(isset($_SESSION['pipReport'])){
	if($_SESSION['pipReport'] == "active"){ $show_pip_report = 1; }
}
$show_2FA = 0; 
if(isset($_SESSION['2FA'])){
	if($_SESSION['2FA'] == "active"){ $show_2FA = 1; $show_session_options = 1; }
}


##############################
#
#   #   ###   # #    #   #   #
#  # #  #  # # # #  #   # # #
# #   # ###  #   # #   #   #
#
###############################          

$show_session_admin = 0;
$show_mailer = 0;
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == "active"){ $show_mailer = 1; $show_session_options = 1; $show_session_admin = 1; $show_session_request2 = 1; }
}

?>

<style type="text/css" nonce="<?= $nonce ?>">
	.bDay{
		text-align:center; 
		padding-top:40px;
	}
</style>
<div class="page-sidebar-wrapper">



		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->

		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->

		<div class="page-sidebar navbar-collapse collapse"> 
        <div class="bDay">
			
<? 
			$cpBday = '2023-03-12';
			if(date('Y-m-d') >= $cpBday){
				$cpBdayImage = '../images/111.jpg';
			}else{
				$cpBdayImage = '../images/109.jpg';
			}
			$cpBdayImage = '../images/112.jpg';
			
?>   
<img src="<? echo $cpBdayImage; ?>" width="95%" class="sideAniversary"> 
<? //<img src="navidad/104.png" width="200px"> ?>
	</div> 
		
			

			<!-- BEGIN SIDEBAR MENU -->

			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">

				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->

				<li class="sidebar-toggler-wrapper"> 

					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

					<div class="sidebar-toggler">

					</div>

					<!-- END SIDEBAR TOGGLER BUTTON -->

				</li>

				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

				<li class="sidebar-search-wrapper hidden-xs">

					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->

					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->

					<?php /*<form class="sidebar-search" action="extra_search.html" method="POST">

						<a href="javascript:;" class="remove">

						<i class="icon-close"></i>

						</a>

						<div class="input-group">

							<input type="text" class="form-control" placeholder="Search...">

							<span class="input-group-btn">

							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>

							</span>

						</div>

					</form>*/ ?><br />&nbsp;

					<!-- END RESPONSIVE QUICK SEARCH FORM -->

				</li>


                

<?php //Dashboard ?>

<li class="<?php if($_SERVER['SCRIPT_NAME'] == '/admin/dashboard.php') echo 'active';?>">

					<a href="dashboard.php">

					<i class="icon-home"></i>

					<span class="title">Inicio</span>

					<span class="selected"></span> 

					</a>

				</li>
				
				
				
				<? if(($show_sessions_bankingDebt == 1) or ($show_sessions_bankingDebtAccountant == 1) or ($show_session_admin == 1)){ ?>
				
				<li class="">

					<a href="bankingDebt.php">	

					<i class="fa fa-money"></i>

					<span class="title">Deuda Bancaria</span>

					<span class="selected"></span> 

					</a>

				</li>
			
				<? } ?>
				
				<? if($_SESSION['email'] == 'jairovargasg@gmail.com'){ ?>
				
				<li class="">

					<a href="payments-consultations.php?form=1&provider=824&worker=&intern=&client=&requester=&request=&bill=&batch=&document=&ckpk=&from=&to=&stage2=&stage=&route=&company=&form=1">

					<i class="fa fa-money"></i>

					<span class="title">Mis Solicitudes</span>

					<span class="selected"></span> 

					</a>

				</li>
				
				<? } ?>
				
				
				
				
				<? /* if(($_SESSION['email'] == 'jairovargasg@gmail.com') or ($_SESSION['email'] == 'hgaitan@casapellas.com')){ ?>
				<li class="">

					<a href="payments-hc.php">

					<i class="fa fa-money"></i>

					<span class="title">Solicitudes CH</span>

					<span class="selected"></span> 

					</a>

				</li>
				
				<? } */ ?>
				
				<? if($show_session_admin == 1){ ?>
				
				<li class="">

					<a href="tools.php">

					<i class="icon-settings"></i>

					<span class="title">Herramientas</span>

					<span class="selected"></span> 

					</a>

				</li>


<?php 
				}
				
if($show_session_options == 1){ ?>
<li>

				
                 	<a href="javascript:;">

					<i class="icon-settings"></i>

					<span class="title">Opciones</span></a>

					<ul class="sub-menu">
						<?
						if(($show_session_admin == 1) or ($show_session_banks == 1)){  
						#$_SESSION['bankingDebt'] ?>
						<?php //Bancos ?>
              			<li>

							<a href="banks.php">

							Bancos</a>

						</li>
						<? } ?>
					<?php 
					if($show_session_admin == 1){ 
					?>
						
                       
						<?php //Beneficiarios ?>
                        <li>

							<a href="beneficiaries-approve.php">

							Beneficiarios</a>

						</li>	
						
                        <?php //Categorias ?>
                        <li>

							<a href="categories-edit.php?id=1">

							Categorías</a>

						</li>
                        <?php 
						}
						if(($show_session_admin == 1) or ($show_session_provider == 1)){
						?>
						
                        <li>

							<a href="clients.php">

							Clientes</a>

						</li>
						<? } 
						if($show_session_admin == 1){ 
						?>
                   		<?php //CONFIG ?> 
                        <li><a href="companies.php">Compañías</a></li>
                        <? #<li><a href="admin-config.php">Configuracion global</a></li> ?>
						<li><a href="email-accounts.php">Configuracion Correo</a></li>  
						<? } ?>
                        <?php //Documents 
						/* ?> 
                        <li>

							<a href="documents.php">

							Documentos</a>

						</li>*/ ?>
                        
						<?php //Fondo disponible 
						if($show_session_admin == 2){ ?>
                        <li>

							<a href="balance.php">Fondo disponible</a></li>
                        <?php
						}
						if($show_session_admin == 1){
						//Manejo de pagos ?>
                      	<li>

							<a href="lines.php">

							Lineas de Negocio</a>

						</li>
						<? } 
						
	if(($show_session_admin == 1) or ($show_session_treasury == 1)){ ?>
						
							<li>

							<a href="payment-management.php">

							Manejo de pagos</a>

						</li>
						<? }
	
						if($show_session_admin == 1){ ?>
                        <?php //Rechazos ?>
                       
						<li>

							<a href="rejections.php">

							Motivos de rechazos</a>

						</li>
                        <?php //Noticias ?>
                        <li>

							<a href="news.php">

							Noticias</a>

						</li>
                    <?php }  ?>	
					<?php 
					if(($show_session_admin == 1) or ($show_session_provider == 1)){ 
					?>
				
                  
						<?php //Planes de pago ?>
                        <li>

							<a href="interns.php">

							Pasantes</a>

						</li>
                        <li>

							<a href="payment-plans.php">

							Planes de Pago</a>

						</li>
						<?php //Proveedores ?>
                        <li>

							<a href="providers.php">

							Proveedores</a>

						</li>	
                   
                    <?php } ?>
                    
                    <?php 
	if(($show_session_admin == 1) or($show_session_routes == 1)){ 
						?>
                        <?php //Rutas de pago ?>
                        <li>

							<a href="routes.php">

							Perfiles de Usuario</a>

						</li>
					<? } ?>
					<?php 
	if($show_session_admin == 1){ 
						?>				
						<?php //Taza de cambio ?>
                        
                        <li>

							<a href="halls-home.php">

							Sucursales</a>

						</li>
                      	<li>

							<a href="standby.php">

							Standby</a>

						</li>
						<? } ?>  <?php 
	if(($show_session_admin == 1) or($show_session_cards == 1)){ 
						?>
                        <?php //Rutas de pago ?>
                        <li>

							<a href="credit-cards.php">

							Tarjetas de Crèdito</a>

						</li>
					<? } 
							if(($show_session_admin == 1) or ($show_session_exchange == 1)){ ?>	
                       	<li>
						
                        <a href="tc.php">

							Tipo de Cambio</a>  
						</li>
						<? } 
						if($show_session_admin == 1){ ?>
						<?php //Unidades de Negocio ?>
                        <li>

							<a href="units.php">

							Unid. de negocio</a>

						</li>
                        <?php //Usuarios ?>
                        <li>

							<a href="users.php">Usuarios</a>
                   		</li>
                    <?php } ?>
						
						
						<? if(($show_session_admin == 1) or ($show_2FA == 1)){ ?>
				
				
				<li class="">

					<a href="workers-2fa.php">

					

					<span class="title">2FA</span>

					<span class="selected"></span> 

					</a>

				</li>
				<? } ?>
    	
					</ul>

				</li>
<?php } ?>               
                

                
               
                
           <?php if(($show_session_admin == 1) or ($show_session_financemanager == 1)){ ?>
           <li>

				
                 	<a href="javascript:;">

					<i class="fa fa-desktop"></i>

					<span class="title">Vistas</span></a>

					<ul class="sub-menu">

				
						<?php //Alcaldias ?>
						 <? if($show_session_admin == 1){ ?>
              			<li>

							<a href="show-retentions-conficts.php">

							Alcaldías</a> 

						</li>
                        <li>

							<a href="show-retentions-imi-duplicated.php">

							IMI duplicado</a>

						</li>
                          <li>

							<a href="show-retentions-ir-duplicated.php">

							IR duplicado</a>

						</li>
                        <? } ?>
                         <li>

							<a href="analytics-ammount.php">

							Solicitudes/Montos</a>

						</li>
                         <? if($show_session_admin == 1){ ?>
						<li>

							<a href="show-expirated-payments-request.php">

							Ingresos vencidos</a>

						</li>
                       
                        
						<li>

							<a href="show-expirated-payments-insurers.php">

							Ingresos vencidos ASEG</a>

						</li>
                       
						<li>

							<a href="show-expirated-payments-request-un.php">

							Ingresos vencidos por UN</a>

						</li>
                    
						<li>

							<a href="show-expirated-payments-cancellations.php">

							Cancelaciones de solicitudes vencidas</a>

						</li>
						
                       <li>

							<a href="show-abs.php">

							Aprobados automáticos</a>

						</li>
					
                      
                          <li>

							<a href="show-approved-by-same-user.php">

							ERR Aprobados</a> 

						</li>
                       <? } ?>
                        
                    
                   
    	
					</ul>

				</li>
				     
		   <li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/analytics.php') echo 'active';?>">
			   <a href="analytics.php">
				   <i class="fa fa-sliders"></i>
				   <span class="title">Analytics</span>
			   </a>
			</li>

           <? } ?>          
           
           <? if(($_SESSION['email'] == 'jairovargasg@gmail.com') or ($_SESSION['email'] == 'hgaitan@casapellas.com')){ $show_sadmin = 1; }  ?>
           <?php if(($show_session_admin == 1) or ($show_session_financemanager2 == 1) or ($show_session_treasury == 1) or ($show_session_insurers_report == 1) or ($show_session_payments_report == 1) or ($show_session_special_payments_report == 1) or ($show_session_user_profiles_report == 1) or ($show_session_auditor_report == 1) or ($show_session_globaltimes_report == 1) or ($show_session_refund_report == 1) or ($show_session_providers_report == 1) or ($show_session_iva == 1) or ($show_electronic_payment_report == 1) or ($show_session_providerInfo == 1) or ($show_session_special_payments_report == 1) or ($show_pip_report == 1)){ ?>  

			<? if($show_sadmin == 1){ ?>
				<li>

                 	<a href="javascript:;">

					<i class="icon-settings"></i>

					<span class="title">Otros modulos</span></a>

					<ul class="sub-menu">
						<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/payments-monitor.php')) echo 'active';?>">
							<a href="payments-monitor.php">
								<i class="icon-magnifier"></i>
								<span class="title">Monitoreo de pagos</span>
							</a>
						</li> 
						<? if($show_session_request_bt == 1){
						//Transferencias Bancarias ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/letters.php') echo 'active';?>">
							<a href="letters.php">
								<i class="fa fa-file-text-o"></i>
								<span class="title">Transferencias Bancarias</span>
							</a>

						</li>
						<? } ?>
						<? if($rowConfig['cic'] == 1){ ?>
						<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/provisionCIC.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/provisionCICView.php')) echo 'active';?>">
							<a href="provisionCIC.php">
								<i class="icon-share-alt"></i>
								<span class="title">Provisión CIC</span>
							</a>
						</li> <? } ?>
						<?php if(($show_session_provisionE1 == 1) or ($show_session_admin == 1)){ ?>
						<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/provisionE1.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/provisionE1-view.php')) echo 'active';?>">
							<a href="provisionE1.php">
								<i class="icon-share-alt"></i>
								<span class="title">Provisión CIC Global</span>
							</a>
						</li> 
						<? } ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/provision-retentions-family.php') echo 'active';?>">
							<a href="provision-retentions-family.php">
								<i class="fa fa-users"></i>
								<span class="title">Familia de Ret.</span>
							</a>
						</li>
						<? if(($_SESSION['email'] == 'gramirez@casapellas.com.ni') or ($_SESSION['email'] == 'rsomarriba@casapellas.com') or ($_SESSION['email'] == 'vruiz@casapellas.com.ni') or ($_SESSION['email'] == 'mllopez@casapellas.com.ni') or ($_SESSION['email'] == 'ecastro@casapellas.com.ni') or ($_SESSION['email'] == 'jrlopez@casapellas.com.ni') or ($_SESSION['email'] == 'hgaitan@casapellas.com.ni') or ($_SESSION['email'] == 'jairovargasg@gmail.com')){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/provision-retentions-catalog.php') echo 'active';?>">
							<a href="provision-retentions-catalog.php">
								<i class="fa fa-list"></i>
								<span class="title">Catálogo de Ret.</span>
							</a>
						</li>
						<? } ?>
						<?php if(($show_session_releasing2 == 1)){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/releasing2.php') echo 'active';?>">
							<a href="releasing2.php">
								<i class="icon-rocket"></i>
								<span class="title">Aprobar liberación</span>
							</a>
						</li> 
						<?php } ?> 
						<?php if($show_session_treasury == 1){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/paymentScheduleBankGroup.php') echo 'active';?>">
							<a href="paymentScheduleBankGroup.php">
								<i class="icon-doc"></i>
								<span class="title">Archivos de Banco</span> 
							</a>
						</li> 
						<? } ?>
						<?php if($show_session_treasury == 1){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/jt.php') echo 'active';?>">
							<a href="jt.php">
								<i class="icon-grid"></i> 
								<span class="title">JT Beta (Solo vista/No procesar)</span>   
							</a>
						</li> 
						<? } ?>
						<?php if($show_session_payer == 1){ 
?>


						<? if($rowConfig['cic2'] == 1){ ?>	
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payablePaymentsCIC.php') echo 'active';?>">
							<a href="payablePaymentsCIC.php">
								<i class="icon-wallet"></i>
								<span class="title">Cancelación CIC</span> 
							</a>
						</li>
						<? } } ?>
						<?php if(($show_session_admin == 1) or ($_SESSION['email'] == 'rsomarriba@casapellas.com')){ ?> 
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/retentions-agcp.php') echo 'active';?>">
							<a href="retentions-agcp.php">
								<i class="icon-directions"></i>
								<span class="title">Retenciones AGCP</span> 
							</a>
						</li>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/show-payments-requested.php') echo 'active';?>">
							<a href="show-payments-requested.php">
								<i class="fa fa-info-circle"></i>
								<span class="title">Cantidad de Solicitudes</span> 
							</a>
						</li>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/show-payments-provisioned.php') echo 'active';?>">
							<a href="show-payments-provisioned.php">
								<i class="fa fa-info-circle"></i>
								<span class="title">Cantidad de Provisiones</span> 
							</a>
						</li>
						<? } ?>
						<? if($show_session_scholarships == 1){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/scholarships-report.php') echo 'active';?>">
							<a href="scholarships-report.php"> 
								<i class="icon-directions"></i>
								<span class="title">Reporte Becas</span> 
							</a>
						</li>
						<?php } ?> 
						<? if(($show_session_frequest == 1) or ($show_session_admin == 1)){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/funds-confirmatio.php') echo 'active';?>">
							<a href="funds-confirmation.php"> 
								<i class="icon-plus"></i>
								<span class="title">Solicitud CDF</span> 
							</a>
						</li>
						<? } ?>  
						<? if(($show_session_fapprove == 1) or ($show_session_admin == 1)){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/funds-approve.php') echo 'active';?>">
							<a href="funds-confirmation-approve.php"> 
								<i class="icon-check"></i>
								<span class="title">Aprobar CDF</span> 
							</a>
						</li>
						<? } if(($show_session_fapprove2 == 1) or ($show_session_admin == 1)){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/funds-approve2.php') echo 'active';?>">
							<a href="funds-confirmation-approve2.php"> 
								<i class="icon-check"></i>
								<span class="title">Conciliación CDF</span> 
							</a>
						</li>
						<? } ?>
						<? if(($show_session_followupAdmin == 1) or ($show_session_followupUser == 1) or ($show_session_admin == 1)){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/funds-approve2.php') echo 'active';?>">
							<a href="followUp.php"> 
								<i class="fa fa-bank"></i>
								<span class="title">Conciliaciones bancarias</span> 
							</a>
						</li>
						<? } ?> 
						
							<? if(($_SESSION['email'] == 'enavarro@casapellas.com') or ($_SESSION['email'] == 'hgaitan@casapellas.com') or ($_SESSION['email'] == 'mgutierrez@casapellas.com') or ($_SESSION['email'] == 'egutierrez@casapellas.com') or ($_SESSION['email'] == 'omiranda@casapellas.com') or ($_SESSION['email'] == 'rsomarriba@casapellas.com') or ($show_session_admin == 1)){ ?>
				<li class="">

					<a href="accountingAccountsTest.php">	

					<i class="icon-book-open"></i>

					<span class="title">Catálogo CTAS</span>

					<span class="selected"></span> 

					</a>

				</li>
				<? } ?>
				<? #esto iba con deuda bancaria. ?>
				<li class="">

					<a href="email-cancellation.php">	

					<i class="fa fa-envelope"></i>

					<span class="title">Email Cancelación</span>

					<span class="selected"></span> 

					</a>

				</li>
						
					</ul>	
						
				</li>
				
				
				<li>

                 	<a href="javascript:;">

					<i class="icon-settings"></i>

					<span class="title">Reportes [Beta]</span></a>

					<ul class="sub-menu">

						<? 
						if($show_session_admin == 1){ 
						?>
						<? #Panel de reportes ?> 
						<li>

							<a href="reportQualityControl.php">

							Pendiente CC</a> 

						</li>
						<li>

							<a href="reports-home.php">

							Panel de Reportes</a>

						</li>
                        <? #Gastos por categorías?>
                        <li>

							<a href="show-expenses-by-categories.php">

							Gastos por Categoría</a>

						</li>
						<? #Tiempos de tesorerias ?>	
				        <li>

							<a href="report-treasury-time.php">

							Tiempos de Tesorería</a>

						</li>
				        <? #Tiempos globales beta ?>
                        
						<? #Proveedores ?>
						<li>

							<a href="show-providers.php">

							Proveedores (min)</a>  

						</li>
						<? #Proveedores (Pagos) ?>
						<li> 

							<a href="show-providers-payments.php">

							Proveedores (Pagos)</a>  

						</li>
						<? #Proveedores (Montos) ?>
						<li> 

							<a href="show-providers-amount.php">

							Proveedores (Montos)</a>  

						</li>
						<? #Proveedores (Retenciones) ?>
						<li> 

							<a href="show-providers-retentions.php">

							Proveedores (Retenciones)</a>  

						</li>
						<? #Pagos rechazados ?>
						<li> 

							<a href="report-rejections.php"> 

							Pagos rechazados</a>  

						</li>
						<? #Pagos regresados ?>
                        <li> 

							<a href="report-returned.php"> 

							Pagos regresados</a>  

						</li>
						
						<? #Liberadores ?>
                        <li> 

							<a href="show-liberators.php">  

							Liberadores</a>  

						</li>
						<? } ?>
                        
                        
						<? if(($show_session_admin == 1) or ($show_session_refunds_report == 1)){ ?>
                         <li>
							 <a href="show-refunds.php">Devoluciones</a>  
						 </li>	 
                        <? }  
						if(($show_session_admin == 1) or ($show_session_iva == 1)){ ?>
                         <li>
							 <a href="showIva.php">IVA Crédito fiscal</a>  
						 </li>	 
                        <? }  
						if(($show_session_admin == 1) or ($show_session_providers_report == 1)){ ?>
                         <li> 
							<a href="providers-export.php">Proveedores <i class="fa fa-download"></i></a>  
                        <? } ?>
						
                        <? if(($show_session_admin == 1) or ($show_session_globaltimes_report == 1)){ ?>
                        <li>
							<a href="report-times.php">Tiempos Globales (Beta)</a> 
						</li>
				        <li>
							<a href="reports.php">General (Beta)</a> 
						</li>
                        <? } ?>
                        <? if(($show_session_admin == 1) or ($show_session_payments_report == 1)){ ?>
                        <li> 
							<a href="report-payments.php">Solicitudes de Pagos</a>   
						</li>
						<? }
						?>
                         <? if(($show_session_admin == 1) or ($show_session_special_payments_report == 1)){ ?>
                        <li> 
							<a href="report-special-payments-home.php">Pagos Especiales</a>  
						</li>
						<? }
						?>
                        <? if(($show_session_admin == 1) or ($show_session_user_profiles_report == 1)){ ?>
                        <li> 
							<a href="show-user-profile.php">Perfiles de Usuario</a>  
						</li>
						<? } 
                        if(($show_session_admin == 1) or ($show_session_auditor_report == 1)){ ?>
                        <li> 

							<a href="show-auditors-report.php">Auditores (Beta)</a>  

						</li>
						<? }
						?>
                        <? if(($show_session_admin == 1) or ($show_session_financemanager2 == 1) or ($show_session_insurers_report == 1)){ ?>
                        <li> 
							<a href="show-insurers.php">Aseguradoras</a>
						</li>
						<?  }
						?>
                        <?php if(($show_session_admin == 1) or ($show_session_treasury == 1)){ ?>
						<li> 
							<a href="report-schedule-approve.php">Ingreso a Banco</a>  
						</li>
						<li> 
							<a href="report-schedule-approve-un.php">Ingreso a Banco UN</a>  
						</li>
						<? } ?>
                        
                        <? if($show_electronic_payment_report == 1){ ?>
                        <li>
							 <a href="reportElectronicPayments.php">Pagos electrónicos</a>
						</li>
                        <? } ?>
                        
						</ul></li>
			<? } ?>
				<li>

				
                 	<a href="javascript:;">

					<i class="icon-settings"></i>

					<span class="title">Reportes</span></a>

					<ul class="sub-menu">

                     
						<? if(($show_session_admin == 1) or ($show_session_financemanager2 == 1) or ($show_session_insurers_report == 1)){ ?>
                        <li>
							<a href="show-insurers.php">Aseguradoras</a>  
						</li>
						<? } ?>
						<? if(($show_session_admin == 1) or ($show_session_auditor_report == 1)){ ?>
                        <li>
							<a href="show-auditors-report.php">Auditores (Beta)</a>  
						</li>
						<? } ?>
						<? if(($show_session_admin == 1) or ($show_session_refund_report == 1)){ ?>
                         <li>
							 <a href="reportRefunds.php">Devoluciones</a>  
						 </li>	 
                        <? }  ?>
						
						
						
						
						
						<? if(($show_session_admin == 1) or ($show_pip_report == 1)){ ?>
                         <li>
							 <a href="report-pip.php">Pagos en Proceso <i class="fa fa-download"></i></a>
						 </li>	 
                        <? } ?>
						
						
						<? if(($show_session_admin == 1) or ($show_session_providers_report == 1)){ ?>
                         <li>
							 <a href="providers-export.php">Proveedores <i class="fa fa-download"></i></a>
						 </li>	 
                        <? } ?>
						<? if(($show_session_admin == 1) or ($show_session_payments_report == 1)){ ?>
                        <li>
							<a href="report-payments.php">Solicitudes de Pagos</a>   
						</li>
						<? } ?>
						<? if(($show_session_admin == 1) or ($show_session_globaltimes_report == 1) or ($show_session_special_payments_report == 1)){ ?>
                        <li>
							<a href="report-times.php">Tiempos Globales (Beta)</a> 
						</li>
                        <? } ?>
                          <? if(($show_session_admin == 1) or ($show_electronic_payment_report == 1)){ ?>
                        <li>
							 <a href="reportElectronicPayments.php">Pagos electrónicos</a>
						</li>
                        <? } ?>
						<? if(($show_session_providerInfo == 1) or ($show_session_admin == 1)){ ?>
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/envelope-creator.php') echo 'active';?>">
							<a href="providers-info.php">
								<i class="fa fa-users"></i>
								<span class="title">Información de Proveedores</span> 
							</a>
						</li>
						<? } ?>	
                        
						</ul></li>
           <? } ?>
              
               
           <?php if($show_session_admin == 1){ ?>     
		   <?php if($_SESSION['email'] == 'jairovargasg@gmail.com'){ ?>
		   <li>

				
                 	<a href="javascript:;">

					<i class="icon-settings"></i>

					<span class="title">Dashboards Adicionales</span></a>

					<ul class="sub-menu">

						<li>

							<a href="dashboard-president.php">

							Presidente</a>

						</li>
                        <li>

							<a href="dashboard-generalmanager.php">

							Gerente General</a>

						</li>
                        <li>

							<a href="dashboard-financemanager.php">

							Gerente Financiero</a>

						</li>
                           <li>

							<a href="dashboard-treasurymanager.php">

							Jefe de Tesorería</a>

						</li>
                        <li>

							<a href="dashboard-manager.php">

							Gerente de Linea</a>

						</li>
                        
                         <li>

							<a href="dashboard-schedule.php">

							Encargado de Pagos</a>

						</li>
                        
                        
                        
                       
                       
                        
                        </ul></li> 
           <?php } ?>
                                                                                                    
                        
                        
                        
<?php }                        
if($show_session_consultation == 1){  
?>
<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/payments-consultations.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/payment-order-view.php')) echo 'active';?>">
					<a href="payments-consultations.php">

					<i class="icon-magnifier"></i> 

					<span class="title">Consultas de pagos</span>

					
 
					</a>
</li> 
<?php }                        
if(($_SESSION['email'] == 'jairovargasg@gmail.com') or ($_SESSION['email'] == 'hgaitan@casapellas.com')){  
?>

<?php } ?>
	
<?php if($show_session_file == 1){ 
?>
<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/files.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/visor.php')) echo 'active';?>">

					<a href="files.php" target="_blank">

					<i class="icon-folder"></i>

					<span class="title">Archivos</span>

					

					</a>

</li>
<?php }
?>
<?php if($show_session_request == 1){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payments.php') echo 'active';?>">

					<a href="payments.php">

					<i class="icon-basket"></i>

					<span class="title">Solicitudes de pagos</span>

					

					</a>

</li>
	
	
<?php } 
if($show_session_request2 == 1){ 
//Visto bueno de Solicitud
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payment-order-approve.php') echo 'active';?>">
	<a href="payment-order-approve.php">
		<i class="fa fa-circle-o"></i>
		<span class="title">Visto bueno de Solicitud</span>
	</a>
</li>
<?php }
if($show_session_spellas == 1){						
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/approve-spellas.php') echo 'active';?>"> 
<a href="approve-spellas.php">
<i class="fa fa-check-circle-o"></i>
<span class="title">Aprobar Devoluciones</span>
</a>
</li>
<? } ?>
<?php if(($show_session_approve1 == 1) or ($show_session_approve2 == 1) or ($show_session_approve3 == 1) or ($show_session_approve_bt == 1)){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/approve.php') echo 'active';?>"> 

					<a href="<?php
                    if($show_session_dch_spellas == 1){
						echo 'approve-special.php'; 
					}else{
						echo 'approve.php';
					} ?>">

					<i class="fa fa-check-circle-o"></i>

					<span class="title">Aprobar Solicitudes</span>

					

					</a>

</li>
<?php } 
?>
<?php if(($show_session_credit == 1) or ($show_session_admin == 1)){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/credit.php') echo 'active';?>">
	<a href="credit.php">
		<i class="fa fa-share-square-o"></i> 
		<span class="title">Liquidaciones</span>
	</a> 
</li> 
<? } ?>
<?php 
$provisionCounter = 0;
if(($show_session_provision == 1) or ($show_session_provision_bt == 1)){ $provisionCounter++; }  
if(($show_session_provision_global == 1)){ $provisionCounter++; }  
if($show_session_provision2 == 1){ $provisionCounter++; } ?>
<? if($provisionCounter > 1){  ?>
				<li class="<?php if(($_SERVER['SCRIPT_NAME'] == '/admin/provision-covid.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/provision-view-covid.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/provision-global.php')) echo 'active';?>">
					<a href="javascript:;">
						<i class="icon-share-alt"></i>
						<span class="title">Provisión</span></a>
					<ul class="sub-menu">
<? } ?>				
<?php if(($show_session_provision == 1) or ($show_session_provision_bt == 1)){  ?>
		
<? /*                 
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/provision.php') echo 'active';?>">

					<a href="provision.php">

					<i class="icon-share-alt"></i> 

					<span class="title">Provisionar Solicitudes</span>

					

					</a>

</li> 
                */ ?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/provision-covid.php') echo 'active';?>">
	<a href="provision-covid.php">
		<i class="icon-share-alt"></i> 
		<span class="title">Provisión COVID</span>
	</a>
</li> 
				
				

				
<? } ?>
              
<?php if(($show_session_provision_global == 1)){  
?>            
  <li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/provision-global.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/provision-global-view.php')) echo 'active';?>">

					<a href="provision-global.php">

					<i class="icon-share-alt"></i> 

					<span class="title">Provisión Global</span>

					</a>
                
 <? } ?>
<?php if($show_session_provision2 == 1){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/provision-approve.php') echo 'active';?>">

					<a href="provision-approve.php">

					<i class="icon-share-alt"></i> 

					<span class="title">Aprobar provisión</span>

					

					</a>

</li> 
<?php } ?> 
				
<? if($provisionCounter > 1){ ?>
			</ul>
		</li>
<? } ?>	
				
			
<?php if(($show_session_provision == 1) or ($show_session_provision_bt == 1) or ($show_session_request == 1)){  
?>                
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payments-packages.php') echo 'active';?>">

					<a href="payments-packages.php">

					<i class="fa fa-truck"></i>

					<span class="title">Remisiones</span>

					

					</a>

</li>
 
<?php } ?> 

				
				
<?php if(($show_session_releasing == 1) or ($show_session_releasing_special == 1)){
	$releasingCounter = 0;
	if($show_session_releasing == 1){ $releasingCounter++; }
	if($show_session_releasing_special == 1){ $releasingCounter++; }
	
	if($releasingCounter == 2){ ?>
				<li>
					<a href="javascript:;">
						<i class="fa fa-eye"></i>
						<span class="title">Liberación</span></a>
					<ul class="sub-menu">
	<? }
?>				
<?php if($show_session_releasing == 1){ ?>
<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/releasing-view.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/releasing.php')) echo 'active';?>">

					<a href="releasing.php">

					<i class="fa fa-eye"></i>

					<span class="title">Liberar pagos</span>

					

					</a>

</li> 
<?php } ?> 
<?php if($show_session_releasing_special == 1){ ?>
<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/releasing-special.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/releasing-special-view.php')) echo 'active';?>">

					<a href="releasing-special.php">

					<i class="fa fa-eye"></i>

					<span class="title">Liberación Especial</span>


					</a>

</li> 
<?php } ?>                 

<? if($releasingCounter == 2){ ?>
					</ul>
				</li>
<?	} ?>	
				
<? } ?>				
<?php if($show_session_paymentschedule == 1){ 
?>
<li>
	<a href="javascript:;">
		<i class="icon-size-actual"></i>
		<span class="title">Programación</span></a>
	<ul class="sub-menu">
		<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payment-schedule.php') echo 'active';?>">

					<a href="payment-schedule.php">

					<i class=" icon-size-actual"></i>

					<span class="title">Programar pagos</span>

					

					</a>

		</li> 
				
		<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payment-schedule-group.php') echo 'active';?>">

					<a href="payment-schedule-group.php">

					<i class=" icon-size-actual"></i>

					<span class="title">Grupos VoBo</span>

					

					</a>
	
		</li>
	</ul>
</li>
<? } ?>



<?php if($show_session_treasury == 1){ ?>

	<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payment-schedule-approve.php') echo 'active';?>">

					<a href="payment-schedule-approve.php">

					<i class="fa fa-bank"></i>

					<span class="title">Ingreso a Banco</span>   

					

					</a>

</li> 

 
<?php } ?> 
<?php /* if($_SESSION['financemanager'] == 'active'){ ?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/approve-cfo.php') echo 'active';?>">

					<a href="approve-cfo.php">

					<i class="fa fa-key"></i>

					<span class="title">Aprobado GF</span> 

					

					</a>

</li> 
<?php }*/ ?> 
<?php if(($show_session_financemanager == 1) or ($show_session_financemanager2 == 1)){ 
?>
<? /*<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/approve-rs-group.php') echo 'active';?>">

					<a href="approve-rs.php">

					<i class="fa fa-briefcase"></i> 

					<span class="title">Firmas Liberadoras</span> 

					

					</a>

</li> 
<?php */ } ?>  
<?php if($show_session_payer == 1){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/payable-payments.php') echo 'active';?>">

					<a href="payable-payments.php">

					<i class="icon-wallet"></i>

					<span class="title">Cancelación de pagos</span> 

					

					</a>

</li>

<?php } ?> 
<?php if($show_session_filereception == 1){   
?>
<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/reception-home.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/file-reception-records.php')) echo 'active'; ?>">

					<a href="reception-home.php">

					<i class="icon-drawer"></i>

					<span class="title">Recepción</span>

					

					</a>
                   </li>
<?php } ?>

<?php  if($show_session_filereview == 1){ 
?>
				<li>

                 	<a href="javascript:;">

					<i class="icon-like"></i>

					<span class="title">Control de Calidad</span></a>

					
					<ul class="sub-menu">
						
						<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/file-review.php') echo 'active';?>">
							<a href="file-review.php">
								<i class="icon-docs"></i>
								<span class="title">Ingreso de remisiones</span> 
							</a>
						</li>
						<li class="start <?php if(($_SERVER['SCRIPT_NAME'] == '/admin/file-review-detail.php') or ($_SERVER['SCRIPT_NAME'] == '/admin/file-review-detail-check.php')) echo 'active';?>">
							<a href="file-review-detail.php">
								<i class="icon-docs"></i>
								<span class="title">Revisión de archivos</span>  
							</a>
						</li>
					</ul>
				</li>
				<?php } ?> 
<?php if($show_session_filestorage == 1){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/file-management-consultations.php') echo 'active';?>">

					<a href="file-management-consultations.php">

					<i class="icon-magnifier"></i>

					<span class="title">Consultas</span>

					

					</a>

</li>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/file-management.php') echo 'active';?>">

					<a href="file-management.php">

					<i class="icon-docs"></i>

					<span class="title">Almacenamiento de archivos</span>

					

					</a>

</li> 
<?php } ?>
<?php  
if($show_session_retimi == 1){ ?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-imi2.php') echo 'active';?>">

					<a href="retentions-generator-imi2.php">

					<i class="fa fa-file-pdf-o"></i>

					<span class="title">Imprimir Ret IMI (SUC)</span> 

					

					</a>

</li> 
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/retentions-generator-ir2.php') echo 'active';?>"> 

					<a href="retentions-generator-ir2.php">

					<i class="fa fa-file-pdf-o"></i>

					<span class="title">Imprimir Ret IR</span> 

					

					</a>

</li>
<?php } ?> 



<?php 
if(($show_session_retentions == 1) or ($show_session_paymentschedule == 1)){ 
?>
<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/retentions-home.php') echo 'active';?>">

					<a href="retentions-home.php"> 

					<i class="icon-directions"></i>

					<span class="title">Retenciones</span> 

					

					</a>

</li>
<? } ?>
	
<?php   
if(($show_session_envelopemaker == 1) or ($show_session_admin == 1)){ ?>
			<li class="start <?php if($_SERVER['SCRIPT_NAME'] == '/admin/envelope-creator.php') echo 'active';?>">

					<a href="envelope-creator.php"> 

					<i class="fa fa-envelope"></i>

					<span class="title">Creacion de Sobres</span> 

					</a>

</li>
<?php }  ?>			
</ul>

			<!-- END SIDEBAR MENU -->
            
            <? /*if((date("Y-m-d") <= '2018-01-06')){ ?>
            <div style="text-align:center; padding-top:40px;">
   			<img src="navidad/penguin_scene.png" width="180px"></div>
			<? } */ ?>

		</div>

	</div>