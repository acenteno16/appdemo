<?php 

require('session-request.php');
require('functions.php');
#require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'; 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

function parseMoney($s) {
    $s = trim((string)$s);
    // deja solo dígitos, punto, coma y signo
    $s = preg_replace('/[^\d.,\-]/', '', $s);

    $hasComma = strpos($s, ',') !== false;
    $hasDot   = strpos($s, '.') !== false;

    if ($hasComma && $hasDot) {
        // el separador decimal es el ÚLTIMO que aparezca
        $lastComma = strrpos($s, ',');
        $lastDot   = strrpos($s, '.');
        if ($lastComma > $lastDot) {
            // decimal = coma → quita puntos miles y cambia coma a punto
            $s = str_replace('.', '', $s);
            $s = str_replace(',', '.', $s);
        } else {
            // decimal = punto → quita comas de miles
            $s = str_replace(',', '', $s);
        }
    } elseif ($hasComma && !$hasDot) {
        // solo coma → trátala como decimal
        $s = str_replace('.', '', $s);
        $s = str_replace(',', '.', $s);
    } else {
        // solo punto o solo dígitos → quita comas por si acaso
        $s = str_replace(',', '', $s);
    }
    return (float)$s;
}

// Uso:
$amount = parseMoney($dtotal[$i]); // 224000.00

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$querymain = "select * from payments where id = ?";
$stmtmain = $con->prepare($querymain);
$stmtmain->bind_param("i", $id);
$stmtmain->execute();
$resultmain = $stmtmain->get_result();
$rowmain = $resultmain->fetch_assoc();

