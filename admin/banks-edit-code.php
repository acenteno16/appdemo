<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('headers.php');
$allowedRoles = ['admin', 'banks', 'bankingDebt']; 
require("sessionCheck.php"); 
include('functions.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : '';

$stmtUpdate = $con->prepare("UPDATE banks SET name = ? WHERE id = ?");
$stmtUpdate->bind_param("si", $name, $id);
$stmtUpdate->execute();
$stmtUpdate->close();

if ($_FILES['file1']['name'] != ""){
	move_uploaded_file ( $_FILES [ 'file1' ][ 'tmp_name' ], '/banks/'.$id.".jpg"); 
}

// Sanitizar los arrays usando tu función sanitizeInput
$aid = isset($_POST['aid']) ? sanitizeInput($_POST['aid'], $con) : [];
$account = isset($_POST['account']) ? sanitizeInput($_POST['account'], $con) : [];
$account2 = isset($_POST['account2']) ? sanitizeInput($_POST['account2'], $con) : [];
$aname = isset($_POST['aname']) ? sanitizeInput($_POST['aname'], $con) : [];
$company = isset($_POST['company']) ? sanitizeInput($_POST['company'], $con) : [];
$currency = isset($_POST['currency']) ? sanitizeInput($_POST['currency'], $con) : [];
$abank = isset($_POST['abank']) ? sanitizeInput($_POST['abank'], $con) : [];
$alid = isset($_POST['alid']) ? sanitizeInput($_POST['alid'], $con) : [];
$plan = isset($_POST['plan']) ? sanitizeInput($_POST['plan'], $con) : [];

for($b=0;$b<sizeof($aname);$b++){

	$queryAl = "INSERT INTO banksalias (bank, bybank, name, userid) VALUES (?, ?, ?, ?)";
	$stmtAl = $con->prepare($queryAl);
	$stmtAl->bind_param("isss", $id, $abank[$b], $aname[$b], $_SESSION['userid']);
	$stmtAl->execute();
	
}

for($c=0;$c<sizeof($account);$c++){
	
		$stmtAccount = $con->prepare("insert into banksaccounts (company, account, account2, aname, currency, bank, plan, ddelete) values (?, ?, ?, ?, ?, ?, ?, '0')");
		$stmtAccount->bind_param("ssssiis", $company[$c], $account[$c], $account2[$c], $aname[$c],$currency[$c],$id,$plan[$c]);
		$stmtAccount->execute();
		$stmtAccount->close();
}

 
header("location: banks-edit.php?id=".$id."&changes=1");

?>