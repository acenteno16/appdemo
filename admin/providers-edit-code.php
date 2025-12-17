<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "providers"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
}

require('functions.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$code = sanitizeInput($_POST['code'], $con);
$name = sanitizeInput($_POST['name'], $con);
$term = sanitizeInput($_POST['term'], $con);
$ruc = sanitizeInput($_POST['ruc'], $con);
$address = sanitizeInput($_POST['address'], $con);
$phone = sanitizeInput($_POST['phone'], $con);
$contact = sanitizeInput($_POST['contact'], $con);
$course = sanitizeInput($_POST['course'], $con);
$flag = sanitizeInput($_POST['flag'], $con);
$currency = sanitizeInput($_POST['currency'], $con);
$international = sanitizeInput($_POST['international'], $con);
$active = sanitizeInput($_POST['active'], $con);
$regime = sanitizeInput($_POST['regime'], $con);
$exo1 = sanitizeInput($_POST['exo1'], $con);
$exo2 = sanitizeInput($_POST['exo2'], $con);
$bank = isset($_POST['bank']) ? $_POST['bank'] : [];
$account = sanitizeInput($_POST['account'], $con);
$plan = sanitizeInput($_POST['plan'], $con);
$cname = sanitizeInput($_POST['cname'], $con);
$cjob  = sanitizeInput($_POST['cjob'], $con);
$cemail = sanitizeInput($_POST['cemail'], $con);
$cphone = sanitizeInput($_POST['cphone'], $con);
$cmobile = sanitizeInput($_POST['cmobile'], $con);
$city = sanitizeInput($_POST['city'], $con);
$country = sanitizeInput($_POST['country'], $con);
$updated = sanitizeInput($_POST['updated'], $con); 
$insurers = sanitizeInput($_POST['insurers'], $con);
$cc = sanitizeInput($_POST['cc'], $con);
$hall = sanitizeInput($_POST['hall'], $con);
$hc = sanitizeInput($_POST['hc'], $con);
$gcp = sanitizeInput($_POST['gcp'], $con);
$baid = sanitizeInput($_POST['baid'], $con);

$docId = $_POST['docId'] ? sanitizeInput($_POST['docId'], $con) : [];
$docType = $_POST['docType'] ? sanitizeInput($_POST['docType'], $con) : [];
$docUrl = $_POST['docUrl'] ? sanitizeInput($_POST['docUrl'], $con) : [];
$docExpiration = $_POST['docDate'] ? sanitizeInput($_POST['docDate'], $con) : [];

$errDC = 0;
$docsStr='';
	
$thisDocType = array();	
$queryDocType = "select * from providersDocsTypes";
$resultDocType = mysqli_query($con, $queryDocType);
while($rowDocType=mysqli_fetch_array($resultDocType)){
	$thisDocType[$rowDocType['id']]= $rowDocType['name'];
 }

#if($_SESSION['email'] == 'jairovargasg@gmail.com'){
	
	for($c=0;$c<sizeof($docType);$c++){
		
		$d = $c+1;
		#Validation
		$docTypeArr = explode(',',$docType[$c]);
		
		if (empty($docUrl[$c])) {
			$errDC++;
    		$docsStr.= "Documentos: En la fila $d se require una URL.\\n";
		} else {
    		$url = trim($docUrl[$c]);

    		// Validar que sea una URL bien formada
    		if (!filter_var($url, FILTER_VALIDATE_URL)) {
					$errDC++;
					$docsStr.= "Documentos: En la fila $d se require una URL válida.\\n";
			} else {
				// Extraer el dominio del URL
				$host = parse_url($url, PHP_URL_HOST);

				// Validar dominio exacto (puede incluir subdominios si querés)
				if ($host !== 'getpay.casapellas.com.ni') {
					$errDC++;
					$docsStr.= "Documentos: En la fila $d la URL debe pertenecer al dominio getpay.casapellas.com.ni.\\n";
				}
    		}
		} 

		
		if(($docTypeArr[1] == 1)){ 
			
			if (empty($docExpiration[$c])) {
				$errDC++;
				$docsStr.= "Documentos: En la fila $d falta fecha de expiración.\\n";
			} else {
				
				$dateStr = trim($docExpiration[$c]);
				$date = DateTime::createFromFormat('d-m-Y', $dateStr);
				$validDate = $date && $date->format('d-m-Y') === $dateStr;
				
				if (!$validDate) {
					$errDC++;
					$docsStr.= "Documentos: En la fila $d la fecha de expiración es invalida.\\n";
				}
				
			}
			
			
		}
		

	}
	
	if($errDC > 0){
		exit("<script>alert('$docsStr');  
		try { sessionStorage.setItem('returningFromProcessor', '1'); } catch (e) {}
  		history.go(-1);
  		</script>");
		
	}
	
	$queryDocsPreDelete = "update providersDocs set ddelete = '1' where provider = '$id'";
	$resultDocsPreDelete = mysqli_query($con, $queryDocsPreDelete);

	for($c=0;$c<sizeof($docType);$c++){
		
		$docTypeArr2 = explode(',',$docType[$c]);
		
		$ttoday = date('Y-m-d');
		$ttotime = date('H:i:s');
		$thisExpiration = '';
		if($docExpiration[$c] != ''){
			$thisExpiration = date('Y-m-d', strtotime(str_replace('/', '-', trim($docExpiration[$c]))));
		}
		
		if($docId[$c] > 0){
			$queryProvidersDocs = "update providersDocs set type='$docTypeArr2[0]', url='$docUrl[$c]', lastupdate='$ttoday', lastuptime='$ttotime', expiration='$thisExpiration', ddelete='0' where id = '$docId[$c]'";
		}else{
			$queryProvidersDocs = "insert into providersDocs (provider, type, url, today, totime, expiration, ddelete) values ('$id', '$docTypeArr2[0]', '$docUrl[$c]', '$ttoday', '$ttotime', '$thisExpiration', '0')";
		}
		
		$resultProvidersDocs = mysqli_query($con, $queryProvidersDocs); 
		
	}
	
	$queryDocsDelete = "delete from providersDocs where ddelete = '1' and provider = '$id'";
	$resultDocsDelete = mysqli_query($con, $queryDocsDelete);
	
#}

$query = $con->prepare("select * from providers where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
 
$queryCode = $con->prepare("select * from providers where code = ? and id != ?");
$queryCode->bind_param("si", $code,$id);
$queryCode->execute();
$resultCode = $queryCode->get_result();
$numCode = $resultCode->num_rows;
if($numCode > 0){
	echo "<script>alert('El codigo de proveedor ya existe. Favor consultar codigo en JDEdwards.'); history.go(-1);</script>";
	exit();
}

#$query = "update providers set code='$code', name='$name', term='$term', ruc='$ruc', email='$email', address='$address', phone='$phone', cname='$cname', jname='$jname', contact='$contact', course='$course', flag='$flag', currency='$currency', international='$international', active='$active', regime='$regime', imi='$exo1', ir='$exo2', phone='$phone', city='$city', country='$country', updated='$updated', gcp='$gcp', insurers='$insurers', cc = '$cc', hall='$hall', hc='$hc' where id='$id'";  
#$result = mysqli_query($con, $query);

$query = "UPDATE providers 
          SET code = ?, name = ?, term = ?, ruc = ?, email = ?, address = ?, phone = ?, cname = ?, 
              jname = ?, contact = ?, course = ?, flag = ?, currency = ?, international = ?, active = ?, 
              regime = ?, imi = ?, ir = ?, city = ?, country = ?, updated = ?, gcp = ?, insurers = ?, 
              cc = ?, hall = ?, hc = ?
          WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param(
    "ssssssssssssssssssssssssssi",
    $code, $name, $term, $ruc, $email, $address, $phone, $cname, $jname, $contact, $course,
    $flag, $currency, $international, $active, $regime, $exo1, $exo2, $city, $country,
    $updated, $gcp, $insurers, $cc, $hall, $hc, $id
);
$stmt->execute();

$querypredelete = "update providers_plans set ddelete = '1' where provider = '$row[id]'";
$resultpredelete = mysqli_query($con, $querypredelete);

for($c=0;$c<sizeof($bank);$c++){
	
	$thisBank = isset($bank[$c]) ? sanitizeInput($bank[$c], $con) : 0;
	$thisAccount = isset($account[$c]) ? sanitizeInput($account[$c], $con) : 0;
	$thisPlan = isset($plan[$c]) ? sanitizeInput($plan[$c], $con) : 0;
	$thisId = isset($baid[$c]) ? sanitizeInput($baid[$c], $con) : 0;
	
	if($baid[$c] > 0){
		#$queryu = "update providers_plans set bank='$bank[$c]', account='$account[$c]', plan='$plan[$c]', ddelete = '0' where id = '$baid[$c]'";
		$queryu = "UPDATE providers_plans 
           SET bank = ?, account = ?, plan = ?, ddelete = '0' 
           WHERE id = ?";
		$stmtu = $con->prepare($queryu);
		$stmtu->bind_param("sssi", $thisBank, $thisAccount, $thisPlan, $thisId);
	}else{
		#$queryu = "insert into providers_plans (provider, bank, account, plan) values ('$row[id]', '$bank[$c]', '$account[$c]', '$plan[$c]')";
		$queryu = "INSERT INTO providers_plans (provider, bank, account, plan) 
           VALUES (?, ?, ?, ?)";
		$stmtu = $con->prepare($queryu);
		$stmtu->bind_param("isss", $row['id'], $thisBank, $thisAccount, $thisPlan);
	} 
	$stmtu->execute();
}

$querydelete = "delete from providers_plans where provider = '$row[id]' and ddelete='1'";
$resultdelete = mysqli_query($con, $querydelete);  

//Contacts while
$cid = isset($_POST['cid']) ? $_POST['cid'] : [];
$cnot = $_POST['cnot'];
$cret = $_POST['cret']; 

$queryPreDelete = $con->prepare("update providerscontacts set ddelete = '1' where provider = ?");
$queryPreDelete->bind_param("i", $id);
$queryPreDelete->execute();

for($c=0;$c<sizeof($cid);$c++){ 
	
	$id = isset($_POST['id']) ? sanitizeInput(intval($_POST['id']), $con) : 0;
	
	$thisCname = sanitizeInput($cname[$c], $con);
	$thisCjob = sanitizeInput($cjob[$c], $con);
	$thisCemail = sanitizeInput($cemail[$c], $con);
	$thisCphone = sanitizeInput($cphone[$c], $con);
	$thisCmobile = sanitizeInput($cmobile[$c], $con);
	$thisCret = sanitizeInput($cret[$c], $con);
	$thisCnot = sanitizeInput($cnot[$c], $con);
	$thisCid = sanitizeInput($cid[$c], $con);
	
	if($cid[$c] > 0){ 
		$queryUpdate = $con->prepare("update providerscontacts set cname=?, cjob=?, cemail=?, cphone=?, cmobile=?, cret=?, cnot=?, ddelete = '0' where id = ?");
		$queryUpdate->bind_param("sssssssi", $thisCname,$thisCjob,$thisCemail,$thisCphone,$thisCmobile,$thisCret,$thisCnot,$thisCid); 
	}else{
		$queryUpdate = $con->prepare("insert into providerscontacts (provider, cname, cjob, cemail, cphone, cmobile, cret, cnot) values (?, ?, ?, ?, ?, ?, ?, ?)");
		$queryUpdate->bind_param("isssssss", $id,$thisCname,$thisCjob,$thisCemail,$thisCphone,$thisCmobile,$thisCret,$thisCnot);
	}
	
	$queryUpdate->execute();
}

$queryDelete = $con->prepare("delete from providerscontacts where provider = ? and ddelete='1'");
$queryDelete->bind_param("i", $id);
$queryDelete->execute();

//End contacts

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];

#newRow
$queryNewData = $con->prepare("select * from providers where id = ?");
$queryNewData->bind_param("i", $id);
$queryNewData->execute();
$resultNewData = $queryNewData->get_result();
$newRow = $resultNewData->fetch_assoc();

$oldRow = json_encode($row);
$newRow = json_encode($newRow);

$gcomments = "El proveedor ha sido actualizado.";
$querytime = "insert into providerstimes (provider, today, now, now2, userid, comment, oldquery, newquery) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$gcomments', '$oldRow', '$newRow')";   
$resulttime = mysqli_query($con, $querytime);

header("location: providers.php");

?>