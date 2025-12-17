<? 

require("session-request.php");  
require('functions.php');

$id = isset($_POST['id']) ? sanitizeInput($_POST['id'], $con) : '';
$hc = isset($_POST['hc']) ? sanitizeInput($_POST['hc'], $con) : '';

$query = "select * from hcTemplates where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$queryHc = "select * from hcTemplates where id = ?";
$stmtHc = $con->prepare($queryHc);
$stmtHc->bind_param("i", $hc);
$stmtHc->execute();
$resultHc = $stmtHc->get_result();
$rowHc = $resultHc->fetch_assoc();


$amounts = $rowHc['templateData'];
$amountArr = explode(',', $amounts);
for($a=0;$a<=sizeof($amountArr);$a++){
	$vals = explode(':', $amountArr[$a]);
	$thisVaue[$vals[0]] = $vals[1];
}

if($row['type'] == 4){
	echo '<div class="row"></div><div class="col-md-4"><label>Beneficiario:</label></div><div class="col-md-4"><label>Colaborador:</label></div><div class="col-md-2"><label>Monto:</label></div>';
}else{
	echo '<div class="row"></div><div class="col-md-8"><label>Beneficiario:</label></div><div class="col-md-2"><label>Monto:</label></div>';
}
	
$queryContent = "select * from hcTemplatesContent where template = '$row[id]'";
$resultContent = mysqli_query($con, $queryContent);
while($rowContent=mysqli_fetch_array($resultContent)){
	
	$cId = $rowContent['id'];
		
	$benArr = explode(',',$rowContent['ben']);
	$queryBen = "select * from providers where id = '$benArr[0]'";
	$resultBen = mysqli_query($con, $queryBen);
	$rowBen = mysqli_fetch_array($resultBen);
	if($rowBen['flag'] == 1){
		$ben = "$rowBen[code] | $rowBen[name]";
	}else{
		$ben = "$rowBen[code] | $rowBen[name]";
	}
	$theId = $benArr[0];
	$benStr = '<div class="col-md-4"><input type="text" name="ben[]" class="form-control" value="'.$ben.'" readonly></div>';	
	$queryBen = "select * from workers where id = '$benArr[1]'";
	$resultBen = mysqli_query($con, $queryBen);
	$rowBen=mysqli_fetch_array($resultBen);
	$ben= "$rowBen[code] | $rowBen[first] $rowBen[last]";
	$theId.= ','.$benArr[1]; 
	$benStr.= '<div class="col-md-4"><input type="hidden" name="tcid[]" value="'.$cId.'"><input type="hidden" name="bid[]" value="'.$theId.'"> <input type="text" name="ben2[]" class="form-control" value="'.$ben.'" readonly></div>';	
 ?>
<div class="row"></div><br>
	
	<? echo $benStr; ?>
	<div class="col-md-2"> <input type="text" name="sAmount[]"  class="form-control" value="<? echo $thisVaue[$cId]; ?>" onKeyUp="calculateTotal();" onkeypress="return justNumbers(event);"></div>

<? } ?>