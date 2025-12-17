<?php include("sessions-reports-payments.php"); ?>
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
</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed page-quick-sidebar-over-content ">

<!-- BEGIN HEADER -->

<?php include("header.php"); ?>

<!-- END HEADER -->

<div class="clearfix"> </div>

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
        
        <h3 class="page-title"> Reportes
          <?php //<small>Ordenes de pago</small> ?>
        </h3>
        <ul class="page-breadcrumb breadcrumb">
          <li> <i class="fa fa-home"></i> <a href="dashboard.php">Inicio</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Reportes</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Solicitudes de Pagos</a> </li>
        </ul>
        
        <!-- END PAGE TITLE & BREADCRUMB--> 
        
      </div>
    </div>
    
    <!-- END PAGE HEADER--> 
    
    <!-- BEGIN PAGE CONTENT-->
    
    <div class="row">
      <div class="col-md-12"><!-- Begin: life time stats -->
        <form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
          <div class="note note-regular">
            <div class="row">
              <h4 style="margin-left:15px;">Filtro:</h4>
              <br>
              <? #No Solicitud ?>
              <div class="col-md-4 ">
                <div class="form-group">
                  <label>No. de Solicitud:</label>
                  <input name="request" type="text" class="form-control" id="request" value="<? echo $_GET['request']; ?>">
                  
                  <!--/row--> 
                  <!--/row--> 
                  <!--/row--> 
                  
                  <!--/row--></div>
              </div>
              <? #Rango de fechas ?>
              <div class="col-md-4" >
                <label class="control-label">Rango de Fechas: (Cancelación)</label>
                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                  <input type="text" class="form-control" name="from" placeholder="desde" value="<? echo $_GET['from']; ?>">
                  <span class="input-group-addon"> <i class="fa fa-angle-double-right"></i></span>
                  <input type="text" class="form-control" name="to" placeholder="hasta"  value="<? echo $_GET['to']; ?>">
                </div>
              </div>
              <? #proveedor ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Proveedor:</label>
                  <select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">
                    <option value="">Todos los Proveedores</option>
                    <?php
                    $queryproviders = "select * from providers order by name";
                    $resultproviders = mysqli_query( $con, $queryproviders );

                    while ( $rowproviders = mysqli_fetch_array( $resultproviders ) ) {

                      ?>
                    <option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['provider'] == $rowproviders['id']) echo 'selected'; ?> ><?php echo $rowproviders["code"]." | ".$rowproviders["name"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <? #Compañia ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Compañía:</label>
                  <select name="company" class="form-control  select2me" id="company" data-placeholder="Seleccionar...">
                    <option value="">Todas las compañias</option>
                    <?php
                    $querycompany = "select * from companies order by id";
                    $resultcompany = mysqli_query( $con, $querycompany );
                    while ( $rowcompany = mysqli_fetch_array( $resultcompany ) ) {
                      ?>
                    <option value="<?php echo $rowcompany["id"]; ?>" <? if($_GET['company'] == $rowcompany['id'])echo 'selected'; ?>><?php echo $rowcompany["name"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <? #PK ?>
              <div class="col-md-4 ">
                <div class="form-group">
                  <label>PK:</label>
                  <input name="cnumber" type="text" class="form-control" id="cnumber" value="<? echo $_GET['cnumber']; ?>">
                  
                  <!--/row--> 
                  <!--/row--> 
                  <!--/row--> 
                  
                  <!--/row--></div>
              </div>
              <? #No resultados ?>
              <div class="col-md-3 " >
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
            </div>
            <div class="row"> <br>
              <br>
              <div class="col-md-4">
                <input type="hidden" id="form" name="form" value="1">
                <button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>
                <button type="button" class="btn red" onClick="clearFilter();"> <i class="fa fa-filter"></i> Limpiar filtro</button>
                <script>
							function clearFilter(){
								window.location = "report-payments.php";
							}
							</script> 
              </div>
            </div>
          </div>
        </form>
        <div class="portlet">
          <div class="portlet-title">
            <div class="caption"> Resultados del filtro </div>
          </div>
          <div class="portlet-body">
            <?php

            $vars = array();
			$today = date( 'Y-m-d' );
            $tampagina = 50;
            $pagina = $_GET[ 'page' ];
            if ( !$pagina ) {
              $inicio = 0;
              $pagina = 1;
            } else {
              $inicio = ( $pagina - 1 ) * $tampagina;
            }

            $from = $_GET[ 'from' ];
            $to = $_GET[ 'to' ];
            $provider = $_GET[ 'provider' ];
            $request = $_GET[ 'request' ];
            $bill = $_GET[ 'bill' ];
            $paymenten = $_GET[ 'paymenten' ];
            $company = $_GET[ 'company' ];
            $immediate = $_GET[ 'immediate' ];
            $type = $_GET[ 'type' ];
            $concept = $_GET[ 'concept' ];
            $category = $_GET[ 'category' ];
            $tstage = 0;
			  
			

            $sql1 = "";
            if ( $from != "" ) {
              $from = date( "Y-m-d", strtotime( $from ) );
              $sql1 = " and times.today >= '$from'";
              $join_times = 1;
              $tstage = 1;
            }
            $sql2 = "";
            if ( $to != "" ) {
              $to = date( "Y-m-d", strtotime( $to ) );
              $sql2 = " and times.today <= '$to'";
              $join_times = 1;
              $tstage = 1;
            }
            $sql3 = "";
            if ( $tstage == 1 ) {
              $sql3 = " and (times.stage = '14' or times.stage = '14.02')";
              #Aqui estamos considerando los pagos cancelados "14", y los pagos cancelados en CIC "14.02"
            }

            $sql4 = "";
            if ( $provider != "" ) {
              $sql4 = " and payments.provider = '$provider'";
            }
            $sql5 = "";
            if ( $request != "" ) {
              $sql5 = " and payments.id = '$request'";
            }
            $sql6 = "";
            if ( $company != "" ) {
              $sql6 = " and payments.company = '$company'";
            }
            $sql7 = "";
            if ( $cnumber != "" ) {
              $sql7 = " and payments.cnumber = '$cnumber'";
            }


            //////////////////////
            ////////////////JOINS
            /////////////////////	
            $join1 = "";
            if ( $join_times == 1 ) {
              $join1 = " inner join times on payments.id = times.payment";
            }

            $sql = $sql1 . $sql2 . $sql3 . $sql4 . $sql5 . $sql6 . $sql7;
            $join = $join1;
			  
			  ?>
			  
			  <? if($_GET['form'] == 1){ ?>
              <form action="report-payments-excel.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sql" value="<? echo $sql; ?>">
                <input type="hidden" name="join" value="<? echo $join; ?>">
				  
				<input type="hidden" name="from" value="<? echo $_GET[ 'from' ]; ?>">
				  <input type="hidden" name="to" value="<? echo $_GET[ 'to' ]; ?>">
				  <input type="hidden" name="provider" value="<? echo $_GET[ 'provider' ]; ?>">
				  <input type="hidden" name="request" value="<? echo $_GET[ 'request' ]; ?>">
				  <input type="hidden" name="bill" value="<? echo $_GET[ 'bill' ]; ?>">
				  <input type="hidden" name="paymenten" value="<? echo $_GET[ 'paymenten' ]; ?>">
				  <input type="hidden" name="company" value="<? echo $_GET[ 'company' ]; ?>">
				  <input type="hidden" name="immediate" value="<? echo $_GET[ 'immediate' ]; ?>">
				  <input type="hidden" name="type" value="<? echo $_GET[ 'type' ]; ?>">
				  <input type="hidden" name="concept" value="<? echo $_GET[ 'concept' ]; ?>">
				  <input type="hidden" name="category" value="<? echo $_GET[ 'category' ]; ?>">
				  <input type="hidden" name="tstage" value="<? echo '0'; ?>">
				  
                <button type="submit" class="btn green"><i class="fa fa-file-excel-o"></i> Export to excel</button> 
              </form> 
              <?
              }
              ?>
			  
			  
			  <?

            $tampagina = 10;
            $pagina = $_GET[ 'page' ];
            if ( !$pagina ) {
              $inicio = 0;
              $pagina = 1;
            } else {
              $inicio = ( $pagina - 1 ) * $tampagina;
            }

            if ( $sql != '' ) {
              $query = "select payments.* from payments" . $join . " where payments.status >= '14'" . $sql . ' group by payments.id order by payments.id desc';
              //$result = mysqli_query($con, $query);
              $num = mysqli_num_rows( $result );
              $numdev = mysqli_num_rows( $result );
              $totpagina = ceil( $numdev / $tampagina );

              $query1 = "select payments.* from payments" . $join . " where payments.status >= '14'" . $sql . " group by payments.id order by payments.id limit " . $inicio . "," . $tampagina;
              //limit ".$inicio.",".$tampagina;  
              //$result1 = mysqli_query($con, $query1); 
              if ( $pagina < $totpagina )$next = $pagina + 1;
              if ( $pagina > 1 )$previous = $pagina - 1;

              if ( $_GET[ 'echo' ] == 1 ) {
                echo $query1 . "<br>";
              }

            }

            if ( $num > 0 ) {

              ?>
            Cantidad de solicitudes: <?php echo $num; ?><br>
            <div class="table-container">
              <div class="table-scrollable">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr role="row" class="heading">
                      <th width="3%"> IDS</th>
                      <th width="9%"> Solicitante&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th width="18%"> Compañia</th>
                      <th width="10%">UN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th width="16%">Proveedor/Colaborador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th width="16%">Monto</th>
                      <th width="16%">Moneda</th>
                      <th width="16%">Fecha de solicitud</th>
                      <th width="16%">Fecha de aprobado1</th>
                      <th width="16%">Tiempo en Aprobado1</th>
                      <th width="16%">Fecha de aprobado2</th>
                      <th width="16%">Tiempo en Aprobado2</th>
                      <th width="16%">Fecha de aprobado3</th>
                      <th width="16%">Tiempo en Aprobado3</th>
                      <th width="16%">Fecha de provisionado</th>
                      <th width="16%">Tiempo en Provisión</th>
                      <th width="16%">Fecha de liberación</th>
                      <th width="16%">Tiempo en Liberación</th>
                      <th width="16%">Fecha de Programación</th>
                      <th width="16%">Tiempo en Programación</th>
                      <th width="16%">Fecha de cancelación</th>
                      <th width="16%">Tiempo en Cancelación</th>
                      <th width="16%">Tiempo total de pago</th>
                      <? //<th width="16%">Fecha Archivado</th> ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    while ( $row = mysqli_fetch_array( $result1 ) ) {
                      //Provider/Colaborator

                      if ( $row[ 'btype' ] == 1 ) {
                        $rowprovider = mysqli_fetch_array( mysqli_query( $con, "select * from providers where id = '$row[provider]'" ) );
                        if ( $rowprovider[ 'flag' ] == 1 ) {
                          $flag = '<img src="../images/flag.png" width="13" alt=""/> ';
                        } else {
                          $flag = "";
                        }

                        $beneficiary = $flag . $rowprovider[ 'code' ] . " | " . $rowprovider[ 'name' ];
                      } else {
                        $rowprovider = mysqli_fetch_array( mysqli_query( $con, "select * from workers where id = '$row[collaborator]'" ) );
                        $beneficiary = $rowprovider[ 'code' ] . " | " . $rowprovider[ 'first' ] . " " . $rowprovider[ 'last' ];
                      }

                      $rowcurrency = mysqli_fetch_array( mysqli_query( $con, "select * from currency where id = '$row[currency]'" ) );
                      $rowtype = mysqli_fetch_array( mysqli_query( $con, "select * from categories where id = '$row[type]'" ) );
                      $rowconcept = mysqli_fetch_array( mysqli_query( $con, "select * from categories where id = '$row[concept]'" ) );
                      $rowconcept2 = mysqli_fetch_array( mysqli_query( $con, "select * from categories where id = '$row[concept2]'" ) );
                      $rowuser = mysqli_fetch_array( mysqli_query( $con, "select * from workers where code = '$row[userid]'" ) );
                      $rowcompany = mysqli_fetch_array( mysqli_query( $con, "select companies.name from companies where id = '$row[company]'" ) );
                      $rowmanager = mysqli_fetch_array( mysqli_query( $con, "select workers.* from routes inner join workers on routes.worker = workers.code where routes.unit='$rowuser[unit]' and routes.type = '14'" ) );


                      //TIMES

                      $query2 = "select * from times where payment = $row[id] order by stage asc";
                      $result2 = mysqli_query( $con, $query2 );
                      $num2 = mysqli_num_rows( $result2 );

                      $queryunit = "select * from units where (code = '$row[route]' or code2 = '$row[route]')";
                      $resultunit = mysqli_query( $con, $queryunit );
                      $rowunit = mysqli_fetch_array( $resultunit );
                      $unitname = $rowunit[ 'code' ] . " | " . $rowunit[ 'name' ];

                      $requestdate = 0;
                      $approve1date = 0;
                      $approve2date = 0;
                      $approve3date = 0;
                      $provisiondate = 0;
                      $releasingdate = 0;
                      $cancellationdate = 0;

                      while ( $row2 = mysqli_fetch_array( $result2 ) ) {
                        switch ( $row2[ 'stage' ] ) {
                          case "1":
                            $requestdate = $row2[ 'today' ];
                            break;
                          case "2":
                            $approve1date = $row2[ 'today' ];
                            break;
                          case "3":
                            $approve2date = $row2[ 'today' ];
                            break;
                          case "4":
                            $approve3date = $row2[ 'today' ];
                            break;
                          case "8":
                            $provisiondate = $row2[ 'today' ];
                            break;
                          case "8.01":
                            $provisiondate = $row2[ 'today' ];
                            break;
                          case "9":
                            $releasingdate = $row2[ 'today' ];
                            break;
                          case "12":
                            $scheduledate = $row2[ 'today' ];
                            break;
                          case "14":
                            $cancellationdate = $row2[ 'today' ];
                            break;
                        }
                      }


                      //Global time
                      if ( $cancellationdate != 0 ) {
                        $datea = $requestdate; //Request date
                        $dateb = $cancellationdate; //Approve1 date
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tglobal = $dias;
                      } else {
                        $tglobal = "NA";
                      }

                      //Approve1 Times
                      if ( $approve1date != 0 ) {
                        $datea = $requestdate; //Request date
                        $dateb = $approve1date; //Approve1 date
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tapprove1 = $dias . ' días';
                      } else {
                        $tapprove1 = "NA";
                      }

                      //Approve2

                      if ( $approve2date != 0 ) {
                        $datea = $approve1date; //Approve1 date
                        $dateb = $approve2date; //Approve2 date

                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tapprove2 = $dias . ' días';
                        $approve2 = 1;
                      } else {
                        $tapprove2 = 'NA';
                      }
                      //Approve3
                      //If approve3 isset
                      if ( $approve3date != 0 ) {
                        $datea = $approve2date; //Aprobado2
                        $dateb = $approve3date; //Aprpbado3
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tapprove3 = $dias . ' días';

                      } else {
                        $tapprove3 = "NA";
                      }

                      //Provision
                      $scheduleuser = "NA";
                      if ( $provisiondate != 0 ) {

                        $queryschedule1 = "select * from times where payment = '$row[id]' and stage = '12.00'";
                        $resultschedule1 = mysqli_query( $con, $queryschedule1 );
                        $numschedule1 = mysqli_num_rows( $resultschedule1 );
                        $rowschedule1 = mysqli_fetch_array( $resultschedule1 );

                        $scheduleuserid = $rowschedule1[ 'userid' ];

                        $queryschedule = "select * from workers where code = '$scheduleuserid'";
                        $resultschedule = mysqli_query( $con, $queryschedule );
                        $rowschedule = mysqli_fetch_array( $resultschedule );

                        $scheduleuser = $rowschedule[ 'first' ] . ' ' . $rowschedule[ 'last' ];
                        if ( $numschedule1 == 0 ) {
                          $scheduleuser = "NA";
                        }

                        if ( $approve1date != 0 ) {
                          $datea = $approve1date;
                        }
                        if ( $approve2date != 0 ) {
                          $datea = $approve2date;
                        }
                        if ( $approve3date != 0 ) {
                          $datea = $approve3date;
                        }
                        $dateb = $provisiondate; //Provision

                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tprovission = $dias . " días";

                      } else {
                        $tprovission = "NA";
                      }

                      //

                      //Releasing
                      if ( $releasingdate != 0 ) {
                        $datea = $provisiondate; //Provision date
                        $dateb = $releasingdate; //releasing date
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $treleasing = $dias . " días";

                      } else {
                        echo "NA";
                      }
                      //Schedule
                      if ( $scheduledate != 0 ) {
                        $datea = $releasingdate; //Releasing
                        $dateb = $scheduledate; //Schedule 
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tschedule = $dias;

                      }

                      //Schedule Approve
                      if ( isset( $stage[ $row[ 'id' ] ][ 13 ] ) ) {
                        $datea = $stage[ $row[ 'id' ] ][ 12 ]; //Schedule
                        $dateb = $stage[ $row[ 'id' ] ][ 13 ]; //Schedule Approve
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tschedulea = $dias;

                      }

                      //Cancellation 
                      if ( $cancellationdate != 0 ) {
                        $datea = $releasingdate; //Schedule Approve
                        $dateb = $cancellationdate; //Cancellation
                        $dias = ( strtotime( $datea ) - strtotime( $dateb ) ) / 86400;
                        $dias = abs( $dias );
                        $dias = floor( $dias );
                        $tcancellation = $dias;

                      }
                      //end times */

                      ?>
                    <tr role="row" class="odd">
                      <td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                      <td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td>
                      <td><?php echo $rowcompany[0]; ?></td>
                      <td><?php echo $unitname;  ?></td>
                      <td><?php echo $beneficiary; ?></td>
                      <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($row['payment'], 2)); ?></td>
                      <td><?php echo $rowcurrency['name']; ?></td>
                      <td><?php if($requestdate != 0){ echo date('d-m-Y',strtotime($requestdate)); }else{ echo "NA"; } ?></td>
                      <td><?php if($approve1date){ echo date('d-m-Y',strtotime($approve1date)); } else{ echo "NA"; }?></td>
                      <td><?php echo $tapprove1; ?></td>
                      <td><?php if($approve2date){ echo date('d-m-Y',strtotime($approve2date)); } else { echo "NA"; } ?></td>
                      <td><?php echo $tapprove2; ?></td>
                      <td><?php if($approve3date){ echo date('d-m-Y',strtotime($approve3date)); } else { echo "NA"; } ?></td>
                      <td><?php echo $tapprove3; ?></td>
                      <td><?php if($provisiondate){ $itprovission++; echo date('d-m-Y',strtotime($provisiondate)); } else { echo "NA"; } ?></td>
                      <td><?php
                      echo $tprovission;
                      $gtprovission += $tprovission;
                      ?></td>
                      <td><?php if($releasingdate){ $itreleasing++; echo date('d-m-Y',strtotime($releasingdate)); } else { echo "NA"; } ?></td>
                      <td><?php
                      echo $treleasing;
                      $gtreleasing += $treleasing;

                      ?></td>
                      <td><?php if($scheduledate){ $itschedule++; echo date('d-m-Y',strtotime($scheduledate)); } else { echo "NA"; } ?></td>
                      <td><?
                      echo $tschedule;
                      $gtschedule += $tschedule;
                      ?></td>
                      <td><?php if($cancellationdate){ $itcancellation++; echo date('d-m-Y',strtotime($cancellationdate)); } else { echo "NA"; } ?></td>
                      <td><?php
                      echo $tcancellation;
                      $gtcancellation += $tcancellation;
                      ?></td>
                      <? /*<td><?php echo $scheduleuser; ?></td>*/ ?>
                      <? //<td><?php //echo $stage[$row['id']][14]; </td>?>
                      <td><?php echo $tglobal; ?></td>
                    </tr>
                    <?php } ?>
                    <tr role="row" class="odd">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><?php echo number_format($gtapprove1/$itapprove1,2); ?></td>
                      <td></td>
                      <td><?php echo number_format($gtapprove2/$itapprove2,2); ?></td>
                      <td></td>
                      <td><?php echo number_format($gtapprove3/$itapprove3,2); ?></td>
                      <td></td>
                      <td><?php echo number_format($gtprovission/$itprovission,2); ?></td>
                      <td></td>
                      <td><?php echo number_format($gtreleasing/$itreleasing,2); ?></td>
                      <td></td>
                      <td><? echo number_format($gtschedule/$itschedule,2); ?></td>
                      <td></td>
                      <td><?php echo number_format($gtcancellation/$itcancellation,2); ?></td>
                      <? /*<td><?php echo $scheduleuser; ?></td>*/ ?>
                      <? //<td><?php //echo $stage[$row['id']][14]; </td>?>
                      <td><?php echo $tglobal; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <?php /* <a href="javascript:print();" class="btn default blue-stripe">Imprimir</a>*/ ?>
              <?
              /*<script>
								<a href="javascript:excel();" class="btn default green-stripe">Exportar a Excel</a>
								function excel(){
									window.open("report-times-excel.php?join=<? echo $join; ?>sql=<? echo $sql; ?>"); 
								}
								</script>*/
              ?>
              <?php }
			else{ ?>
              <?
              /*<div class="note note-danger">

						<p>

							<?php if($sql == ""){
                            	echo "NOTA: Ningún filtro aplicado.";
							}else{
								echo "NOTA: Ningún resultado con los filtros aplicados.";
							}
							?>
                                

						</p>

					</div>*/
              ?>
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

<script src="../assets/admin/pages/scripts/components-pickers.js"></script> 
<script src="../assets/admin/pages/scripts/table-managed.js"></script> 
<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();
TableManaged.init();


        });



</script> 

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
<script>
function reloadsconcept(nid){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	 document.getElementById("concept").innerHTML = data;
	});
	reloadsconcept2(0);
}

function reloadsconcept2(nid){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	 document.getElementById("concept2").innerHTML = data;
	});
	
}

</script>
</script>