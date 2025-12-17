<?

include('session-bankingDebt.php');

?>

<? 

/*
$queryRecords = "select * from bankingDebtRecords where bankingDebt = '$id' group by ";
$resultRecords = mysqli_query($con, $queryRecords);
$rowRecords=mysqli_fetch_array($resultRecords);	*/
	
$queryRecords = "select * from bankingDebtRecords where bankingDebt = '$id' and transaction = '$rowTransaction[id]'";
$resultRecords = mysqli_query($con, $queryRecords);
$numRecords = mysqli_num_rows($resultRecords);
	
if($numRecords == 0){ ?>
	<div class="note note-danger">NOTA: No se encontró contabilización para la documentación.</div>
<?
}else{ ?>
<div class="row">
<div class="col-md-3 ">
  <div class="form-group">
    <label>Batch</label>
  </div>
</div>
<div class="col-md-3 ">
  <div class="form-group">
    <label>Documento(s):</label>
  </div>
</div>
<div class="col-md-4 ">
  <div class="form-group">
    <label>Archivo:</label>
  </div>
</div>	
<?	
while($rowRecords=mysqli_fetch_array($resultRecords)){
?>
	<div class="row"></div>
<div class="col-md-3 ">
  <div class="form-group">
    <input name="nobatch[]" type="text" class="form-control" id="batch[]" value="<? echo $rowRecords['batch']; ?>" readonly>
  </div>
</div>
<div class="col-md-3 ">
  <div class="form-group">
    <input name="nodocument[]" type="text" class="form-control" id="document[]" value="<? echo $rowRecords['document']; ?>" readonly>
  </div>
</div>
<div class="col-md-3 ">
  <div class="form-group">
    <div class="input-group" id="nofileText">
      <input type="text" id="nofileUrl" name="nofileUrl[]" class="form-control" value="<? echo $rowRecords['url'];  ?>" readonly>
      <span class="input-group-addon"> <a href="<? echo $rowRecords['url'];  ?>" target="_blank"><i class="fa fa-search"></i></a> </span> </div>
  </div>
</div>

<? } ?>
</div>
<? } ?>	
