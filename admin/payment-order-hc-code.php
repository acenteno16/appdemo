<? 

include("session-request.php");  
require('functions.php');

if(($_SESSION['request-7'] == 'active') or ($_SESSION['admin'] == 'active')){ 
	#doNothing
}else{
	exit('<script>alert("Error de persimos. Contactar al administrador."); window.location = "dashboard.php";</script>');
}

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = isset($_POST['id']) ? sanitizeInput($_POST['id'], $con) : '';

$querymain = "select * from payments where id = ?";
$stmtmain = $con->prepare($querymain);
$stmtmain->bind_param("i", $id);
$stmtmain->execute();
$resultmain = $stmtmain->get_result();
$rowmain = $resultmain->fetch_assoc();

if($rowmain['status'] != 0){
	header('location: dashboard.php');
	exit();
}

$queryHC = "select * from hc where payment = '$rowmain[id]'";
$resultHC = mysqli_query($con, $queryHC);
$numHC = mysqli_num_rows($resultHC);
if($numHC == 0){
	$queryInsertHC = "insert into hc (payment) values ('$rowmain[id]')";
	$resultInsertHC = mysqli_query($con,$queryInsertHC);
}else{
	$queryInsertHC = "update hc set hctype='0', ben='0', uTemplate='0', template='0', templateContent='', templateData='' where payment = '$rowmain[id]'";
	$resultInsertHC = mysqli_query($con,$queryInsertHC); 
}

$queryReset = "update payments set btype='0', parent='0', provider='0', collaborator='0', description='', ammount='0', payment='0', currency='0', notes='', routeid='', headship='', company='', distributable='0', globalpayment='0' where id = '$rowmain[id]'";
$resultReset = mysqli_query($con,$queryReset);

$user = sanitizeInput($_SESSION['userid'], $con);
$theroute = explode(',', sanitizeInput($_POST['theroute'], $con)); 
$route = $theroute[0];
$headship = $theroute[1];
$newbutton = sanitizeInput($_POST['newbutton'], $con);
$notes = sanitizeInput(addslashes($_POST['notes']), $con);
$stype = sanitizeInput($_POST['stype'], $con);
$collaborator = sanitizeInput($_POST['collaborator'], $con);
$provider = sanitizeInput($_POST['provider'], $con);
$description = sanitizeInput($_POST['description'], $con);

$billunits = sanitizeInput($_POST['billunits'], $con);
$billnumber = sanitizeInput($_POST['billnumber'], $con);
$billtoday = sanitizeInput($_POST['billtoday'], $con);
$billamount = sanitizeInput($_POST['billamount'], $con);
$hall = sanitizeInput($_POST['hall'], $con);

$totalbill = sanitizeInput(str_replace(',', '', $_POST['totalbill']), $con);
$currency = sanitizeInput($_POST['currency'], $con);
$file = sanitizeInput($_POST['file'], $con);
$description = sanitizeInput($_POST['description'], $con);
$notes = sanitizeInput($_POST['notes'], $con); 
$cut = sanitizeInput($_POST['cut'], $con);
$distributable = sanitizeInput($_POST['distributable'], $con);


$utemplate = 0;
$template = 0;
$globalPayment = 0;

/*

-Sigue el consecutivo de los pagos
-La provisión libera automaticamente el pago.
-El pago se marca como privado
-El pago se marca como hr
-Se crea un perfil de busqueda de pagos hr 
-Pagos seran VIP
rotulos de inss ir e inatec  
*/

$tc = 1;
if($currency == 2){
	$queryTc = "select * from tc where today = '$today'";
	$resultTc = mysqli_query($con, $queryTc);	
	$rowTc = mysqli_fetch_array($resultTc); 
	$tc = $rowTc['tc'];
}

$provider = sanitizeInput($_POST['provider'], $con);
$collaborator = sanitizeInput($_POST['collaborator'], $con);

$singleBill = 1;
$type = 3;
$concept = 17;

