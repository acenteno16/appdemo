<div id="fid_<? echo $_POST['variable']; ?>">
<div class="col-md-10">
<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();">
<option value=""></option>
<?php 
include('session-request.php');
if (!isset($_SESSION['userid']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_SESSION['userid'])) {
    die("Acceso no autorizado.");
}	

$queryFbox = $con->prepare("select * from filebox where user = ? order by id desc");
$queryFbox->bind_param("s", $_SESSION['userid']);
$queryFbox->execute();
$resultFbox = $queryFbox->get_result();
while($rowFbox=$resultFbox->fetch_assoc()){
	
	$urlFbox = htmlspecialchars($rowFbox['url'], ENT_QUOTES, 'UTF-8');
    $idFbox = htmlspecialchars($rowFbox['id'], ENT_QUOTES, 'UTF-8');
    $titleFbox = htmlspecialchars($rowFbox['title'], ENT_QUOTES, 'UTF-8');
	
?>
<option value="<?php echo '/admin/visor.php?key='.$urlFbox; ?>">
<?php echo $idFbox." | ".$titleFbox; ?></option>
<?php } ?>
</select>
</div>
<div class="col-md-2 ">
<button type="button" class="btn red icn-only" onclick="eliminarFile(<? echo $_POST['variable']; ?>);">-</button>
</div><div class="row"></div>
</div><br>