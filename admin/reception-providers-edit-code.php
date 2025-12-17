<?php include("sessions.php");

$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$term = $_POST['term'];
$ruc = $_POST['ruc'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$contact = $_POST['contact'];
$course = $_POST['course'];
$flag = $_POST['flag'];
$currency = $_POST['currency'];
$international = $_POST['international'];
$active = $_POST['active'];

//
$regime = $_POST['regime'];
$exo1 = $_POST['exo1'];
$exo2 = $_POST['exo2'];
$bank = $_POST['bank'];
$account = $_POST['account'];
$plan = $_POST['plan'];

//
$cname = $_POST['cname'];
$cjob  = $_POST['cjob'];
$cemail = $_POST['cemail'];
$cphone = $_POST['cphone'];
$cmobile = $_POST['cmobile'];

$city = $_POST['city'];
$country = $_POST['country'];
$updated = $_POST['updated']; 
$insurers = $_POST['insurers'];
$cc = $_POST['cc'];
$hall = $_POST['hall'];

$queryprovider = "select * from providers where id = '$id'";
$resultprovider = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$query_code = "select * from providers where code = '$code' and id != '$id'";
$result_code = mysqli_query($con, $query_code);
$num_code = mysqli_num_rows($result_code);

$gcp = $_POST['gcp'];

if($num_code > 0){
	echo "<script>alert('El codigo de proveedor ya existe. Favor consultar codigo en JDEdwards.'); history.go(-1);</script>";
	exit();
}

$query = "update providers set code='$code', name='$name', term='$term', ruc='$ruc', email='$email', address='$address', phone='$phone', cname='$cname', jname='$jname', contact='$contact', course='$course', flag='$flag', currency='$currency', international='$international', active='$active', regime='$regime', imi='$exo1', ir='$exo2', phone='$phone', city='$city', country='$country', updated='$updated', gcp='$gcp', insurers='$insurers', cc = '$cc', hall='$hall' where id='$id'";  
$result = mysqli_query($con, $query);

//Banks while
$baid = $_POST['baid'];

$querypredelete = "update providers_plans set ddelete = '1' where provider = '$id'";
$resultpredelete = mysqli_query($con, $querypredelete);

for($c=0;$c<sizeof($bank);$c++){
	if($baid[$c] > 0){
		$queryu = "update providers_plans set bank='$bank[$c]', account='$account[$c]', plan='$plan[$c]', ddelete = '0' where id = '$baid[$c]'";
	}else{
		$queryu = "insert into providers_plans (provider, bank, account, plan) values ('$id', '$bank[$c]', '$account[$c]', '$plan[$c]')";
	} 
	$resultu = mysqli_query($con, $queryu);
}

$querydelete = "delete from providers_plans where provider = '$id' and ddelete='1'";
$resultdelete = mysqli_query($con, $querydelete);  

//End banks

//Contacts while
$cid = $_POST['cid'];
$cnot = $_POST['cnot'];
$cret = $_POST['cret']; 

$querypredelete = "update providerscontacts set ddelete = '1' where provider = '$id'";
$resultpredelete = mysqli_query($con, $querypredelete);

for($c=0;$c<sizeof($cid);$c++){ 
	if($cid[$c] > 0){ 
		echo $queryu = "update providerscontacts set cname='$cname[$c]', cjob='$cjob[$c]', cemail='$cemail[$c]', cphone='$cphone[$c]', cmobile='$cmobile[$c]', cret='$cret[$c]', cnot='$cnot[$c]', ddelete = '0' where id = '$cid[$c]'";
	}else{
		echo $queryu = "insert into providerscontacts (provider, cname, cjob, cemail, cphone, cmobile, cret, cnot) values ('$id', '$cname[$c]', '$cjob[$c]', '$cemail[$c]', '$cphone[$c]', '$cmobile[$c]', '$cret[$c]', '$cnot[$c]')";
	}
	
	$resultu = mysqli_query($con, $queryu);
}

$querydelete = "delete from providerscontacts where provider = '$id' and ddelete='1'";
$resultdelete = mysqli_query($con, $querydelete); 

//End contacts

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];


//Record

$rowStr = implode(',', 'code, name, ruc, flag, international, currency, active, term, regime, imi, ir, course, phone, city, country, address, updated, gcp, insurer, cc, hall');
$rowStr = explode(',', 'name, id');
$arr = array();
foreach($rowStr as $val){
    if($row[$val] != ${$val}){
        $arr[$val]['old'] = $row[$val];
        $arr[$val]['new'] = ${$val};
   } 
}

$arr = json_encode($arr);
$gcomments = "El proveedor ha sido actualizado.";

$querytime = "insert into providerstimes (provider, today, now, now2, userid, comment, changelog) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$gcomments', '$arr')";   
$resulttime = mysqli_query($con, $querytime);



header("location: providers.php"); 


/*if($row['term'] != $term){
    $arr['term']['old'] = $row['term'];
    $arr['term']['new'] = $term;
}
if($row['ruc'] != $ruc){
    $arr['ruc']['old'] = $row['ruc'];
    $arr['ruc']['new'] = $ruc;
}
if($row['flag'] != $flag){
    $arr['flag']['old'] = $row['flag'];
    $arr['flag']['new'] = $flag;
}
if($row[''] != $){
    $arr['']['old'] = $row[''];
    $arr['']['new'] = $;
}
if($row[''] != $){
    $arr['']['old'] = $row[''];
    $arr['']['new'] = $;
}if($row[''] != $){
    $arr['']['old'] = $row[''];
    $arr['']['new'] = $;
}
if($row[''] != $){
    $arr['']['old'] = $row[''];
    $arr['']['new'] = $;
}
*/

?>