switch($stype){
	case 1:
		#ayudas economicas
		#$provider = '0';
		#$collaborator = $_POST['collaborator'];
		$btype = 2;
		break;
	case 2:
		#Embargos judiciales
		$uTemplates = $_POST['utemplates'];
		$utemplate = $_POST['uTemplate'];
		$template = $_POST['template'];
		$globalPayment = $totalbill;
		$btype = 1;
		
		break;
	case 3:
		#Pension alimenticia
		$uTemplates = $_POST['utemplates'];
		$utemplate = $_POST['uTemplate'];
		$template = $_POST['template'];
		$globalPayment = $totalbill;
		$btype = 1;
		break;
	case 4:
		#IR laboral
		$provider = '1944';
		$collaborator = '0';
		$btype = 1;
		break;
	case 5:
		#INSS laboral/patronal
		$provider = '2977';
		$collaborator = '0';
		$btype = 1; 
		$singleBill = 0;
		break;
	case 7:
		#INATEC
		$provider = '2972';
		$collaborator = '0';
		$btype = 1;
		$singleBill = 0;
		break;
	case 8:
		#Comisiones
		$btype = 2;
		break;
	case 9:
		#Horas extras
		$btype = 2;
		break;
	case 10:
		#Bonos
		$btype = 2;
		break;
	case 11:
		#Vacaciones
		$btype = 2;
		break;
	case 12:
		#Aguinaldo
		$btype = 2;
		break;
	case 13:
		#Prestamos
		$btype = 2;
		break;
	case 14:
		#Vacaciones
		$btype = 2;
		break;
	case 15:
		#Salarios
		$btype = 2;
		break;		
}

#$sAmount = sanitizeInput($_POST['sAmount'], $con);
#$tcid = sanitizeInput($_POST['tcid'], $con);
$sAmount = isset($_POST['sAmount']) ? sanitizeInput($_POST['sAmount'], $con) : [];
$tcid = isset($_POST['tcid']) ? sanitizeInput($_POST['tcid'], $con) : [];

if(sizeof($sAmount) > 0){
	for($d=0;$d<=sizeof($sAmount);$d++){
		$tData.="$tcid[$d]:$sAmount[$d],"; 
	}
	$tData = substr($tData,0,-1);
}

$queryUpdateHC = "UPDATE hc SET hctype = ?, uTemplate = ?, template = ?, templateData = ? WHERE payment = ?";
$stmtUpdateHC = $con->prepare($queryUpdateHC);
$stmtUpdateHC->bind_param("ssssi", $stype, $utemplate, $template, $tData, $id);
$stmtUpdateHC->execute();

$querycompany = "select * from units where id = ?";
$stmtcompany = $con->prepare($querycompany);
$stmtcompany->bind_param("s", $route);
$stmtcompany->execute();
$resultcompany = $stmtcompany->get_result();
$rowcompany = $resultcompany->fetch_assoc();
$company = $rowcompany['id'];

$query = "UPDATE payments 
          SET btype = ?, 
              parent = '0', 
              provider = ?, 
              collaborator = ?, 
              description = ?, 
              ammount = ?, 
              payment = ?, 
              currency = ?, 
              notes = ?, 
              routeid = ?, 
              headship = ?, 
              company = ?, 
              distributable = ?, 
              immediate = '1', 
              ncatalog = '1' 
          WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param(
    "ssssddsssissi",
    $btype,
    $provider,
    $collaborator,
    $description,
    $totalbill,
    $totalbill,
    $currency,
    $notes,
    $route,
    $headship,
    $company,
    $distributable,
    $id
);
$stmt->execute();

$queryPreDeleteBills = "update bills set ddelete='1' where payment = '$rowmain[id]'";
$resultPreDeleteBills = mysqli_query($con, $queryPreDeleteBills);

