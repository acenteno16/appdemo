  <? /*  <a href="#" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>

    <div class="page-quick-sidebar-wrapper">

        <div class="page-quick-sidebar">            

            <div class="nav-justified">

                <ul class="nav nav-tabs nav-justified">

                    <?php 
					#<li class="active">

                        #<a href="#quick_sidebar_tab_1" data-toggle="tab">

                       # Users <span class="badge badge-danger">2</span>

                        #</a>

                    #</li> ?>

                 
                </ul>

                <div class="tab-content">

                
                    <div class="tab-pane active page-quick-sidebar-alerts" id="quick_sidebar_tab_1">

                        <div class="page-quick-sidebar-alerts-list">

                            <h3 class="list-heading">Ayuda</h3>

                            <ul class="feeds list-items">
             
                                <?php if($show_session_request == 1){ ?>
                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            

                                            <div class="cont-col4">

                                                <div >

                                                     Como ingresar una solicitud de pago? <a href="help-payment-order.php"><span class="label label-sm label-info ">

                                                    Ver<i class="fa fa-share"></i>

                                                    </span></a>

                                                </div>
                                                
                                                

                                            </div>

                                        </div>

                                    </div>


                                </li>
                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            

                                            <div class="cont-col4">

                                                <div > 

                                                     Como ingresar una solicitud de pago (Devolucion)? <a href="help-payment-order-refund.php"><span class="label label-sm label-info ">

                                                    Ver<i class="fa fa-share"></i>

                                                    </span></a>

                                                </div>
                                                
                                                

                                            </div>

                                        </div>

                                    </div>


                                </li>
                                <?php } ?>
								<?php if(($show_session_approve1 == 1) or ($show_session_approve2 == 1) or ($show_session_approve3 == 1)){ ?>
                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            

                                            <div class="cont-col4">

                                                <div >

                                                     Como aprobar una solicitud de pago? <a href="help-payment-approve.php"><span class="label label-sm label-info ">

                                                    Ver<i class="fa fa-share"></i>

                                                    </span></a>

                                                </div>
                                                
                                                

                                            </div>

                                        </div>

                                    </div>


                                </li>
                                <?php } ?>
                                
                                 <?php 
								 //Recepcion de remisiones
								if($show_session_filereception == 1){ ?>
                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            

                                            <div class="cont-col4">

                                                <div >

                                                     Cómo ingresar una remisión? <a href="help-file-reception.php"><span class="label label-sm label-info ">

                                                    Ver<i class="fa fa-share"></i>

                                                    </span></a>

                                                </div>
                                                
                                                

                                            </div>

                                        </div>

                                    </div>


                                </li>
                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            

                                            <div class="cont-col4">

                                                <div >

                                                     Cómo entregar una remisión? <a href="help-file-reception-delivery.php"><span class="label label-sm label-info ">

                                                    Ver<i class="fa fa-share"></i>

                                                    </span></a>

                                                </div>
                                                
                                                

                                            </div>

                                        </div>

                                    </div>


                                </li>
                                <?php } ?>
                                
                            </ul>
                        </div>

                    </div>

                    <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_2"></div>

                </div>

            </div>

        </div>

    </div>
	*/ ?>