if($rowmain['status'] != 0){
	exit("<script>
	alert('El ID de la solicitud ya fue creado.');f
	window.location = 'payments.php';
	</script>");
}

$billCheck = isset($_POST['bill']) ? sanitizeInput($_POST['bill'], $con) : 0;
$duplicates = findDuplicates($billCheck);

if (!empty($duplicates)) {
	$duplicatesStr = implode(", ", $duplicates);
	echo "<script>
				alert('Se encontraron duplicados los siguientes documentos: $duplicatesStr'); 
				history.go(-1);
			</script>	
			";
		exit();	
}
$providerCheck = isset($_POST['provider']) ? sanitizeInput($_POST['provider'], $con) : '';
for($o=0;$o<sizeof($billCheck);$o++){
	$thisBill = sanitizeInput($billCheck[$o], $con);
	$qstr.=$queryBcheck = "select bills.payment from bills inner join payments on bills.payment = payments.id inner join providers on payments.provider = providers.id where bills.number = ? and providers.id = ? and payments.approved != '2' and payments.id != ?";
	$stmtBcheck = $con->prepare($queryBcheck);
	$stmtBcheck->bind_param("sii", $thisBill,$providerCheck,$id);
	$stmtBcheck->execute();
	$resultBcheck = $stmtBcheck->get_result();
	$numBcheck = $resultBcheck->num_rows;
	if($numBcheck > 0){
		while ($rowBcheck = $resultBcheck->fetch_assoc()){
			$pIds.= $rowBcheck['payment'].', ';
		}
		$pIds = substr($pIds,0,-2);
		echo "<script>
				alert('La factura no. $thisBill  aparece en el sistema vinculada a la solicitud(es): $pIds'); 
				history.go(-1);
			</script>	
			";
		exit();	

	}
}


$user = isset($_SESSION['userid']) ? sanitizeInput($_SESSION['userid'], $con) : '';
$theroute = explode(',',$_POST['theroute']); 
$route = isset($theroute[0]) ? sanitizeInput(intval($theroute[0]), $con) : 0;
$headship = isset($theroute[1]) ? sanitizeInput(intval($theroute[1]), $con) : 0;
$newbutton = isset($_POST['newbutton']) ? sanitizeInput($_POST['newbutton'], $con) : '';
$notes = isset($_POST['notes']) ? addslashes(sanitizeInput($_POST['notes'], $con)) : '';
$dspayment = isset($_POST['dspayment']) ? sanitizeInput($_POST['dspayment'], $con) : '';
$type = isset($_POST['type']) ? sanitizeInput($_POST['type'], $con) : '';
$concept = isset($_POST['concept']) ? sanitizeInput($_POST['concept'], $con) : '';
$concept2 = isset($_POST['concept2']) ? sanitizeInput($_POST['concept2'], $con) : '';
$description = isset($_POST['description']) ? addslashes(sanitizeInput($_POST['description'], $con)) : '';
$monitor = isset($_POST['monitor']) ? sanitizeInput($_POST['monitor'], $con) : '';

//Bill
$bill = isset($_POST['bill']) ? sanitizeInput($_POST['bill'], $con) : '';
$letters = isset($_POST['letters']) ? sanitizeInput($_POST['letters'], $con) : '';
$stotal = isset($_POST['stotal']) ? sanitizeInput($_POST['stotal'], $con) : '';
$stotal2 = isset($_POST['stotal2']) ? sanitizeInput($_POST['stotal2'], $con) : '';
$tax = isset($_POST['tax']) ? sanitizeInput($_POST['tax'], $con) : '';
$exempt = isset($_POST['exempt']) ? sanitizeInput($_POST['exempt'], $con) : '';
$exempt2 = isset($_POST['exempt2']) ? sanitizeInput($_POST['exempt2'], $con) : '';
$billdate = isset($_POST['billdate']) ? sanitizeInput($_POST['billdate'], $con) : '';
$billdate2 = isset($_POST['billdate2']) ? sanitizeInput($_POST['billdate2'], $con) : '';
$ammount = isset($_POST['ammount']) ? sanitizeInput($_POST['ammount'], $con) : '';
$billret1a = isset($_POST['ret1a']) ? sanitizeInput($_POST['ret1a'], $con) : '';
$billret2a = isset($_POST['ret2a']) ? sanitizeInput($_POST['ret2a'], $con) : '';
$inturammount = isset($_POST['inturammount']) ? sanitizeInput($_POST['inturammount'], $con) : '';
$inturammount2 = isset($_POST['inturammount2']) ? sanitizeInput($_POST['inturammount2'], $con) : '';
$nd = isset($_POST['nd']) ? sanitizeInput($_POST['nd'], $con) : '';
$immediate = isset($_POST['immediate']) ? sanitizeInput($_POST['immediate'], $con) : '';

//Bill Insurer
$ipolicy = isset($_POST['ipolicy']) ? sanitizeInput($_POST['ipolicy'], $con) : '';
$iquotaqq = isset($_POST['iquotaqq']) ? sanitizeInput($_POST['iquotaqq'], $con) : '';
$iquotano = isset($_POST['iquotano']) ? sanitizeInput($_POST['iquotano'], $con) : '';
$iquotaexpiration = isset($_POST['iquotaexpiration']) ? sanitizeInput($_POST['iquotaexpiration'], $con) : '';

//Globals
$ret1 = isset($_POST['retention1']) ? intval(sanitizeInput($_POST['retention1'], $con)) : 0;
$ret1a = isset($_POST['retention1ammount']) ? numberFormat(sanitizeInput($_POST['retention1ammount'], $con)) : '';
$ret2 = isset($_POST['retention2']) ? sanitizeInput($_POST['retention2'], $con) : '';
$ret2a = isset($_POST['retention2ammount']) ? numberFormat(sanitizeInput($_POST['retention2ammount'], $con)) : '';
$totalbill = isset($_POST['totalbill']) ? sanitizeInput($_POST['totalbill'], $con) : '';

// Float VARS
$payment = isset($_POST['floatpayment']) ? sanitizeInput($_POST['floatpayment'], $con) : '';
$paymentnio = isset($_POST['floatpaymentnio']) ? sanitizeInput($_POST['floatpaymentnio'], $con) : '';
$floatcurrency = isset($_POST['floatcurrency']) ? sanitizeInput($_POST['floatcurrency'], $con) : '';
$billid = isset($_POST['billid']) ? sanitizeInput($_POST['billid'], $con) : '';
$currency = isset($_POST['currency']) ? sanitizeInput($_POST['currency'], $con) : '';
$beneficiarie = isset($_POST['beneficiarie']) ? sanitizeInput($_POST['beneficiarie'], $con) : '';
$retainer = isset($_POST['retainer']) ? sanitizeInput($_POST['retainer'], $con) : '';
$retainer2 = isset($_POST['retainer2']) ? sanitizeInput($_POST['retainer2'], $con) : '';
$retainer3 = isset($_POST['retainer3']) ? sanitizeInput($_POST['retainer3'], $con) : '';
$retainer4 = isset($_POST['retainer4']) ? sanitizeInput($_POST['retainer4'], $con) : '';

$modrettype = isset($_POST['modrettype']) ? sanitizeInput($_POST['modrettype'], $con) : '';
$modrettoday = isset($_POST['modrettoday']) ? sanitizeInput($_POST['modrettoday'], $con) : '';
$modretno = isset($_POST['modretno']) ? sanitizeInput($_POST['modretno'], $con) : '';
$modretprovider = isset($_POST['modretprovider']) ? sanitizeInput($_POST['modretprovider'], $con) : '';
$modretaddress = isset($_POST['modretaddress']) ? sanitizeInput($_POST['modretaddress'], $con) : '';
$modretruc = isset($_POST['modretruc']) ? sanitizeInput($_POST['modretruc'], $con) : '';
$modretnid = isset($_POST['modretnid']) ? sanitizeInput($_POST['modretnid'], $con) : '';
$modretphone = isset($_POST['modretphone']) ? sanitizeInput($_POST['modretphone'], $con) : '';
$modretconcept = isset($_POST['modretconcept']) ? sanitizeInput($_POST['modretconcept'], $con) : '';
$modretbills = isset($_POST['modretbills']) ? sanitizeInput($_POST['modretbills'], $con) : '';
$modrettotalbill = isset($_POST['modrettotalbill']) ? sanitizeInput($_POST['modrettotalbill'], $con) : '';
$modretpercent = isset($_POST['modretpercent']) ? sanitizeInput($_POST['modretpercent'], $con) : '';
$modrettotalretention = isset($_POST['modrettotalretention']) ? sanitizeInput($_POST['modrettotalretention'], $con) : '';
$modretelaborator = isset($_POST['modretelaborator']) ? sanitizeInput($_POST['modretelaborator'], $con) : '';
$cc = isset($_POST['cc']) ? sanitizeInput($_POST['cc'], $con) : '';
$solvency = isset($_POST['solvency']) ? date("Y-m-d", strtotime(sanitizeInput($_POST['solvency'], $con))) : '';
$ncatalog = isset($_POST['ncatalog']) ? sanitizeInput($_POST['ncatalog'], $con) : '';
$provider = isset($_POST['provider']) ? sanitizeInput($_POST['provider'], $con) : 0;

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$distributable = isset($_POST['distributable']) ? sanitizeInput($_POST['distributable'], $con) : '';

if(($dspayment == 0) and ($newbutton == "save")){
	exit("<script>
	alert('Usted debe de seleccionar un tipo de beneficiario de pago. (CODE)');
	history.go(-1) ; 
	</script>");
}
if($dspayment == 1){
	
	
	$collaborator = 0;

	if(($provider == "") and ($newbutton == "save")){ 
		exit("<script>
		alert('Usted debe de seleccionar un Proveedor. (CODE)');
		history.go(-1);
		</script>");	
	}
	
	$queryprovider = "SELECT * FROM providers WHERE id = ?";
	$stmtprovider = $con->prepare($queryprovider);
	$stmtprovider->bind_param("i", $provider);
	$stmtprovider->execute();
	$resultprovider = $stmtprovider->get_result();
	$rowprovider = $resultprovider->fetch_assoc();

	
}
if($dspayment == 2){
	$collaborator = $_POST['collaborator'];
	$provider = 0;  
	if(($collaborator == "") and ($newbutton == "save")){ 
		exit("<script>
		alert('Usted debe de seleccionar un Colaborador. (CODE)');
		history.go(-1);
		</script>");
	}
}
if(($description == "") and ($newbutton == "save")){
	exit("<script> 
		 alert('Usted debe de ingresar una descripcion. (CODE)');
		 history.go(-1);
		 </script>");
}
if(($theroute[0] == 0) and ($newbutton == "save")){
	exit("<script> 
		 alert('Usted debe de ingresar una ruta. (CODE)');
		 history.go(-1);
		 </script>");
}
if(($payment <= 0) and ($newbutton == "save")){
	exit("<script> 
	alert('El monto no puede ser igual a cero. (CODE)');
	history.go(-1);
	</script>");
}
//Comprobar facturas
if(($provider > 0) and ($newbutton == "save")){
    
    $billErr = 0;
    $billErrStr = "";
    
    for($tb=0;$tb<sizeof($bill);$tb++){
        
        $queryThisBill = "SELECT payments.id 
                  FROM bills 
                  INNER JOIN payments ON bills.payment = payments.id 
                  WHERE payments.provider = ? 
                  AND bills.number = ? 
                  AND payments.id != ? 
                  AND payments.status > 0 
                  AND payments.approved != 2";
		$stmtThisBill = $con->prepare($queryThisBill);
		$stmtThisBill->bind_param("isi", $provider, $bill[$tb], $id);
		$stmtThisBill->execute();
		$resultThisBill = $stmtThisBill->get_result();
		$numThisBill = $resultThisBill->num_rows;

		if ($numThisBill > 0) {
    		$rowThisBill = $resultThisBill->fetch_array();
    		$billErr++;
    		$billErrStr .= " Documento No. $bill[$tb] en IDS: $rowThisBill[0], ";
		}

        
    }
    
    if($billErr > 0){
        $billErrStr = substr($billErrStr,0,-2);
		$billErrStr = sanitizedOutput($billErrStr);
        exit("<script>alert('Error con Documento(s) repetidos: $billErrStr (CODE)');history.go(-1);</script>");
    }
   
}

//Delete distribution
$querydd = "UPDATE distribution SET ddelete = 1 WHERE payment = ?";
$stmtdd = $con->prepare($querydd);
$stmtdd->bind_param("i", $id);
$stmtdd->execute();
$stmtdd->close();
 
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
			
			$thisDtotal =  parseMoney($dtotal[$c]);
			
			if($did[$c] == 0){
				$querydistribution = "insert into distribution (payment, unit, unitid, percent, total, ddelete) values ('$id', '$thisunit', '$thisunitid', '$dpercent[$c]', '$thisDtotal', '0')";
			} 
			else{
				$querydistribution = "update distribution set unit='$thisunit', unitid='$thisunitid', percent='$dpercent[$c]', total='$thisDtotal', ddelete='0' where id = '$did[$c]'"; 
			} 
			$resultdistribution = mysqli_query($con, $querydistribution);
			 
		}	
	}
}
else{
	
	$querydistribution = "select * from distribution where payment = '$id'"; 
	$resultdistribution = mysqli_query($con, $querydistribution);
	$numdistribution = mysqli_num_rows($resultdistribution);
	if($numdistribution == 0){
		$querydistribution = "insert into distribution (payment, unitid, percent, total)o values ('$id', '$route', '100', '$gstotald')"; 
		$resultdistribution = mysqli_query($con, $querydistribution);
	} 
	
	
}

$querydd2 = "DELETE FROM distribution WHERE payment = ? AND ddelete = 1";
$stmtdd2 = $con->prepare($querydd2);
$stmtdd2->bind_param("i", $id);
$stmtdd2->execute();
$stmtdd2->close();

//Always UPDATE because payment has an id 
$floatammount2 = isset($_POST['floatammount2']) ? sanitizeInput($_POST['floatammount2'], $con) : '';
$nftotalbill = numberFormat($totalbill);
$nfret1a = numberFormat($ret1a);
$nfret2a = numberFormat($ret2a);
$nfpayment = numberFormat($payment);
$nfpayment2 = numberFormat($paymentnio);
$ammount2 = numberFormat($floatammount2);

$gstotald = isset($_POST['stotalbill']) ? str_replace(',', '', sanitizeInput($_POST['stotalbill'], $con)) : '';
$cut = isset($_POST['cut']) ? sanitizeInput($_POST['cut'], $con) : '';

//Get the Company (Route based)
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
$stmtcompany->close();

//get the mgmp
$mgmp = 4;
if(($floatcurrency == 1) and ($currency == 1)){
	$mgmp = "1";
}
//Dolares-Dolares
if(($floatcurrency == 2) and ($currency == 2)){
	$mgmp = "2";
}
//Dolares-Cordobas
if(($floatcurrency == 1) and ($currency == 2)){
	$mgmp = "3";
}

// Preparar la consulta
$query = "UPDATE payments SET
    today = ?,
    btype = ?,
    provider = ?,
    collaborator = ?,
    description = ?,
    ammount = ?,
    ammount2 = ?,
    currency = ?,
    ret1 = ?,
    ret1a = ?,
    ret2 = ?,
    ret2a = ?,
    payment = ?,
    paymentnio = ?,
    userid = ?,
    beneficiarie = ?,
    routeid = ?,
    headship = ?,
    headship2 = ?,
    retainer = ?,
    notes = ?,
    distribution = ?,
    distributable = ?,
    acp = ?,
    acp2 = ?,
    stotal = ?,
    manualrets = ?,
    cut = ?,
    company = ?,
    immediate = ?,
    mgmp = ?,
    cc = ?,
    monitor = ?,
    solvencyExpiration = ?,
    ncatalog = ?
WHERE id = ?";
$stmt = $con->prepare($query);
#35 bind
$stmt->bind_param(
    "siiisddiddddddsiiiiisiiiidisiiiiisii",
    $today,
    $dspayment,
    $provider,
    $collaborator,
    $description,
    $nftotalbill,
    $ammount2,
    $floatcurrency,
    $ret1,
    $nfret1a,
    $ret2,
    $nfret2a,
    $nfpayment,
    $nfpayment2,
    $_SESSION['userid'],
    $beneficiarie,
    $route,
    $headship,
    $headship,
    $retainer,
    $notes,
    $distributable,
    $distributable,
    $retainer2,
    $retainer3,
    $gstotald,
    $retainer4,
    $cut,
    $company,
    $immediate,
    $mgmp,
    $cc,
    $monitor,
    $solvency,
    $ncatalog,
    $id
);
$stmt->execute();
$stmt->close();

//Start Billing write or Update
$ammount = sanitizeInput($_POST['ammount'], $con);
$stotal2 = sanitizeInput($_POST['stotal2'], $con);
$dtype = sanitizeInput($_POST['dtype'], $con);

$querydeletebill = "DELETE FROM bills WHERE payment = ?";
$stmtdeletebill = $con->prepare($querydeletebill);
$stmtdeletebill->bind_param("i", $id);
$stmtdeletebill->execute();

for($c = 0; $c < sizeof($ammount); $c++){
	
	$billdate[$c] = date("Y-m-d", strtotime($billdate[$c]));
	$billdate2[$c] = date("Y-m-d", strtotime($billdate2[$c]));
	$iquotaexpiration[$c] = date("Y-m-d", strtotime($iquotaexpiration[$c]));
			
	$tc = 1;
	if($currency == 2){
		$querytc = "select * from tc where today = '$billdate[$c]'";
		$resulttc = mysqli_query($con, $querytc);
		$rowtc = mysqli_fetch_array($resulttc); 
		$tc = $rowtc['tc']; 
	}
			
	//Bills
	$nfbillpayment = 0; 
	$nfammount = numberFormat($ammount[$c]); 
	$nfstotal = numberFormat($stotal[$c]);
	$nfstotal2 = numberFormat($stotal2[$c]);
	$nftax = numberFormat($tax[$c]);
	$nfintur = numberFormat($inturammount[$c]);
	$nfinturammount = numberFormat($inturammount2[$c]);
	$nfexempt = numberFormat($exempt[$c]);
	$nfexempt2 = numberFormat($exempt2[$c]);
			
	//Retentions
	$nfftotal1 = numberFormat($billret1a[$c]);
	$nfftotal2 = numberFormat($billret2a[$c]);
			
	$nfbillpayment = numberFormat($ammount[$c])-numberFormat($billret1a[$c])-numberFormat($billret2a[$c]);
			
	//NIO
	$nfnioammount = $nfammount*$tc;
	$nfniostotal = $nfstotal*$tc;
	$nfniostotal2 = $nfstotal2*$tc;
	$nfniotax = $nftax*$tc;
	$nfniointurammount = $nfinturammount*$tc;
	$nfniobillpayment = $nfbillpayment*$tc;
			
	$billcut = 0;
	if($billdate[$c] < $cut){
		$billcut = 1;
	}
	
	$thebillc = addslashes($bill[$c]);  
	
	
	// Asignar valores de expresiones a variables
$letters_c = $letters[$c];
$type_c = $type[$c];
$concept_c = $concept[$c];
$concept2_c = $concept2[$c];
$billdate_c = $billdate[$c];
$billdate2_c = $billdate2[$c];
$nd_c = $nd[$c];
$dtype_c = $dtype[$c];
$ipolicy_c = $ipolicy[$c];
$iquotaqq_c = $iquotaqq[$c];
$iquotano_c = $iquotano[$c];
$iquotaexpiration_c = $iquotaexpiration[$c];

// Preparar la consulta y vincular parámetros
$query1 = "INSERT INTO bills (payment, number, ammount, letters, stotal, stotal2, tax, intur, inturammount, exempt, exempt2, type, concept, concept2, billdate, billdate2, ret1, ret1a, ret2, ret2a, currency, tc, nioammount, niostotal, niotax, niointur, niobillpayment, cut, nd, dtype, ipolicy, iquotaqq, iquotano, iquotaexpiration, ncatalog) 
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param(
    "isssssssssssssssssssssssssssssssssi",
    $id, $thebillc, $nfammount, $letters_c, $nfstotal, $nfstotal2, $nftax, $nfintur, $nfinturammount, $nfexempt, $nfexempt2, 
    $type_c, $concept_c, $concept2_c, $billdate_c, $billdate2_c, $ret1, $nfftotal1, $ret2, $nfftotal2, 
    $currency, $tc, $nfnioammount, $nfniostotal, $nfniotax, $nfniointurammount, $nfniobillpayment, $billcut, $nd_c, 
    $dtype_c, $ipolicy_c, $iquotaqq_c, $iquotano_c, $iquotaexpiration_c, $ncatalog
);

$stmt1->execute();


			
}	
	
//Start Manual retentions
$querydeleteretentions = "DELETE FROM manualretentions WHERE payment = ?";
$stmtdeleteretentions = $con->prepare($querydeleteretentions);
$stmtdeleteretentions->bind_param("i", $id);
$stmtdeleteretentions->execute();

if($retainer4 == 1){
	for($c = 0; $c < sizeof($modrettype); $c++){
		
		$thetoday[$c] = date("Y-m-d", strtotime($modrettoday[$c]));  
		
		$queryrets = "INSERT INTO manualretentions (payment, type, today, number, provider, address, ruc, nid, phone, concept, bills, totalbill, percent, totalretention, elaborator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmtrets = $con->prepare($queryrets);
		$stmtrets->bind_param(
    	"isssssssssssdss",
    	$id,
    	$modrettype[$c],
    	$thetoday[$c],
    	$modretno[$c],
    	$modretprovider[$c],
    	$modretaddress[$c],
    	$modretruc[$c],
    	$modretnid[$c],
    	$modretphone[$c],
    	$modretconcept[$c],
    	$modretbills[$c],
    	$modrettotalbill[$c],
    	$modretpercent[$c],
    	$modrettotalretention[$c],
    	$modretelaborator[$c]
		);
		$stmtrets->execute();
  	}
}

//start expiration
if($dspayment == 1){
	$querybills = "SELECT * FROM bills WHERE payment = ? ORDER BY billdate ASC LIMIT 1";
	$stmtbills = $con->prepare($querybills);
	$stmtbills->bind_param("i", $id);
	$stmtbills->execute();
	$resultbills = $stmtbills->get_result();
	$rowbills = $resultbills->fetch_assoc();

	$fecha = $rowbills['billdate'];
	$nuevafecha = strtotime ( '+'.$rowprovider['term'].' day' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	###
	if($nuevafecha >= $today){
		$nuevafecha = strtotime ( '+'.$rowprovider['term'].' day' , strtotime ( $today ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha ); 
	}
	###
	
	$expiration = $nuevafecha; 
	
}
elseif($dspayment == 2){
	//$expiration = date('Y-m-d',strtotime('+30 days', strtotime(date('Y-m-d'))));
	$fecha = date('Y-m-d'); 
	$nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	$expiration = $nuevafecha; 
}

$queryexp = "UPDATE payments SET expiration = ? WHERE id = ?";
$stmtexp = $con->prepare($queryexp);
$stmtexp->bind_param("si", $expiration, $id);
$stmtexp->execute();
//End expiration

//Files 
$fileid = $_POST['fileid'];
$file = $_POST['file'];

#$fileid = isset($_POST['fileid']) ? sanitizeInput(explode(',', $_POST['fileid']), $con) : [];
#$file = isset($_POST['file']) ? sanitizeInput(explode(',', $_POST['file']), $con) : [];

$querydeletef = "UPDATE files SET deletefile = 1 WHERE payment = ?";
$stmtdeletef = $con->prepare($querydeletef);
$stmtdeletef->bind_param("i", $id);
$stmtdeletef->execute();

for($c=0;$c<sizeof($file);$c++){ 

	//si el archivo no existe
	if($file[$c] != ""){
		
		if (($fileid[$c] == '') or ($fileid[$c] == 0)) {
    		$query32 = "INSERT INTO files (payment, link, deletefile) VALUES (?, ?, ?)";
    		$stmt32 = $con->prepare($query32);
    		$deletefile = 0;
    		$stmt32->bind_param("isi", $id, $file[$c], $deletefile);
			$filesStr.=$query32;
		} else {
    		$query32 = "UPDATE files SET link = ?, deletefile = ? WHERE id = ?";
    		$stmt32 = $con->prepare($query32);
    		$deletefile = 0;
    		$stmt32->bind_param("sii", $file[$c], $deletefile, $fileid[$c]);
		}
		
		$stmt32->execute();

	}
	
}

$querydeletef2 = "DELETE FROM files WHERE payment = ? AND deletefile = ?";
$stmtdeletef2 = $con->prepare($querydeletef2);
$deletefile = 1;
$stmtdeletef2->bind_param("ii", $id, $deletefile);
$stmtdeletef2->execute();

#Solvencies
#$solvencyArr = explode(',',$_POST['solvencyfile']); 
$solvencyArr = isset($_POST['solvencyfile']) ? sanitizeInput(explode(',', $_POST['solvencyfile']), $con) : [];
$solvencyfile = $solvencyArr[0];
$solvencylid = $solvencyArr[1];
$solvencyid = $solvencyArr[2];

$querydeletes = "UPDATE paymentsSolvency SET deletefile = ? WHERE payment = ?";
$stmtdeletes = $con->prepare($querydeletes);
$deletefile = 1;
$stmtdeletes->bind_param("ii", $deletefile, $id);
$stmtdeletes->execute();
 
	//If the user doesnt pick a file. 
	if($solvencyfile != ""){ 
		
		if ($solvencyid == 0) {
    		$query33 = "INSERT INTO paymentsSolvency (today, payment, link, linkid, expiration, deletefile) VALUES (?, ?, ?, ?, ?, ?)";
    		$stmt33 = $con->prepare($query33);
    		$deletefile = 0;
    		$stmt33->bind_param("sisssi", $today, $id, $solvencyfile, $solvencylid, $solvency, $deletefile);
		} else {
    		$query33 = "UPDATE paymentsSolvency SET link = ?, linkid = ?, expiration = ?, deletefile = ? WHERE id = ?";
    		$stmt33 = $con->prepare($query33);
    		$deletefile = 0;
    		$stmt33->bind_param("sisii", $solvencyfile, $solvencylid, $solvency, $deletefile, $solvencyid);
		}
		$stmt33->execute();

	}
	
$querydeletef2 = "DELETE FROM paymentsSolvency WHERE payment = ? AND deletefile = ?";
$stmtdeletef2 = $con->prepare($querydeletef2);
$deletefile = 1;
$stmtdeletef2->bind_param("ii", $id, $deletefile);
$stmtdeletef2->execute();
#End Solvencies

//Draft
if($newbutton == "draft"){
	header("location: payments.php");
}
//Save payment
if($newbutton == "save"){
	
	//Fiscal Cut
	$queryglobals = "select * from globals";
	$resultglobals =mysqli_query($con, $queryglobals);
	$rowglobals = mysqli_fetch_array($resultglobals);
	
	//Aqui revisamos si la ruta tiene aprobador de solicitud
	$queryroute = "SELECT * FROM routes WHERE unitid = ? AND headship = ? AND type = ?";
	$stmtroute = $con->prepare($queryroute);
	$type = 20;
	$stmtroute->bind_param("iii", $route, $headship, $type);
	$stmtroute->execute();
	$resultroute = $stmtroute->get_result();
	$numroute = $resultroute->num_rows;

	$arequest = 1;
	$arequest2 = "";
	
    if($numroute > 0){
		$arequest = 0; 
		$arequest2 = " En espera de aprobado.";
	} 
	
	$query1 = "UPDATE payments SET status = ?, arequest = ? WHERE id = ?";
	$stmt1 = $con->prepare($query1);
	$status = 1;
	$stmt1->bind_param("isi", $status, $arequest, $id);
	$stmt1->execute();

	//Times	
	$query2 = "INSERT INTO times (payment, today, now, now2, userid, stage, comment) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt2 = $con->prepare($query2);
	$stage = 1;
	$comment = 'Pago Ingresado';
	$stmt2->bind_param("issssis", $id, $today, $now, $now2, $_SESSION['userid'], $stage, $comment);
	$stmt2->execute();

	$query4 = "UPDATE payments SET sent = ? WHERE id = ?";
	$stmt4 = $con->prepare($query4);
	$sent = 1;
	$stmt4->bind_param("ii", $sent, $id);
	$stmt4->execute();
	
	$gcomments = "Enhorabuena, el paquete ha sido creado.";
	$querytime = "INSERT INTO senttimes (package, today, now, now2, userid, stage, comment) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt = $con->prepare($querytime);
	$stmt->bind_param("isssiss", $id, $today, $now, $now2, $_SESSION['userid'], $stage, $gcomments);
	$stmt->execute();    


	if($immediate == 1){ 
		include('function-getnext.php');
		getNext($id,'1');
		exit("<script>window.location = 'payment-order-view.php?id=$id'; </script>");
	}else{
		header("location: payment-order-view.php?id=".$id); 
	}	
  
}

function numberFormat($unformatedNumber){ 
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}

function findDuplicates($array) {
    $duplicates = array(); // Almacena los valores duplicados
    $counts = array_count_values($array); // Cuenta la frecuencia de cada valor

    foreach ($counts as $value => $count) {
        if ($count > 1) {
            $duplicates[] = $value; // Agregar al array de duplicados si se repite
        }
    }

    return $duplicates; // Devuelve un array con los valores duplicados
}

?>