if($singleBill == 1){
	
	$queryBillCheck = "select id from bills where payment = '$rowmain[id]'";
	$resultBillCheck = mysqli_query($con, $queryBillCheck);
	$numBillCheck = mysqli_num_rows($resultBillCheck);
	if($numBill == 0){
		$queryBillInsert = "insert into bills (payment, dtype) values ('$rowmain[id]', '9')";
		$resultBillInsert = mysqli_query($con, $queryBillInsert);
		$billId = mysqli_insert_id($con);
	}else{
		$rowBillCheck = mysqli_fetch_array($resultBillCheck);
		$billId = $rowBillCheck['id'];
	}
	
	$nioammount = $totalbill*$tc;
	$uid = uniqid(); 
	$queryBills = "UPDATE bills 
               SET number = ?, 
                   ammount = ?, 
                   stotal2 = ?, 
                   type = ?, 
                   concept = ?, 
                   concept2 = ?, 
                   billdate = ?, 
                   billdate2 = ?, 
                   currency = ?, 
                   tc = ?, 
                   nioammount = ?, 
                   niostotal = ?, 
                   niobillpayment = ? 
               WHERE id = ?";
$stmtBills = $con->prepare($queryBills);
$stmtBills->bind_param(
    "sddsssssidddds", 
    $uid,          // number
    $totalbill,    // ammount
    $totalbill,    // stotal2
    $type,         // type
    $concept,      // concept
    $concept2,     // concept2
    $today,        // billdate
    $today,        // billdate2
    $currency,     // currency
    $tc,           // tc
    $nioammount,   // nioammount
    $nioammount,   // niostotal
    $nioammount,   // niobillpayment
    $billId        // id
);
$stmtBills->execute();
$stmtBills->close();
		
}
else{
	
	#Facturas multiple
	
	for($b=0;$b<sizeof($billunits);$b++){ 

		if(($billtoday[$b] == "") or ($billtoday[$b] == "0000-00-00")){ 
			//Do Nothing
		}else{
			$billtoday[$b] = date('Y-m-d', strtotime($billtoday[$b])); 
		}
	
		$nioammount = $billamount[$b];
		if($currency == 2){
			$querytc = "select * from tc where today = '$billdate[$b]'";
			$resulttc = mysqli_query($con, $querytc);	
			$rowtc = mysqli_fetch_array($resulttc); 
			$tc = $rowtc['tc']; 
			$nioammount = $billamount[$b]*$tc; 
		}
	
		$billcut = 0;
		if($billdate[$b] < $cut){
			$billcut = 1;
		} 

		if($billid[$b] == 0){
			
			#$queryBill = "insert into bills (payment, number, ammount, stotal2, type, concept, concept2, billdate, billdate2, currency, nioammount, niobillpayment, cut, dtype, unit, ddelete) values ('$id', '$billnumber[$b]', '$billamount[$b]', '$billamount[$b]', '3', '231', '$concept2', '$billtoday[$b]', '$billtoday[$b]', '$currency', '$nioammount', '$nioammount', '$billcut', '2', '$billunits[$b]', '0')"; 
			$queryBill = "INSERT INTO bills 
              (payment, number, ammount, stotal2, type, concept, concept2, billdate, billdate2, currency, nioammount, niobillpayment, cut, dtype, unit, ddelete) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmtBill = $con->prepare($queryBill);
			$thisBillPayment = $id;
			$thisBillNumber = $billnumber[$b];
			$thisBillAmount = $billamount[$b];
			$thisBillStotal2 = $billamount[$b]; // Repetido por diseño
			$thisBillType = 3; // Constante
			$thisBillConcept = 231; // Constante
			$thisBillConcept2 = $concept2; // Ya sanitizado
			$thisBillDate = $billtoday[$b];
			$thisBillDate2 = $billtoday[$b]; // Repetido por diseño
			$thisBillCurrency = $currency;
			$thisBillNioAmount = $nioammount;
			$thisBillNioPayment = $nioammount; // Repetido por diseño
			$thisBillCut = $billcut;
			$thisBillDtype = 2; // Constante
			$thisBillUnit = $billunits[$b];
			$thisBillDdelete = 0; // Constante
			
			$stmtBill->bind_param(
				"isddiisssiddsisi", 
				$thisBillPayment, 
				$thisBillNumber, 
				$thisBillAmount, 
				$thisBillStotal2, 
				$thisBillType, 
				$thisBillConcept, 
				$thisBillConcept2, 
				$thisBillDate, 
				$thisBillDate2, 
				$thisBillCurrency, 
				$thisBillNioAmount, 
				$thisBillNioPayment, 
				$thisBillCut, 
				$thisBillDtype, 
				$thisBillUnit, 
				$thisBillDdelete
			);


		}else{
			#$queryBill = "update  bills set number='$billnumber[$b]', ammount='$billamount[$b]', stotal2='$billamount[$b]', type='3', concept='231', concept2='', billdate='$billtoday[$b]', billdate2='$billtoday[$b]', currency='$currency', nioammount='$nioammount', niobillpayment='$nioammount', cut='$billcut', dtype='2', unit='$billunits[$b]' ddelete='0' where id = '$id'"; 
			$queryBill = "UPDATE bills 
              SET number = ?, 
                  ammount = ?, 
                  stotal2 = ?, 
                  type = '3', 
                  concept = '231', 
                  concept2 = '', 
                  billdate = ?, 
                  billdate2 = ?, 
                  currency = ?, 
                  nioammount = ?, 
                  niobillpayment = ?, 
                  cut = ?, 
                  dtype = '2', 
                  unit = ?, 
                  ddelete = '0' 
              WHERE id = ?";
			$stmtBill = $con->prepare($queryBill);

			// Asignación de valores con prefijo $thisBill
			$thisBillNumber = $billnumber[$b];
			$thisBillAmount = $billamount[$b];
			$thisBillStotal2 = $billamount[$b]; // Repetido por diseño
			$thisBillBilldate = $billtoday[$b];
			$thisBillBilldate2 = $billtoday[$b]; // Repetido por diseño
			$thisBillCurrency = $currency;
			$thisBillNioAmmount = $nioammount;
			$thisBillNioBillpayment = $nioammount; // Repetido por diseño
			$thisBillCut = $billcut;
			$thisBillUnit = $billunits[$b];
			$thisBillId = $id;

			// Vincular los parámetros
			$stmtBill->bind_param(
				"sddssiddssi", 
				$thisBillNumber, 
				$thisBillAmount, 
				$thisBillStotal2, 
				$thisBillBilldate, 
				$thisBillBilldate2, 
				$thisBillCurrency, 
				$thisBillNioAmmount, 
				$thisBillNioBillpayment, 
				$thisBillCut, 
				$thisBillUnit, 
				$thisBillId
			);
		}
	
		$stmtBill->execute();
		$stmtBill->close();
	}
	
}

