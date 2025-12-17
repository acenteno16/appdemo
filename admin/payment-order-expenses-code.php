<?php 

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("session-request.php"); 
include('functions.php'); 

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$id_parent = $id;

$template_isset = $_POST['template_isset'];
if($template_isset != 1){
	echo "<script>alert('No se cargo la plantilla.'); history.go(-1);</script>";
	exit(); 
}

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$querymain = "select * from payments where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

if($rowmain['status'] != 0){
	header('location: dashboard.php');
	exit();
}


$user = sanitizeInput($_SESSION['userid'], $con);
$theroute = explode(',',$_POST['theroute']); 
$route = isset($theroute[0]) ? sanitizeInput(intval($theroute[0]), $con) : 0;
$headship = isset($theroute[1]) ? sanitizeInput(intval($theroute[1]), $con) : 0;

$notes = sanitizeInput($_POST['notes'], $con);
$file = sanitizeInput($_POST['file'], $con);
$currency = sanitizeInput($_POST['currency'], $con);
$zdescription = sanitizeInput($_POST['description'], $con);
$description = sanitizeInput($_POST['description'], $con); // Reusing description sanitized value
if($description == ""){
	echo "<script>alert('Ingresar una descripcion.'); history.go(-1);</script>";
	exit(); 
}

$totalbill_raw = str_replace(',', '', $_POST['totalbill']); // Remove commas
$totalbill = sanitizeInput($totalbill_raw, $con); // Sanitize the cleaned value
$collaborator = isset($_POST['collaborator']) ? sanitizeInput($_POST['collaborator'], $con) : [];
$collaborator_ammount = isset($_POST['collaborator_ammount']) ? sanitizeInput($_POST['collaborator_ammount'], $con) : [];

$collaborator_count = 0;
$collaborator_okay = 0;
for($c=0;$c<sizeof($collaborator);$c++){	
	if($collaborator[$c] != ""){
	 $collaborator_okay = 1;
	 $collaborator_count++;
	}
}
if($collaborator_okay == 0){
	echo "<script>alert('No se encontraron colaboradores.'); history.go(-1);</script>";
	exit();
}
if(($route == 0) or ($route == '') or ($route == null)){ 
	echo "<script>alert('Ingrese la ruta.'); history.go(-1);</script>";
	exit();
}

$querycompany = "SELECT companies.id 
                 FROM companies 
                 INNER JOIN units ON companies.code = units.companyCode 
                 WHERE units.id = ?"; 
$stmtcompany = $con->prepare($querycompany);
$stmtcompany->bind_param("s", $route);
$stmtcompany->execute();
$resultcompany = $stmtcompany->get_result();
$rowcompany = $resultcompany->fetch_assoc();
$company = $rowcompany['id'];

$template_save = sanitizeInput($_POST['template_save'], $con);
$template_name = sanitizeInput($_POST['template_name'], $con);

if($template_save == 1){
	$query_template = "insert into templatesexpenses (userid, name) values ('$_SESSION[userid]', '$template_name')";
	$result_template = mysqli_query($con, $query_template); 
	$template_id = mysqli_insert_id($con);
}


$payments_inc = 0;
$user = $_SESSION['userid'];
	
	//Aqui vamos a eliminar los hijos anteriores
	$query_delete_childs = "select * from payments where child = '$id_parent'";
	$result_delete_childs = mysqli_query($con, $query_delete_childs);
	$num_delete_childs = mysqli_num_rows($result_delete_childs);
	if($num_delete_childs > 0){
		
		$gcomments_delete_childs = "El pago ha sido rechazado por el sistema. Pago hijo #$id_parent";	
		
		while($row_delete_childs=mysqli_fetch_array($result_delete_childs)){
			
			$query_delete_childs2 = "update payments set approved = '2', child ='0' where id = '$row_delete_childs[id]'";
			$result_delete_childs2 = mysqli_query($con, $query_delete_childs2);
		
			$query_delete_childs3 = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$row_delete_childs[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '7.13', '$gcomments_delete_childs', '$reason', '$reason2')";
			$result_delete_childs3 = mysqli_query($con, $query_delete_childs3);
		}
		
		
	}
	
	for($i=0;$i<sizeof($collaborator);$i++){ 
	
		$str_child = "";
	
		if($payments_inc > 0){
	
			$query = "insert into payments (status, userid, child, ncatalog) values ('0', '$user', '$id_parent', '1')";
			$result = mysqli_query($con, $query);  
			$id = mysqli_insert_id($con);
			
			$str_child = "child='$id_parent', ";
	
		}
	
		$thebillc = date('d-m-y').'_'.$collaborator[$i];
		
		$tc = '1.0000';
		$ammount = $collaborator_ammount[$i];
		$ammount_int = str_replace(',','',$ammount);

		#$enletras = toLettes($ammount_int);
		$enletras = '';

		//INSER BILL
		$query_bill = "insert into bills (payment, number, ammount, stotal2, type, concept, concept2, billdate, billdate2, currency, tc, nioammount, niobillpayment, cut, dtype, letters) values ('$id', '$thebillc', '$ammount', '$ammount', '4', '183', '$concept2', '$today', '$today', '$currency', '$tc', '$ammount', '$ammount', '$billcut', '2', '$enletras')";
		$result_bill = mysqli_query($con, $query_bill);
		
		$fecha = date('Y-m-d'); 
		$nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		$expiration = $nuevafecha;
		
		//INSER PAYMENT
		$query = "update payments set today='$today', btype='2', collaborator='$collaborator[$i]', ".$str_child."description='$description', ammount='$floatstotal', ammount2='$floattotal', currency='$currency', payment='$ammount', paymentnio='$ammount', userid='$_SESSION[userid]', routeid='$route', headship='$headship', headship2='$headship', notes='$notes', distribution='$distributable', distributable='$distributable', stotal='$ammount', cut='$cut', company='$company', zdescription='$description', expiration='$expiration', globalpayment='$totalbill', sent='1', mgmp='$currency', ncatalog='1' where id = '$id'"; 
		$result = mysqli_query($con, $query);
		
		if($template_save == 1){
			$query_template_content = "insert into templatesexpensescontent (template, userid) values ('$template_id', '$collaborator[$i]')";
			$result_template_content = mysqli_query($con, $query_template_content);
		}
		
		$queryroute = "select * from routes where unitid = '$route' and headship = '$headship' and type = '20'";
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);

		$arequest = 1;
		$arequest2 = "";

		if(($numroute > 0) and ($headship > 0)){
		$arequest = 0; 
		$arequest2 = " En espera de aprobado."; 
		} 
	
		$query1 = "update payments set status = '1', arequest='$arequest', templateid='$template_id' where id = '$id'";
		$result1 = mysqli_query($con, $query1);
		
		//INSERT TIMES	
		$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Pago Ingresado')";
		$result2 = mysqli_query($con, $query2); 
		
		for($c=0;$c<sizeof($file);$c++){
			
			if($file[$c] != ""){
				$query_files = "insert into files (payment, link, deletefile) values ('$id', '$file[$c]', '0')";
				$result_files = mysqli_query($con, $query_files); 
			}
		} 
		
		$payments_inc++;
		
}

header('location: payment-order-view.php?id='.$id_parent);

?>