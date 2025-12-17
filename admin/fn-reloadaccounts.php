<? 

include("sessions.php");  

$type = $_POST['type'];
$selector = $_POST['selector'];
$val = $_POST['val'];

$sql = "";
if($selector == 1){
	
	$select_name = "account1";
	
	if($val == 1){
		$sql.= "";	
	}
	if($val == 2){
		$sql.= " and banksaccounts.currency != '1'";
	}
	if($val == 3){
		$sql.= " and banksaccounts.currency != '2'";
	}
	if($val == 4){
		$sql.= "";	
	}
}

if($selector == 2){
	
	$select_name = "account2";
	
	$query_pre = "select company, currency from banksaccounts where id = '$val'";
	$result_pre = mysqli_query($con, $query_pre);
	$row_pre = mysqli_fetch_array($result_pre);
	
	if($type == 1){
		$sql.= " and banksaccounts.company = '$row_pre[company]' and banksaccounts.currency = '$row_pre[currency]'";
	}
	if($type == 2){
		//$sql.= " and banksaccounts.company = '$row_pre[company]' and banksaccounts.currency = '1'";
		$sql.= " and banksaccounts.currency = '1'";
	}
	if($type == 3){
		//$sql.= " and banksaccounts.company = '$row_pre[company]' and banksaccounts.currency = '2'";
		$sql.= " and banksaccounts.currency = '2'";
	}
	if($type == 4){
		$sql.= " and banksaccounts.currency = '$row_pre[currency]'";
	}
	if($type == 5){
		$sql.= " and banksaccounts.currency = '$row_pre[currency]'"; 
	}
	
}

$query_account = "select banks.name, banksaccounts.account2, currency.name, companies.name, banksaccounts.id from banksaccounts inner join banks on banksaccounts.bank = banks.id inner join currency on banksaccounts.currency = currency.id inner join companies on banksaccounts.company = companies.id where banksaccounts.id > '0'$sql order by banksaccounts.company, banks.name, banksaccounts.currency"; 
$result_account = mysqli_query($con, $query_account);
$num_account = mysqli_num_rows($result_account);
$inc = 0;

?>
<select name="<? echo $select_name; ?>" class="form-control" id="<? echo $select_name; ?>" onChange="javascript:clientType(this.value);">
<option value="0" selected>Seleccionar</option> 
<? 

while($row_account=mysqli_fetch_array($result_account)){ ?>

<?  

$close_line = "";

if($row_account[3] != $thiscompany){
	echo "</optgroup>";
}
if(($inc == 0) or ($row_account[3] != $thiscompany)){
	$inc++;
	$thiscompany = $row_account[3];
	
?>
<optgroup label="<? echo $row_account[3]; ?>">  
<? } ?>
<option value="<? echo $row_account[4]; ?>" <? if($rowclient['type'] == 1) echo "selected"; ?>><? echo $row_account[0]." - ".$row_account[1]." (".$row_account[2].")"; ?></option>
<? } ?> 
</select>