$queryDeleteBills = "delete from bills where payment = '$rowmain[id]' and ddelete = '1'";
$resultDeleteBills = mysqli_query($con, $queryDeleteBills);

//Pre delete distribution
$queryPreDeleteDistribution = "update distribution set ddelete='1' where payment = '$rowmain[id]'";
$resultPreDeleteDistribution = mysqli_query($con, $queryPreDeleteDistribution);  
if($distributable == 1){
	
	$dunit = $_POST['dunit'];
	$dpercent = $_POST['dpercent'];
	$dtotal = $_POST['dtotal'];
	$did = $_POST['did'];
	
	for($c=0;$c<sizeof($dpercent);$c++){ 
		
		//Definimos que el pago se va a dristribuir
		$wdistribute = 1;
		//Si hace falta algun dato decimos que no ingresamos dicha distribucion
		if(($dunit[$c] == '') and ($dpercent[$c] == '') and ($dtotal[$c] == '')){
			$wdistribute = 0;
		}
		//Si el pago se va a distribuir procedemos.
		if($wdistribute == 1){
			
			$unitInfo = explode(',', $dunit[$c]);
			$thisunit = $unitInfo[0];
			$thisunitid = $unitInfo[1]; 
			
			if($did[$c] == 0){
				$querydistribution = "insert into distribution (payment, unit, unitid, percent, total, ddelete) values ('$id', '$thisunit', '$thisunitid', '$dpercent[$c]', '$dtotal[$c]', '0')";
			}
			else{
				$querydistribution = "update distribution set unit='$thisunit', unitid='$thisunitid', percent='$dpercent[$c]', total='$dtotal[$c]', ddelete='0' where id = '$did[$c]'"; 
			}
			$resultdistribution = mysqli_query($con, $querydistribution); 
		}	
	}
}
else{
	$querydistribution = "select * from distribution where payment = '$rowmain[id]'"; 
	$resultdistribution = mysqli_query($con, $querydistribution);
	$numdistribution = mysqli_num_rows($resultdistribution);
	if($numdistribution == 0){
		$stotalbill = isset($_POST['stotalbill']) ? sanitizeInput($_POST['stotalbill'], $con) : 0;
		$querydistribution = "insert into distribution (payment, unitid, percent, total) values ('$id', '$route', '100', '$stotalbill')"; 
		$resultdistribution = mysqli_query($con, $querydistribution);
	}
}

$queryDeleteDistribution = "delete from distribution where payment = '$rowmain[id]' and ddelete='1'";
$resultDeleteDistribution = mysqli_query($con, $queryDeleteDistribution);  

//Files
$fileid = isset($_POST['fileid']) ? sanitizeInput($_POST['fileid'], $con) : [];
$file = isset($_POST['file']) ? sanitizeInput($_POST['file'], $con) : [];

$querydeletef = "update files set deletefile = '1' where payment = '$rowmain[id]'";
$resultdeletef=mysqli_query($con, $querydeletef);
for($c=0;$c<sizeof($fileid);$c++) {
	if($file[$c] != ""){
		if($fileid[$c] == 0){
			$query32 = "insert into files (payment, link, deletefile) values ('$rowmain[id]', '$file[$c]', '0')";
		}else{
			$query32 = "update files set link='$file[$c]', deletefile='0' where id = '$fileid[$c]'";
		}
		$result32 = mysqli_query($con, $query32); 
	}	
}
$querydeletef2 = "delete from files where payment = '$rowmain[id]' and deletefile = '1'";
$resultdeletef2=mysqli_query($con, $querydeletef2); 

