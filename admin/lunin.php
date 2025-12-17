<h1>Diego and Santi Calculator</h1>

<? 


$diego = $_GET['uno'];
$santi = $_GET['dos'];
$suyen = $_GET['suyen'];
$jairo = '';

if($suyen == 1){
	$jairo = $santi+$diego;
}
if($suyen == 2){
	$jairo = $santi-$diego;
}
if($suyen == 3){
	$jairo = $santi*$diego;
}
if($suyen == 4){
	$jairo = $santi/$diego;
}

?>

<form method="get" action="<? echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<input type="text" name="uno" value="<? echo $diego; ?>">
<select name="suyen">
<option value="1">+</option>
	<option value="2">-</option>
	<option value="3">*</option>
	<option value="4">/</option>
</select>
<input type="text" name="dos" value="<? echo $santi; ?>"> 
<button type="submit">=</button>
<input type="text" name="tres" value="<? echo $jairo; ?>" readonly>
</form>
