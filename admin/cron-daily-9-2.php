<?php

#ini_set( 'display_errors', 1 );
#ini_set( 'display_startup_errors', 1 );
#error_reporting( E_ALL );

require '/var/www/html/admin/connection.php';
require '/var/www/html/fn-pending.php';
require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'; 

//Notificaciones a aprobados.
$query = "select * from routes where ((type = '2') or (type = '3') or (type = '4')) group by worker";
$result = mysqli_query($con, $query );
$num = mysqli_num_rows( $result );
while ( $row = mysqli_fetch_array( $result ) ) {

  $queryworker = "select * from workers where code = '$row[worker]'";
  $resultworker = mysqli_query($con, $queryworker );
  $rowworker = mysqli_fetch_array( $resultworker );
  $workername = $rowworker[ 'first' ] . " " . $rowworker[ 'last' ];
  $workeremail = $rowworker[ 'email' ];

  $queryu = "select * from routes where worker = '$row[worker]' and (type = '2' or type = '3' or type = '4')";
  $resultu = mysqli_query($con, $queryu );
  $numu = mysqli_num_rows( $resultu );

  if ( $numu > 0 ) {
    $firstu = 1;
    while ( $rowu = mysqli_fetch_array( $resultu ) ) {
      $rowutype = intval( $rowu[ 'type' ] );
      $rowutype = $rowutype - 1;

      if ( $firstu == 1 ) { //First
        $sqlu = " and (((payments.status = '$rowutype') and (payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
        if ( $numu == 1 ) {
          $sqlu .= ")";
        }
        $firstu++;
      } elseif ( $firstu == $numu ) { //Last
        $sqlu .= " or ((payments.status = '$rowutype') and (payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]')))";
        $firstu++;
      } else { //Middle
        $sqlu .= " or ((payments.status = '$rowutype') and (payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
        $firstu++;
      }
    }
    $querybefore1 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.approved = '0' and payments.child='0'" . $sqlu . " group by payments.id order by payments.expiration desc";

    $resultbefore1 = mysqli_query($con, $querybefore1 );
    $numbefore1 = mysqli_num_rows( $resultbefore1 );
    $ids = "";
    $numbefore2 = 0;
    if ( $numbefore1 > 0 ) {
      while ( $rowbefore1 = mysqli_fetch_array( $resultbefore1 ) ) {

        if ( $rowbefore1[ 'route' ] > 0 ) {
          $ids .= $rowbefore1[ 0 ] . ', ';
          $numbefore2++;
        }

      }
      if ( $numbefore2 > 0 ) {

        fnPending( $workername, $workeremail, $numbefore1, $con);

      }


    }
  }

}

?>