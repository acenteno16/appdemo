<? 

include('sessions.php');
include("catalogs.php");

$id = $_POST['id'];
$today = $_POST['today'];
if($today != ''){
	$today = date("Y-m-d", strtotime($today));
}
$batch = $_POST['batch'];
$classification = $_POST['classification'];

$query = "select * from followupLogContent where id = '$id'";
$result = mysqli_query($con, $query);  
$row = mysqli_fetch_array($result);

if($row['status'] == 0){
	
	$queryUpdate = "update followupLogContent set batch2 = '$batch', today2='$today', classification='$classification', status = '1' where id = '$id'";
	$resultUpdate = mysqli_query($con, $queryUpdate);  
	
	$query = "select * from followupLogContent where id = '$id'";
	$result = mysqli_query($con, $query);  
	$row = mysqli_fetch_array($result);
	
}

$row_user = mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[originator]'"));
$row_user2 = mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[conciliator]'"));

?>
<td class="sorting_1"><?php echo $row['id']; ?></td>
<td><? echo $thisCompany[$row['company']]; ?></td>	
<td><? echo $thisBank[$row['bank']]; ?></td>
<td><? echo $thisAccount[$row['account']]; ?></td>
<td><? echo $thisType[$row['type']]; ?></td>
<td><? echo $thisAccount2[$row['account2']]; ?></td>
<td><? echo $row['dday']; ?></td>
<td><? echo $thisDocType[$row['doctype']]; ?></td>
<td><? echo $row['doc']; ?></td>
<td><? echo $row['explanation']; ?></td>
<td><? echo number_format($row['amount'],2); ?></td>
<td><? echo $thisCurrency[$row['currency']]; ?></td>
<td><? echo $row['originator']." | ".$row_user['first'][0].". ".$row_user['last']; ?></td>
<td><? echo $row['batch']; ?></td>
<td><? echo $row['conciliator']." | ".$row_user2['first'][0].". ".$row_user2['last']; ?></td>
<td><input type="text" class="form-control" id="batch_<? echo $row['id']; ?>" value="<? echo $row['batch2']; ?>" <? if($row['batch2'] != '') echo 'readonly'; ?> ></td>
<td><input type="text" class="form-control <? if($row['status'] == 0) echo 'date-picker'; ?>" id="today_<? echo $row['id']; ?>" value="<? 
									if($row['today2'] != '0000-00-00'){
										echo date("d-m-Y", strtotime($row['today2']));
									}		
									?>" readonly></td>
<td><? if($row['status'] == 0){ ?><select id="classification_<? echo $row['id']; ?>" class="form-control">
									<option value="0" selected>Seleccionar</option> 
								<? $queryClassification = "select id, name from followupLogClassification";
									$resultClassification = mysqli_query($con, $queryClassification);
									while($rowClassification=mysqli_fetch_array($resultClassification)){ ?>
										<option value='<? echo $rowClassification['id']; ?>' <? if($rowClassification['id'] == $row['classification']) echo 'selected'; ?>><? echo $rowClassification['name']; ?></option>
									<? } ?>
									</select>
									<? }else{  
									
									$queryClassification = "select id, name from followupLogClassification where id = '$row[classification]'";
									$resultClassification = mysqli_query($con, $queryClassification);
									$rowClassification=mysqli_fetch_array($resultClassification);
									?>
									<input type="text" class="form-control" id="classification_<? echo $row['id']; ?>" value="<? echo $rowClassification['name']; ?>" readonly>
									<? } ?></td>	
<td width="700px">
<? 
$permit = 0;
if(($_SESSION['admin'] == 'active') or ($_SESSION['userid'] == $row['conciliator'])){
	$permit = 1;
}
if(($row['status'] == 0) and ($permit == 1)){ ?><a href="javascript:saveAction(<? echo $row['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-refresh"></i></a><? } ?>
<a data-toggle="modal" href="#long<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i></a>								
</td>