$fecha = date('Y-m-d'); 
$nuevafecha = strtotime ( '+3 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$expiration = $nuevafecha; 

$strParent = '';
if($template > 0){
	$strParent  = ", parent='3'";
}

$queryLast = "update payments set expiration='$expiration'$strParent where id = '$rowmain[id]'";
$resultLast = mysqli_query($con, $queryLast);  

if($newbutton == "draft"){ 
	exit("<script>window.location = 'payments-hc.php'; </script>"); 
}
else{	
	
	$queryroute = "select * from routes where unit = '$route' and headship = '$headship' and type = '20'";
	$resultroute = mysqli_query($con, $queryroute); 
	$numroute = mysqli_num_rows($resultroute);
	
	$arequest = 1;
	$arequest2 = "";

    if($numroute >0){
		$arequest = 0; 
		$arequest2 = " En espera de aprobado.";
	} 
	
	$query1 = "update payments set status = '1', arequest='$arequest', sent='1' where id = '$rowmain[id]'";
	$result1 = mysqli_query($con, $query1);
	
	#delete childs
	$query_delete_childs = "select * from payments where child = '$rowmain[id]'";
	$result_delete_childs = mysqli_query($con, $query_delete_childs);
	$num_delete_childs = mysqli_num_rows($result_delete_childs);
	if($num_delete_childs > 0){
		
		$gcomments_delete_childs = "El pago ha sido rechazado por el sistema. Pago hijo #$id_parent";	
		
		while($row_delete_childs=mysqli_fetch_array($result_delete_childs)){
			
			$query_delete_childs2 = "update payments set approved = '2', child ='0' where id = '$row_delete_childs[id]'";
			$result_delete_childs2 = mysqli_query($con, $query_delete_childs2);
			
			$query_delete_childs3 = "INSERT INTO times (payment, today, now, now2, userid, stage, comment, reason, reason2) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt_delete_childs3 = $con->prepare($query_delete_childs3);
			$payment = $row_delete_childs['id'];
			$stage = '7.13';
			$stmt_delete_childs3->bind_param(
				"issssssss", 
				$payment,                // payment
				$today,                  // today
				$now,                    // now
				$now2,                   // now2
				$_SESSION['userid'],     // userid
				$stage,                  // stage (float)
				$gcomments_delete_childs, // comment
				$reason,                 // reason
				$reason2                 // reason2
			);
			$stmt_delete_childs3->execute();
		}
		
		
	}
	
	//Times	
	$query2 = "INSERT INTO times (payment, today, now, now2, userid, stage, comment) 
           VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt2 = $con->prepare($query2);
	$stage = 1;
	$comment = "Pago Ingresado";
	$stmt2->bind_param("issssss", $id, $today, $now, $now2, $_SESSION['userid'], $stage, $comment);
	$stmt2->execute();
	
	$gcomments = "Enhorabuena, el paquete ha sido creado.";
	$querytime = "INSERT INTO senttimes (package, today, now, now2, userid, stage, comment) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmttime = $con->prepare($querytime);
	$stage = 1;
	$stmttime->bind_param("issssss", $id, $today, $now, $now2, $_SESSION['userid'], $stage, $gcomments);
	$stmttime->execute();
	
	if($template > 0){
		
		$bid = $_POST['bid'];
		
		for($p=0;$p<sizeof($bid);$p++){
			
			$thisAmount = str_replace(',','',$sAmount[$p]);
			$bidArr = explode(',',$bid[$p]);  
			if($currency == 2){
				$paymentNio = $thisAmount*$tc;
			}else{
				$paymentNio = $thisAmount;
			}
			
			if($p == 0){
				
				$queryParent = "UPDATE payments 
                SET today = ?, 
                    btype = ?, 
                    provider = ?, 
                    collaborator = ?, 
                    description = ?, 
                    ammount = ?, 
                    ammount2 = ?, 
                    currency = ?, 
                    payment = ?, 
                    paymentnio = ?, 
                    userid = ?, 
                    route = ?, 
                    headship = ?, 
                    headship2 = ?, 
                    notes = ?, 
                    distribution = ?, 
                    distributable = ?, 
                    stotal = ?, 
                    cut = ?, 
                    company = ?, 
                    zdescription = ?, 
                    expiration = ?, 
                    globalpayment = ?, 
                    sent = '1', 
                    mgmp = ?, 
                    arequest = ? 
                WHERE id = ?";

				$stmtParent = $con->prepare($queryParent);
				$stmtParent->bind_param(
					"sssssssssssssssssssssssssi", 
					$today, 
					$btype, 
					$provider, 
					$collaborator, 
					$description, 
					$thisAmount, 
					$thisAmount, 
					$currency, 
					$thisAmount, 
					$paymentNio, 
					$userid, 
					$route, 
					$headship, 
					$headship, 
					$notes, 
					$distributable, 
					$distributable, 
					$thisAmount, 
					$cut, 
					$company, 
					$description, 
					$expiration, 
					$globalPayment, 
					$currency, 
					$arequest, 
					$id
				);
				$stmtParent->execute();
				
			}
			elseif($p > 0){
				#insert childs
				$user = $_SESSION['userid'];
				
				if($thisAmount > 0){ 
				
					$queryChilds = "insert into payments (status, userid, child) values ('1', '$user', '$rowmain[id]')";
					$resultChilds = mysqli_query($con, $queryChilds);  
					$idChild = mysqli_insert_id($con);

					$queryChildsUpdate = "update payments set today='$today', btype='$btype', provider='$bidArr[0]', collaborator='$bidArr[1]', child='$rowmain[id]', description='$description', ammount='$thisAmount', ammount2='$thisAmount', currency='$currency', payment='$sAmount[$p]', paymentnio='$paymentNio', userid='$_SESSION[userid]', route='$route', headship='$headship', headship2='$headship', notes='$notes', distribution='$distributable', distributable='$distributable', stotal='$sAmount[$p]', cut='$cut', company='$company', zdescription='$description', expiration='$expiration', globalpayment='$globalPayment', sent='1', mgmp='$currency', arequest='$arequest', hc='1', immediate='1' where id = '$idChild'";
					$resultChildsUpdate = mysqli_query($con, $queryChildsUpdate);
				
					//Times	
					$queryChildsTimes = "INSERT INTO times (payment, today, now, now2, userid, stage, comment) 
                     VALUES (?, ?, ?, ?, ?, 1, 'Pago Ingresado')";
					$stmtChildsTimes = $con->prepare($queryChildsTimes);
					$stmtChildsTimes->bind_param(
						"isss",
						$idChild,
						$today,
						$now, 
						$now2 
					);
					$stmtChildsTimes->execute();  

					$gcomments = "Enhorabuena, el paquete ha sido creado.";
					$querytime = "INSERT INTO senttimes (package, today, now, now2, userid, stage, comment)
					VALUES (?, ?, ?, ?, ?, 1, ?)";
					$stmttime = $con->prepare($querytime);
					$stmttime->bind_param(
						"isssss", 
    					$idChild,   // package
						$today,     // today
						$now,       // now
						$now2,      // now2
						$_SESSION['userid'], // userid (alfanumérico)
						$gcomments  // comment
					);
					$stmttime->execute();
					
					if(($stype == 2) or ($stype == 3)){
					
						$queryWorkerFiles = "select * from hcfiles where collaborator = '$bidArr[1]'";
						$resultWorkerFiles = mysqli_query($con, $queryWorkerFiles);
						while($rowWorkerFiles=mysqli_fetch_array($resultWorkerFiles)){
							$queryInserFiles = "insert into files (payment, link, deletefile) values ('$rowmain[id]', '$rowWorkerFiles[$c]', '0')";
							$resultInsertFiles = mysqli_query($con, $queryInserFiles);
							
						}
		
					}	
					
				}
				
			}
			
			if(($stype == 2) or ($stype == 3)){
					
					$queryWorkerFiles = "select * from hcfiles where collaborator = '$bidArr[1]'";
					$resultWorkerFiles = mysqli_query($con, $queryWorkerFiles);
					while($rowWorkerFiles=mysqli_fetch_array($resultWorkerFiles)){
						$queryInserFiles = "insert into files (payment, link, deletefile) values ('$rowmain[id]', '$rowWorkerFiles[$c]', '0')";
						$resultInsertFiles = mysqli_query($con, $queryInserFiles); 
							
					}
		
				}
			
		}
		
	}

	include('function-getnext.php');
	getNext($rowmain['id'],'1'); 
	exit("<script>window.location = 'payment-order-view.php?id=$rowmain[id]'; </script>");
	
}

function cleanString($string){
	$newString = addslashes($string);
	return $newString;
}

?>